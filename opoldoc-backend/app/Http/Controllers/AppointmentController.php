<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\MedicalBackground;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 15);
        if ($perPage < 1) {
            $perPage = 15;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
        ]);

        $query = Appointment::with(['patient', 'doctor', 'queue', 'services']);

        $currentUser = $request->user();

        if ($currentUser && $currentUser->role === 'patient') {
            $query->whereIn('patient_id', $currentUser->accessiblePatientIds());
        } elseif ($request->filled('patient_id')) {
            $query->where('patient_id', $request->query('patient_id'));
        }

        if ($request->filled('doctor_id')) {
            $query->where('doctor_id', $request->query('doctor_id'));
        }

        if ($request->filled('appointment_type')) {
            $query->where('appointment_type', $request->query('appointment_type'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        if ($request->boolean('queue_request_only')) {
            $query->where('appointment_type', 'scheduled')->whereNull('appointment_datetime');
        }

        if ($request->boolean('upcoming_only')) {
            $query->whereNotNull('appointment_datetime')
                ->where('appointment_datetime', '>=', now());
        }

        if ($request->filled('start_date') || $request->filled('end_date')) {
            $startRaw = $request->query('start_date', null);
            $endRaw = $request->query('end_date', null);

            $start = $startRaw ? Carbon::parse($startRaw)->startOfDay() : null;
            $end = $endRaw ? Carbon::parse($endRaw)->endOfDay() : null;

            if (! $start && $end) {
                $start = $end->copy()->startOfDay();
            }
            if ($start && ! $end) {
                $end = $start->copy()->endOfDay();
            }

            if ($start && $end) {
                $query->whereNotNull('appointment_datetime')
                    ->whereBetween('appointment_datetime', [$start, $end]);
            }
        }

        return $query
            ->orderByRaw('appointment_datetime IS NULL ASC')
            ->orderBy('appointment_datetime')
            ->orderByDesc('appointment_id')
            ->paginate($perPage);
    }

    public function store(Request $request)
    {
        $currentUser = $request->user();
        $isPatient = $currentUser && $currentUser->role === 'patient';

        $queueRequest = $request->boolean('queue_request');

        $data = $request->validate([
            'patient_id' => [$isPatient ? 'sometimes' : 'required', 'exists:users,user_id'],
            'doctor_id' => ['required', 'exists:users,user_id'],
            'appointment_datetime' => ['nullable', 'date'],
            'appointment_type' => ['required', 'in:walk_in,scheduled'],
            'status' => ['nullable', 'in:pending,confirmed,completed,cancelled,no_show'],
            'reason_for_visit' => ['nullable', 'string'],
            'priority_level' => ['nullable', 'integer'],
            'service_id' => [$isPatient ? 'required' : 'nullable', 'exists:services,service_id'],
        ]);

        if ($isPatient) {
            $targetPatientId = $currentUser->user_id;
            if ($request->filled('patient_id')) {
                $candidate = (int) $request->input('patient_id');
                if (! $currentUser->canAccessPatientId($candidate)) {
                    abort(403);
                }
                $targetPatientId = $candidate;
            }

            $data['patient_id'] = $targetPatientId;
            $data['appointment_type'] = 'scheduled';
        }

        if ($data['appointment_type'] === 'scheduled' && ! $queueRequest && ! array_key_exists('appointment_datetime', $data)) {
            return response()->json([
                'message' => 'Appointment datetime is required.',
            ], 422);
        }

        $serviceId = $data['service_id'] ?? null;
        unset($data['service_id']);

        if (! empty($data['appointment_datetime'])) {
            $dt = Carbon::parse($data['appointment_datetime']);
            $doctorId = (int) ($data['doctor_id'] ?? 0);

            $dayKey = strtolower($dt->format('D'));
            $timeValue = $dt->format('H:i:s');

            $schedule = DoctorSchedule::query()
                ->where('doctor_id', $doctorId)
                ->whereTime('start_time', '<=', $timeValue)
                ->whereTime('end_time', '>', $timeValue)
                ->whereHas('days', function ($q) use ($dayKey) {
                    $q->where('day_of_week', $dayKey);
                })
                ->orderBy('start_time')
                ->first();

            if (! $schedule) {
                return response()->json([
                    'message' => 'Doctor is not available at the selected time.',
                    'code' => 'DOCTOR_NOT_AVAILABLE',
                ], 422);
            }

            if ($schedule->max_patients) {
                $slotStart = $dt->copy()->setTimeFromTimeString((string) $schedule->start_time);
                $slotEnd = $dt->copy()->setTimeFromTimeString((string) $schedule->end_time);

                $booked = Appointment::query()
                    ->where('doctor_id', $doctorId)
                    ->whereNotNull('appointment_datetime')
                    ->where('status', '!=', 'cancelled')
                    ->where('appointment_datetime', '>=', $slotStart)
                    ->where('appointment_datetime', '<', $slotEnd)
                    ->count();

                if ($booked >= (int) $schedule->max_patients) {
                    return response()->json([
                        'message' => 'Selected time slot is fully booked.',
                        'code' => 'SLOT_FULL',
                    ], 422);
                }
            }

            if ($serviceId) {
                $service = Service::query()->find($serviceId);
                $doctor = User::query()->find($doctorId);

                if ($service && $doctor) {
                    $serviceName = (string) ($service->service_name ?? '');
                    $serviceCategory = strtolower(trim(explode(':', $serviceName, 2)[0] ?? $serviceName));
                    $doctorSpec = strtolower(trim((string) ($doctor->specialization ?? '')));

                    $serviceCategory = trim($serviceCategory);
                    $doctorSpec = trim($doctorSpec);

                    if ($serviceCategory !== '' && $doctorSpec !== '') {
                        $matches = str_contains($doctorSpec, $serviceCategory) || str_contains($serviceCategory, $doctorSpec);
                        if (! $matches) {
                            return response()->json([
                                'message' => 'Selected doctor does not match the chosen service.',
                                'code' => 'SPECIALIZATION_MISMATCH',
                            ], 422);
                        }
                    }
                }
            }
        }

        if ($data['appointment_type'] === 'scheduled') {
            $patientId = (int) ($data['patient_id'] ?? 0);
            $hasMedicalBackground = $patientId > 0
                ? MedicalBackground::query()->where('patient_id', $patientId)->exists()
                : false;

            if (! $hasMedicalBackground) {
                return response()->json([
                    'message' => 'Medical background is required before booking an appointment.',
                    'code' => 'MEDICAL_BACKGROUND_REQUIRED',
                ], 428);
            }
        }

        $data['created_by'] = $request->user()->user_id ?? null;

        if (! isset($data['status'])) {
            $data['status'] = 'pending';
        }

        if ($data['appointment_type'] === 'walk_in' && (! isset($data['appointment_datetime']) || $data['appointment_datetime'] === null)) {
            $data['appointment_datetime'] = now();
        }

        $appointment = DB::transaction(function () use ($data, $serviceId) {
            $appointment = Appointment::create($data);
            if ($serviceId) {
                $appointment->services()->sync([(int) $serviceId]);
            }
            return $appointment;
        });

        return response()->json($appointment->load(['patient', 'doctor', 'services']), 201);
    }

    public function show(Appointment $appointment)
    {
        $currentUser = request()->user();
        if ($currentUser && $currentUser->role === 'patient') {
            if (! $currentUser->canAccessPatientId((int) $appointment->patient_id)) {
                abort(403);
            }
        }

        return $appointment->load(['patient', 'doctor', 'queue', 'transaction', 'services']);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $data = $request->validate([
            'patient_id' => ['sometimes', 'exists:users,user_id'],
            'doctor_id' => ['sometimes', 'exists:users,user_id'],
            'appointment_datetime' => ['sometimes', 'date'],
            'appointment_type' => ['sometimes', 'in:walk_in,scheduled'],
            'status' => ['sometimes', 'in:pending,confirmed,completed,cancelled,no_show'],
            'reason_for_visit' => ['sometimes', 'nullable', 'string'],
            'priority_level' => ['sometimes', 'integer'],
            'check_in_time' => ['sometimes', 'nullable', 'date'],
        ]);

        $appointment->update($data);

        return $appointment->refresh()->load(['patient', 'doctor', 'queue', 'transaction', 'services']);
    }

    public function destroy(Appointment $appointment)
    {
        $currentUser = request()->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $appointment->delete();

        return response()->json([
            'message' => 'Appointment deleted',
        ]);
    }
}

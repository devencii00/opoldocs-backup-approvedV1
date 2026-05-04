<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Conversation;
use App\Models\DoctorSchedule;
use App\Models\LogEntry;
use App\Models\MedicalBackground;
use App\Models\Message;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
            'search' => ['nullable', 'string'],
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

        $search = trim((string) $request->query('search', ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('reason_for_visit', 'like', '%'.$search.'%');

                if (is_numeric($search)) {
                    $q->orWhere('appointment_id', (int) $search);
                }

                $q->orWhereHas('patient', function ($p) use ($search) {
                    $p->where('email', 'like', '%'.$search.'%')
                        ->orWhere('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->orWhere('middlename', 'like', '%'.$search.'%')
                        ->orWhere('contact_number', 'like', '%'.$search.'%');
                });

                $q->orWhereHas('doctor', function ($d) use ($search) {
                    $d->where('email', 'like', '%'.$search.'%')
                        ->orWhere('firstname', 'like', '%'.$search.'%')
                        ->orWhere('lastname', 'like', '%'.$search.'%')
                        ->orWhere('middlename', 'like', '%'.$search.'%')
                        ->orWhere('license_number', 'like', '%'.$search.'%')
                        ->orWhere('specialization', 'like', '%'.$search.'%');
                });
            });
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
        $isReceptionist = $currentUser && $currentUser->role === 'receptionist';

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

        $doctor = User::query()->find((int) $data['doctor_id']);
        if (! $doctor || $doctor->role !== 'doctor') {
            return response()->json([
                'message' => 'Selected doctor is invalid.',
                'code' => 'INVALID_DOCTOR',
            ], 422);
        }
        if ($this->isDoctorUnavailable((int) $doctor->user_id)) {
            return response()->json([
                'message' => 'Doctor is currently unavailable.',
                'code' => 'DOCTOR_UNAVAILABLE',
            ], 422);
        }

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

        if ($data['appointment_type'] === 'scheduled' && ! $queueRequest && empty($data['appointment_datetime'])) {
            return response()->json([
                'message' => 'Appointment datetime is required.',
            ], 422);
        }

        $serviceId = $data['service_id'] ?? null;
        unset($data['service_id']);

        $service = null;
        if ($serviceId) {
            $service = Service::query()->find((int) $serviceId);
            if (! $service || $service->is_active === false) {
                return response()->json([
                    'message' => 'Selected service is inactive.',
                    'code' => 'SERVICE_INACTIVE',
                ], 422);
            }
        }

        if (! empty($data['appointment_datetime'])) {
            $dt = Carbon::parse($data['appointment_datetime']);
            $doctorId = (int) ($data['doctor_id'] ?? 0);

            if ($data['appointment_type'] === 'scheduled' && $dt->isPast()) {
                return response()->json([
                    'message' => 'Appointment datetime must be in the future.',
                    'code' => 'DATETIME_IN_PAST',
                ], 422);
            }

            $dayKey = strtolower($dt->format('D'));
            $timeValue = $dt->format('H:i:s');

            $daySchedules = DoctorSchedule::query()
                ->where('doctor_id', $doctorId)
                ->where('day_of_week', $dayKey)
                ->where('is_available', true)
                ->orderBy('start_time')
                ->get();

            if ($daySchedules->isEmpty()) {
                return response()->json([
                    'message' => 'Doctor is not available at the selected time.',
                    'code' => 'DOCTOR_NOT_AVAILABLE',
                ], 422);
            }

            $slotMinutes = 90;
            $intervals = [];

            foreach ($daySchedules as $row) {
                $startStr = (string) $row->start_time;
                $endStr = (string) $row->end_time;

                $startStr = str_contains($startStr, ':') ? $startStr : '';
                $endStr = str_contains($endStr, ':') ? $endStr : '';
                if ($startStr === '' || $endStr === '') {
                    continue;
                }

                $startTime = Carbon::createFromFormat('H:i:s', substr($startStr, 0, 8));
                $endTime = Carbon::createFromFormat('H:i:s', substr($endStr, 0, 8));

                $startMin = ((int) $startTime->format('H')) * 60 + (int) $startTime->format('i');
                $endMin = ((int) $endTime->format('H')) * 60 + (int) $endTime->format('i');

                if ($endMin <= $startMin) {
                    continue;
                }

                $intervals[] = [$startMin, $endMin];
            }

            usort($intervals, fn ($a, $b) => $a[0] <=> $b[0]);

            $merged = [];
            foreach ($intervals as $interval) {
                if (empty($merged)) {
                    $merged[] = $interval;
                    continue;
                }
                $lastIdx = count($merged) - 1;
                [$ls, $le] = $merged[$lastIdx];
                [$cs, $ce] = $interval;
                if ($cs <= $le) {
                    $merged[$lastIdx] = [$ls, max($le, $ce)];
                } else {
                    $merged[] = $interval;
                }
            }

            $selectedMin = ((int) $dt->format('H')) * 60 + (int) $dt->format('i');
            $allowed = [];
            foreach ($merged as [$startMin, $endMin]) {
                for ($m = $startMin; $m + $slotMinutes <= $endMin; $m += $slotMinutes) {
                    $allowed[$m] = true;
                }
            }

            if (! isset($allowed[$selectedMin])) {
                return response()->json([
                    'message' => 'Selected time slot is not available.',
                    'code' => 'SLOT_INVALID',
                ], 422);
            }

            $slotStart = $dt->copy()->seconds(0);
            $slotEnd = $slotStart->copy()->addMinutes($slotMinutes);

            $existingDoctorAppointments = Appointment::query()
                ->where('doctor_id', $doctorId)
                ->whereNotNull('appointment_datetime')
                ->where('appointment_type', 'scheduled')
                ->where('status', '!=', 'cancelled')
                ->whereDate('appointment_datetime', $slotStart->toDateString())
                ->get(['appointment_id', 'appointment_datetime']);

            foreach ($existingDoctorAppointments as $appt) {
                $existingStart = Carbon::parse((string) $appt->appointment_datetime)->seconds(0);
                $existingEnd = $existingStart->copy()->addMinutes($slotMinutes);
                if ($existingStart->lt($slotEnd) && $existingEnd->gt($slotStart)) {
                    return response()->json([
                        'message' => 'Selected time slot already has an appointment.',
                        'code' => 'DOCTOR_CONFLICT',
                    ], 422);
                }
            }

            $patientId = (int) ($data['patient_id'] ?? 0);
            if ($patientId > 0) {
                $existingPatientAppointments = Appointment::query()
                    ->where('patient_id', $patientId)
                    ->whereNotNull('appointment_datetime')
                    ->where('appointment_type', 'scheduled')
                    ->where('status', '!=', 'cancelled')
                    ->whereDate('appointment_datetime', $slotStart->toDateString())
                    ->get(['appointment_id', 'appointment_datetime']);

                foreach ($existingPatientAppointments as $appt) {
                    $existingStart = Carbon::parse((string) $appt->appointment_datetime)->seconds(0);
                    $existingEnd = $existingStart->copy()->addMinutes($slotMinutes);
                    if ($existingStart->lt($slotEnd) && $existingEnd->gt($slotStart)) {
                        return response()->json([
                            'message' => 'Patient already has an appointment in the selected time slot.',
                            'code' => 'PATIENT_CONFLICT',
                        ], 422);
                    }
                }
            }

            if ($serviceId) {
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

        if ($data['appointment_type'] === 'scheduled' && $isPatient) {
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

        if ($isReceptionist) {
            $data['status'] = 'confirmed';
        } elseif (! isset($data['status'])) {
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

        LogEntry::write(
            optional($request->user())->user_id ? (int) $request->user()->user_id : null,
            'appointment_created',
            'appointments',
            (int) $appointment->appointment_id,
            [
                'patient_id' => (int) $appointment->patient_id,
                'doctor_id' => (int) $appointment->doctor_id,
                'status' => (string) ($appointment->status ?? ''),
            ]
        );

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

        $previousDoctorId = (int) $appointment->doctor_id;

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

        if (array_key_exists('doctor_id', $data)) {
            $doctor = User::query()->find((int) $data['doctor_id']);
            if (! $doctor || $doctor->role !== 'doctor') {
                return response()->json([
                    'message' => 'Selected doctor is invalid.',
                    'code' => 'INVALID_DOCTOR',
                ], 422);
            }
            if ($this->isDoctorUnavailable((int) $doctor->user_id)) {
                return response()->json([
                    'message' => 'Doctor is currently unavailable.',
                    'code' => 'DOCTOR_UNAVAILABLE',
                ], 422);
            }
        }

        $appointment->update($data);

        $appointment->refresh();

        $doctorChanged = array_key_exists('doctor_id', $data) && (int) $appointment->doctor_id !== $previousDoctorId;
        if ($doctorChanged) {
            $appointment->loadMissing(['patient', 'doctor']);
            $newDoctorName = trim(implode(' ', array_filter([
                $appointment->doctor?->firstname,
                $appointment->doctor?->lastname,
            ])));
            if ($newDoctorName === '') {
                $newDoctorName = 'Doctor #'.$appointment->doctor_id;
            }

            $conversation = Conversation::ensureForPatient((int) $appointment->patient_id);

            Message::create([
                'conversation_id' => $conversation->conversation_id,
                'sender' => 'bot',
                'message_text' => 'Your doctor has been reassigned to '.$newDoctorName.'.',
            ]);
        }

        LogEntry::write(
            optional($request->user())->user_id ? (int) $request->user()->user_id : null,
            'appointment_updated',
            'appointments',
            (int) $appointment->appointment_id,
            [
                'fields' => array_keys($data),
            ]
        );

        return $appointment->load(['patient', 'doctor', 'queue', 'transaction', 'services']);
    }

    private function isDoctorUnavailable(int $doctorId): bool
    {
        $payload = Cache::store('file')->get('doctor_availability:'.$doctorId);
        return is_array($payload) && ($payload['is_available'] ?? null) === false;
    }

    public function destroy(Appointment $appointment)
    {
        $currentUser = request()->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $appointment->delete();

        LogEntry::write(
            optional(request()->user())->user_id ? (int) request()->user()->user_id : null,
            'appointment_deleted',
            'appointments',
            (int) $appointment->appointment_id,
            [
                'patient_id' => (int) $appointment->patient_id,
                'doctor_id' => (int) $appointment->doctor_id,
            ]
        );

        return response()->json([
            'message' => 'Appointment deleted',
        ]);
    }
}

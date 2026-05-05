<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Queue;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WalkInController extends Controller
{
    public function index()
    {
        return Appointment::query()
            ->where('appointment_type', 'walk_in')
            ->paginate();
    }

    public function store(Request $request)
    {
        $request->merge([
            'appointment_type' => 'walk_in',
        ]);

        return app(AppointmentController::class)->store($request);
    }

    public function storeGuest(Request $request)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $data = $request->validate([
            'doctor_id' => ['required', 'exists:users,user_id'],
            'service_ids' => ['nullable', 'array'],
            'service_ids.*' => ['integer', 'exists:services,service_id'],
            'appointment_datetime' => ['nullable', 'date'],
            'reason_for_visit' => ['nullable', 'string'],
            'priority_level' => ['nullable', 'integer'],
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'middlename' => ['nullable', 'string'],
            'birthdate' => ['nullable', 'date'],
            'sex' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string'],
        ]);

        $plainPassword = Str::random(12);

        $result = DB::transaction(function () use ($currentUser, $data, $plainPassword) {
            $serviceIds = array_values(array_unique(array_map('intval', $data['service_ids'] ?? [])));

            $patient = User::create([
                'email' => null,
                'password_hash' => Hash::make($plainPassword),
                'role' => 'patient',
                'status' => 'active',
                'firstname' => $data['firstname'] ?? null,
                'lastname' => $data['lastname'] ?? null,
                'middlename' => $data['middlename'] ?? null,
                'birthdate' => $data['birthdate'] ?? null,
                'sex' => $data['sex'] ?? null,
                'address' => $data['address'] ?? null,
                'contact_number' => $data['contact_number'] ?? null,
                'is_first_login' => true,
                'account_activated' => true,
            ]);

            $targetEmail = 'patient'.$patient->user_id.'@mail.com';
            if (User::where('email', $targetEmail)->exists()) {
                $targetEmail = 'patient'.$patient->user_id.'-'.Str::lower(Str::random(4)).'@mail.com';
            }
            $patient->update(['email' => $targetEmail]);

            $appointmentDatetime = ! empty($data['appointment_datetime'])
                ? Carbon::parse($data['appointment_datetime'])
                : now();

            $priorityLevel = Queue::sanitizePriorityLevel($data['priority_level'] ?? null) ?? 5;

            $appointment = Appointment::create([
                'patient_id' => $patient->user_id,
                'doctor_id' => (int) $data['doctor_id'],
                'created_by' => $currentUser?->user_id,
                'appointment_datetime' => $appointmentDatetime,
                'appointment_type' => 'walk_in',
                'status' => 'confirmed',
                'reason_for_visit' => $data['reason_for_visit'] ?? null,
                'priority_level' => $priorityLevel,
            ]);

            if (count($serviceIds)) {
                $appointment->services()->sync($serviceIds);
            }

            $queueAt = now();
            $date = $queueAt->toDateString();
            $max = Queue::whereDate('queue_datetime', $date)->max('queue_number');
            $queueNumber = ((int) $max) + 1;

            $queue = Queue::create([
                'appointment_id' => $appointment->appointment_id,
                'queue_number' => $queueNumber,
                'queue_datetime' => $queueAt,
                'status' => 'waiting',
                'priority_level' => $priorityLevel,
            ]);

            return [
                'patient' => $patient->refresh(),
                'credentials' => [
                    'email' => $patient->email,
                    'password' => $plainPassword,
                    'generated' => true,
                ],
                'appointment' => $appointment->load(['patient', 'doctor', 'services', 'queue']),
                'queue' => $queue->load(['appointment.patient', 'appointment.doctor']),
            ];
        });

        return response()->json($result, 201);
    }

    public function show(Appointment $walk_in)
    {
        if ($walk_in->appointment_type !== 'walk_in') {
            abort(404);
        }

        return $walk_in->load(['patient', 'doctor', 'queue', 'transaction']);
    }
}

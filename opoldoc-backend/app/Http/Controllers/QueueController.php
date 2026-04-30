<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
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

        $query = Queue::with(['appointment.patient', 'appointment.doctor']);

        $currentUser = $request->user();
        $isPatient = $currentUser && $currentUser->role === 'patient';

        if ($isPatient) {
            $query->whereHas('appointment', function ($q) use ($currentUser) {
                $q->whereIn('patient_id', $currentUser->accessiblePatientIds());
            });
        }

        if ($request->filled('doctor_id')) {
            $doctorId = $request->query('doctor_id');
            $query->whereHas('appointment', function ($q) use ($doctorId) {
                $q->where('doctor_id', $doctorId);
            });
        }

        if ($request->filled('date')) {
            $date = $request->query('date');
            $query->whereDate('queue_datetime', $date);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->query('status'));
        }

        $paginator = $query
            ->orderByDesc('queue_datetime')
            ->paginate($perPage);

        $minutesPerPatient = (int) env('QUEUE_MINUTES_PER_PATIENT', 10);
        if ($minutesPerPatient < 1) {
            $minutesPerPatient = 10;
        }
        if ($minutesPerPatient > 120) {
            $minutesPerPatient = 120;
        }

        $paginator->getCollection()->transform(function (Queue $queue) use ($minutesPerPatient) {
            $queue->loadMissing('appointment');

            $doctorId = $queue->appointment ? $queue->appointment->doctor_id : null;
            $date = $queue->queue_datetime ? $queue->queue_datetime->toDateString() : now()->toDateString();

            $priority = (int) ($queue->priority_level ?? 5);
            $number = (int) ($queue->queue_number ?? 999999);

            if (! $doctorId) {
                $queue->position = null;
                $queue->estimated_wait_minutes = null;

                return $queue;
            }

            $aheadCount = Queue::query()
                ->whereHas('appointment', function ($q) use ($doctorId) {
                    $q->where('doctor_id', $doctorId);
                })
                ->whereDate('queue_datetime', $date)
                ->whereIn('status', ['waiting', 'serving'])
                ->where(function ($q) use ($priority, $number) {
                    $q->whereRaw('COALESCE(priority_level, 5) < ?', [$priority])
                        ->orWhere(function ($q) use ($priority, $number) {
                            $q->whereRaw('COALESCE(priority_level, 5) = ?', [$priority])
                                ->whereRaw('COALESCE(queue_number, 999999) < ?', [$number]);
                        });
                })
                ->count();

            $position = $aheadCount + 1;
            $estimatedWait = $queue->status === 'serving' ? 0 : max(0, $aheadCount * $minutesPerPatient);

            $queue->position = $position;
            $queue->estimated_wait_minutes = $estimatedWait;

            return $queue;
        });

        return $paginator;
    }

    public function store(Request $request)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            return response()->json([
                'message' => 'Patients cannot enter the queue directly.',
            ], 403);
        }

        $data = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,appointment_id'],
            'queue_number' => ['nullable', 'integer'],
            'queue_datetime' => ['nullable', 'date'],
            'status' => ['nullable', 'in:waiting,serving,done,cancelled'],
            'priority_level' => ['nullable', 'integer'],
        ]);

        if (Queue::where('appointment_id', $data['appointment_id'])->exists()) {
            return response()->json([
                'message' => 'This appointment is already in the queue.',
            ], 422);
        }

        if (! isset($data['status'])) {
            $data['status'] = 'waiting';
        }

        $queueAt = isset($data['queue_datetime']) ? Carbon::parse($data['queue_datetime']) : now();
        $data['queue_datetime'] = $queueAt;

        if (! isset($data['queue_number']) || $data['queue_number'] === null) {
            $date = $queueAt->toDateString();
            $max = Queue::whereDate('queue_datetime', $date)->max('queue_number');
            $data['queue_number'] = ((int) $max) + 1;
        }

        $queue = Queue::create($data);

        return response()->json($queue->load(['appointment.patient', 'appointment.doctor']), 201);
    }

    public function join(Request $request)
    {
        $currentUser = $request->user();
        if (! $currentUser || $currentUser->role !== 'patient') {
            abort(403);
        }

        $data = $request->validate([
            'doctor_id' => ['required', 'exists:users,user_id'],
            'reason_for_visit' => ['nullable', 'string'],
            'priority_level' => ['nullable', 'integer'],
            'patient_id' => ['sometimes', 'exists:users,user_id'],
        ]);

        $targetPatientId = (int) $currentUser->user_id;
        if ($request->filled('patient_id')) {
            $candidate = (int) $request->input('patient_id');
            if (! $currentUser->canAccessPatientId($candidate)) {
                abort(403);
            }
            $targetPatientId = $candidate;
        }

        $today = now()->toDateString();
        $activeExists = Queue::query()
            ->whereDate('queue_datetime', $today)
            ->whereIn('status', ['waiting', 'serving'])
            ->whereHas('appointment', function ($q) use ($targetPatientId) {
                $q->where('patient_id', $targetPatientId);
            })
            ->exists();

        if ($activeExists) {
            return response()->json([
                'message' => 'You already have an active queue entry.',
            ], 422);
        }

        $priorityLevel = isset($data['priority_level']) ? (int) $data['priority_level'] : 5;

        $result = DB::transaction(function () use ($currentUser, $data, $priorityLevel, $targetPatientId) {
            $appointment = Appointment::create([
                'patient_id' => $targetPatientId,
                'doctor_id' => (int) $data['doctor_id'],
                'created_by' => $currentUser->user_id,
                'appointment_datetime' => now(),
                'appointment_type' => 'walk_in',
                'status' => 'confirmed',
                'reason_for_visit' => $data['reason_for_visit'] ?? null,
                'priority_level' => $priorityLevel,
            ]);

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

            return $queue->load(['appointment.patient', 'appointment.doctor']);
        });

        return response()->json($result, 201);
    }

    public function show(Request $request, Queue $queue)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            $queue->loadMissing('appointment');
            if (! $queue->appointment || ! $currentUser->canAccessPatientId((int) $queue->appointment->patient_id)) {
                abort(403);
            }
        }

        return $queue->load(['appointment.patient', 'appointment.doctor']);
    }

    public function update(Request $request, Queue $queue)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $data = $request->validate([
            'queue_number' => ['sometimes', 'integer'],
            'queue_datetime' => ['sometimes', 'nullable', 'date'],
            'status' => ['sometimes', 'in:waiting,serving,done,cancelled'],
            'priority_level' => ['sometimes', 'integer'],
        ]);

        $nextStatus = array_key_exists('status', $data) ? $data['status'] : null;

        DB::transaction(function () use ($queue, $data, $nextStatus) {
            $queue->update($data);

            if ($nextStatus === 'serving') {
                $queue->loadMissing('appointment');
                $doctorId = $queue->appointment ? $queue->appointment->doctor_id : null;
                $date = $queue->queue_datetime ? $queue->queue_datetime->toDateString() : null;

                if ($doctorId && $date) {
                    Queue::query()
                        ->where('queue_id', '!=', $queue->queue_id)
                        ->whereHas('appointment', function ($q) use ($doctorId) {
                            $q->where('doctor_id', $doctorId);
                        })
                        ->whereDate('queue_datetime', $date)
                        ->where('status', 'serving')
                        ->update(['status' => 'waiting']);
                }
            }
        });

        return $queue->refresh()->load(['appointment.patient', 'appointment.doctor']);
    }

    public function destroy(Request $request, Queue $queue)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $queue->delete();

        return response()->json([
            'message' => 'Queue entry deleted',
        ]);
    }
}

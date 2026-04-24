<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;
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

        return $query
            ->orderByDesc('queue_datetime')
            ->paginate($perPage);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'appointment_id' => ['required', 'exists:appointments,appointment_id'],
            'queue_number' => ['nullable', 'integer'],
            'queue_datetime' => ['nullable', 'date'],
            'status' => ['nullable', 'in:waiting,serving,done,cancelled'],
            'priority_level' => ['nullable', 'integer'],
        ]);

        if (! isset($data['status'])) {
            $data['status'] = 'waiting';
        }

        $queue = Queue::create($data);

        return response()->json($queue->load(['appointment.patient', 'appointment.doctor']), 201);
    }

    public function show(Queue $queue)
    {
        return $queue->load(['appointment.patient', 'appointment.doctor']);
    }

    public function update(Request $request, Queue $queue)
    {
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

    public function destroy(Queue $queue)
    {
        $queue->delete();

        return response()->json([
            'message' => 'Queue entry deleted',
        ]);
    }
}

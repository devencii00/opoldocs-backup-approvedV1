<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    public function index()
    {
        return Queue::with('appointment')->paginate();
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

        return response()->json($queue->load('appointment'), 201);
    }

    public function show(Queue $queue)
    {
        return $queue->load('appointment');
    }

    public function update(Request $request, Queue $queue)
    {
        $data = $request->validate([
            'queue_number' => ['sometimes', 'integer'],
            'queue_datetime' => ['sometimes', 'nullable', 'date'],
            'status' => ['sometimes', 'in:waiting,serving,done,cancelled'],
            'priority_level' => ['sometimes', 'integer'],
        ]);

        $queue->update($data);

        return $queue->refresh()->load('appointment');
    }

    public function destroy(Queue $queue)
    {
        $queue->delete();

        return response()->json([
            'message' => 'Queue entry deleted',
        ]);
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use Illuminate\Http\Request;

class QueueDisplayController extends Controller
{
    public function page(Request $request)
    {
        $date = $request->query('date');
        if (! $date) {
            $date = now()->toDateString();
        }

        $doctorId = $request->query('doctor_id');

        return view('public.queue_display', [
            'date' => $date,
            'doctorId' => $doctorId,
        ]);
    }

    public function data(Request $request)
    {
        $date = $request->query('date');
        if (! $date) {
            $date = now()->toDateString();
        }

        $doctorId = $request->query('doctor_id');

        $query = Queue::query()
            ->with(['appointment.patient', 'appointment.doctor'])
            ->whereDate('queue_datetime', $date);

        if ($doctorId) {
            $query->whereHas('appointment', function ($q) use ($doctorId) {
                $q->where('doctor_id', (int) $doctorId);
            });
        }

        $items = $query->get();

        $serving = $items->first(function ($q) {
            return (string) ($q->status ?? '') === 'serving';
        });

        $waiting = $items
            ->filter(function ($q) {
                return (string) ($q->status ?? '') === 'waiting';
            })
            ->sortBy(function ($q) {
                $priority = (int) ($q->priority_level ?? 5);
                $number = (int) ($q->queue_number ?? 999999);
                return str_pad((string) $priority, 6, '0', STR_PAD_LEFT).'-'.str_pad((string) $number, 6, '0', STR_PAD_LEFT);
            })
            ->values();

        $next = $waiting->take(10)->values();

        $formatPerson = function ($user, string $fallback) {
            if (! $user) {
                return $fallback;
            }
            $full = $user->personalInformation->full_name ?? null;
            $full = is_string($full) ? trim($full) : '';
            return $full !== '' ? $full : $fallback;
        };

        $payload = [
            'date' => $date,
            'doctor_id' => $doctorId ? (int) $doctorId : null,
            'now_serving' => $serving ? [
                'queue_id' => $serving->queue_id,
                'queue_number' => $serving->queue_number,
                'queue_code' => $serving->queue_code,
                'status' => $serving->status,
                'priority_level' => $serving->priority_level,
                'patient' => [
                    'user_id' => $serving->appointment?->patient_id,
                    'name' => $formatPerson($serving->appointment?->patient, 'Patient'),
                ],
                'doctor' => [
                    'user_id' => $serving->appointment?->doctor_id,
                    'name' => $formatPerson($serving->appointment?->doctor, 'Doctor'),
                ],
            ] : null,
            'next' => $next->map(function ($q) use ($formatPerson) {
                return [
                    'queue_id' => $q->queue_id,
                    'queue_number' => $q->queue_number,
                    'queue_code' => $q->queue_code,
                    'status' => $q->status,
                    'priority_level' => $q->priority_level,
                    'patient' => [
                        'user_id' => $q->appointment?->patient_id,
                        'name' => $formatPerson($q->appointment?->patient, 'Patient'),
                    ],
                    'doctor' => [
                        'user_id' => $q->appointment?->doctor_id,
                        'name' => $formatPerson($q->appointment?->doctor, 'Doctor'),
                    ],
                ];
            })->all(),
            'counts' => [
                'waiting' => $waiting->count(),
                'total' => $items->count(),
            ],
            'generated_at' => now()->toIso8601String(),
        ];

        return response()->json($payload);
    }
}

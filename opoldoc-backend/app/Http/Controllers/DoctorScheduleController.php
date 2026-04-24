<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use App\Models\DoctorScheduleDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorScheduleController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 50);
        if ($perPage < 1) {
            $perPage = 50;
        }
        if ($perPage > 100) {
            $perPage = 100;
        }

        return DoctorSchedule::query()
            ->with(['doctor', 'days'])
            ->when($request->query('doctor_id'), function ($q) use ($request) {
                $q->where('doctor_id', $request->query('doctor_id'));
            })
            ->latest('schedule_id')
            ->paginate($perPage);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'doctor_id' => ['required', 'exists:users,user_id'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'max_patients' => ['nullable', 'integer', 'min:1'],
            'days' => ['required', 'array', 'min:1'],
            'days.*' => ['required', 'in:mon,tue,wed,thu,fri,sat,sun'],
        ]);

        return DB::transaction(function () use ($data) {
            $schedule = DoctorSchedule::create([
                'doctor_id' => $data['doctor_id'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'max_patients' => $data['max_patients'] ?? null,
            ]);

            $uniqueDays = array_values(array_unique($data['days']));
            foreach ($uniqueDays as $day) {
                DoctorScheduleDay::create([
                    'schedule_id' => $schedule->schedule_id,
                    'day_of_week' => $day,
                ]);
            }

            return response()->json($schedule->load(['doctor', 'days']), 201);
        });
    }

    public function update(Request $request, DoctorSchedule $doctorSchedule)
    {
        $data = $request->validate([
            'start_time' => ['sometimes', 'date_format:H:i'],
            'end_time' => ['sometimes', 'date_format:H:i'],
            'max_patients' => ['sometimes', 'nullable', 'integer', 'min:1'],
            'days' => ['sometimes', 'array', 'min:1'],
            'days.*' => ['required_with:days', 'in:mon,tue,wed,thu,fri,sat,sun'],
        ]);

        if (array_key_exists('start_time', $data) && array_key_exists('end_time', $data)) {
            if ($data['end_time'] <= $data['start_time']) {
                return response()->json(['message' => 'End time must be after start time.'], 422);
            }
        }

        return DB::transaction(function () use ($doctorSchedule, $data) {
            $doctorSchedule->update([
                'start_time' => $data['start_time'] ?? $doctorSchedule->start_time,
                'end_time' => $data['end_time'] ?? $doctorSchedule->end_time,
                'max_patients' => array_key_exists('max_patients', $data) ? $data['max_patients'] : $doctorSchedule->max_patients,
            ]);

            if (array_key_exists('days', $data)) {
                DoctorScheduleDay::where('schedule_id', $doctorSchedule->schedule_id)->delete();
                $uniqueDays = array_values(array_unique($data['days']));
                foreach ($uniqueDays as $day) {
                    DoctorScheduleDay::create([
                        'schedule_id' => $doctorSchedule->schedule_id,
                        'day_of_week' => $day,
                    ]);
                }
            }

            return $doctorSchedule->refresh()->load(['doctor', 'days']);
        });
    }

    public function destroy(DoctorSchedule $doctorSchedule)
    {
        $doctorSchedule->delete();

        return response()->json([
            'message' => 'Schedule deleted',
        ]);
    }
}

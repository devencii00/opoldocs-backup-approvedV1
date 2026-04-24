<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

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

        return Appointment::with(['patient', 'doctor'])->paginate($perPage);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,user_id'],
            'doctor_id' => ['required', 'exists:users,user_id'],
            'appointment_datetime' => ['required', 'date'],
            'appointment_type' => ['required', 'in:walk_in,scheduled'],
            'status' => ['nullable', 'in:pending,confirmed,completed,cancelled,no_show'],
            'reason_for_visit' => ['nullable', 'string'],
            'priority_level' => ['nullable', 'integer'],
        ]);

        $data['created_by'] = $request->user()->user_id ?? null;

        if (! isset($data['status'])) {
            $data['status'] = 'pending';
        }

        $appointment = Appointment::create($data);

        return response()->json($appointment->load(['patient', 'doctor']), 201);
    }

    public function show(Appointment $appointment)
    {
        return $appointment->load(['patient', 'doctor', 'queue', 'transaction']);
    }

    public function update(Request $request, Appointment $appointment)
    {
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

        return $appointment->refresh()->load(['patient', 'doctor', 'queue', 'transaction']);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return response()->json([
            'message' => 'Appointment deleted',
        ]);
    }
}

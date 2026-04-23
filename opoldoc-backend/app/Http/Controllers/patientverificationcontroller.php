<?php

namespace App\Http\Controllers;

use App\Models\PatientVerification;
use Illuminate\Http\Request;

class PatientVerificationController extends Controller
{
    public function index()
    {
        return PatientVerification::with('patient')->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,user_id'],
            'type' => ['required', 'in:senior,pwd,pregnant'],
            'status' => ['nullable', 'in:active,inactive'],
        ]);

        if (! isset($data['status'])) {
            $data['status'] = 'active';
        }

        $verification = PatientVerification::create($data);

        return response()->json($verification->load('patient'), 201);
    }

    public function show(PatientVerification $patientVerification)
    {
        return $patientVerification->load('patient');
    }

    public function update(Request $request, PatientVerification $patientVerification)
    {
        $data = $request->validate([
            'status' => ['sometimes', 'in:active,inactive'],
        ]);

        $patientVerification->update($data);

        return $patientVerification->refresh()->load('patient');
    }

    public function destroy(PatientVerification $patientVerification)
    {
        $patientVerification->delete();

        return response()->json([
            'message' => 'Verification deleted',
        ]);
    }
}


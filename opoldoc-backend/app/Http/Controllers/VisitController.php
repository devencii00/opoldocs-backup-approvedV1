<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = $request->user();

        $query = Transaction::with([
            'appointment.patient',
            'appointment.doctor',
            'prescriptions.doctor',
            'prescriptions.items.medicine',
        ]);

        if ($currentUser && $currentUser->role === 'patient') {
            $query->whereHas('appointment', function ($q) use ($currentUser) {
                $q->whereIn('patient_id', $currentUser->accessiblePatientIds());
            });
        } elseif ($request->filled('patient_id')) {
            $patientId = $request->input('patient_id');
            $query->whereHas('appointment', function ($q) use ($patientId) {
                $q->where('patient_id', $patientId);
            });
        }

        return $query->orderByDesc('visit_datetime')->orderByDesc('transaction_id')->paginate();
    }

    public function show(Request $request, Transaction $visit)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            $visit->loadMissing('appointment');
            if (! $visit->appointment || ! $currentUser->canAccessPatientId((int) $visit->appointment->patient_id)) {
                abort(403);
            }
        }

        return $visit->load([
            'appointment.patient',
            'appointment.doctor',
            'prescriptions.doctor',
            'prescriptions.items.medicine',
        ]);
    }
}

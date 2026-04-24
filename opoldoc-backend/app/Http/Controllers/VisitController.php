<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with([
            'appointment.patient',
            'appointment.doctor',
            'prescriptions.doctor',
            'prescriptions.items.medicine',
        ]);

        if ($request->filled('patient_id')) {
            $patientId = $request->input('patient_id');
            $query->whereHas('appointment', function ($q) use ($patientId) {
                $q->where('patient_id', $patientId);
            });
        }

        return $query->orderByDesc('visit_datetime')->orderByDesc('transaction_id')->paginate();
    }

    public function show(Transaction $visit)
    {
        return $visit->load([
            'appointment.patient',
            'appointment.doctor',
            'prescriptions.doctor',
            'prescriptions.items.medicine',
        ]);
    }
}

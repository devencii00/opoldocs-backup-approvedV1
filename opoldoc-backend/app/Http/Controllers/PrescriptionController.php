<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        return Prescription::with(['doctor', 'transaction'])->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'transaction_id' => ['required', 'exists:transactions,transaction_id'],
            'doctor_id' => ['required', 'exists:users,user_id'],
            'notes' => ['nullable', 'string'],
            'prescribed_datetime' => ['nullable', 'date'],
        ]);

        $prescription = Prescription::create($data);

        return response()->json($prescription->load(['doctor', 'transaction']), 201);
    }

    public function show(Prescription $prescription)
    {
        return $prescription->load(['doctor', 'transaction', 'items']);
    }

    public function update(Request $request, Prescription $prescription)
    {
        $data = $request->validate([
            'notes' => ['sometimes', 'nullable', 'string'],
            'prescribed_datetime' => ['sometimes', 'nullable', 'date'],
        ]);

        $prescription->update($data);

        return $prescription->refresh()->load(['doctor', 'transaction', 'items']);
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();

        return response()->json([
            'message' => 'Prescription deleted',
        ]);
    }
}

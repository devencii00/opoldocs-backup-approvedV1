<?php

namespace App\Http\Controllers;

use App\Models\MedicalBackground;
use Illuminate\Http\Request;

class MedicalBackgroundController extends Controller
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

        $query = MedicalBackground::query()->with('patient');

        if ($request->filled('patient_id')) {
            $query->where('patient_id', $request->query('patient_id'));
        }

        if ($request->filled('category')) {
            $query->where('category', $request->query('category'));
        }

        return $query->orderBy('category')->orderBy('name')->paginate($perPage);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => ['required', 'exists:users,user_id'],
            'category' => ['required', 'in:allergy_food,allergy_drug,condition'],
            'name' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $record = MedicalBackground::create($data);

        return response()->json($record->load('patient'), 201);
    }

    public function show(MedicalBackground $medicalBackground)
    {
        return $medicalBackground->load('patient');
    }

    public function update(Request $request, MedicalBackground $medicalBackground)
    {
        $data = $request->validate([
            'patient_id' => ['sometimes', 'exists:users,user_id'],
            'category' => ['sometimes', 'in:allergy_food,allergy_drug,condition'],
            'name' => ['sometimes', 'string'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ]);

        $medicalBackground->update($data);

        return $medicalBackground->refresh()->load('patient');
    }

    public function destroy(MedicalBackground $medicalBackground)
    {
        $medicalBackground->delete();

        return response()->json([
            'message' => 'Medical background deleted',
        ]);
    }
}

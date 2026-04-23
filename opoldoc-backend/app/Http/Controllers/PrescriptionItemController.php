<?php

namespace App\Http\Controllers;

use App\Models\PrescriptionItem;
use Illuminate\Http\Request;

class PrescriptionItemController extends Controller
{
    public function index()
    {
        return PrescriptionItem::with('prescription')->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'prescription_id' => ['required', 'exists:prescriptions,prescription_id'],
            'medicine_name' => ['required', 'string'],
            'dosage' => ['nullable', 'string'],
            'frequency' => ['nullable', 'string'],
            'duration' => ['nullable', 'string'],
            'instructions' => ['nullable', 'string'],
        ]);

        $item = PrescriptionItem::create($data);

        return response()->json($item->load('prescription'), 201);
    }

    public function show(PrescriptionItem $prescriptionItem)
    {
        return $prescriptionItem->load('prescription');
    }

    public function update(Request $request, PrescriptionItem $prescriptionItem)
    {
        $data = $request->validate([
            'medicine_name' => ['sometimes', 'string'],
            'dosage' => ['sometimes', 'nullable', 'string'],
            'frequency' => ['sometimes', 'nullable', 'string'],
            'duration' => ['sometimes', 'nullable', 'string'],
            'instructions' => ['sometimes', 'nullable', 'string'],
        ]);

        $prescriptionItem->update($data);

        return $prescriptionItem->refresh()->load('prescription');
    }

    public function destroy(PrescriptionItem $prescriptionItem)
    {
        $prescriptionItem->delete();

        return response()->json([
            'message' => 'Prescription item deleted',
        ]);
    }
}


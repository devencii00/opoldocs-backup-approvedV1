<?php

namespace App\Http\Controllers;

use App\Models\PrescriptionItem;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        return PrescriptionItem::query()->paginate();
    }

    public function show(PrescriptionItem $medicine)
    {
        return $medicine;
    }

    public function store(Request $request)
    {
        $request->merge([
            'medicine_name' => $request->input('medicine_name'),
        ]);

        return app(PrescriptionItemController::class)->store($request);
    }

    public function update(Request $request, PrescriptionItem $medicine)
    {
        return app(PrescriptionItemController::class)->update($request, $medicine);
    }

    public function destroy(PrescriptionItem $medicine)
    {
        return app(PrescriptionItemController::class)->destroy($medicine);
    }
}


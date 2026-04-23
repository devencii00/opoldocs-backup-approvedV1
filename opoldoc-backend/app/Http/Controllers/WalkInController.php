<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class WalkInController extends Controller
{
    public function index()
    {
        return Appointment::query()
            ->where('appointment_type', 'walk_in')
            ->paginate();
    }

    public function store(Request $request)
    {
        $request->merge([
            'appointment_type' => 'walk_in',
        ]);

        return app(AppointmentController::class)->store($request);
    }

    public function show(Appointment $walk_in)
    {
        if ($walk_in->appointment_type !== 'walk_in') {
            abort(404);
        }

        return $walk_in->load(['patient', 'doctor', 'queue', 'transaction']);
    }
}


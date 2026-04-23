<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return User::query()
            ->where('role', 'patient')
            ->paginate();
    }

    public function store(Request $request)
    {
        $request->merge(['role' => 'patient']);

        return app(UserController::class)->store($request);
    }

    public function show(User $patient)
    {
        if ($patient->role !== 'patient') {
            abort(404);
        }

        return $patient;
    }

    public function update(Request $request, User $patient)
    {
        if ($patient->role !== 'patient') {
            abort(404);
        }

        return app(UserController::class)->update($request, $patient);
    }

    public function destroy(User $patient)
    {
        if ($patient->role !== 'patient') {
            abort(404);
        }

        return app(UserController::class)->destroy($patient);
    }
}


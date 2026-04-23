<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        return User::query()
            ->where('role', 'doctor')
            ->paginate();
    }

    public function store(Request $request)
    {
        $request->merge(['role' => 'doctor']);

        return app(UserController::class)->store($request);
    }

    public function show(User $doctor)
    {
        if ($doctor->role !== 'doctor') {
            abort(404);
        }

        return $doctor;
    }

    public function update(Request $request, User $doctor)
    {
        if ($doctor->role !== 'doctor') {
            abort(404);
        }

        return app(UserController::class)->update($request, $doctor);
    }

    public function destroy(User $doctor)
    {
        if ($doctor->role !== 'doctor') {
            abort(404);
        }

        return app(UserController::class)->destroy($doctor);
    }
}


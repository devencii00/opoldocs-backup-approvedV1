<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    public function index(Request $request)
    {
        return User::query()
            ->where('user_id', $request->user()->user_id)
            ->get();
    }

    public function show(User $personal_information)
    {
        return $personal_information;
    }

    public function store(Request $request)
    {
        return $this->update($request, $request->user());
    }

    public function update(Request $request, User $personal_information)
    {
        $data = $request->validate([
            'firstname' => ['sometimes', 'nullable', 'string'],
            'lastname' => ['sometimes', 'nullable', 'string'],
            'middlename' => ['sometimes', 'nullable', 'string'],
            'birthdate' => ['sometimes', 'nullable', 'date'],
            'sex' => ['sometimes', 'nullable', 'string'],
            'address' => ['sometimes', 'nullable', 'string'],
            'contact_number' => ['sometimes', 'nullable', 'string'],
        ]);

        $personal_information->update($data);

        return $personal_information->refresh();
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::query()->paginate();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,doctor,receptionist,patient'],
            'status' => ['nullable', 'in:active,inactive,suspended'],
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'middlename' => ['nullable', 'string'],
            'birthdate' => ['nullable', 'date'],
            'sex' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string'],
        ]);

        $data['password_hash'] = Hash::make($data['password']);
        unset($data['password']);

        if (! isset($data['status'])) {
            $data['status'] = 'active';
        }

        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'email' => ['sometimes', 'email', "unique:users,email,{$user->user_id},user_id"],
            'password' => ['sometimes', 'string', 'min:8'],
            'must_change_credentials' => ['sometimes', 'boolean'],
            'role' => ['sometimes', 'in:admin,doctor,receptionist,patient'],
            'status' => ['sometimes', 'in:active,inactive,suspended'],
            'firstname' => ['sometimes', 'nullable', 'string'],
            'lastname' => ['sometimes', 'nullable', 'string'],
            'middlename' => ['sometimes', 'nullable', 'string'],
            'birthdate' => ['sometimes', 'nullable', 'date'],
            'sex' => ['sometimes', 'nullable', 'string'],
            'address' => ['sometimes', 'nullable', 'string'],
            'contact_number' => ['sometimes', 'nullable', 'string'],
        ]);

        if (array_key_exists('password', $data)) {
            $data['password_hash'] = Hash::make($data['password']);
            unset($data['password']);
        }

        if (array_key_exists('must_change_credentials', $data)) {
            if ($data['must_change_credentials'] === false) {
                $user->is_first_login = false;
            }
            unset($data['must_change_credentials']);
        }

        $user->update($data);

        return $user->refresh();
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'role' => 'patient',
            'status' => 'active',
            'firstname' => $data['firstname'] ?? null,
            'lastname' => $data['lastname'] ?? null,
        ]);

        return response()->json($user, 201);
    }
}

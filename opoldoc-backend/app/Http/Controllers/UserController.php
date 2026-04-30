<?php

namespace App\Http\Controllers;

use App\Mail\StaffInviteMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        return User::query()->paginate();
    }

    public function store(Request $request)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

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

    public function show(Request $request, User $user)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient' && $user->user_id !== $currentUser->user_id) {
            abort(403);
        }

        return $user;
    }

    public function update(Request $request, User $user)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient' && $user->user_id !== $currentUser->user_id) {
            abort(403);
        }

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
            'account_activated' => ['sometimes', 'boolean'],
            'license_number' => ['sometimes', 'nullable', 'string'],
            'specialization' => ['sometimes', 'nullable', 'string'],
        ]);

        if ($currentUser && $currentUser->role === 'patient') {
            unset($data['role'], $data['status'], $data['account_activated'], $data['license_number'], $data['specialization']);
        }

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

    public function destroy(Request $request, User $user)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password_hash' => Hash::make($data['password']),
            'role' => 'patient',
            'status' => 'active',
            'is_dependent' => false,
            'account_activated' => true,
            'is_first_login' => false,
            'firstname' => $data['firstname'] ?? null,
            'lastname' => $data['lastname'] ?? null,
        ]);

        return response()->json($user, 201);
    }

    public function invite(Request $request)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient') {
            abort(403);
        }

        $data = $request->validate([
            'email' => ['required', 'email', 'unique:users,email'],
            'role' => ['required', 'in:admin,doctor,receptionist,patient'],
            'status' => ['nullable', 'in:active,inactive,suspended'],
            'firstname' => ['nullable', 'string'],
            'lastname' => ['nullable', 'string'],
            'middlename' => ['nullable', 'string'],
            'birthdate' => ['nullable', 'date'],
            'sex' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string'],
            'license_number' => ['nullable', 'string'],
            'specialization' => ['nullable', 'string'],
            'employee_number' => ['nullable', 'string'],
            'hire_date' => ['nullable', 'date'],
        ]);

        $plainPassword = Str::random(12);

        $data['password_hash'] = Hash::make($plainPassword);
        $data['status'] = $data['status'] ?? 'active';
        $data['is_first_login'] = true;

        $user = User::create($data);

        Mail::to($user->email)->send(new StaffInviteMail($user, $plainPassword));

        return response()->json($user, 201);
    }

    public function dependents(Request $request, User $user)
    {
        $currentUser = $request->user();
        if ($currentUser && $currentUser->role === 'patient' && (int) $currentUser->user_id !== (int) $user->user_id) {
            abort(403);
        }

        return $user->children()->get();
    }
}

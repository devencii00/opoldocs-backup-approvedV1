<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'device_name' => ['nullable', 'string'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password_hash)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        if ($user->status !== 'active') {
            return response()->json([
                'message' => 'Account is not active',
            ], 403);
        }

        $user->tokens()->delete();

        $token = $user->createToken($credentials['device_name'] ?? 'api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        }

        return response()->json([
            'message' => 'Logged out',
        ]);
    }

    public function requestPasswordReset(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user) {
            return response()->json([
                'message' => 'If the email exists, a reset token has been generated',
            ]);
        }

        $token = Str::random(64);

        $user->password_reset_token = $token;
        $user->password_reset_expires_at = now()->addMinutes(60);
        $user->save();

        return response()->json([
            'message' => 'Password reset token generated',
            'token' => $token,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || $user->password_reset_token !== $data['token']) {
            return response()->json([
                'message' => 'Invalid token or email',
            ], 422);
        }

        if (! $user->password_reset_expires_at || $user->password_reset_expires_at->isPast()) {
            return response()->json([
                'message' => 'Token has expired',
            ], 422);
        }

        $user->password_hash = Hash::make($data['password']);
        $user->password_reset_token = null;
        $user->password_reset_expires_at = null;
        $user->save();

        return response()->json([
            'message' => 'Password reset successful',
        ]);
    }
}

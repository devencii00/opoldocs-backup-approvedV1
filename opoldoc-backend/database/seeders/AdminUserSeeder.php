<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'role' => 'admin',
                'status' => 'active',
                'password_hash' => Hash::make('admin123'),

                'account_activated' => 1,
                'is_first_login' => 1,
            ]
        );
    }
}
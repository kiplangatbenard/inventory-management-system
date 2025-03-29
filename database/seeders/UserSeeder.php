<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user if not exists
        User::firstOrCreate(
            ['email' => 'adminben@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('1234'),
                'role' => 'admin',
            ]
        );

        // Create a manager user if not exists
        User::firstOrCreate(
            ['email' => 'manben@gmail.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('1234'),
                'role' => 'manager',
            ]
        );

        // Create a regular user if not exists
        User::firstOrCreate(
            ['email' => 'userben@gmail.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('1234'),
                'role' => 'user',
            ]
        );
    }
}

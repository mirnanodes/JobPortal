<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Portal',
            'email' => 'admin@jobportal.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Jobseekers
        User::create([
            'name' => 'Lila',
            'email' => 'lila@example.com',
            'password' => Hash::make('password'),
            'role' => 'jobseeker',
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => Hash::make('password'),
            'role' => 'jobseeker',
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'password' => Hash::make('password'),
            'role' => 'jobseeker',
        ]);

        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@example.com',
            'password' => Hash::make('password'),
            'role' => 'jobseeker',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Receptionist',
            'email' => 'receptionist@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);

        User::create([
            'name' => 'Doctor',
            'email' => 'doctor@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        User::create([
            'name' => 'Nurse',
            'email' => 'nurse@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'nurse',
        ]);

        User::create([
            'name' => 'Pharmacist',
            'email' => 'pharmacist@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'pharmacist',
        ]);
    }
}

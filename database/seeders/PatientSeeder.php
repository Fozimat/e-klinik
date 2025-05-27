<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $receptionist = User::where('role', 'receptionist')->first();

        foreach (range(1, 10) as $i) {
            Patient::create([
                'name' => $faker->name,
                'birth_date' => $faker->date(),
                'gender' => $faker->randomElement(['male', 'female']),
                'phone_number' => $faker->numerify('08##########'),
                'created_by' => $receptionist->id,
            ]);
        }
    }
}

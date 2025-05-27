<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medicines = [
            [
                'name' => 'Paracetamol',
                'description' => 'Obat untuk menurunkan demam dan meredakan nyeri ringan hingga sedang.'
            ],
            [
                'name' => 'Amoxicillin',
                'description' => 'Antibiotik untuk mengobati berbagai infeksi bakteri.'
            ],
            [
                'name' => 'Ibuprofen',
                'description' => 'Obat antiinflamasi nonsteroid (NSAID) untuk meredakan nyeri dan peradangan.'
            ],
            [
                'name' => 'Antasida',
                'description' => 'Digunakan untuk mengatasi gangguan lambung seperti maag dan asam lambung.'
            ],
            [
                'name' => 'Loperamide',
                'description' => 'Obat untuk mengatasi diare.'
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}

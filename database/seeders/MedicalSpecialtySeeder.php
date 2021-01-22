<?php

namespace Database\Seeders;

use App\Models\MedicalSpecialty;
use Illuminate\Database\Seeder;

class MedicalSpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties=[
            [
                'name'=>'Cardiologia',
            ],
            [
                'name'=>'Otorinolaringoiatria',
            ],
            [
                'name'=>'Odontoiatra',
            ],
            [
                'name'=>'Neurologia',
            ],
            [
                'name'=>'Forame Ovale Pervio',
            ],
            [
                'name'=>'Medicina Iperbarica',
            ],

        ];
        foreach ($specialties as $specialty) {
            MedicalSpecialty::create($specialty);
        }

    }
}

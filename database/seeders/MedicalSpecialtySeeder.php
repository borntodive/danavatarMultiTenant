<?php

namespace Database\Seeders;

use App\Models\MedicalSpecialty;
use App\Models\Tenant;
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
        $y40=Tenant::where('url','y40')->first();

        $specialties=[
            [
                'name'=>'Medicina Subacquea',
                'slug'=>'diving',
            ],
            [
                'name'=>'Wearable',
                'slug'=>'wearable',
                'only_center'=>true,
            ],
            [
                'name'=>'Cardiologia',
                'slug'=>'cardio',
            ],
            [
                'name'=>'Otorinolaringoiatria',
                'slug'=>'otolaryngology',
            ],
            [
                'name'=>'Odontoiatra',
                'slug'=>'dentist'
            ],
            [
                'name'=>'Neurologia',
                'slug'=>'neuro'
            ],
            [
                'name'=>'Forame Ovale Pervio',
                'slug'=>'fop',
            ],
            [
                'name'=>'Medicina Iperbarica',
                'slug'=>'hyperbaric',
            ],

        ];
        foreach ($specialties as $specialty) {
            $ms=MedicalSpecialty::create($specialty);
            $ms->centers()->attach($y40);
        }

    }
}

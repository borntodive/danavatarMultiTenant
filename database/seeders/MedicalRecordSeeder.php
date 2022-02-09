<?php

namespace Database\Seeders;

use App\Models\MedicalRecord;
use App\Models\MedicalSpecialty;
use Illuminate\Database\Seeder;

class MedicalRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = MedicalSpecialty::get();
        MedicalRecord::factory()->count(100)->create([
            'user_id'=>4,
            'tenant_id'=>1,
            'doctor_id'=>2,
            //'medical_specialty_id'=>$specialties->random()->id
        ]);
    }
}

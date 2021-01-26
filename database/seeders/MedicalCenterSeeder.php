<?php

namespace Database\Seeders;

use App\Models\MedicalCenter;
use Illuminate\Database\Seeder;

class MedicalCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MedicalCenter::factory(3)->create();
    }
}

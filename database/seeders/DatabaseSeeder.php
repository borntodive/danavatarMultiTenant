<?php

namespace Database\Seeders;

use App\Models\MedicalSpecialty;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LaratrustSeeder::class,
            TenantSeeder::class,
            UserSeeder::class,
            MedicalSpecialtySeeder::class,
            MedicalRecordSeeder::class,
            SensorSeeder::class,
            SampleSeeder::class,

        ]);
    }
}

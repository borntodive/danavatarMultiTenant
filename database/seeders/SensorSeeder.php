<?php

namespace Database\Seeders;

use App\Models\Sensor;
use Illuminate\Database\Seeder;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $sensors = [
            "Temperature",
            "Saturation",
            "HeartRate",
            "BreathFrequency",
            "Position",
            "Ecg",
            "Respiration",
            "Respiration2",
            "AccelerationX",
            "AccelerationY",
            "AccelerationZ"
        ];
        foreach ($sensors as $sensor) {
            Sensor::create(
                [
                    'name' => $sensor,
                    'color' => $faker->hexColor,
                ]
            );
        }
    }
}

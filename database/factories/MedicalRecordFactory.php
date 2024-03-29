<?php

namespace Database\Factories;

use App\Models\MedicalRecord;
use App\Models\MedicalSpecialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $specialties = MedicalSpecialty::get();

        return [
            'user_id' => UserFactory::class,
            'tenant_id' => TenantFactory::class,
            'doctor_id' => UserFactory::class,
            'medical_specialty_id' => $specialties->random()->id,
            'data'=>json_encode([
                $this->faker->randomElement(
                    [
                        'house',
                        'flat',
                        'apartment',
                        'room', 'shop',
                        'lot', 'garage',
                    ]
                ),
            ]),

        ];
    }
}

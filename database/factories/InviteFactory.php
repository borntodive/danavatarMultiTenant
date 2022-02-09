<?php

namespace Database\Factories;

use App\Models\Invite;
use Illuminate\Database\Eloquent\Factories\Factory;

class InviteFactory extends Factory
{
    protected $model = Invite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname'=>$this->faker->firstName(),
            'lastname'=>$this->faker->lastName(),
            'email'=>$this->faker->safeEmail(),
            'codice_fiscale'=>$this->faker->taxId(),
            'dob'=>$this->faker->date(),
            'tenant_id'=>1,
        ];
    }
}

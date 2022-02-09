<?php

namespace Database\Factories;

use App\Models\ApiToken;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApiTokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'token'=>$this->faker->asciify('******************************'),
            'tenant_id'=>1,
        ];
    }
}

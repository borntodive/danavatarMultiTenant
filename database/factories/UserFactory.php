<?php

namespace Database\Factories;

use App\Enums\UserGender;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'gender'=>UserGender::getRandomValue(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'dob'=>$this->faker->date(),
            'password' => bcrypt('password'), // password
            'remember_token' => Str::random(10),
            'codice_fiscale'=>$this->faker->taxId(),
        ];
    }
}

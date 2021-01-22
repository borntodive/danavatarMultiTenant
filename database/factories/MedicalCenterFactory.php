<?php

namespace Database\Factories;

use App\Models\MedicalCenter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MedicalCenterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MedicalCenter::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->sentence(3);
        $slug = Str::slug($name, '-');
        return [
            'name' => $name,
            'email' => $this->faker->unique()->safeEmail(),
            'slug' => $slug,
            'url' => $slug,
        ];
    }
}

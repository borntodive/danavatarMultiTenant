<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TenantFactory extends Factory
{
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

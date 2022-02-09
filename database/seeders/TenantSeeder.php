<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $name = 'Y40';
        $slug = Str::slug($name, '-');

        $y40 = Tenant::create([
            'name' => $name,
            'email' => $faker->unique()->safeEmail(),
            'slug' => $slug,
            'url' => 'y40',
        ]);

        $name = 'test';
        $slug = Str::slug($name, '-');

        $test = Tenant::create([
            'name' => $name,
            'email' => $faker->unique()->safeEmail(),
            'slug' => $slug,
            'url' => 'test',
        ]);
    }
}

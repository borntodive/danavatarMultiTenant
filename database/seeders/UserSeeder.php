<?php

namespace Database\Seeders;

use App\Enums\UserGender;
use App\Models\Role;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $y40 = Tenant::where('url', 'y40')->first();
        $test = Tenant::where('url', 'test')->first();
        $y40Team = Team::where('name', $y40->slug)->first();
        $testTeam = Team::where('name', $test->slug)->first();

        $superAdminRole = Role::where('name', 'super_admin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $doctorRole = Role::where('name', 'medical_doctor')->first();
        $userRole = Role::where('name', 'user')->first();
        $superAdmin = User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'superAdmin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $superAdmin->attachRole($superAdminRole);
        $y40Admin = User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'y40Admin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $y40Admin->centers()->attach($y40);
        $y40Admin->attachRole($adminRole, $y40Team);
        $y40Cardiologo = User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'y40Cardio@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $y40Cardiologo->centers()->attach($y40);
        $y40Cardiologo->attachRole($doctorRole, $y40Team);

        $y40Utente = User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'y40Utente@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $y40Utente->centers()->attach($y40);
        $y40Utente->attachRole($userRole, $y40Team);

        $y40Users = User::factory()->count(100)->create();
        foreach ($y40Users as $u) {
            $u->centers()->attach($y40);
            $u->attachRole($userRole, $y40Team);
        }

        $testUsers = User::factory()->count(100)->create();
        foreach ($testUsers as $u) {
            $u->centers()->attach($test);
            $u->attachRole($userRole, $testTeam);
        }
    }
}

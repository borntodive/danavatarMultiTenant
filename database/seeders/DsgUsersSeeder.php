<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

use App\Enums\UserGender;
use App\Models\Tenant;
use Illuminate\Support\Str;

class DsgUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dsgTeam = Team::where('name', 'dsg')->first();
        $dsg=  Tenant::where('url', 'dsg')->first();

        $userRole = Role::where('name', 'user')->first();
        $operatorRole=Role::where('name', 'operator')->first();
        $technicianRole=Role::where('name', 'technician')->first();
        $coRole=Role::where('name', 'central_office')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $faker = Factory::create();
        $user= User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'dsgUtente@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $user->centers()->attach($dsg);
        $user->attachRole($userRole, $dsgTeam);

        $operator= User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'dsgOperator@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $operator->centers()->attach($dsg);
        $operator->attachRole($operatorRole, $dsgTeam);

        $technician= User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'dsgTechnician@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $technician->centers()->attach($dsg);
        $technician->attachRole($technicianRole, $dsgTeam);

        $co= User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'dsgCO@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $co->centers()->attach($dsg);
        $co->attachRole($coRole, $dsgTeam);

        $admin= User::create(
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
                'gender'=>UserGender::getRandomValue(),
                'email' => 'dsgAdmin@example.com',
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // password
                'remember_token' => Str::random(10),
            ]
        );
        $admin->centers()->attach($dsg);
        $admin->attachRole($adminRole, $dsgTeam);

    }
}

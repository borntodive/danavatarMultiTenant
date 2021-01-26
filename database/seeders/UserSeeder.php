<?php

namespace Database\Seeders;

use App\Models\MedicalCenter;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $centers=MedicalCenter::all();

        $users=\App\Models\User::factory(10)->create();
        foreach ($users as $user) {
            $i=random_int(0,count($centers)-1);
            $user->centers()->attach($centers[$i]);
        }
    }
}

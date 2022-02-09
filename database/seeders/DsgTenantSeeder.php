<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Team;
use App\Models\Tenant;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;

class DsgTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dsg = Tenant::create([
            'name' => 'DSG',
            'email' => 'andrea.covelli@gmail.com',
            'slug' => 'dsg',
            'url' => 'dsg',
        ]);
        $dsgTeam = Team::where('name', 'dsg')->first();
        $userRole = Role::where('name', 'user')->first();
        $adminRole = Role::where('name', 'admin')->first();
        foreach (User::all() as $user) {
            if ($user->email == 'superAdmin@example.com') {
                continue;
            }
            try {
                $user->centers()->attach($dsg);

                if ($user->email == 'andrea.covelli@gmail.com') {
                    $user->syncRoles([$adminRole], $dsgTeam);
                } else {
                    $user->syncRoles([$userRole], $dsgTeam);
                }
            } catch (Exception $e) {
                dd($e);
            }
        }
    }
}

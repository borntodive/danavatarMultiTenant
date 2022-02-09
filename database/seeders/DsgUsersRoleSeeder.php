<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DsgUsersRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dsgTeam = Team::where('name', 'dsg')->first();
        $userRole = Role::where('name', 'user')->first();
        $adminRole = Role::where('name', 'admin')->first();
        foreach (User::all() as $user) {
            if ($user->email == 'superAdmin@example.com') {
                continue;
            }
            try {
                if ($user->email == 'andrea.covelli@gmail.com') {
                    $user->attachRole($adminRole, $dsgTeam);
                } else {
                    $user->attachRole($userRole, $dsgTeam);
                }
            } catch (Exception $e) {
                dd($user);
            }
        }
    }
}

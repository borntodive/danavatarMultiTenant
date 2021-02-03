<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateLaratrustTables();
        $roles=[
            'user',
            'medical_doctor',
            'admin',
            'super_admin',
        ];
        $createdPermissions=[];
        foreach ($roles as $role) {
            $createdRole=Role::firstOrCreate([
                'name' => $role,
                'display_name' => ucwords(str_replace('_', ' ', $role)),
                'description' => ucwords(str_replace('_', ' ', $role))
            ]);
            $permission=$role.'_permission';
            $createdPermissions[]=Permission::create([
                'name' => $permission,
                'display_name' => ucwords(str_replace('_', ' ', $permission)),
                'description' => ucwords(str_replace('_', ' ', $permission))
            ]);
            if(end($roles) !== $role) {
                $createdRole->attachPermissions($createdPermissions);
            }
        }

    }

    /**
     * Truncates all the laratrust tables and the users table
     *
     * @return  void
     */
    public function truncateLaratrustTables()
    {
        $this->command->info('Truncating User, Role and Permission tables');
        Schema::disableForeignKeyConstraints();

        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        Schema::enableForeignKeyConstraints();
    }
}

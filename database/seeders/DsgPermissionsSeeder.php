<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class DsgPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->truncateLaratrustTables();
        $permissions = [
            'view_all_users',
            'edit_users_roles',
            'view_advanced_dive_data',
            'view_edit_advanced_lab',
            'edit_settings',
            'own_other_users',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'display_name' => ucwords(str_replace('_', ' ', $permission)),
                'description' => ucwords(str_replace('_', ' ', $permission)),
            ]);
        }
    }
}

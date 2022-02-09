<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GFSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        settings()->group('gf')->set([
            'yellow_limit' => 74,
            'red_limit' => 87,
            'gf_hi' => 80,
            'gf_low'=> 40,
        ]);
    }
}

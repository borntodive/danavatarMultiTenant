<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesHypertable extends Migration
{
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS timescaledb;');
        if (app()->environment('local'))
            DB::statement("SELECT create_hypertable('samples', 'time');");
        else {
            DB::statement("SELECT create_distributed_hypertable('samples', 'time', 'sensor_id');");
            DB::statement("SELECT add_dimension('samples', 'user_id');");
        }
    }

    public function down()
    {
        //
    }
}

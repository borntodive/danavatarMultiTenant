<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplesHypertable extends Migration
{
    public function up()
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS timescaledb;');
        DB::statement("SELECT create_hypertable('samples', 'time');");
    }

    public function down()
    {
        //
    }
}

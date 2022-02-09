<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('sensor_id');
            $table->timestamp('time', 13)->index();
            $table->float('value');

            $table->timestamps();
            $table->primary(['user_id', 'sensor_id', 'time']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('samples');
    }
};

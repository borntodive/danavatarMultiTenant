<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sensors_per_day', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('user_id');
            $table->timestamp('date');
            $table->text('sensors');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sensors_per_days');
    }
};

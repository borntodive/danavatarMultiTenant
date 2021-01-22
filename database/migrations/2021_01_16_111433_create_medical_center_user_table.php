<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalCenterUserTable extends Migration
{
    public function up()
    {
        Schema::create('medical_center_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreignId('medical_center_id');
            //

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_center_user');
    }
}

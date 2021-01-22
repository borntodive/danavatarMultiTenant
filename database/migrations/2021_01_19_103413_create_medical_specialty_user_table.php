<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalSpecialtyUserTable extends Migration
{
    public function up()
    {
        Schema::create('medical_specialty_user', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('user_id');
            $table->foreignId('medical_specialty_id');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_specialty_user');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalSpecialtiesTable extends Migration
{
    public function up()
    {
        Schema::create('medical_specialties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug');
            $table->boolean('only_center')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('medical_specialties');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnamnesesTable extends Migration
{
    public function up()
    {
        Schema::create('anamneses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('data')->nullable();

            //
            $table->foreignId('tenant_id')->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('anamneses');
    }
}

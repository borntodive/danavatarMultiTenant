<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTokensTable extends Migration
{
    public function up()
    {
        Schema::create('api_tokens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token')->unique()->index();
            $table->foreignId('tenant_id')->constrained()->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_tokens');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email');
            $table->string('codice_fiscale');
            $table->boolean('is_admin')->default(false);
            $table->date('dob');
            $table->string('token');
            $table->dateTime('expires_at');
            $table->dateTime('accepted_at')->nullable();
            $table->ipAddress('accepted_ip')->nullable();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');

            //

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invites');
    }
};

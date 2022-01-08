<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewDiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('dives');
        Schema::create('dives', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('uploader_id');
            $table->unsignedBigInteger('confetech_id')->nullable();
            $table->dateTime('upload_time');
            $table->string('type');
            $table->dateTime('date');
            $table->float('depth');
            $table->float('temp');
            $table->float('runtime');
            $table->json('profile');
            $table->json('mini_chart');
            $table->dateTime('end_date');
            $table->json('gf')->nullable();
            $table->json('gf_computer')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dives');
    }
}

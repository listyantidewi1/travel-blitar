<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['bus', 'train']);
            $table->integer('line');
            $table->unsignedBigInteger('from_place_id');
            $table->unsignedBigInteger('to_place_id');
            $table->time('departure_time');
            $table->time('arrival_time');
            $table->integer('distance');
            $table->time('speed');
            $table->timestamps();

            $table->foreign('from_place_id')->references('id')->on('place');
            $table->foreign('to_place_id')->references('id')->on('place');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Dump extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id('id');
            $table->string('title');
            $table->longText('description');
            $table->string('video');
            $table->string('image');
            $table->string('age');
            $table->string('duration');
            $table->string('director');
            $table->string('rating');
            $table->string('country');
            $table->string('studio');
            $table->string('language');
            $table->string('start_hire');
            $table->string('end_hire');
            $table->string('price');
            $table->timestamps();
        });

        Schema::create('places', function (Blueprint $table) {
            $table->id('id');
            $table->integer('row');
            $table->integer('place');
        });

        Schema::create('reservation', function (Blueprint $table) {
           $table->id('id');
           $table->string('number');
           $table->integer("film_id");
           $table->integer('place_id')->nullable();
           $table->string('created_at');
        });

        Schema::create('reservation_places', function (Blueprint $table) {
           $table->id('id');
           $table->integer('film_id');
           $table->integer('place_id');
           $table->integer('is_reserved')->default(0);
        });

        Schema::create('payment', function (Blueprint $table) {
           $table->id('id');
           $table->string('number');
           $table->string('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('films');
        Schema::dropIfExists('places');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('reservation');
        Schema::dropIfExists('reservation_places');
        Schema::dropIfExists('payment');
    }
}

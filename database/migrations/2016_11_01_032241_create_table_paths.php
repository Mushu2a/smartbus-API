<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePaths extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paths', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('bookingSeats');
            $table->integer('remainingSeats');
            $table->tinyInteger('type')->default('0')->comment = "Type de trajet ? 0 => aller-retour | 1 => aller | 2 => retour";
            $table->string('startPlace');
            $table->string('startCity');
            $table->string('startZip');
            $table->string('middlePlace')->nullable();
            $table->string('middleCity')->nullable();
            $table->string('middleZip')->nullable();
            $table->string('finnishPlace');
            $table->string('finnishCity');
            $table->string('finnishZip');
            $table->integer('price');
            $table->dateTime('date');
            $table->time('startTime');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('paths');
    }
}

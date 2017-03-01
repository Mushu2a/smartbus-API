<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('lastname', 30);
            $table->string('firstname', 30);
            $table->string('email')->unique();
            $table->string('username', 30)->unique();
            $table->integer('phone')->nullable();
            $table->dateTime('birthday');
            $table->string('address1', 50);
            $table->string('address2', 50);
            $table->string('city', 30);
            $table->integer('zip');
            $table->string('country', 30);
            $table->tinyInteger('gender')->default('0')->comment = "0 => Homme | 1 => Femme";
            $table->string('brandBus')->nullable()->comment = "Marque du Bus";
            $table->string('comfort')->nullable()->comment = "Confort du Bus";
            $table->integer('number')->nullable()->comment = "Nombre de place dans le Bus";
            $table->tinyInteger('owner')->default('0')->comment = "Possède t'il un bus ? 0 => Non | 1 => Oui";
            $table->string('password');
            $table->string('api_token')->unique();
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
        Schema::drop('users');
    }
}

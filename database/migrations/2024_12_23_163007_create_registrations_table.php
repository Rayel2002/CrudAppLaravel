<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id('registration_Id');
            $table->unsignedBigInteger('user_Id');
            $table->unsignedBigInteger('reservation_Id');
            $table->string('registrationStatus'); // Voeg deze kolom toe
            $table->dateTime('registrationDate')->nullable(); // Voeg dit ook toe, als het in de seeder gebruikt wordt

            $table->foreign('user_Id')->references('user_Id')->on('users')->onDelete('cascade');
            $table->foreign('reservation_Id')->references('reservation_id')->on('reservations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}


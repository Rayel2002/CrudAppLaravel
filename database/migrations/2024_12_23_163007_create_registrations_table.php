<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('registration_Id'); // Primaire sleutel
            $table->unsignedBigInteger('user_Id'); // Foreign key naar users
            $table->unsignedBigInteger('reservation_Id'); // Foreign key naar reservations
            $table->enum('registrationStatus', ['pending', 'approved', 'declined']); // Status van registratie
            $table->timestamp('registrationDate')->useCurrent();
            $table->timestamps();

            $table->foreign('user_Id')->references('user_Id')->on('users')->onDelete('cascade');
            $table->foreign('reservation_Id')->references('reservation_Id')->on('reservations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}

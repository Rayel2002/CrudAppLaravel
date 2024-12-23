<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsMetaTable extends Migration
{
    public function up()
    {
        Schema::create('registrations_meta', function (Blueprint $table) {
            $table->unsignedBigInteger('registration_Id');
            $table->string('registration_status');
            $table->dateTime('registration_date');

            $table->foreign('registration_Id')->references('registration_Id')->on('registrations')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('registrations_meta');
    }
}


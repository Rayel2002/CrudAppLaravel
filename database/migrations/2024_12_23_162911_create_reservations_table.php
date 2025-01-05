<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('reservation_Id'); // Primaire sleutel
            $table->unsignedBigInteger('created_by'); // Foreign key naar users
            $table->unsignedBigInteger('status_Id'); // Foreign key naar statuses
            $table->unsignedBigInteger('category_Id'); // Foreign key naar categories
            $table->string('reservation_type'); // Type reservering, bijvoorbeeld 'meeting'
            $table->time('start_time');
            $table->time('end_time');
            $table->string('place');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('user_Id')->on('users')->onDelete('cascade');
            $table->foreign('status_Id')->references('status_Id')->on('statuses')->onDelete('cascade');
            $table->foreign('category_Id')->references('category_Id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}


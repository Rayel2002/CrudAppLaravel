<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->bigIncrements('reservation_Id');
        $table->unsignedBigInteger('created_by');
        $table->unsignedBigInteger('status_Id')->default(1); // Standaard naar "In behandeling"
        $table->unsignedBigInteger('category_Id');
        $table->unsignedBigInteger('type_Id'); // Nieuwe relatie met types
        $table->time('start_time');
        $table->time('end_time');
        $table->string('place');
        $table->text('description')->nullable();
        $table->timestamps();

        $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('status_Id')->references('status_Id')->on('statuses')->onDelete('cascade');
        $table->foreign('category_Id')->references('category_Id')->on('categories')->onDelete('cascade');
        $table->foreign('type_Id')->references('type_Id')->on('types')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}


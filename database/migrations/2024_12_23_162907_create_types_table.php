<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('type_Id');
            $table->unsignedBigInteger('category_Id'); // Foreign key naar categories
            $table->string('name')->unique();
            $table->timestamps();

            $table->foreign('category_Id')->references('category_Id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('types');
    }
}

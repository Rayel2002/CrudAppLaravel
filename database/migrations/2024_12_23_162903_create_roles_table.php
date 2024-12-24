<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id('role_Id'); // Primary key
            $table->unsignedBigInteger('permission_Id'); // Foreign key to permissions
            $table->string('role');
            $table->timestamps();

            $table->foreign('permission_Id')->references('permission_Id')->on('permissions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('role_Id');
            $table->unsignedBigInteger('permission_Id');

            $table->foreign('role_Id')->references('role_Id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_Id')->references('permission_Id')->on('permissions')->onDelete('cascade');

            $table->primary(['role_Id', 'permission_Id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}


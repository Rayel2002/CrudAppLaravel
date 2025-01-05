<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionsTable extends Migration
{
    public function up()
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('role_Id'); // Foreign key naar roles
            $table->unsignedBigInteger('permission_Id'); // Foreign key naar permissions

            $table->foreign('role_Id')->references('role_Id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_Id')->references('permission_Id')->on('permissions')->onDelete('cascade');

            $table->primary(['role_Id', 'permission_Id']); // Combinatie van beide als primaire sleutel
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_permissions');
    }
}

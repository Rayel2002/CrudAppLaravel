<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();

        Role::all()->each(function ($role) use ($permissions) {
            $role->permissions()->attach($permissions->random(2)->pluck('permission_Id')->toArray());
        });
    }
}


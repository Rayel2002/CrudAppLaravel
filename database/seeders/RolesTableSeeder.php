<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();

        $roles = [
            ['role' => 'Admin', 'permission_Id' => $permissions->where('permission', 'Full Access')->first()->permission_Id],
            ['role' => 'Manager', 'permission_Id' => $permissions->where('permission', 'Limited Access')->first()->permission_Id],
            ['role' => 'User', 'permission_Id' => $permissions->where('permission', 'Read Only')->first()->permission_Id],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}

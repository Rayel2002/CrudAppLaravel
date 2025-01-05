<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolePermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = Permission::all();

        if ($permissions->isEmpty()) {
            $this->command->error('No permissions found. Please run PermissionsTableSeeder first.');
            return;
        }

        $roles = Role::all();

        if ($roles->isEmpty()) {
            $this->command->error('No roles found. Please run RolesTableSeeder first.');
            return;
        }

        $roles->each(function ($role) use ($permissions) {
            $role->permissions()->attach(
                $permissions->random(rand(1, $permissions->count()))->pluck('permission_Id')->toArray()
            );
        });

        if (DB::table('role_permissions')->count() === 0) {
            $this->command->error('RolePermissions not seeded. Check RolePermissionsSeeder.');
        } else {
            $this->command->info('RolePermissions successfully seeded!');
        }
    }
}

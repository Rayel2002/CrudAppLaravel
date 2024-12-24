<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['permission' => 'Full Access'],
            ['permission' => 'Limited Access'],
            ['permission' => 'Read Only'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}

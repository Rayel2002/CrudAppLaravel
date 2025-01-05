<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            ['permission' => 'Full Access', 'created_at' => now(), 'updated_at' => now()],
            ['permission' => 'Limited Access', 'created_at' => now(), 'updated_at' => now()],
            ['permission' => 'Read Only', 'created_at' => now(), 'updated_at' => now()],
        ];

        Permission::insert($permissions);

        if (Permission::count() === 0) {
            $this->command->error('Permissions not seeded. Check PermissionsTableSeeder.');
        } else {
            $this->command->info('Permissions successfully seeded!');
        }
    }
}

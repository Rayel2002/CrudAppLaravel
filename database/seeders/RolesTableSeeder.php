<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['role' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'Manager', 'created_at' => now(), 'updated_at' => now()],
            ['role' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ];

        Role::insert($roles);
    }
}


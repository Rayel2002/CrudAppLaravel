<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            RolePermissionsSeeder::class,
            UsersTableSeeder::class,
            StatusSeeder::class,
            CategorySeeder::class,
            ReservationsTableSeeder::class,
            RegistrationsTableSeeder::class,
        ]);
    }
}

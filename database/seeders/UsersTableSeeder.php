<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'geboortedatum' => '1990-01-01',
                'role_Id' => 1,
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'password' => bcrypt('password'),
                'geboortedatum' => '1992-05-10',
                'role_Id' => 2,
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'geboortedatum' => '1995-07-15',
                'role_Id' => 3,
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

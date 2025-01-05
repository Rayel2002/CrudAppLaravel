<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Type;

class ReservationsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::count();
        $types = Type::count();

        if ($users === 0) {
            $this->command->error('No users found. Please run UsersTableSeeder first.');
            return;
        }

        if ($types === 0) {
            $this->command->error('No types found. Please run TypeSeeder first.');
            return;
        }

        $reservations = [
            [
                'type_Id' => 1, // Zorg ervoor dat dit overeenkomt met een bestaand Type
                'category_Id' => 1, // Zorg ervoor dat dit overeenkomt met een bestaande Category
                'start_time' => now()->addDays(1)->setTime(10, 0),
                'end_time' => now()->addDays(1)->setTime(11, 0),
                'place' => 'Conference Room A',
                'description' => 'Team meeting to discuss project updates.',
                'status_Id' => 1, // Standaard status (In behandeling)
                'created_by' => 1, // Zorg ervoor dat dit overeenkomt met een bestaande gebruiker
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_Id' => 2, // Bijvoorbeeld "Workshop"
                'category_Id' => 2, // Zorg ervoor dat dit overeenkomt met een bestaande Category
                'start_time' => now()->addDays(2)->setTime(14, 0),
                'end_time' => now()->addDays(2)->setTime(16, 0),
                'place' => 'Workshop Hall B',
                'description' => 'Hands-on workshop on new tools.',
                'status_Id' => 1, // Standaard status (In behandeling)
                'created_by' => 2, // Zorg ervoor dat dit overeenkomt met een bestaande gebruiker
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Reservation::insert($reservations);
    }
}

<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;

class ReservationsTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::count();

        if ($users === 0) {
            $this->command->error('No users found. Please run UsersTableSeeder first.');
            return;
        }

        $reservations = [
            [
                'reservation_type' => 'Meeting',
                'start_time' => now()->addDays(1)->setTime(10, 0),
                'end_time' => now()->addDays(1)->setTime(11, 0),
                'place' => 'Conference Room A',
                'description' => 'Team meeting to discuss project updates.',
                'status_Id' => 1,
                'category_Id' => 1,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Reservation::insert($reservations);
    }
}

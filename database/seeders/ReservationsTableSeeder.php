<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationsTableSeeder extends Seeder
{
    public function run()
    {
        $reservations = [
            [
                'reservation_type' => 'Meeting',
                'start_time' => now()->addDays(1)->setTime(10, 0),
                'end_time' => now()->addDays(1)->setTime(11, 0),
                'place' => 'Conference Room A',
                'description' => 'Team meeting to discuss project updates.',
            ],
            [
                'reservation_type' => 'Workshop',
                'start_time' => now()->addDays(2)->setTime(14, 0),
                'end_time' => now()->addDays(2)->setTime(16, 0),
                'place' => 'Workshop Hall B',
                'description' => 'Hands-on workshop on new software tools.',
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}

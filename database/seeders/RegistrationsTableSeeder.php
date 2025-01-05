<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;
use App\Models\Reservation;

class RegistrationsTableSeeder extends Seeder
{
    public function run()
    {
        $reservations = Reservation::count();

        if ($reservations === 0) {
            $this->command->error('No reservations found. Please run ReservationsTableSeeder first.');
            return;
        }

        $registrations = [
            [
                'user_Id' => 2,
                'reservation_Id' => 1,
                'registrationStatus' => 'approved',
                'registrationDate' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        Registration::insert($registrations);
    }
}

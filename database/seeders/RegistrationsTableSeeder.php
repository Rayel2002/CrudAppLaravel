<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Registration;

class RegistrationsTableSeeder extends Seeder
{
    public function run()
    {
        $registrations = [
            [
                'user_Id' => 1,
                'reservation_Id' => 1,
                'registrationStatus' => 'Confirmed',
                'registrationDate' => now(),
            ],
            [
                'user_Id' => 2,
                'reservation_Id' => 2,
                'registrationStatus' => 'Pending',
                'registrationDate' => now(),
            ],
        ];

        foreach ($registrations as $registration) {
            Registration::create($registration);
        }
    }
}

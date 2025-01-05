<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['status_Id' => 1, 'status' => 'In behandeling'],
            ['status_Id' => 2, 'status' => 'Afgewezen'],
            ['status_Id' => 3, 'status' => 'Geaccepteerd'],
        ];

        foreach ($statuses as $status) {
            Status::updateOrCreate(['status_Id' => $status['status_Id']], $status);
        }
    }
}

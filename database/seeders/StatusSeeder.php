<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            ['status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'inactive', 'created_at' => now(), 'updated_at' => now()],
        ];

        Status::insert($statuses);
    }
}

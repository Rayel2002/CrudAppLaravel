<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    public function run()
    {
        Type::insert([
            ['name' => 'Vergadering', 'category_Id' => 1],
            ['name' => 'Presentatie', 'category_Id' => 1],
            ['name' => 'Workshop', 'category_Id' => 2],
            ['name' => 'Training', 'category_Id' => 2],
        ]);
    }
}

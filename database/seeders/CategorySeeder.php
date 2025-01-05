<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['category_name' => 'Training', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Event', 'created_at' => now(), 'updated_at' => now()],
        ];

        Category::insert($categories);
    }
}

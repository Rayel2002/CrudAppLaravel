<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::insert([
            ['category_Id' => 1, 'name' => 'Zakelijk'],
            ['category_Id' => 2, 'name' => 'Educatief'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Novela',
            ],
            [
                'name' => 'Fantasía',
            ],
            [
                'name' => 'Clásicos',
            ],
            [
                'name' => 'Ciencia ficción',
            ],
            [
                'name' => 'Infantil',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'id'=> 1,
                'name'=> 'Mobile Phone'
            ],
            [
                'id'=> 2,
                'name'=> 'Laptop'
            ],
            [
                'id'=> 3,
                'name'=> 'Book'
            ]
        ];

        Category::insert($categories);

    }
}

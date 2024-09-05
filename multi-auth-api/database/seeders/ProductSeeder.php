<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name'=> 'Lenovo Thinkpad',
            'price'=> 599.99,
            'category_id'=> Category::where('name', 'Electronics')->first()->id,
            'user_id'=> 1
        ]);

        Product::create([
            'name'=> 'The Ghost in Love',
            'price'=> 22.99,
            'category_id'=> Category::where('name', 'Books')->first()->id,
            'user_id'=> 1
        ]);

        Product::create([
            'name'=> 'Harry Potter - The Philosopher\'s Stone',
            'price'=> 59.99,
            'category_id'=> Category::where('name', 'Books')->first()->id,
            'user_id'=> 1
        ]);

        Product::create([
            'name'=> 'Watches',
            'price'=> 99.99,
            'category_id'=> Category::where('name', 'Accessories')->first()->id,
            'user_id'=> 1
        ]);
    }
}

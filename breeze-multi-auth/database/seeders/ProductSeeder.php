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
            'name'=> 'Samsung Galaxy S23',
            'price'=> 899,
            'category_id'=> Category::where('name', 'Smartphones')->first()->id
        ]);
        Product::create([
            'name'=> 'iPhone 14',
            'price'=> 999,
            'category_id'=> Category::where('name', 'Smartphones')->first()->id
        ]);

        Product::create([
            'name'=> 'HP Spectre x360',
            'price'=> 1299,
            'category_id'=> Category::where('name', 'Laptops')->first()->id
        ]);
        Product::create([
            'name'=> 'MacBook Air M2',
            'price'=> 1199,
            'category_id'=> Category::where('name', 'Laptops')->first()->id
        ]);

        Product::create([
            'name'=> 'Belts',
            'price'=> 49.99,
            'category_id'=> Category::where('name', 'Accessories')->first()->id
        ]);
        Product::create([
            'name'=> 'Watches',
            'price'=> 199.99,
            'category_id'=> Category::where('name', 'Accessories')->first()->id
        ]);
    }
}

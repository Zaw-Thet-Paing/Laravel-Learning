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
            'name'=> 'Smartphone',
            'price'=> '699',
            'category_id'=> Category::where('name', 'Electronics')->first()->id
        ]);

        Product::create([
            'name' => 'Laptop',
            'price' => '999',
            'category_id' => Category::where('name', 'Electronics')->first()->id
        ]);

        Product::create([
            'name' => 'Novel',
            'price' => '19',
            'category_id' => Category::where('name', 'Books')->first()->id
        ]);

        Product::create([
            'name' => 'T-Shirt',
            'price' => '29',
            'category_id' => Category::where('name', 'Clothing')->first()->id
        ]);
    }
}

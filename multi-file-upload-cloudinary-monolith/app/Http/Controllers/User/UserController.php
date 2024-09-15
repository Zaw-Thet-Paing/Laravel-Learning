<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('photos')->paginate(12);
        return view('user.index', compact('categories', 'products'));
    }

    public function productByCategory(Category $category)
    {
        // dd($category->toArray());
        $products = $category->products()->paginate(12);
        // dd($products->toArray());
        $categories = Category::all();

        return view('user.index', compact('categories', 'products'));
    }

    public function productDetails(string $id)
    {
        $product = Product::with(['photos', 'category'])->findOrFail($id);
        // dd($product);
        return view('user.details', compact('product'));
    }
}

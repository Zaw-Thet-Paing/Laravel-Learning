<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        // $products = Product::select('products.*', 'categories.name as category_name')
        //                 ->leftJoin('categories', 'products.category_id','=', 'categories.id')
        //                 ->get();
        // dd($products->toArray());
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'price'=> 'required',
            'category_id'=> 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('product.create')->with('product_create_failed', 'All field need to fill');
        }

        Product::create([
            'name'=> $request['name'],
            'price'=> $request['price'],
            'category_id'=> $request['category_id']
        ]);

        return redirect()->route('product.index')->with('product_create_success', 'Product created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name'=> 'required',
            'price'=> 'required',
            'category_id'=> 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('product.edit', $product->id)->with('product_edit_failed', 'All field need to fill');
        }

        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->category_id = $request['category_id'];
        $product->update();

        return redirect()->route('product.index')->with('product_updated_success', 'Product Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index')->with('product_delete_success', 'Product Deleted!');
    }
}

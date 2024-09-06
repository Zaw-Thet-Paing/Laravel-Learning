<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'user'])->get();
        // $products->load(['category', 'user']); //load() is used to lazy load relationship on an already fetched collection
        return response()->json([
            'message'=> 'Get all products',
            'data'=> $products
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->ip());
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'price'=> 'required|numeric',
            'category_id'=> 'required|exists:categories,id'
        ]);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->errors()], 422);
        }
        $product = Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::user()->id
        ]);
        return response()->json([
            'message'=> 'Product created',
            'data'=> $product
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['category', 'product'])->find($id);

        if(!$product){
            return response()->json(['error'=> 'Product not found'], 404);
        }

        return response()->json([
            'message'=> 'Get Product by ID',
            'data'=> $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if(!$product){
            return response()->json([
                'error'=> 'Product not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'price'=> 'required|numeric',
            'category_id'=> 'required|exists:categories,id'
        ]);
        if($validator->fails()){
            return response()->json(['errors'=> $validator->errors()], 422);
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->user_id = Auth::user()->id;
        $product->update();

        return response()->json([
            'message'=> 'Product Updated',
            'data'=> $product
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['error'=> 'Product not found'], 404);
        }
        $product->delete();
        return response()->json([
            'message'=> 'Product deleted successfully'
        ], 200);
    }
}

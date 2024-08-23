<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message'=> 'Getting all products',
            'data'=> Product::all()
        ]);
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
            return response()->json([
                'errors'=> $validator->errors()
            ], 400);
        }

        $product = new Product();
        $product->name = request('name');
        $product->price = request('price');
        $product->category_id = request('category_id');

        $product->save();

        return response()->json([
            'message'=> 'Product created successfully.',
            'data'=> $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'message'=> 'Product details',
            'data'=> $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{

            $validator = Validator::make($request->all(), [
                'name'=> 'required',
                'price'=> 'required',
                'category_id'=> 'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'errors'=> $validator->errors()
                ], 400);
            }

            $product = Product::findOrFail($id);

            $product->name = request('name');
            $product->price = request('price');
            $product->category_id = request('category_id');
            $product->update();

            return response()->json([
                'message'=> 'Product updated successfully.',
                'data'=> $product
            ]);

        }catch(Exception $e){
            return response()->json([
                'message'=> $e->getMessage(),
                'status'=> 500
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message'=> 'Product deleted successfully.']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all(); // If not, will return null

        return response()->json([
            'message'=> 'Get all categories',
            'data'=> $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string|unique:categories'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422); // Unprocessable Entity
        }

        $category = Category::create($request->only('name'));

        return response()->json([
            'message'=> 'Category created successfully',
            'data'=> $category
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id); // If not, will return null

        return response()->json([
            'message'=> 'Get category by id',
            'data'=> $category
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'error'=> 'Category not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'=> 'required|string|unique:categories,name,' . $category->id
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        $category->update($request->only('name'));

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return response()->json(['error'=> 'Category not found'], 404);
        }

        $category->delete();

        return response()->json(['message'=> 'Category deleted successfully'], 200);

    }
}

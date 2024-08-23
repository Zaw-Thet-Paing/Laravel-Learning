<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'message'=> 'Getting all categories',
            'data'=> Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $validator = Validator::make($request->all(), [
                'name'=> 'required'
            ]);

            if($validator->fails()){
                return response()->json([
                    'errors'=> $validator->errors()
                ], 400);
            }

            $category = new Category();
            $category->name = request('name');

            $category->save();

            return response()->json([
                'message'=> 'Category created successfully.',
                'data'=> $category
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'message'=> 'Category details',
            'data'=> $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors(),
                'status'=> 400
            ], 400);
        }

        $category = Category::findOrFail($id);

        $category->name = request('name');
        $category->update();

        return response()->json([
            'message'=> 'Category updated successfully.',
            'data'=> $category
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message'=> 'Category deleted successfully.']);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::where('user_id', Auth::user()->id)->get();

        $galleries = $galleries->map(function($gallery){
            return [
                'id'=> $gallery->id,
                'title'=> $gallery->title,
                'description'=> $gallery->description,
                'image_url'=> Storage::url($gallery->image_url)
            ];
        });

        return response()->json([
            'message'=> 'Get all galleries',
            'data'=> $galleries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required|string',
            'description'=> 'required|string',
            'photo'=> 'required|file'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        if(!$request->hasFile('photo')){
            return response()->json([
                'error'=> 'Image not found'
            ], 400);
        }

        $path = $request->file('photo')->store('public/' .  Auth::user()->name);

        if(!$path){
            return response()->json([
                'error'=> 'Image upload failed'
            ], 500);
        }

        $gallery = new Gallery();
        $gallery->user_id = Auth::user()->id;
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->image_url = $path;
        $gallery->save();

        return response()->json([
            'message'=> 'Gallery created',
            'data'=> $gallery
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = Gallery::find($id);

        if(!$gallery){
            return response()->json([
                'error'=> 'Gallery not found'
            ], 404);
        }

        if($gallery->user_id !== Auth::user()->id){
            return response()->json([
                'error'=> 'Unauthorized Access'
            ], 401);
        }

        return response()->json([
            'message'=> 'Get gallery by id',
            'data'=> [
                'id'=> $gallery->id,
                'title'=> $gallery->title,
                'description'=> $gallery->description,
                'image_url'=> Storage::url($gallery->image_url)
            ]
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $gallery = Gallery::find($id);

        if(!$gallery){
            return response()->json([
                'error'=> 'Gallery not found'
            ], 404);
        }

        if($gallery->user_id !== Auth::user()->id){
            return response()->json([
                'error'=> 'Unauthorized Access'
            ], 401);
        }

        $validator = Validator::make($request->all(), [
            'title'=> 'required|string',
            'description'=> 'required|string',
            'photo'=> 'nullable|file'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        $gallery->title = $request->title;
        $gallery->description = $request->description;

        if($request->hasFile('photo')){
            if(Storage::has($gallery->image_url)){
                Storage::delete($gallery->image_url);
            }
            $path = $request->file('photo')->store('public/' .  Auth::user()->name);

            if(!$path){
                return response()->json([
                    'error'=> 'Image upload failed'
                ], 500);
            }

            $gallery->image_url = $path;
        }

        $gallery->update();

        return response()->json([
            'message'=> 'Gallery updated',
            'data'=> $gallery
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gallery::find($id);

        if(!$gallery){
            return response()->json([
                'error'=> 'Gallery not found'
            ], 404);
        }

        if($gallery->user_id !== Auth::user()->id){
            return response()->json([
                'error'=> 'Unauthorized Access'
            ], 401);
        }

        if(Storage::has($gallery->image_url)){
            Storage::delete($gallery->image_url);
        }

        $gallery->delete();

        return response()->json([
            'message'=> 'gallery deleted!'
        ], 200);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
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
        $images = Image::where('user_id', Auth::user()->id)->get();
        // dd($images->toArray());
        return view('gallery.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
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
            return redirect()->route('gallery.create')->with('upload_failed', $validator->errors());
        }

        $path = $request->file('photo')->store('public/' . Auth::user()->name);
        // php artisan storage:link
        Image::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'image_url'=> $path,
            'user_id'=> Auth::user()->id
        ]);

        return redirect()->route('gallery.index')->with('uploaded', 'Photo uploaded');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = Image::findOrFail($id);
        return view('gallery.image', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = Image::find($id);
        return view('gallery.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $image = Image::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title'=> 'required',
            'description'=> 'required'
        ]);

        if($validator->fails()){
            return redirect()->route('gallery.edit')->with('update_failed', $validator->errors());
        }

        $image->title = $request->title;
        $image->description = $request->description;

        if($request->file('photo')){
            if(Storage::exists($image->image_url)){
                Storage::delete($image->image_url);
            }
            $path = $request->file('photo')->store('public/' . Auth::user()->name);
            if(!$path){
                return redirect()->route('gallery.edit')->with('update_failed', 'Photo upload failed');
            }

            $image->image_url = $path;
        }

        $image->update();

        return redirect()->route('gallery.index')->with('updated', 'Image updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = Image::findOrFail($id);

        if($image->user_id !== Auth::user()->id){
            return redirect()->route('gallery.index')->with('delete_failed', 'Unauthorized action');
        }

        if(Storage::exists($image->image_url)){
            Storage::delete($image->image_url);
        }

        $image->delete();

        return redirect()->route('gallery.index')->with('deleted', 'Photo deleted successfully');

    }
}

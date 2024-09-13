<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'price'=> 'required',
            'description'=> 'required',
            'photos'=> 'required|array',
            'photos.*'=> 'required|file',
            'category_id'=> 'required|integer|exists:categories,id'
        ]);

        if($validator->fails()){
            return redirect()->route('admin.product.create')->with('create_fail', $validator->errors());
        }

        // $cloudinaryImage = $request->file('photo')->storeOnCloudinary('products');
        // $url = $cloudinaryImage->getSecurePath();
        // $public_id = $cloudinaryImage->getPublicId();
        // $response = cloudinary()->upload($request->file('photo')->getRealPath())->getSecurePath();

        // dd($url);
        $product = Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'description'=> $request->description,
            'category_id'=> $request->category_id,
            'user_id'=> Auth::user()->id
        ]);

        foreach($request->file('photos') as $photo){
            $cloudinaryImage = $photo->storeOnCloudinary('products');
            $url = $cloudinaryImage->getSecurePath();
            $public_id = $cloudinaryImage->getPublicId();

            Photo::create([
                'image_url'=> $url,
                'product_id'=> $product->id,
                'public_id'=> $public_id
            ]);
        }

        return redirect()->route('admin.product.index')->with('created', 'Product Created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with(['photos', 'category'])->findOrFail($id);
        // dd($product->toArray());
        return view('admin.product.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::with(['category', 'photos'])->findOrFail($id);
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'price'=> 'required',
            'description'=> 'required',
            'photos'=> 'nullable|array',
            'photos.*'=> 'nullable|file',
            'category_id'=> 'required|integer|exists:categories,id'
        ]);

        if($validator->fails()){
            return redirect()->route('admin.product.create')->with('edit_fail', $validator->errors());
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->update();

        // dd($request->hasFile('photos'));
        if($request->hasFile('photos')){
            foreach($request->file('photos') as $photo){
                $cloudinaryImage = $photo->storeOnCloudinary('products');
                $url = $cloudinaryImage->getSecurePath();
                $public_id = $cloudinaryImage->getPublicId();

                Photo::create([
                    'image_url'=> $url,
                    'product_id'=> $product->id,
                    'public_id'=> $public_id
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('updated', 'Product Updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        foreach($product->photos as $photo){
            Cloudinary::destroy($photo->public_id);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('deleted', 'Product Deleted');
    }

    public function deletePhoto(string $id){
        $photo = Photo::findOrFail($id);
        // dd($photo);
        Cloudinary::destroy($photo->public_id);
        $photo->delete();
        return redirect()->back();
    }
}

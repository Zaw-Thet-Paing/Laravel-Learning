<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'message'=> 'Get all posts',
            'data'=> $posts
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required|string',
            'content'=> 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        $post = new Post();
        $post->user_id = Auth::user()->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return response()->json([
            'message'=> 'Post Created',
            'data'=> $post
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                'error'=> 'Post not found'
            ], 404);
        }

        return response()->json([
            'message'=> 'Get post by id ' . $id,
            'data'=> $post
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                'error'=> 'Post not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'title'=> 'required|string',
            'content'=> 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->update();

        return response()->json([
            'message'=> 'Post updated',
            'data'=> $post
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);

        if(!$post){
            return response()->json([
                'error'=> 'Post not found'
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message'=> 'Post deleted'
        ], 200);
    }
}

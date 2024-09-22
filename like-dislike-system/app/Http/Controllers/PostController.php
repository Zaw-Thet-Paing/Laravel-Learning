<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();
        return view('posts', compact('posts'));
    }

    public function ajaxLike(Request $request)
    {
        $post = Post::find($request->id);
        $response = Auth::user()->toggleLikeDislike($post->id, $request->like);

        return response()->json(['success' => $response]);
    }

}

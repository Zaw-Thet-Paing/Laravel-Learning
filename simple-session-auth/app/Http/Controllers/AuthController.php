<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string|max:50',
            'email'=> 'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'Validation Error',
                'errors'=> $validator->errors()
            ], 400);
        }

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        Auth::login($user);

        return response()->json([
            'message'=> 'User registered an logged in successfully',
            'data'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email
            ]
        ]);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=> 'required|string|email',
            'password'=> 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> 'Validation Error',
                'errors'=> $validator->errors()
            ], 400);
        }

        $user = User::where('email', $request->email)->first();

        if(!$user or !Hash::check($request->password, $user->password)){
            return response()->json([
                'message'=> 'Invalid credential'
            ]);
        }

        Auth::login($user);

        return response()->json([
            'message'=> 'Login successful',
            'data'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email
            ]
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        return response()->json([
            'message'=> 'user logged out successfully'
        ]);
    }

    public function home(){
        if(Auth::check()){
            $user = Auth::user();

            return response()->json([
                'message'=> 'Welcome to home page',
                'data'=> [
                    'id'=> $user->id,
                    'name'=> $user->name,
                    'email'=> $user->email
                ]
            ]);
        }
        return response()->json([
            'message'=> 'Unauthorized'
        ], 401);
    }
}

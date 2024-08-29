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
            'email'=> 'required|string|email|unique:users',
            'password'=> 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> $validator->errors()
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'message'=> 'Register Success',
            'token_type'=> 'Bearer',
            'access_token'=> $token,
            'data'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email
            ]
        ];

        return response()->json($response, 201);

    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> $validator->errors()
            ]);
        }

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message'=> 'Incorrect email or password'
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'message'=> 'Register Success',
            'token_type'=> 'Bearer',
            'access_token'=> $token,
            'data'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email
            ]
        ];

        return response()->json($response, 200);

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=> 'Logout successful'
        ]);
    }

    public function home(){
        return response()->json([
            'message'=> 'Home Page',
            'data'=> [
                'id'=> Auth::user()->id,
                'name'=> Auth::user()->name,
                'email'=> Auth::user()->email
            ]
        ]);
    }

    public function unauthenticated(){
        return response()->json([
            'message'=> 'Unauthenticated. Please login first'
        ]);
    }
}

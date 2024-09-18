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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:8'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        // Need to create custom personal access token model cuz sanctum only support for sql
        $auth_token = $user->createToken('auth_token')->plainTextToken;
        // dd($user->toArray());
        $response_data = [
            'message'=> 'Register success',
            'token_type'=> 'Bearer',
            'access_token'=> $auth_token,
            'data'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email
            ]
        ];
        return response()->json($response_data, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=> $validator->errors()
            ], 422);
        }

        if(!Auth::attempt($request->only(['email', 'password']))){
            return response()->json([
                'error'=> 'Credential Wrong'
            ]);
        }

        $user = Auth::user();
        $auth_token = $user->createToken('auth_token')->plainTextToken;

        $response_data = [
            'message'=> 'Login Success',
            'token_type'=> 'Bearer',
            'access_token'=> $auth_token,
            'data'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email
            ]
        ];

        return response()->json($response_data, 200);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=> 'Logout Successful'
        ]);
    }

    public function unauthorized()
    {
        return response()->json([
            'message'=> 'Please login first'
        ]);
    }
}

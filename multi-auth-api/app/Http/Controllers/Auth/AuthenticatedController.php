<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthenticatedController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=> 'required|string',
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

        $response_data = [
            'message'=> 'Login success',
            'token_type'=> 'Bearer',
            'access_token'=> $token,
            'date'=> [
                'id'=> $user->id,
                'name'=> $user->name,
                'email'=> $user->email,
                'role'=> $user->role
            ]
        ];

        return response()->json($response_data, 200);

    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=> 'Logout successful'
        ]);
    }

    public function unauthenticated()
    {
        return response()->json([
            'message'=> 'Please login first'
        ]);
    }
}

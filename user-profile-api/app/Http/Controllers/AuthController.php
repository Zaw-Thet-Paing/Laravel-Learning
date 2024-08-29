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
            'email'=> 'required|email|unique:users',
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

        $user->profile()->create();

        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'message'=> 'Register success',
            'token_type'=> 'Bearer',
            'access_token'=> $token,
        ];

        return response()->json($response, 201);

    }

    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email'=> 'required|email',
            'password'=> 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'message'=> $validator->errors()
            ]);
        }

        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message'=> 'Invalid Credential'
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = [
            'message'=> 'Login Success',
            'token_type'=> 'Bearer',
            'access_token'=> $token
        ];

        return response()->json($response);

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=> 'User logout success'
        ]);
    }

    public function unauthenticated(){
        return response()->json([
            'message'=> 'Unauthenticated access'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user = $user->load('profile');

        $response = [
            'id'=> $user->id,
            'name'=> $user->email,
            'email'=> $user->email,
            'profile'=> [
                'id'=> $user->profile->id,
                'bio'=> $user->profile->bio,
                'phone_number'=> $user->profile->phone_number,
                'address'=> $user->profile->address
            ]
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request){
        $user = Auth::user();
        $user->profile()->update([
            'bio'=> $request->bio,
            'phone_number'=> $request->phone_number,
            'address'=> $request->address
        ]);

        return response()->json([
            'message'=> 'Profile updated successfully'
        ]);
    }

}

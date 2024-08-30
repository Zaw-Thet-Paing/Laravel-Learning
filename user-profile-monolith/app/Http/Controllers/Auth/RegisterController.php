<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register_page(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|string|min:8'
        ]);

        if($validator->fails()){
            return redirect()->route('register')->with('register_failed', $validator->errors());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        $user->profile()->create();
        Auth::login($user);
        return redirect()->route('profile.index');
    }
}

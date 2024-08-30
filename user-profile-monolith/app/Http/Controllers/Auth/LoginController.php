<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login_page(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('profile.index');
        }

        return redirect()->route('login')->with('login_failed', 'Credential wrong');

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();
        $user = $user->load('profile');
        return view('user.profile', compact('user'));
    }

    public function update(Request $request){
        $profile = Profile::find(Auth::user()->id);

        $profile->bio = $request->bio;
        $profile->phone_number = $request->phone_number;
        $profile->address = $request->address;
        $profile->update();

        return redirect()->route('profile.index')->with('profile_updated', 'Profile Update');

    }

}

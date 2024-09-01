<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function changePassword()
    {
        return view('user.changePassword');
    }

    public function updatePassword()
    {
        $oldPassword = request('oldPassword');
        $confirmPassword = request('confirmPassword');
        $user = Auth::user();

        if(!Hash::check($oldPassword, $user->password)){
            return redirect()->route('profile.changePasswordPage')->with('password_update_failed', 'Old password didn\'t match');
        }

        $user->password = Hash::make($confirmPassword);
        $user->update();

        return redirect()->route('profile.index')->with('password_changed', 'Password changed');

    }

}

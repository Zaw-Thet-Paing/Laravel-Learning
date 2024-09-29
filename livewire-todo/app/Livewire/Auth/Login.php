<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{

    public $email;
    public $password;

    public function login()
    {
        $credentials = $this->validate([
            'email'=> 'required',
            'password'=> 'required'
        ]);

        if(!Auth::attempt($credentials)){
            $this->addError('email', 'The provided credentials do not match our records.');
        }else{
            $this->redirect(route('user.home'), navigate:true);
        }

    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}

<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{

    public function logout()
    {
        Auth::logout();
        $this->redirect(route('login'), navigate:true);
    }

    public function render()
    {
        return view('livewire.profile');
    }
}

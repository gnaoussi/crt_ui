<?php

namespace App\Livewire;

use Livewire\Component;

class LoginComponent extends Component
{
    public $email = 'jean-marc.dupont@crtsolution.com';
    public $password = '••••••••••••';
    public $showPassword = false;
    public $rememberMe = true;
    public $isCaptchaChecked = true;

    public function login()
    {
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.login-component')->layout('components.layouts.guest');
    }
}

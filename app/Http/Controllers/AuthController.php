<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{

    // use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function account(): View
    {
        return view('auth.account');
    }

    public function login(): View
    {
        return view('auth.login');
    }

    public function register(): View
    {
        return view('auth.register');
    }

}

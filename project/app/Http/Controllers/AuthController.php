<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegister() {
        return view('login-register.register');
    }
    public function showLogin() {
        return view('login-register.login');
    }
}

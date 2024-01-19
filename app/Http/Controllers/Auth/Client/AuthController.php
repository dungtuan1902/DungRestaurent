<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.client.page.login');
    }
    public function register()
    {
        return view('auth.client.page.register');
    }
    public function forgot()
    {
        return view('auth.client.page.forgot');
    }
}

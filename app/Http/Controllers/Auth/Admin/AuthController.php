<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash, DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $title = (!filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'username' : 'email');
            $login = [$title => $request->email, 'password' => $request->password];
            if (Auth::guard('admin')->attempt($login)) {
                notify()->success('Login success');
                return redirect()->route('dashboard');
            } else {
                notify()->error('Login error');
                return redirect()->route('admin.login');
            }
        }
        return view('auth.admin.page.login');
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        notify()->success('Logout success');
        return redirect()->route('admin.login');
    }
}

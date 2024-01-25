<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Auth, Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->isMethod('post')) {
            $param = $request->except('_token', 'confirm_password', 'firstname', 'lastname');
            $param['password'] = Hash::make($param['password']);
            $param['name'] = $request->firstname . $request->lastname;
            $create_user = User::create($param);
            if ($create_user) {
                notify()->success('Register success');
                return redirect()->route('client.login');
            } else {
                notify()->error('Login error');
                return redirect()->route('client.register');
            }
        }
        return view('auth.client.page.register');
    }
    public function forgot()
    {
        return view('auth.client.page.forgot');
    }
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $title = (!filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'username' : 'email');
            $login = [$title => $request->email, 'password' => $request->password];
            if (Auth::guard('web')->attempt($login)) {
                $user = Auth::guard('web')->user();
                $updateStatus = User::where('id', $user->id)->update(['status' => '1']);
                notify()->success('Login success');
                return redirect()->route('client.main');
            } else {
                notify()->error('Login error');
                return redirect()->route('client.login');
            }
        }
        return view('auth.client.page.login');
    }
    public function logout(Request $request)
    {
        $user = Auth::guard('web')->user();
        $updateStatus = User::where('id', $user->id)->update(['status' => '0']);
        Auth::logout();
        notify()->success('Logout success');
        return redirect()->route('client.main');
    }
}

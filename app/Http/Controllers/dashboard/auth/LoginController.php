<?php

namespace App\Http\Controllers\dashboard\auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return \view('dashboard.auth.login');
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->check() && auth()->user()->is_admin == 1) {
                return redirect(\route('dashboard'));
            }else {
                auth()->logout();
                return redirect(route('login'));
            }
        }else{
            return redirect()->route('login')->with('toast_error', 'Email Address or password are Wrong');

        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        return redirect(route('login'));
    }


}

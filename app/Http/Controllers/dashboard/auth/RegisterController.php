<?php

namespace App\Http\Controllers\dashboard\auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'governorate_id' => ['required'],
            // 'city_id' => ['required'],
        ]);

        $request['password'] = Hash::make($request->password);

        User::create($request->all());

       return \redirect(\route('login'));

    }
}

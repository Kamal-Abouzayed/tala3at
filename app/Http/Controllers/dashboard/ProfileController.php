<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);

        if (auth()->user()->id != $user->id ) {
            return \view('dashboard.not_found');
        } else {
            return view('dashboard.users.profile', \compact('user'));
        }

    }
}

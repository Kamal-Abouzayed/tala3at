<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Story;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function index()
    // {
    //     return \view('home');
    // }

    public function dashboard()
    {
        $users = User::all();
        $stories = Story::orderBy('created_at', 'DESC')->get();
        return view('dashboard.index', \compact('users', 'stories'));
    }
}

<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return \view('dashboard.users.index', \compact('users'));
    }

    public function create()
    {
        $governorates = Governorate::all();
        return \view('dashboard.users.create', \compact('governorates'));
    }

    public function store(Request $request)
    {
        $user = $this->validate($request, [
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|string|max:255|unique:users',
            'image'          => 'required|image|max:1024',
            'governorate_id' => 'required',
            'password'       => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
        }
        $user->image = $imageName;
        $user->governorate_id = $request->governorate_id;
        $user->password = Hash::make($request->password);

        $user->save();

        return \redirect(\route('users.index'))->with('success' , __('messages.user_created'));
    }

    public function show()
    {
        # code...
    }

    public function edit($id)
    {
        $user = User::find($id);

        return \view('dashboard.users.edit', \compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->validate($request, [
            'name'           => 'required|string|max:255',
            'email'          => 'sometimes|required|email|string|max:255',
            'image'          => 'sometimes|required|image|max:1024',
            'governorate_id' => 'required',
            'password'       => 'required|min:8',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }
        $user->governorate_id = $request->governorate_id;
        $user->password = Hash::make($request->password);

        $user->update();

        return \redirect(\route('users.index'))->with('success' , __('messages.user_updated'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $image_path = public_path('images').'/'.$user->image;

        if(File::exists($image_path)) {
            File::delete($image_path);
        }

        $user->delete();

        return \redirect(\route('users.index'))->with('success' , __('messages.user_deleted'));
    }
}

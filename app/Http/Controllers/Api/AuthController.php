<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return \response()->json(['status_code' => 400, 'message' => 'Bad Request']);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'status_code' => 200,
            'message' => 'User Created Successfully',
        ]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return \response()->json(['status_code' => 400, 'message' => 'Bad Request']);
        }

        $data = \request(['email','password']);

        if (!Auth::attempt($data)) {
            return \response()->json([
                'status_code' => 500,
                'message' => 'Unauthorized',
            ]);
        }

        $user = User::where('email',$request->email)->first();

        $token = $user->createToken('authToken')->plainTextToken;

        return \response()->json([
            'status_code' => 200,
            'message' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'status_code' => 200,
            'message' => 'Token Deleted Successfully',
        ]);
    }
}

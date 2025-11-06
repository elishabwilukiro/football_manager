<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }
    public function index()
    {
        $data = [
            'header' => 'FOOTBALL MANAGER',
            'title' => 'Login'
        ];

        return view('auth.login', compact('data'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {            
            if(Auth::user()->role == 'admin')
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Successfully',
                    'redirect_url' => route('admin-dashboard')
                ]);
            }
            elseif(Auth::user()->role == 'manager')
            {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Successfully',
                    'redirect_url' => route('manager-dashboard')
                ]);
            }
        }

        return response()->json([
            'status' => 500,
            'message' => 'Invalid Email or Password'
        ]);
    }

    public function resetPassword()
    {
        $data = [
            'header' => 'FOOTBALL MANAGER',
            'title' => 'Reset Password'
        ];
        return view('auth.reset-password', compact('data'));
    }

    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = [
            'header' => 'FOOTBALL MANAGER',
            'title' => 'My Profile'
        ];
        $user = User::with('team')->find(Auth::id());
        return view('backend.profile.profile', compact('data','user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
}

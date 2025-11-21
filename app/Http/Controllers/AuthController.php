<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
            'title' => 'Login to Your Account'
        ];

        return view('auth.login', compact('data'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:3',
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
            if (Auth::user()->archive == '1' || Auth::user()->status == 'in_active') {
                Auth::logout();
                return response()->json([
                    'status' => 500,
                    'message' => 'Your account has been deactivated or archived. Contact admin.'
                ]);
            }

            switch (Auth::user()->role) {
                case 'admin':
                    return response()->json([
                        'status' => 200,
                        'message' => 'Login Successfully',
                        'redirect_url' => route('admin-dashboard')
                    ]);
                case 'manager':
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
            'title' => 'Profile'
        ];
        $user = User::with('team')->find(Auth::id());
        return view('backend.profile.profile', compact('data','user'));
    }

    public function updateProfile(Request $request,$id)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'email'        => 'required|email|max:255',
            'location'     => 'required|max:255',
            'password'     => 'sometimes|min:3', // optional password
        ]);

        $userID = Crypt::decrypt($id);
        $user = User::findOrFail($userID);
        
        $updateData = [
            'first_name'   => $validated['first_name'],
            'middle_name'  => $validated['middle_name'],
            'last_name'    => $validated['last_name'],
            'phone_number' => $validated['phone_number'],
            'email'        => $validated['email'],
            'location'     => $validated['location'],
        ];
        if(!empty($validated['password'])){
            $updateData['password'] = Hash::make($validated['password']);
        }
        $user->update($updateData);
        return redirect()->back()->with('success','User details updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    
}

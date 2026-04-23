<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function list()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Users',
                'section' => 'All Users',
            ];
            
        $team = Team::where('archive','=','0')->orderBy('id','desc')->get();
        $user = User::with('team')
                ->where('archive','=','0')
                ->orderBy('id','desc')->get();

        return view('backend.users.list', compact('data','user','team'));
    }
    public function add(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'User',
                'section' => 'Add New User'
            ];
        $team = Team::where('archive','=','0')->orderBy('id','desc')->get();    
        return view('backend.users.add', compact('data','team'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'username'     => 'sometimes|string|max:255',
            'email'        => 'required|email|unique:tbl_users,email',
            'location'     => 'required|string|max:255',
            'password'     => 'sometimes|string',
            'phone_number' => 'required|digits:10',
            'role'         => 'required|string',
            'team_id'      => 'sometimes|integer',
            'status'       => 'required|in:active,in_active',
            'photo'        => 'sometimes|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $photoName = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/user_uploads'), $photoName);
        }
        
        $user_id = Auth::user()->id;  
        User::create([
            'role'         => $request->input('role'),
            'first_name'   => $request->input('first_name'),
            'middle_name'  => $request->input('middle_name'),
            'last_name'    => $request->input('last_name'),
            'username'     => $request->input('username'),
            'phone_number' => $request->input('phone_number'),
            'email'        => $request->input('email'),
            'location'     => $request->input('location'),
            'team_id'      => $request->input('team_id'),
            'upload'       => $photoName,
            'password'     => Hash::make($request->input('password')),
            'status'       => $request->input('status'),
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ]);
        return redirect('admin/user/list')->with('success','User saved successfully.');
    }
    public function edit($id)
    {
        if (!Auth::check()) return redirect()->route('login');
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'User',
                'section' => 'Edit User'
        ];
        $user = User::with('team')->findOrFail(Crypt::decrypt($id));
        $teams = Team::where('archive','=','0')->get();
        return view('backend.users.edit', compact('data','user','teams'));    
    }
    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'first_name'   => 'required|string|max:255',
            'middle_name'  => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'username'     => 'nullable|string|max:255',
            'email'        => 'required|email|unique:tbl_users,email',
            'location'     => 'required|string|max:255',
            'password'     => 'required|string|min:3',
            'phone_number' => 'required|digits:10',
            'role'         => 'required|string|in:admin,manager',
            'team_id'      => 'nullable|integer',
            'status'       => 'required|in:active,in_active',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);


        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $user_id = Auth::id();

        if ($request->hasFile('logo')) {
            if (!empty($team->logo) && file_exists(public_path('uploads/team_uploads/' . $team->logo))) {
                unlink(public_path('uploads/team_uploads/' . $team->logo));
            }

            $file = $request->file('logo');
            $logoName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/team_uploads'), $logoName);
        }
        $photoName = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $photoName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/user_uploads'), $photoName);
        }

        $updateData = [
            'role'         => $validated['role'],
            'first_name'   => $validated['first_name'],
            'middle_name'  => $validated['middle_name'],
            'last_name'    => $validated['last_name'],
            'username'     => $validated['username'],
            'phone_number' => $validated['phone_number'],
            'email'        => $validated['email'],
            'location'     => $validated['location'],
            'team_id'      => $validated['team_id'],
            'upload'       => $photoName,
            // 'password'     => Hash::make($validated['password']),
            'status'       => $validated['status'],
            'created_by'   => $user_id,
            'updated_by'   => $user_id,
        ];

        if(!empty($validated['password'])){
            $updateData['password'] = Hash::make($validated['password']);
        }
        $user->update($updateData);
        return redirect()->back()->with('success', 'User updated successfully.');    

        // return redirect()->route('admin-user-list')->with('success','User updated successfully');    
    }
    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $user = User::findOrFail($id);
        $user->update(
            ['archive'  =>  '1', 
            'updated_by'    =>  Auth::id()
        ]);     
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function details(Request $request,$id)
    {
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'User',
                'section' => 'Details',
            ];
        $userID = Crypt::decrypt($id);
        $user = User::with(['team'])->findOrFail($userID);
        return view('backend.users.profile', compact('data','user'));
    }
}


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
                'title' => 'All Users',
            ];
        $user = User::with('team')->where('archive','=','0')->get();

        $team = Team::where('archive','=','0')->get();
        return view('backend.users.list', compact('data','user','team'));
    }

    public function listView(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
        ]);

        // $email = $request->input('email');
        // $phone_number = $request->input('phone_number');

        // $query = User::query();
        // if($email) $query->where('email','like','%' .$email. '%');
        // if($phone_number) $query->where('phone_number','like','%'.$phone_number.'%');
        // $data = $query->orderBy('id','desc')->paginate(10);
        $user = User::with('team')->where('archive','=','0')->get();

        return view('backend.users.list_view', compact('data','user'));
    }

    public function saveUser(Request $request)
    {
        try {

            $request->validate([
                'full_name' => 'required|string|max:255',
                'username' => 'required|string|max:255',
                'user_email' => 'required|email',
                'location' => 'required|string|max:255',
                'password' => 'nullable|string|min:3',
                'phone' => 'required|digits:10',
                'user_role' => 'required|string',
                'user_status' => 'required|in:0,1',
                'hidden_id' => 'nullable',
            ]);  

            DB::beginTransaction();

            $hidden_id = $request->input('hidden_id');
            $full_name = $request->input('full_name');
            $username = $request->input('username');
            $phone = $request->input('phone');
            $email = $request->input('user_email');
            $location = $request->input('location');
            $password = $request->input('password');
            $role = $request->input('user_role');
            $user_status = $request->input('user_status');
            $user_id = Auth::user()->id;
            $user_code = rand(00000,99999);    

            if(empty($hidden_id)):
                $saveData = [
                    'name' => $full_name,
                    'username' => $username,
                    'phone' => $phone,
                    'email' => $email,
                    'location' => $location,
                    'role' => $role,
                    'user_code' => $user_code,
                    'password' => Hash::make($password),
                    'status' => $user_status,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                ## Save data
                DB::table('users')->insertGetId($saveData);
                $message='User saved successfully';

            else:

                // if($password==null)$password=$password : Hash::make($password);
                $saveData = [
                    'name' => $full_name,
                    'username' => $username,
                    'phone' => $phone,
                    'email' => $email,
                    // 'password' => Hash::make($password),
                    'location' => $location,
                    'role' => $role,
                    'status' => $user_status,
                    'updated_by' => $user_id,
                ];

                $condition=[
                    'id'=>Crypt::decrypt($hidden_id),
                    'archive'=>0
                ];

                ## Save data
                DB::table('users')->where($condition)->update($saveData);
                $message='User updated successfully';

            endif;

            DB::commit();

            return response()->json(['status' => 200, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function editUser($id)
    {
        $data = User::findUser($id);
        return response()->json(['data'=>$data, 'id'=>Crypt::encrypt($id)]);
    }

    public function deleteUser($id)
    {
        try {
            $data = User::updateUser($id);
            if($data)
            {
                $message='User deleted successfully';
                return response()->json(['status' => 200, 'message' => $message]);
            }else{
                $message='Something went wrong. Try again!';
                return response()->json(['status' => 450, 'message' => $message]);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }

    }

    public function userData()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $role_id = $user->role;

        switch ($role_id) {
            case 1:
                $data = [
                    'role' => 'Administrator',
                    'name' => $user->name,
                    'email'=> $user->email,
                ];
                break;
            case 2:
                $data = [
                    'role' => 'Cashier',
                    'name' => $user->name,
                    'email'=> $user->email,
                ];
                break;
            default:
                $data = [
                    'role'=> 'Unknown Role',
                    'name'=> $user->name,
                    'email'=> $user->email,
                ];
        }
        return response()->json(['data' => $data]);
    }
}


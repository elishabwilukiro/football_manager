<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Position;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PlayerController extends Controller
{
    public function list()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'All Players',
            ];

        $team = Team::where('archive','=','0')->get();
        $position = Position::where('archive','=','0')->get();
        $players = Player::with(['team','position'])
                ->where('archive','=','0')
                ->get();
        return view('backend.players.list', compact('data','team','position','players'));
    }

    public function listView(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
        ]);

        $team_name = $request->input('team_name');
        $team_email = $request->input('team_email');


        $data = Player::where('archive','=','0')->get();
        // $data = DB::select('select * from tbl_teams where status = ?', ['active']);
        // if($team_name) $query->where('team_name','like','%' .$team_name. '%');
        // if($team_email) $query->where('team_email','like','%'.$team_email.'%');
        // $data = $query->orderBy('id','desc')->paginate(10);
        // dd($data);
        return view('backend.players.list_view', compact('data'));
    }

    public function savePlayer(Request $request)
    {
        try {

            $request->validate([
                'first_name' => 'required|string',
                'middle_name' => 'required|string',
                'last_name' => 'required|string',
                'email' => 'required|email',
                'phone_number' => 'required|digits:10',
                'date_of_birth' => 'required|string',
                'nationality' => 'required|string|min:3',
                'city' => 'required|string|min:3',
                'national_id' => 'required|string',
                'address' => 'sometimes|nullable|max:255',
                'team_id' => 'required',
                'position_id' => 'required',
                'status' => 'required|in:active,in_active',
                'jersey_number' => 'sometimes',
                'hidden_id' => 'nullable',
            ]);  

            DB::beginTransaction();

            $hidden_id = $request->input('hidden_id');
            $first_name = $request->input('first_name');
            $middle_name = $request->input('middle_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $phone_number = $request->input('phone_number');
            $date_of_birth = $request->input('date_of_birth');
            $nationality = $request->input('nationality');
            $city = $request->input('city');
            $national_id = $request->input('national_id');
            $address = $request->input('address');
            $status = $request->input('status');
            $position_id = $request->input('position_id');
            $team_id = $request->input('team_id');
            $jersey_number = $request->input('jersey_number');
            $profile = $request->input('profile');
            $user_id = Auth::user()->id;

            $registration_number = rand(0000,9999) . '-' . date('m') . '-' .date('Y');

            if(empty($hidden_id)):
                $inputs = [
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone_number' => $phone_number,
                    'date_of_birth' => $date_of_birth,
                    'registration_number' => $registration_number,
                    'nationality' => $nationality,
                    'national_id' => $national_id,
                    'city' => $city,
                    'address' => $address,
                    'position_id' => $position_id,
                    'team_id' => $team_id,
                    'jersey_number' => $jersey_number,
                    'upload' => $profile,
                    'status' => $status,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $data = Player::create($inputs);
                $message = 'Player saved successfully';

            else:

                $inputs = [
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone_number' => $phone_number,
                    'date_of_birth' => $date_of_birth,
                    'registration_number' => $registration_number,
                    'nationality' => $nationality,
                    'national_id' => $national_id,
                    'city' => $city,
                    'address' => $address,
                    'position_id' => $position_id,
                    'team_id' => $team_id,
                    'jersey_number' => $jersey_number,
                    'upload' => $profile,
                    'status' => $status,
                    'updated_by' => $user_id,
                ];

                $condition=[
                    'id'=>Crypt::decrypt($hidden_id),
                    'archive'=>0
                ];
                $data = Player::where($condition)->update($inputs);
                $message = 'Player updated successfully';

            endif;

            DB::commit();

            return response()->json(['status' => 200, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function editPlayer($id)
    {
        $data = Player::findOrFail($id);
        return response()->json(['data'=>$data, 'id'=>Crypt::encrypt($id)]);
    }

    public function deletePlayer($id)
    {
        try {

            $delete = Player::where('id', $id)->update('archive',1);
            if($delete)
            {
                $message='Player deleted successfully';
                return response()->json(['status' => 200, 'message' => $message]);
            }else{
                $message='Something went wrong. Try again!';
                return response()->json(['status' => 450, 'message' => $message]);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }

    }

}

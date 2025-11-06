<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TeamController extends Controller
{
    public function list()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'All Teams',
            ];

        $team = Team::where('archive','=','0')->get();
        return view('backend.teams.list', compact('data','team'));
    }

    public function listView(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
        ]);

        $team_name = $request->input('team_name');
        $team_email = $request->input('team_email');


        $data = Team::where('archive','=','0')->get();
        // $data = DB::select('select * from tbl_teams where status = ?', ['active']);
        // if($team_name) $query->where('team_name','like','%' .$team_name. '%');
        // if($team_email) $query->where('team_email','like','%'.$team_email.'%');
        // $data = $query->orderBy('id','desc')->paginate(10);
        // dd($data);
        return view('backend.teams.list_view', compact('data'));
    }

    public function saveTeam(Request $request)
    {
        try {

            $request->validate([
                'team_name' => 'required|string|max:255',
                'team_email' => 'required|email',
                'phone_number' => 'required|digits:10',
                'city' => 'required|string|max:255',
                'team_address' => 'required|string|min:3',
                'stadium' => 'sometimes|nullable|max:255',
                'founded_year' => 'required|string',
                'status' => 'required|in:active,in_active',
                'hidden_id' => 'nullable',
            ]);  

            DB::beginTransaction();

            $hidden_id = $request->input('hidden_id');
            $team_name = $request->input('team_name');
            $team_email = $request->input('team_email');
            $phone_number = $request->input('phone_number');
            $city = $request->input('city');
            $team_address = $request->input('team_address');
            $stadium = $request->input('stadium');
            $founded_year = $request->input('founded_year');
            $status = $request->input('status');
            $logo = $request->input('logofounded_year');
            $founded_year = $request->input('founded_year');
            $user_id = Auth::user()->id;

            $reg_number = rand(0000,9999) . '-' . date('Y');    
            $certificate = 'TZF-' . rand(000,999) .'-' . date('Y');    

            if(empty($hidden_id)):
                $inputs = [
                    'team_name' => $team_name,
                    'registration_number' => $reg_number,
                    'registration_certificate' => $certificate,
                    'city' => $city,
                    'team_address' => $team_address,
                    'team_email' => $team_email,
                    'team_number' => $phone_number,
                    'stadium' => $stadium,
                    'founded_year' => $founded_year,
                    'logo' => $logo,
                    'status' => $status,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $data = Team::create($inputs);
                $message = 'Team saved successfully';

            else:

                $inputs = [
                    'team_name' => $team_name,
                    'city' => $city,
                    'team_address' => $team_address,
                    'team_email' => $team_email,
                    'team_number' => $phone_number,
                    'stadium' => $stadium,
                    'founded_year' => $founded_year,
                    'logo' => $logo,
                    'status' => $status,
                    'updated_by' => $user_id,
                ];

                $condition=[
                    'id'=>Crypt::decrypt($hidden_id),
                    'archive'=>0
                ];
                $data = Team::where($condition)->update($inputs);
                $message = 'Team updated successfully';

            endif;

            DB::commit();

            return response()->json(['status' => 200, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function editTeam($id)
    {
        $data = Team::findOrFail($id);
        return response()->json(['data'=>$data, 'id'=>Crypt::encrypt($id)]);
    }

    public function deleteTeam($id)
    {
        try {

            $delete = Team::where('id', $id)->update('archive',1);
            if($delete)
            {
                $message='Team deleted successfully';
                return response()->json(['status' => 200, 'message' => $message]);
            }else{
                $message='Something went wrong. Try again!';
                return response()->json(['status' => 450, 'message' => $message]);
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }

    }

    public function getTeamDetails($id)
    {
        $data = Team::where('id','=',$id)->get();
        return response()->json(['data'=>$data, 'id'=>$id]);
    }
    

}

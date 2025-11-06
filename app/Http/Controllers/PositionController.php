<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Position;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PositionController extends Controller
{
    public function list()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'All Positions',
            ];

        $positions = Position::where('archive','=','0')->get();
        return view('backend.positions.list', compact('data','positions'));
    }

    public function listView(Request $request)
    {
        $request->validate([
            'team_name' => 'required',
        ]);

        $team_name = $request->input('team_name');
        $team_email = $request->input('team_email');


        $data = Position::where('archive','=','0')->get();
        // $data = DB::select('select * from tbl_teams where status = ?', ['active']);
        // if($team_name) $query->where('team_name','like','%' .$team_name. '%');
        // if($team_email) $query->where('team_email','like','%'.$team_email.'%');
        // $data = $query->orderBy('id','desc')->paginate(10);
        // dd($data);
        return view('backend.positions.list_view', compact('data'));
    }

    public function savePosition(Request $request)
    {
        try {

            $request->validate([
                'position' => 'required|string|max:255',
                'description' => 'sometimes',
                'status' => 'required|in:active,in_active',
                'hidden_id' => 'nullable',
            ]);  

            DB::beginTransaction();

            $hidden_id = $request->input('hidden_id');
            $position = $request->input('position');
            $description = $request->input('description');
            $status = $request->input('status');
            $user_id = Auth::user()->id;

            if(empty($hidden_id)):
                $inputs = [
                    'position_name' => $position,
                    'position_description' => $description,
                    'status' => $status,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $data = Position::create($inputs);
                $message = 'Position saved successfully';

            else:

                $inputs = [
                    'position_name' => $position,
                    'position_description' => $description,
                    'status' => $status,
                    'status' => $status,
                    'updated_by' => $user_id,
                ];

                $condition=[
                    'id'=>Crypt::decrypt($hidden_id),
                    'archive'=>0
                ];
                $data = Position::where($condition)->update($inputs);
                $message = 'Position updated successfully';

            endif;

            DB::commit();

            return response()->json(['status' => 200, 'message' => $message]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function editPosition($id)
    {
        $data = Position::findOrFail($id);
        return response()->json(['data'=>$data, 'id'=>Crypt::encrypt($id)]);
    }

    public function deletePosition($id)
    {
        try {

            $delete = Position::where('id', $id)->update('archive',1);
            if($delete)
            {
                $message='Position deleted successfully';
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

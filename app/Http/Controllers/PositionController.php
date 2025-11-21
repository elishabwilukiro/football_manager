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
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Positions',
                'section' => 'All Position'
            ];

        $positions = Position::where('archive','=','0')->orderBy('id','desc')->get();
        return view('backend.positions.list', compact('data','positions'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Position',
                'section' => 'Add New Position'
            ];

        return view('backend.positions.add', compact('data'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'sometimes',
            'status' => 'required|in:active,in_active',
        ]);  

        $position = $request->input('position');
        $description = $request->input('description');
        $status = $request->input('status');
        $user_id = Auth::user()->id;

        $inputs = [
            'position_name' => $position,
            'position_description' => $description,
            'status' => $status,
            'created_by' => $user_id,
            'updated_by' => $user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Position::create($inputs);
        return redirect('admin/position/list')->with('success','Position saved successfully');
    }

    public function edit($id)
    {
        if (!Auth::check()) return redirect()->route('login');
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Position',
                'section' => 'Edit Position'
            ];
        $position = Position::findOrFail(Crypt::decrypt($id));
        return view('backend.positions.edit', compact('data','position'));    
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'position' => 'required|string|max:255',
            'description' => 'sometimes',
            'status' => 'required|in:active,in_active',
        ]);  
        $id = Crypt::decrypt($id);
        $position = Position::findOrFail($id);
        $inputs = [
            'position_name'        => $validated['position'],
            'position_description' => $validated['description'] ?? null,
            'status'               => $validated['status'],
            'updated_by'           => Auth::id()
        ];
        $updated = $position->update($inputs);
        if($updated){
            return redirect()
                ->route('admin-position-list')
                ->with('success','Position updated successfully');
        }else{
            return redirect()->back()->with('error','Something went wrong');
        }
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);

        $position = Position::findOrFail($id);

        $position->update([
            'archive' => '1',
            'updated_by' => Auth::id()
        ]);
        return redirect()->back()->with('success', 'Position deleted successfully.');
    }

}

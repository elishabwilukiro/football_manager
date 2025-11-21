<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Encryption\DecryptException;

class TeamController extends Controller
{
    public function list()
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Teams',
                'section' => 'All Teams',
            ];

        $team = Team::where('archive','=','0')->orderBy('id','desc')->get();
        return view('backend.teams.list', compact('data','team'));
    }
    public function add(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Team',
                'section' => 'Add New Team'
            ];

        return view('backend.teams.add', compact('data'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'team_email' => 'required|email',
            'phone_number' => 'required|digits:10',
            'region' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'stadium' => 'nullable|string|max:255',
            'status' => 'required|in:active,in_active',
            // 'founded_year' => 'nullable|string',
            // 'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'registration_certificate' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:4096',
        ]);
        
        $deadline = Setting::where('key','team_registration_deadline')->value('value');
        
        if(!$deadline) return redirect()->back()->with('error','Team registration deadline not configured.');
        
        if (now()->greaterThan(Carbon::parse($deadline))) return redirect()->back()->with('error', 'Team registration is closed. Deadline was ' . Carbon::parse($deadline)->format('d M Y'));
        
        $user_id = Auth::user()->id;        
        
        $reg_number = strtoupper(Str::random(4)) . '-' . date('Y');  // e.g. AB3X-2025

        // $logoPath = null;
        // if ($request->hasFile('logo')) {
        //     $logoPath = $request->file('logo')->store('logos', 'public');
        // }

        $certificatePath = null;
        if ($request->hasFile('registration_certificate')) {
            $certificatePath = $request->file('registration_certificate')->store('certificates', 'public');
        }
        
        $inputs = [
            'team_name' => $request->team_name,
            'registration_number' => $reg_number,
            'region' => $request->region,
            'address' => $request->address,
            'team_email' => $request->team_email,
            'team_number' => $request->phone_number,
            'stadium' => $request->stadium,
            // 'founded_year' => $request->founded_year,
            // 'logo' => $logoPath,
            'registration_certificate' => $certificatePath,
            'status' => $request->status,
            'created_by' => $user_id,
            'updated_by' => $user_id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
  
        Team::create($inputs);

        return redirect('admin/team/list')->with('success','Team saved successfully');
    }

    public function edit($id)
    {
        if (!Auth::check()) return redirect()->route('login');
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Team',
                'section' => 'Edit Team'
            ];
        $team = Team::findOrFail(Crypt::decrypt($id));
        return view('backend.teams.edit', compact('data','team'));    
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'team_name'      => 'required|string|max:255',
            'team_email'     => 'required|email',
            'phone_number'   => 'required|digits:10',
            'region'         => 'required|string|max:255',
            'address'        => 'required|string|min:3',
            'stadium'        => 'nullable|max:255',
            'status'         => 'required|in:active,in_active',
            // 'founded_year'   => 'required|string',
            // 'logo'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'registration_certificate' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:4096',
        
        ]);

        $id = Crypt::decrypt($id);
        $team = Team::findOrFail($id);
        $user_id = Auth::id();

        $certificatePath = $team->registration_certificate; // keep old by default
        if ($request->hasFile('registration_certificate')) {
            // OPTIONAL: delete old file if exists
            if ($certificatePath && Storage::disk('public')->exists($certificatePath)) {
                Storage::disk('public')->delete($certificatePath);
            }
            // Upload new file
            $certificatePath = $request->file('registration_certificate')->store('certificates', 'public');
        }

        $team->update([
            'team_name'      => $validated['team_name'],
            'region'           => $validated['region'],
            'address'   => $validated['address'],
            'team_email'     => $validated['team_email'],
            'team_number'    => $validated['phone_number'],
            'stadium'        => $validated['stadium'],
            // 'founded_year'   => $validated['founded_year'],
            // 'logo'           => $logoName,
            'registration_certificate' => $certificatePath,
            'status'         => $validated['status'],
            'updated_by'     => $user_id,
            'updated_at'     => now(),
        ]);

        return redirect()->route('admin-team-list')->with('success','Team updated successfully');
    }
    public function delete($id)
    {
        $team_id = Crypt::decrypt($id);
        $team = Team::findOrFail($team_id);
        $team->update(
            ['archive'  =>  '1', 
            'updated_by'    =>  Auth::id()
        ]);     
        return redirect()->back()->with('success', 'Team deleted successfully.');
    }
    
    public function details(Request $request,$id)
    {
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Team Profile',
            ];
        $team_id = Crypt::decrypt($id);
        $team = Team::findOrFail($team_id);
        $total_players = Player::where('team_id','=',$team_id)->count();
        return view('backend.teams.profile', compact('data','team','total_players'));
    }
    

}

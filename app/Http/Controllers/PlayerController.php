<?php

namespace App\Http\Controllers;

use id;
use App\Models\Team;
use App\Models\Player;
use App\Models\Setting;
use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    public function list()
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Players',
                'section' => 'All Players'
            ];

        $team = Team::where('archive','=','0')->get();
        $position = Position::where('archive','=','0')->get();
        if(Auth::user()->role == 'manager'){
            $players = Player::with(['team','position'])
                ->where('archive','=','0')
                ->where('team_id','=',Auth::user()->team_id)
                ->orderBy('id','desc')->get();
        }else{
            $players = Player::with(['team','position'])
                ->where('archive','=','0')
                ->orderBy('id','desc')->get();
        }
        
        return view('backend.players.list', compact('data','team','position','players'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Players',
                'section' => 'Add New Players'
            ];

        if(Auth::user()->role == 'manager'){
            $team = Team::where('archive','=','0')->where('id','=',Auth::user()->team_id)->get();
        }else{
            $team = Team::where('archive','=','0')->orderBy('id','desc')->get();
        }
        $position = Position::where('archive','=','0')->orderBy('id','desc')->get();
        return view('backend.players.add', compact('data','team','position'));
    }

    public function generatePlayerRegNumber()
    {
        $prefix = 'PLY';
        $year = now()->format('Y');
        $random = strtoupper(Str::random(4));

        // Example: PLY-2025-0001
        $count = Player::count() + 1;
        $formattedCount = str_pad($count, 4, '0', STR_PAD_LEFT);

        return "{$prefix}-{$year}-{$formattedCount}";
    }
    public function save(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|min:3,max:255',
            'middle_name'   => 'required|string|min:3,max:255',
            'last_name'     => 'required|string|min:3,max:255',
            'email'         => 'required|email|unique:tbl_players,email',
            'phone_number'  => 'required|digits:10|unique:tbl_players,phone_number',
            'date_of_birth' => 'required|string',
            'birth_certificate_no' => 'required|string',
            'nationality'   => 'required|string',
            'region'        => 'required|string',
            // 'national_id' => 'required|string',
            'address'       => 'sometimes|nullable|max:255',
            'team_id'       => 'required',
            'position_id'   => 'sometimes',
            'status'        => 'required|in:active,in_active',
            // 'jersey_number' => 'sometimes',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'birth_certificate' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:4096',

        ]);  
       
        $uploadPath = base_path('public/assets/uploads/');
         if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $photoName = null;
        // if ($request->hasFile('photo')) {
        //     $photoPath = $request->file('photo')->store('photo', 'public');
        // }
        if ($request->hasFile('photo')) {
            $logo      = $request->file('photo');
            $photoName  = time() . '_photo.' . $logo->getClientOriginalExtension();
            $logo->move($uploadPath, $photoName);
        }

        $fileName = null;
        // if ($request->hasFile('birth_certificate')) {
        //     $fileName = $request->file('birth_certificate')->store('birth_certificate', 'public');
        // }
        if ($request->hasFile('birth_certificate')) {
            $file       = $request->file('birth_certificate');
            $fileName   = time() . '_birth_certificate.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $fileName);
        }

        $deadline = Setting::where('key', 'player_registration_deadline')->value('value');

        if (!$deadline) return redirect()->back()->with('error', 'Player registration deadline not configured.');        
        
        if (now()->greaterThan(Carbon::parse($deadline))) return redirect()->back()->with('error', 'Player registration is closed. Deadline was ' . Carbon::parse($deadline)->format('d M Y'));
        
        $registration_number = $this->generatePlayerRegNumber();  // Example: PLY-2025-0001

        $inputs = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'birth_certificate_no' => $request->birth_certificate_no,
            'registration_number' => $registration_number,
            'nationality' => $request->nationality,
            // 'national_id' => $request->national_id,
            'region' => $request->region,
            'address' => $request->address,
            'position_id' => $request->position_id,
            'team_id' => $request->team_id,
            // 'jersey_number' => $request->jersey_number,
            'upload' => $photoName,
            'birth_certificate' => $fileName,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        Player::create($inputs);
        return redirect()->back()->with('success', 'Player registered successfully with registration number: ' . $registration_number);    
    }

    public function edit($id)
    {
        if (!Auth::check()) return redirect()->route('login');
        
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Players',
                'section' => 'Edit Players'
            ];
        $player = Player::with(['team','position'])->findOrFail(Crypt::decrypt($id));
        $position = Position::where('archive','=','0')->orderBy('id','desc')->get();

        if(Auth::user()->role == 'manager'){
            $team = Team::where('id', Auth::user()->team_id)->orderBy('id','desc')->get();
        } else {
            $team = Team::where('archive','=','0')->orderBy('id','desc')->get();
        }
        
        return view('backend.players.edit', compact('data','player','team','position'));
    }

    public function update(Request $request,$id)
    {
        $validated = $request->validate([
            'first_name'    => 'required|string|min:3,max:255',
            'middle_name'   => 'required|string|min:3,max:255',
            'last_name'     => 'required|string|min:3,max:255',
            'email'         => 'required|email',
            'phone_number'  => 'required|digits:10',
            'date_of_birth' => 'required|string',
            'birth_certificate_no' => 'required|string',
            'nationality'   => 'required|string',
            'region'        => 'required|string',
            // 'national_id' => 'required|string',
            'address'       => 'sometimes|nullable|max:255',
            'team_id'       => 'required',
            'position_id'   => 'sometimes',
            'status'        => 'required|in:active,in_active',
            // 'jersey_number' => 'sometimes',
            'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'birth_certificate' => 'nullable|mimes:jpg,jpeg,png,webp,pdf|max:4096',

        ]);  

        $player = Player::findOrFail(Crypt::decrypt($id));
        $user_id = Auth::id();

        $uploadPath = base_path('public/assets/uploads/');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $photoName = $player->photo;     
        $attachName = $player->birth_certificate;  
        
        // ========== UPDATE LOGO (ONLY IF NEW FILE PROVIDED) ==========
        if ($request->hasFile('photo')) {
            if ($player->photo && file_exists($uploadPath . $player->photo)) {
                unlink($uploadPath . $player->photo);
            }
            $photo      = $request->file('photo');
            $photoName  = time() . '_photo.' . $photo->getClientOriginalExtension();
            $photo->move($uploadPath, $photoName);
        }

        // ========== UPDATE ATTACHMENT (ONLY IF NEW FILE PROVIDED) ==========
        if ($request->hasFile('birth_certificate')) {
            if ($player->birth_certificate && file_exists($uploadPath . $player->birth_certificate)) {
                unlink($uploadPath . $player->birth_certificate);
            }
            $birth_certificate         = $request->birth_certificate('birth_certificate');
            $attachName   = time() . '_birth_certificate.' . $birth_certificate->getClientOriginalExtension();
            $birth_certificate->move($uploadPath, $attachName);
        }

        // $photoPath = $player->photo; // keep old by default
        // if ($request->hasFile('photo')) {
        //     if ($photoPath && Storage::disk('public')->exists($photoPath)) {
        //         Storage::disk('public')->delete($photoPath);
        //     }
        //     $photoPath = $request->file('photo')->store('photo', 'public');
        // }

        // $certificatePath = $player->birth_certificate; // keep old by default
        // if ($request->hasFile('birth_certificate')) {
        //     if ($certificatePath && Storage::disk('public')->exists($certificatePath)) {
        //         Storage::disk('public')->delete($certificatePath);
        //     }
        //     $certificatePath = $request->file('birth_certificate')->store('birth_certificates', 'public');
        // }

        $deadline = Setting::where('key', 'player_registration_deadline')->value('value');
        if (!$deadline) return redirect()->back()->with('error', 'Player registration deadline not configured.');        
        if (now()->greaterThan(Carbon::parse($deadline))) return redirect()->back()->with('error', 'Player registration is closed. Deadline was ' . Carbon::parse($deadline)->format('d M Y'));
        
        // Example: PLY-2025-0001
        // $registration_number = $this->generatePlayerRegNumber();

        $player->update([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'date_of_birth' => $validated['date_of_birth'],
            'birth_certificate_no' => $validated['birth_certificate_no'],
            // 'registration_number' => $registration_number,
            'nationality' => $validated['nationality'],
            // 'national_id' => $validated['national_id'],
            'region' => $validated['region'],
            'address' => $validated['address'],
            'position_id' => $validated['position_id'],
            'team_id' => $validated['team_id'],
            // 'jersey_number' => $validated['jersey_number'],
            'upload' => $photoName,
            'birth_certificate' => $attachName,
            'status' => $validated['status'],
            'updated_by' => $user_id,
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Player updated successfully');    
    }
    public function delete($id)
    {
        $id = Crypt::decrypt($id);

        $team = Player::findOrFail($id);

        $team->update([
            'archive' => '1',
            'updated_by' => Auth::id()
        ]);
        return redirect()->back()->with('success', 'Player deleted successfully.');
    }
  
    public function details(Request $request,$id)
    {
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Profile',
                'section' => 'Player Profile',
            ];
        $playerID = Crypt::decrypt($id);
        $player = Player::with(['team','position'])->findOrFail($playerID);
        return view('backend.players.profile', compact('data','player'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function list()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $data = [
                'header' => 'PLAYER MANAGER',
                'title' => 'Settings',
                'section' => 'All Settings'
            ];

        $settings = Setting::pluck('value', 'key')->toArray(); 

        return view('backend.settings.list', compact('data','settings'));
    }
    public function save(Request $request)
    {
        $request->validate([
            'player_registration_deadline' => 'required|date|after_or_equal:today',
            'player_low_age_limit' => 'sometimes|integer',
            'team_registration_deadline' => 'required|date|after_or_equal:today',
            'status' => 'sometimes|in:active,in_active',
        ]);

        $data = [
            'player_registration_deadline' => $request->player_registration_deadline,
            'player_low_age_limit' => $request->player_low_age_limit,
            'team_registration_deadline' => $request->team_registration_deadline,
        ];
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key'=>$key],
                ['value'=>$value],
                ['created_by' => Auth::id()],
                ['updated_by' => Auth::id()]
            );
        }

        return redirect()->back()->with('success', 'Settings saved successfully.'); 
    }
}

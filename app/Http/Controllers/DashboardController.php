<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $data = [
            'header' => 'PLAYER MANAGER',
            'title' => 'Dashboard'
        ];

        if (Auth::user()->role == 'admin') 
        {   
            $total_players = Player::where('archive','=','0')->count();
            $total_teams = Team::where('archive','=','0')->count();
            return view('backend.dashboard.admin_dashboard', compact('data','total_players','total_teams'));
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $user = User::with('team')->findOrFail(Auth::id());
            $total_players = Player::where('archive','=','0')->where('team_id','=',Auth::user()->team_id)->count();
            return view('backend.dashboard.manager_dashboard', compact('data','user','total_players'));
        } 
        else 
        {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    }
}

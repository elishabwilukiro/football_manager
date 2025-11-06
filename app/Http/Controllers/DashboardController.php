<?php

namespace App\Http\Controllers;

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
            return view('backend.dashboard.admin_dashboard', compact('data'));
        } 
        elseif (Auth::user()->role == 'manager') 
        {
            $warehouse = $product = $category = null;
            return view('backend.dashboard.manager_dashboard', compact('data'));
        } 
        else 
        {
            return redirect()->route('login')->with('error', 'Unauthorized access.');
        }
    }
}

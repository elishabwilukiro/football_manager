<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\StaffController;

# Login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('welcome');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::get('/my-profile', [AuthController::class, 'profile'])->name('profile');


# FOR SUPER USER
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

     # Dashboard
     Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin-dashboard');

     # Users
     Route::get('user', [UserController::class, 'list'])->name('admin-user');
     Route::get('user-view', [UserController::class, 'listView'])->name('admin-user-view');
     Route::post('user/save', [UserController::class, 'saveUser'])->name('admin-user-save');
     Route::get('user-edit/{id}', [UserController::class, 'editUser'])->name('admin-user-edit');
     Route::get('user-delete/{id}', [UserController::class, 'deleteUser'])->name('admin-user-delete');
     
     # Teams
     Route::get('team', [TeamController::class, 'list'])->name('admin-team');
     Route::get('team-view', [TeamController::class, 'listView'])->name('admin-team-view');
     Route::post('team/save', [TeamController::class, 'saveTeam'])->name('admin-team-save');
     Route::get('team-edit/{id}', [TeamController::class, 'editTeam'])->name('admin-team-edit');
     Route::get('team-delete/{id}', [TeamController::class, 'deleteTeam'])->name('admin-team-delete');
     Route::get('team-details/{id}', [TeamController::class, 'getTeamDetails'])->name('admin-team-details');
   
     # Players
     Route::get('player', [PlayerController::class, 'list'])->name('admin-player');
     Route::get('player-view', [PlayerController::class, 'listView'])->name('admin-player-view');
     Route::post('player/save', [PlayerController::class, 'savePlayer'])->name('admin-player-save');
     Route::get('player-edit/{id}', [PlayerController::class, 'editPlayer'])->name('admin-player-edit');
     Route::get('player-delete/{id}', [PlayerController::class, 'deletePlayer'])->name('admin-player-delete');
  
     # Positions
     Route::get('position', [PositionController::class, 'list'])->name('admin-position');
     Route::get('position-view', [PositionController::class, 'listView'])->name('admin-position-view');
     Route::post('position/save', [PositionController::class, 'savePosition'])->name('admin-position-save');
     Route::get('position-edit/{id}', [PositionController::class, 'editPosition'])->name('admin-position-edit');
     Route::get('position-delete/{id}', [PositionController::class, 'deletePosition'])->name('admin-position-delete');

});
 


# FOR SUPER USER
Route::group(['middleware' => 'manager', 'prefix' => 'manager'], function () {

     # Dashboard
     Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('manager-dashboard');
   
     # Players
     Route::get('player', [PlayerController::class, 'list'])->name('manager-player');
     Route::get('player-view', [PlayerController::class, 'listView'])->name('manager-player-view');
     Route::post('player/save', [PlayerController::class, 'savePlayer'])->name('manager-player-save');
     Route::get('player-edit/{id}', [PlayerController::class, 'editPlayer'])->name('manager-player-edit');
     Route::get('player-delete/{id}', [PlayerController::class, 'deletePlayer'])->name('manager-player-delete');
     
     # Staff
     Route::get('staff', [StaffController::class, 'list'])->name('manager-staff');
     Route::get('staff-view', [StaffController::class, 'listView'])->name('manager-staff-view');
     Route::post('staff/save', [StaffController::class, 'saveStaff'])->name('manager-staff-save');
     Route::get('staff-edit/{id}', [StaffController::class, 'editStaff'])->name('manager-staff-edit');
     Route::get('staff-delete/{id}', [StaffController::class, 'deleteStaff'])->name('manager-staff-delete');
  

});

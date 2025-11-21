<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StaffController;

# Login
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('welcome');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
// Route::post('/profile/edit/{id}', [AuthController::class, 'updateProfile'])->name('profile-save');
Route::post('profile/edit/{id}', [AuthController::class, 'updateProfile'])->name('profile.update');


# FOR SUPER USER
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {

     # Dashboard
     Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin-dashboard');

     # Users
     Route::get('user/list', [UserController::class, 'list'])->name('admin-user-list');
     Route::get('user/add', [UserController::class, 'add'])->name('admin-user-add');
     Route::post('user/add', [UserController::class, 'save'])->name('admin-user-save');
     Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('admin-user-edit');
     Route::post('user/edit/{id}', [UserController::class, 'update'])->name('admin-user-update');
     Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('admin-user-delete');
     Route::get('user/details/{id}', [UserController::class, 'details'])->name('admin-user-details');
     
     # Teams
     Route::get('team/list', [TeamController::class, 'list'])->name('admin-team-list');
     Route::get('team/add', [TeamController::class, 'add'])->name('admin-team-add');
     Route::post('team/add', [TeamController::class, 'save'])->name('admin-team-save');
     Route::get('team/edit/{id}', [TeamController::class, 'edit'])->name('admin-team-edit');
     Route::post('team/edit/{id}', [TeamController::class, 'update'])->name('admin-team-update');
     Route::get('team/delete/{id}', [TeamController::class, 'delete'])->name('admin-team-delete');
     Route::get('team/details/{id}', [TeamController::class, 'details'])->name('admin-team-details');
   
     # Players
     Route::get('player/list', [PlayerController::class, 'list'])->name('admin-player-list');
     Route::get('player/add', [PlayerController::class, 'add'])->name('admin-player-add');
     Route::post('player/save', [PlayerController::class, 'save'])->name('admin-player-save');
     Route::get('player/edit/{id}', [PlayerController::class, 'edit'])->name('admin-player-edit');
     Route::post('player/edit/{id}', [PlayerController::class, 'update'])->name('admin-player-update');
     Route::get('player/delete/{id}', [PlayerController::class, 'delete'])->name('admin-player-delete');
     Route::get('player/details/{id}', [PlayerController::class, 'details'])->name('admin-player-details');
  
     # Positions
     Route::get('position/list', [PositionController::class, 'list'])->name('admin-position-list');
     Route::get('position/add', [PositionController::class, 'add'])->name('admin-position-add');
     Route::post('position/add', [PositionController::class, 'save'])->name('admin-position-save');
     Route::get('position/edit/{id}', [PositionController::class, 'edit'])->name('admin-position-edit');
     Route::post('position/edit/{id}', [PositionController::class, 'update'])->name('admin-position-update');
     Route::get('position/delete/{id}', [PositionController::class, 'delete'])->name('admin-position-delete');

     # Settings
     Route::get('setting/list', [SettingController::class, 'list'])->name('admin-setting-list');
     Route::post('setting/save', [SettingController::class, 'save'])->name('admin-setting-save');


});


# FOR SUPER USER
Route::group(['middleware' => 'manager', 'prefix' => 'manager'], function () {

     # Dashboard
     Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('manager-dashboard');
   
     # Players
     Route::get('player/list', [PlayerController::class, 'list'])->name('manager-player-list');
     Route::get('player/add', [PlayerController::class, 'add'])->name('manager-player-add');
     Route::post('player/add', [PlayerController::class, 'save'])->name('manager-player-save');
     Route::get('player/edit/{id}', [PlayerController::class, 'edit'])->name('manager-player-edit');
     Route::post('player/edit/{id}', [PlayerController::class, 'update'])->name('manager-player-update');
     Route::get('player/delete/{id}', [PlayerController::class, 'delete'])->name('manager-player-delete');
     Route::get('player/details/{id}', [PlayerController::class, 'details'])->name('manager-player-details');
     
     # Staff
     Route::get('staff/list', [StaffController::class, 'list'])->name('manager-staff-list');
     Route::get('staff/add', [StaffController::class, 'add'])->name('manager-staff-add');
     Route::post('staff/save', [StaffController::class, 'save'])->name('manager-staff-save');
     Route::get('staff/edit/{id}', [StaffController::class, 'edit'])->name('manager-staff-edit');
     Route::get('staff/edit/{id}', [StaffController::class, 'update'])->name('manager-staff-update');
     Route::get('staff/delete/{id}', [StaffController::class, 'delete'])->name('manager-staff-delete');
  

});

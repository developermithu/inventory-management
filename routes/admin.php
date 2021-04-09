<?php

use App\Http\Controllers\admin\BackupController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;



// Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
//     Route::get('/dashboard', DashboardController::class)->name('dashboard');
//     Route::resource('roles', RoleController::class);
// });

//Go to RouteServiceProvider For Details

Route::get('/dashboard', DashboardController::class)->name('dashboard');

// Users and Roles
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);

// Profile
Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

// Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');

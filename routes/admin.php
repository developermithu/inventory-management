<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RoleController;
use Illuminate\Support\Facades\Route;



// Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
//     Route::get('/dashboard', DashboardController::class)->name('dashboard');
//     Route::resource('roles', RoleController::class);
// });

//Go to RouteServiceProvider For Details

Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::resource('roles', RoleController::class);

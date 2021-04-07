<?php

use App\Http\Controllers\admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// For Admin Panel
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

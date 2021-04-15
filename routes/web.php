<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Socialite Login 
Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider'])->name('login.provider');
Route::get('/login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('login.callback');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// For Page
Route::get('{slug}', [PageController::class, 'index'])->name('page');

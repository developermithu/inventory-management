<?php

use App\Http\Controllers\admin\BackupController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MenuBuilderController;
use App\Http\Controllers\admin\MenuController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\SettingController;
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

// Password
Route::get('profile/security', [ProfileController::class, 'changePassword'])->name('profile.password.change');
Route::put('profile/security', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

// Backups
Route::resource('backups', BackupController::class)->only(['index', 'store', 'destroy']);
Route::get('backups/{file_name}', [BackupController::class, 'download'])->name('backups.download');
Route::delete('backups', [BackupController::class, 'clean'])->name('backups.clean');

// Pages
Route::resource('pages', PageController::class);

// Menus
Route::resource('menus', MenuController::class)->except(['show']);
Route::group(['as' => 'menus.', 'prefix' => 'menus/{id}'], function () {
    Route::post('order', [MenuBuilderController::class, 'order'])->name('order');
    Route::get('builder', [MenuBuilderController::class, 'index'])->name('builder');

    Route::get('item/create', [MenuBuilderController::class, 'itemCreate'])->name('item.create');
    Route::post('item/store', [MenuBuilderController::class, 'itemStore'])->name('item.store');

    Route::get('item/{itemId}/edit', [MenuBuilderController::class, 'itemEdit'])->name('item.edit');
    Route::put('item/{itemId}/update', [MenuBuilderController::class, 'itemUpdate'])->name('item.update');
    Route::delete('item/{itemId}/destroy', [MenuBuilderController::class, 'itemDestroy'])->name('item.destroy');
});

// Settings
Route::group(['as' => 'settings.', 'prefix' => 'settings'], function () {
    Route::get('general', [SettingController::class, 'general'])->name('general');
    Route::put('general', [SettingController::class, 'generalUpdate'])->name('general.update');

    Route::get('appearance', [SettingController::class, 'appearance'])->name('appearance');
    Route::put('appearance', [SettingController::class, 'appearanceUpdate'])->name('appearance.update');

    Route::get('mail', [SettingController::class, 'mail'])->name('mail');
    Route::put('mail', [SettingController::class, 'mailUpdate'])->name('mail.update');

    Route::get('socialite', [SettingController::class, 'socialite'])->name('socialite');
    Route::put('socialite', [SettingController::class, 'socialiteUpdate'])->name('socialite.update');
});

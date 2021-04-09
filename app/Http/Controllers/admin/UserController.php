<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        Gate::authorize('admin.users.index');
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        Gate::authorize('admin.users.create');
        $roles = Role::all();
        return view('admin.users.user-management', compact('roles'));
    }

    public function store(Request $request)
    {
        Gate::authorize('admin.users.create');
        $this->validate($request, [
            'name' => 'required | string',
            'email' => 'required | string | email | unique:users',
            'password' => 'required | confirmed | min:8 ',
            'role_id' => 'required',
            'status' => 'required',
            'avatar' => 'required | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->filled('status'),
        ]);

        // Image Upload
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        Toastr::success('User created successfully!', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        // Gate::authorize('admin.users.index');
        // return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        Gate::authorize('admin.users.edit');
        $roles = Role::all();
        return view('admin.users.user-management', compact('roles', 'user'));
    }

    public function update(Request $request, User $user)
    {
        Gate::authorize('admin.users.edit');
        $this->validate($request, [
            'name' => 'required | string',
            'email' => 'required | string | email | unique:users,email,' . $user->id,
            'password' => 'nullable | confirmed | min:8 ',
            'role_id' => 'required',
            'status' => 'required',
            'avatar' => 'nullable | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
            'status' => $request->filled('status'),
        ]);

        // Image Upload //singleFile() User model e
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        Toastr::success('Data updated !', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin.users.index');
    }

    public function destroy(User $user)
    {
        Gate::authorize('admin.users.destroy');
        $user->delete();
        Toastr::success('Data deleted successfully!', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        return back();
    }
}

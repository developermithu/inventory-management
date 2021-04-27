<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{

    public function index()
    {
        Gate::authorize('admin.roles.index');
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        Gate::authorize('admin.roles.create');
        $modules = Module::all();
        return view('admin.roles.role-management', compact('modules'));
    }

    public function store(Request $request)
    {
        Gate::authorize('admin.roles.create');
        $this->validate($request, [
            'name' => 'required | unique:roles',
            'permissions' => 'required | array',
            'permissions.*' => 'integer',
        ]);

        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ])->permissions()->sync($request->input('permissions', []));

        Toastr::success('Data created successfully.');
        return redirect()->route('admin.roles.index');
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        Gate::authorize('admin.roles.edit');
        $modules = Module::all();
        return view('admin.roles.role-management', compact('modules', 'role'));
    }

    public function update(Request $request, Role $role)
    {
        Gate::authorize('admin.roles.edit');
        $this->validate($request, [
            'name' => 'required',  //not unique
            'permissions' => 'required | array',
            'permissions.*' => 'integer',
        ]);
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        $role->permissions()->sync($request->input('permissions'));
        Toastr::success('Data updated successfully.');
        return redirect()->route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        Gate::authorize('admin.roles.destroy');
        if ($role->deletable == true) {
            Toastr::success('Data deleted successfully.');
            $role->delete();
        } else {
            Toastr::error('You can not delete this data.');
        }
        return back();
    }
}

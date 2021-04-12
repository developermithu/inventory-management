<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class MenuController extends Controller
{

    public function index()
    {
        Gate::authorize('admin.menus.index');
        $menus = Menu::latest('id')->get();
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        Gate::authorize('admin.menus.create');
        return view('admin.menus.menu-management');
    }

    public function store(Request $request)
    {
        Gate::authorize('admin.menus.create');
        $this->validate($request, [
            'name' => 'required | string | max:120 | unique:menus',
            'description' => 'nullable | string',
        ]);

        Menu::create([
            'name' => Str::slug($request->name),
            'description' => $request->description,
            'deletable' => true,
        ]);

        Toastr::success('Menu created successfully!', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin.menus.index');
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        Gate::authorize('admin.menus.edit');
        return view('admin.menus.menu-management', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        Gate::authorize('admin.menus.edit');
        $this->validate($request, [
            'name' => 'required | string | max:120 | unique:menus,name,' . $menu->id,
            'description' => 'nullable | string',
        ]);

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'deletable' => true,
        ]);

        Toastr::success('Menu updated successfully!', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        return redirect()->route('admin.menus.index');
    }

    public function destroy(Menu $menu)
    {
        Gate::authorize('admin.menus.destroy');

        if ($menu->deletable == true) {
            $menu->delete();
            Toastr::success('Menu deleted successfully!', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        } else {
            Toastr::error('You can\'t delete system menu.', 'Sorry!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        }
        return back();
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenuBuilderController extends Controller
{

    public function index($id)
    {
        Gate::authorize('admin.menus.index');
        $menu = Menu::findOrFail($id);
        return view('admin.menus.builder', compact('menu'));
    }

    public function order(Request $request, $id)
    {
        Gate::authorize('admin.menus.index');
        $menuItemOrder = json_decode($request->order); //from script js
        $this->OrderMenu($menuItemOrder, null);
    }

    private function OrderMenu(array $menuItems, $parentId)
    {
        foreach ($menuItems as $key => $item) {
            $menuItem = MenuItem::findOrFail($item->id);
            $menuItem->update([
                'order' => $key + 1,
                'parent_id' => $parentId
            ]);
            if (isset($item->children)) {
                $this->OrderMenu($item->children, $menuItem->id);
            }
        }
    }

    public function itemCreate($id)
    {
        Gate::authorize('admin.menus.create');
        $menu = Menu::findOrFail($id);
        return view('admin.menus.builder-management', compact('menu'));
    }

    public function itemStore(Request $request, $id)
    {
        Gate::authorize('admin.menus.create');
        $this->validate($request, [
            'type' => 'required | string',
            'title' => 'nullable | string',
            'divider_title' => 'nullable | string',
            'url' => 'nullable | string',
            'target' => 'nullable | string',
            'icon_class' => 'nullable | string',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->menuItems()->create([
            'divider_title' => $request->divider_title,
            'type' => $request->type,
            'title' => $request->title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class,
        ]);

        Toastr::success('Menu item created successfully');
        return redirect()->route('admin.menus.builder', $menu->id);
    }

    public function itemEdit($id, $itemId)
    {
        Gate::authorize('admin.menus.edit');
        $menu = Menu::findOrFail($id);
        // $menuItem = $menu->menuItems()->findOrFail($itemId);  //it's show error
        $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId);

        return view('admin.menus.builder-management', compact('menu', 'menuItem'));
    }

    public function itemUpdate(Request $request, $id, $itemId)
    {
        Gate::authorize('admin.menus.create');
        $this->validate($request, [
            'type' => 'required | string',
            'title' => 'nullable | string',
            'divider_title' => 'nullable | string',
            'url' => 'nullable | string',
            'target' => 'nullable | string',
            'icon_class' => 'nullable | string',
        ]);

        $menu = Menu::findOrFail($id);
        $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId);

        $menuItem->update([
            'divider_title' => $request->divider_title,
            'type' => $request->type,
            'title' => $request->title,
            'url' => $request->url,
            'target' => $request->target,
            'icon_class' => $request->icon_class,
        ]);

        Toastr::success('Menu item updated successfully');
        return redirect()->route('admin.menus.builder', $menu->id);
    }

    public function itemDestroy($id, $itemId)
    {
        Gate::authorize('admin.menus.destroy');
        // return Menu::findOrFail($id)->menuItems;
        // $menu = Menu::findOrFail($id);
        // $menuItem = MenuItem::where('menu_id', $menu->id)->findOrFail($itemId);
        // $menuItem->delete();

        Menu::findOrFail($id)->menuItems()->findOrFail($itemId)->delete();
        Toastr::success('Menu item deleted successfully.');
        return back();
    }
}

<?php

use App\Models\Menu;

if (!function_exists('menu')) {

    /**
     * get menu with item and child''s by name
     *
     * @param
     * @return
     */
    function menu($name)
    {
        $menu = Menu::where('name', $name)->first();
        return $menu->menuItems()->with('childs')->get();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminSidebar = Menu::updateOrCreate([
            'name' => 'admin-sidebar',
            'description' => 'this is dynamic admin sidebar',
            'deletable' => false
        ]);

        // MenuItem::updateOrCreate([
        //     'menu_id' => $adminSidebar->id,
        // ]); or

        // Menu Divider
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'divider',
            'order' => 1,
            'divider_title' => 'Menus',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 2,
            'title' => 'Dashboard',
            'url' => '/admin/dashboard',
            'icon_class' => 'metismenu-icon pe-7s-home',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 3,
            'title' => 'Pages',
            'url' => '/admin/pages',
            'icon_class' => 'metismenu-icon pe-7s-news-paper',
        ]);

        // Access Control Divider
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'divider',
            'order' => 4,
            'divider_title' => 'Access Control',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 5,
            'title' => 'Roles',
            'url' => '/admin/roles',
            'icon_class' => 'metismenu-icon pe-7s-check',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 6,
            'title' => 'User',
            'url' => '/admin/users',
            'icon_class' => 'metismenu-icon pe-7s-users',
        ]);

        // System Divider
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'divider',
            'order' => 7,
            'divider_title' => 'System',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 8,
            'title' => 'Menus',
            'url' => '/admin/menus',
            'icon_class' => 'metismenu-icon pe-7s-menu',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 9,
            'title' => 'Backup',
            'url' => '/admin/backups',
            'icon_class' => 'metismenu-icon pe-7s-cloud',
        ]);
        $adminSidebar->menuItems()->updateOrCreate([
            'type' => 'item',
            'order' => 10,
            'title' => 'Settings',
            'url' => '/admin/settings/general',
            'icon_class' => 'metismenu-icon pe-7s-settings',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin Dashboard
        $moduleAdminDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'admin.dashboard',
        ]);

        // Role Management
        $moduleAdminRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Access Role',
            'slug' => 'admin.roles.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Create Role',
            'slug' => 'admin.roles.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Edit Role',
            'slug' => 'admin.roles.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminRole->id,
            'name' => 'Delete Role',
            'slug' => 'admin.roles.destroy',
        ]);

        // User Management
        $moduleAdminUser = Module::updateOrCreate(['name' => 'User Management']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Access User',
            'slug' => 'admin.users.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Create User',
            'slug' => 'admin.users.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Edit User',
            'slug' => 'admin.users.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminUser->id,
            'name' => 'Delete User',
            'slug' => 'admin.users.destroy',
        ]);

        // Backups
        $moduleAdminBackup = Module::updateOrCreate(['name' => 'Backups']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBackup->id,
            'name' => 'Access Backups',
            'slug' => 'admin.backups.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBackup->id,
            'name' => 'Create Backups',
            'slug' => 'admin.backups.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBackup->id,
            'name' => 'Download Backups',
            'slug' => 'admin.backups.download',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminBackup->id,
            'name' => 'Delete Backups',
            'slug' => 'admin.backups.destroy',
        ]);

        // Page
        $moduleAdminPage = Module::updateOrCreate(['name' => 'Page']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminPage->id,
            'name' => 'Access Page',
            'slug' => 'admin.pages.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminPage->id,
            'name' => 'Create Page',
            'slug' => 'admin.pages.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminPage->id,
            'name' => 'Edit Page',
            'slug' => 'admin.pages.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminPage->id,
            'name' => 'Delete Page',
            'slug' => 'admin.pages.destroy',
        ]);

        // Menu
        $moduleAdminMenu = Module::updateOrCreate(['name' => 'Menu']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminMenu->id,
            'name' => 'Access Menu',
            'slug' => 'admin.menus.index',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminMenu->id,
            'name' => 'Access Menu Builder',
            'slug' => 'admin.menus.builder',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminMenu->id,
            'name' => 'Create Menu',
            'slug' => 'admin.menus.create',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminMenu->id,
            'name' => 'Edit Menu',
            'slug' => 'admin.menus.edit',
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminMenu->id,
            'name' => 'Delete Menu',
            'slug' => 'admin.menus.destroy',
        ]);
    }
}

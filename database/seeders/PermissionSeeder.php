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
    }
}

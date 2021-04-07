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
        $moduleAdminDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
            'module_id' => $moduleAdminDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'admin.dashboard',
        ]);

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
    }
}

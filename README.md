# Laravel Admin Kit

 ### Feature
 1. Admin Role
 2. User Role

 ### Library
 <pre>
 Spatie media library
 Dropify
 </pre>

#### Migration table edit korle 
php artisan migrate:fresh  //cmd <br>
php artisan migrate:fresh --seed //cmd
php artisan db:seed --class=UserSeeder //cmd single seeder
#### With Seeder & Migration 
php artisan make:model Permission -ms //
#### Check Model Relations
<pre>
php artisan tinker  //cmd

Module::find(1)
Module::find(3)
Module::find(1)->permissions

Permission::find(1)
Permission::find(1)->module
Permission::find(1)->roles

Role::find(1)
Role::find(1)->permissions
Role::find(1)->users

User::find(1)
User::find(1)->role
</pre>
#### Resource Controller Create
php artisan make:controller RoleController --model=Role

#### when use gate 
use Illuminate\Support\Facades\Gate;

#### Custom Blade Component 
Providers/AppServiceProvider

#### Custom Admin Service Provider 
Providers/RouteServiceProvider
#### For Backup
Spatie/Laravel-Backup Package <br>
Customize PermissionSeeder For Backup <br>
Setup Mailtrap Email <br>
php artisan backup:run //cmd <br>
php artisan backup:clean //cmd <br>

## For Mysqldump backup error
set config/database.com under mysql []
 <pre>
            'dump' => [
                'dump_binary_path' => 'C:\xampp\mysql\bin', // only the path, so without `mysqldump` or `pg_dump`
                'use_single_transaction',
                'timeout' => 60 * 5, // 5 minute timeout
            ],
</pre>

==== Migration table edit korle ====
php artisan migrate:fresh  //cmd
php artisan migrate:fresh --seed //cmd

==== With Seeder & Migration ====
php artisan make:model Permission -ms //

=== Check Model Relations ===
php artisan tinker  //cmd

Module::find(1)
Module::find(2)
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



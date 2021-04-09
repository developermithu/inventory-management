<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Two way
        // first way protected fillable/guarded model lagbe na

        // $user = new User();
        // $user->role_id = Role::where('slug', 'admin')->first()->id;
        // $user->name = 'Admin';
        // $user->email = 'admin@gmail.com';
        // $user->password = Hash::make('admin');
        // $user->save();

        User::updateOrCreate([
            'role_id' => Role::where('slug', 'admin')->first()->id,
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'status' => true,
        ]);

        User::updateOrCreate([
            'role_id' => Role::where('slug', 'user')->first()->id,
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            'status' => true,
        ]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        return view('admin.profile.index');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | string',
            'email' => 'required | string | email | unique:users,email,' . Auth::id(),
            'avatar' => 'nullable | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Image 
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');  //no problem
        }

        $user->save();
        Toastr::success('Data updated successfully!', 'Welcome!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        return back();
    }

    public function changePassword()
    {
        return view('admin.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required | confirmed | min:4',
        ]);

        $user = Auth::user();
        $hash_db_password = $user->password;

        if (Hash::check($request->old_password, $hash_db_password)) {
            if (!Hash::check($request->password, $hash_db_password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                Auth::logout();
                Toastr::success('Password changed !');
                return redirect()->route('login');
            } else {
                Toastr::error('New password should not be same as old password !', 'Oops!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
            }
        } else {
            Toastr::error('Password does not match !', 'Oops!', ["progressBar" => "true", "positionClass" => "toast-bottom-right"]);
        }

        return back();
    }
}

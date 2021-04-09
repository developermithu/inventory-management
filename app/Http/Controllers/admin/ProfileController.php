<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}

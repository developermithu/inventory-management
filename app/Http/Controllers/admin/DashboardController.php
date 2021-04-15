<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        Gate::authorize('admin.dashboard');
        $data['pageCount'] = Page::count();
        $data['userCount'] = User::count();
        $data['roleCount'] = Role::count();
        $data['menuCount'] = Menu::count();
        $data['users'] = User::latest()->take(10)->get();

        return view('admin.dashboard', $data);
    }
}

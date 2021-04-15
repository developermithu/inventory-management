<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Socialite Login
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user =  Socialite::driver($provider)->user();
        // dd($user);
        $existingUser = User::whereEmail($user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'role_id' => Role::where('slug', 'user')->first()->id,
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'email_verified_at' => Date::now(),
                'password' => Hash::make(uniqid()), //we don't need pwd
                'status' => true,
            ]);

            // Image Upload
            if ($user->getAvatar()) {
                $newUser->addMediaFromUrl($user->getAvatar())->toMediaCollection('avatar');
            }
            Auth::login($newUser);
        }
        return redirect($this->redirectPath());
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function general()
    {
        return view('admin.settings.general');
    }

    public function generalUpdate(Request $request)
    {
        $this->validate($request, [
            'site_title' => 'required | string | max: 60',
            'site_description' => 'nullable | string | max: 255',
            'site_address' => 'nullable | string | max: 255',
        ]);

        Setting::updateOrCreate(['name' => 'site_title'], ['value' => $request->site_title]);
        // Update .env APP_NAME
        Artisan::call("env:set APP_NAME=' " . $request->site_title . " ' ");

        Setting::updateOrCreate(['name' => 'site_description'], ['value' => $request->site_description]);
        Setting::updateOrCreate(['name' => 'site_address'], ['value' => $request->site_address]);

        Toastr::success('Settings updated successfully');
        return back();
    }

    public function appearance()
    {
        return view('admin.settings.appearance');
    }

    public function appearanceUpdate(Request $request)
    {
        $this->validate($request, [
            'site_logo' => 'nullable | image | mimes:png,jpg,jpeg | max: 2048',
            'site_favicon' => 'nullable | image | mimes:png,jpg,jpeg | max: 1048',
        ]);

        // Update Logo
        if ($request->hasFile('site_logo')) {
            $this->deleteOldLogo(setting('site_logo'));
            Setting::updateOrCreate(['name' => 'site_logo'], ['value' => Storage::disk('public')->put('logos', $request->file('site_logo'))]);
        }
        // Update Favicon
        if ($request->hasFile('site_favicon')) {
            $this->deleteOldLogo(setting('site_favicon'));
            Setting::updateOrCreate(['name' => 'site_favicon'], ['value' => Storage::disk('public')->put('logos', $request->file('site_favicon'))]);
        }

        Toastr::success('Settings updated successfully');
        return back();
    }

    private function deleteOldLogo($path)
    {
        Storage::disk('public')->delete($path);
    }

    public function mail()
    {
        return view('admin.settings.mail');
    }

    public function mailUpdate(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'mail_mailer' => 'string | max: 255',
            'mail_host' => 'nullable | string | max: 255',
            'mail_port' => 'nullable | string | max: 255',
            'mail_username' => 'nullable | string | max: 255',
            'mail_password' => 'nullable | string | max: 255',
            'mail_encryption' => 'nullable | string | max: 255',
            'mail_from_address' => 'nullable | string | max: 255',
            'mail_from_name' => 'nullable | string | max: 255',
        ]);

        Setting::updateOrCreate(['name' => 'mail_mailer'], ['value' => $request->mail_mailer]);
        Artisan::call("env:set MAIL_MAILER='" . $request->mail_mailer . "'");

        Setting::updateOrCreate(['name' => 'mail_host'], ['value' => $request->mail_host]);
        Artisan::call("env:set MAIL_HOST='" . $request->mail_host . "'");

        Setting::updateOrCreate(['name' => 'mail_port'], ['value' => $request->mail_port]);
        Artisan::call("env:set MAIL_PORT='" . $request->mail_port . "'");

        Setting::updateOrCreate(['name' => 'mail_username'], ['value' => $request->mail_username]);
        Artisan::call("env:set MAIL_USERNAME='" . $request->mail_username . "'");

        Setting::updateOrCreate(['name' => 'mail_password'], ['value' => $request->mail_password]);
        Artisan::call("env:set MAIL_PASSWORD='" . $request->mail_password . "'");

        Setting::updateOrCreate(['name' => 'mail_encryption'], ['value' => $request->mail_encryption]);
        Artisan::call("env:set MAIL_ENCRYPTION='" . $request->mail_encryption . "'");

        Setting::updateOrCreate(['name' => 'mail_from_address'], ['value' => $request->mail_from_address]);
        Artisan::call("env:set MAIL_FROM_ADDRESS='" . $request->mail_from_address . "'");

        Setting::updateOrCreate(['name' => 'mail_from_name'], ['value' => $request->mail_from_name]);
        Artisan::call("env:set MAIL_FROM_NAME='" . $request->mail_from_name . "'");

        Toastr::success('Settings updated successfully');
        return back();
    }

    public function socialite()
    {
        return view('admin.settings.socialite');
    }

    public function socialiteUpdate(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'facebook_client_id' => 'nullable | string | max: 255',
            'facebook_client_secret' => 'nullable | string | max: 255',
            'google_client_id' => 'nullable | string | max: 255',
            'google_client_secret' => 'nullable | string | max: 255',
            'github_client_id' => 'nullable | string | max: 255',
            'github_client_secret' => 'nullable | string | max: 255',
        ]);

        // Facebook
        Setting::updateOrCreate(['name' => 'facebook_client_id'], ['value' => $request->facebook_client_id]);
        Artisan::call("env:set FACEBOOK_CLIENT_ID='" . $request->facebook_client_id . "'");

        Setting::updateOrCreate(['name' => 'facebook_client_secret'], ['value' => $request->facebook_client_secret]);
        Artisan::call("env:set FACEBOOK_CLIENT_SECRET='" . $request->facebook_client_secret . "'");

        // Google
        Setting::updateOrCreate(['name' => 'google_client_id'], ['value' => $request->google_client_id]);
        Artisan::call("env:set GOOGLE_CLIENT_ID='" . $request->google_client_id . "'");

        Setting::updateOrCreate(['name' => 'google_client_secret'], ['value' => $request->google_client_secret]);
        Artisan::call("env:set GOOGLE_CLIENT_SECRET='" . $request->google_client_secret . "'");

        // Github
        Setting::updateOrCreate(['name' => 'github_client_id'], ['value' => $request->github_client_id]);
        Artisan::call("env:set GITHUB_CLIENT_ID='" . $request->github_client_id . "'");

        Setting::updateOrCreate(['name' => 'github_client_secret'], ['value' => $request->github_client_secret]);
        Artisan::call("env:set GITHUB_CLIENT_SECRET='" . $request->github_client_secret . "'");

        Toastr::success('Settings updated successfully');
        return back();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // General Settings
        Setting::updateOrCreate(['name' => 'site_title'], ['value' => 'StartarKit']);
        Setting::updateOrCreate(['name' => 'site_description'], ['value' => 'A laravel startar kit for web artisan']);
        Setting::updateOrCreate(['name' => 'site_address'], ['value' => 'Sylhet, Bangladesh']);

        // Mail Settings
        Setting::updateOrCreate(['name' => 'mail_mailer'], ['value' => 'smtp']);
        Setting::updateOrCreate(['name' => 'mail_host'], ['value' => 'smtp.mailtrap.io']);
        Setting::updateOrCreate(['name' => 'mail_port'], ['value' => '2525']);
        Setting::updateOrCreate(['name' => 'mail_username'], ['value' => 'aa6a8342cb38d7']);
        Setting::updateOrCreate(['name' => 'mail_password'], ['value' => '36b84712f4f5cf']);
        Setting::updateOrCreate(['name' => 'mail_encryption'], ['value' => 'tls']);
        Setting::updateOrCreate(['name' => 'mail_from_address'], ['value' => 'www.mithudas77@gmail.com']);
        Setting::updateOrCreate(['name' => 'mail_from_name'], ['value' => 'laravelStartarKit']);

        // Facebook
        Setting::updateOrCreate(['name' => 'facebook_client_id'], ['value' => '476928676842056']);
        Setting::updateOrCreate(['name' => 'facebook_client_secret'], ['value' => 'caba0c266717c6ae239a8b1cee0976ef']);

        // Google
        Setting::updateOrCreate(['name' => 'google_client_id'], ['value' => '1064115465884-6siogqrl15lb1125eljshqihc0is23ro.apps.googleusercontent.com']);
        Setting::updateOrCreate(['name' => 'google_client_secret'], ['value' => 'bEcAqfDkBmPIhGE_PABgnYQX']);

        // Github
        Setting::updateOrCreate(['name' => 'github_client_id'], ['value' => '2f425d6e771bae79d860']);
        Setting::updateOrCreate(['name' => 'github_client_secret'], ['value' => '1264518564051f3ac8b1e139e17be4ee1377c9c3']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Setting::where('key', 'app_name')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_name';
            $setting->value = env('APP_NAME', 'Shoe Shoe Basic');
            $setting->is_env = true;
            $setting->save();
        }
        if (Setting::where('key', 'app_url')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_url';
            $setting->value = env('APP_URL', (string)url('/'));
            $setting->is_env = true;
            $setting->save();
        }
        if (Setting::where('key', 'app_address')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_address';
            $setting->value = '';
            $setting->save();
        }
        if (Setting::where('key', 'app_shipping_cost')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_shipping_cost';
            $setting->value = 0;
            $setting->save();
        }
        if (Setting::where('key', 'app_mobile')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_mobile';
            $setting->value = '';
            $setting->save();
        }
        if (Setting::where('key', 'app_instagram')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_instagram';
            $setting->value = 'https://www.instagram.com/instagram/';
            $setting->save();
        }
     
        if (Setting::where('key', 'app_logo')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_logo';
            $setting->value = 'default';
            $setting->save();
        }

        if (Setting::where('key', 'app_bg_authentication')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_bg_authentication';
            $setting->value = 'default';
            $setting->save();
        }

        if (Setting::where('key', 'app_tax')->count() == 0) {
            $setting = new Setting();
            $setting->key = 'app_tax';
            $setting->value = 0;
            $setting->save();
        }
    }
}

<?php

namespace App\Providers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    
        if (file_exists(storage_path('installed'))) {
            $settings = [];
            $result = SettingResource::collection(Setting::all());
            foreach ($result as $obj) {
                $settings[$obj->key] = $obj->value;
            }
            view()->share([
                'settings' => $settings,
            ]);
        }
    }
}

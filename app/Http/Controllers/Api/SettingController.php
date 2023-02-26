<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $settings = Setting::all();
        $appName = $settings[0]['value'];
        $appAddress = $settings[2]['value'] ?? '';
        $appShippingCost = $settings[3]['value'] ?? '';
        $appMobile = $settings[4]['value'] ?? '';
        $appInstagram = $settings[5]['value'] ?? '';
        $appTaxPercent = $settings[12]['value'] ?? '';

        $appLogo = '';
        if (
            $settings[6]['value'] === null ||
            $settings[6]['value'] === '' ||
            $settings[6]['value'] === 'default'
        ) {

            $appLogo =   env('APP_URL') . "/assets/logo.png";
        } else {
            $appLogo =   env('APP_URL') . "/assets/" .  $settings[6]['value'];
        }

        try {
            return response()->json([
                'setting' => new SettingResource([
                    'app_name' => $appName,
                    'app_address' => $appAddress,
                    'app_mobile' => $appMobile,
                    'app_instagram' => $appInstagram,
                    'app_shipping_cost' => $appShippingCost,
                    'app_logo' => $appLogo,
                    'app_tax_percent'=> $appTaxPercent
                ])
            ], 200);
        } catch (\Throwable $e) {
            report($e);
            Log::error($e->getMessage());
        }
    }
}

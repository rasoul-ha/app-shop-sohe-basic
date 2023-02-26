<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;
    public static function getLogo()
    {
        $logo = setting('app_logo');
        switch ($logo) {
            case null:
            case 'default':
                return asset('/assets/logo.png');
            default:
                if (asset($logo)) {
                    return asset($logo);
                } else {
                    return asset('/assets/logo.png');
                }
        }
    }

    public static function getBgAuthentication()
    {
        $background = setting('app_bg_authentication');
        switch ($background) {
            case null:
            case 'default':
                return asset('/assets/bg_authentication.jpg');
            default:
                if (asset($background)) {
                    return asset($background);
                } else {
                    return asset('/assets/bg_authentication.jpg');
                }
        }
    }


}

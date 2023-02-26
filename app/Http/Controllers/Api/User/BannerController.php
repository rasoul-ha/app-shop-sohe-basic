<?php

namespace App\Http\Controllers\Api\user;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\BannerResource;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BannerController extends Controller
{
    public function index()
    {
        try {
            $banners = Banner::with('entity')->where('status', 1)->get();

            return response()->json([
                'banners' => BannerResource::collection($banners)
            ], 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}

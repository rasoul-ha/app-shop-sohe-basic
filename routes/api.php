<?php


use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\User\AccountController;
use App\Http\Controllers\Api\User\AddressController;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\user\BannerController;
use App\Http\Controllers\Api\User\CategoryController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\ProductController;
use App\Http\Controllers\Api\User\PurcheseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// SITE-IMAGES
Route::get('/images', [\App\Http\Controllers\Admin\Api\ImageController::class, 'index']);
Route::post('/images/upload', [\App\Http\Controllers\Admin\Api\ImageController::class, 'uploadFile']);
Route::delete('/images/remove/{image}', [\App\Http\Controllers\Admin\Api\ImageController::class, 'destroy']);

Route::get('banners/products/{category}', [\App\Http\Controllers\Admin\Api\BannerController::class, 'selectedProductsByCategory']);


// APP - USER
// Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password/{user}', [AuthController::class, 'resetPassword']);

// SETTINGS APP
Route::get('/setting', SettingController::class);
// BANNERS
Route::get('/banners', [BannerController::class, 'index']);
// CATEGORIES
Route::get('/categories', [CategoryController::class, 'index']);
// PRODUCTS
Route::get('/products/{category}', [ProductController::class, 'index']);


// USER
Route::middleware('auth:sanctum')->group(function () {
    // Authentication
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::put('/update-name', [AccountController::class, 'updateName']);
    Route::put('/update-password', [AccountController::class, 'updatePassword']);
    // ORDERS
    Route::get('/orders', [OrderController::class, 'index']);
    // ADDRESSES
    Route::apiResource('/addresses', AddressController::class);
    // PURCHESE
    Route::post('purchese', PurcheseController::class);
});

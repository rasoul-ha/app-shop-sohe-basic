<?php

use App\Http\Controllers\Admin\AddressController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Authentication\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::redirect('/', '/admin/login');

Route::middleware('guest:admin')->prefix('/admin')->group(function () {
    // AUTHENTICATION
    // LOGIN
    Route::get('/login', [AuthController::class, 'showLoginForm']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    // FORGOT PASSWORD
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgotpasswordform');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'passwordRequest'])->name('password.request');
    Route::get('/reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('resetpasswordform');
    // RESET PASSWORD
    Route::post('/reset-password', [ForgotPasswordController::class, 'passwordUpdate'])->name('password.update');
});


Route::middleware('auth:admin')->group(function () {
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('/dashboard')->group(function () {
        // DASHBOARD : HOME
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::group(['as' => 'dashboard.'], function () {
            // DASHBOARD : SETTINGS
            Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
            Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
            // DASHBOARD : PROFILE
            Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
            Route::put('/update-profile', [App\Http\Controllers\Admin\ProfileController::class, 'updateProfile'])->name('profile.update');
            // DASHBOARD : UPDATE PASSWORD
            Route::put('/update-password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('password.update');
            // DASHBOARD : IMAGES
            Route::get('/images', [ImageController::class, 'index'])->name('images');
            // DASHBOARD : NOTIFICATIONS
            Route::get('mark-as-read/{id}', [App\Http\Controllers\Admin\NotificationContorller::class, 'markAsRead'])->name('mark.notification');
            Route::get('mark-all-as-read', [App\Http\Controllers\Admin\NotificationContorller::class, 'markAllAsRead'])->name('mark.notifications');

            //  DASHBOARD : USERS
            Route::resource('/users', App\Http\Controllers\Admin\UserController::class)->names('users')->except('show');
            // DASHBOARD : ADDRESSES
            Route::get('/user/{user}/addressess', [AddressController::class, 'index'])->name('addresses.index');
            Route::get('/user/{user}/addresses', [AddressController::class, 'create'])->name('addresses.create');
            Route::post('/user/{user}/addresses', [AddressController::class, 'store'])->name('addresses.store');
            Route::get('/user/{user}/addresses/{address}/edit', [AddressController::class, 'edit'])->name('addresses.edit');
            Route::put('addresses/{address}/edit', [AddressController::class, 'update'])->name('addresses.update');
            Route::delete('addresses/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');

            // DASHBOARD : CATEGORIES
            Route::resource('/categories', App\Http\Controllers\Admin\CategoryController::class)->names('categories')->except('show');
            // DASHBOARD : PRODUCTS
            Route::resource('/products', App\Http\Controllers\Admin\ProductController::class)->names('products')->except('show');
             // DASHBOARD : BANNERS
            Route::resource('/banners', App\Http\Controllers\Admin\BannerController::class)->names('banners')->except('show');

            // DASHBOARD : ORDERS
            Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
            Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
            Route::post('/orders/{order}/payment', [OrderController::class, 'changePaymentStatus'])->name('orders.payment.status');
            Route::post('/orders/{order}/step', [OrderController::class, 'changeStepStatus'])->name('orders.step.status');
        });
    });
});

Route::fallback(function () {
    return redirect('/');
});


// require __DIR__.'/auth.php';

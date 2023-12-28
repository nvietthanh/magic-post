<?php

use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\User\OrderController as UserOrderController;
use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\PasswordController;
use App\Http\Controllers\User\Auth\ProfileController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return redirect()->route('user.home');
});

Route::middleware('guest')->as('auth.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('register', [RegisteredUserController::class, 'store'])->name('register-store');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login-store');
});

Route::as('user.')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/order-search', [UserOrderController::class, 'search'])->name('order.search');

    // get region of point
    Route::get('/get-province-all', [RegionController::class, 'getProvinceAll'])->name('region.province-all');
    Route::get('/get-district-all/{id}', [RegionController::class, 'getDistrict'])->name('region.get-district');
});

Route::middleware('auth')->as('user.')->group(function () {
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    Route::as('api.')->prefix('api')->group(function () {
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // change password
        Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('change-password');
        // update profile
        Route::get('/profile', [ProfileController::class, 'getProfile'])->name('get-profile');
        Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('update-profile');

        // list order
        Route::get('/order', [UserOrderController::class, 'index'])->name('order.index');
    });
});

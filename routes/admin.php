<?php

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\ConcentratePointController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TransactionPointController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\AdminAccountController as ApiAdminAccountController;
use App\Http\Controllers\Api\ConcentratePointController as ApiConcentratePointController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\TransactionPointController as ApiTransactionPointController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('store-login');
});

# route admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/account', [AdminAccountController::class, 'index'])->name('account.index');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

    Route::get('/transaction-point', [TransactionPointController::class, 'index'])->name('transaction-point.index');

    Route::get('/concentrate-point', [ConcentratePointController::class, 'index'])->name('concentrate-point.index');
});

# api admin
Route::middleware(['auth:admin'])->as('api.')->prefix('api/')->group(function () {
    // logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    // change password
    Route::post('/change-password', [PasswordController::class, 'changePassword'])->name('change-password');
    // update profile
    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('get-profile');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('update-profile');

    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // crud account
    Route::apiResource('/account', ApiAdminAccountController::class);

    // crud user admin
    Route::apiResource('/user', ApiUserController::class);

    // crud transaction point
    Route::apiResource('/transactioin-point', ApiTransactionPointController::class);

    // crud transaction point
    Route::apiResource('/concentrate-point', ApiConcentratePointController::class);

    // get region of point
    Route::get('/get-province-all', [RegionController::class, 'getProvinceAll'])->name('region.province-all');
    Route::get('/get-district-all/{id}', [RegionController::class, 'getDistrict'])->name('region.get-district');
});

<?php

use App\Http\Controllers\Admin\AdminAccountController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\PasswordController;
use App\Http\Controllers\Admin\Auth\ProfileController;
use App\Http\Controllers\Admin\ConcentrateOrderReceiveController;
use App\Http\Controllers\Admin\ConcentrateOrderSendController;
use App\Http\Controllers\Admin\ConcentratePointController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TransactionOrderReceiveController;
use App\Http\Controllers\Admin\TransactionOrderSendController;
use App\Http\Controllers\Admin\TransactionPointController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Api\AdminAccountController as ApiAdminAccountController;
use App\Http\Controllers\Api\ConcentrateOrderReceiveController as ApiConcentrateOrderReceiveController;
use App\Http\Controllers\Api\ConcentrateOrderSendController as ApiConcentrateOrderSendController;
use App\Http\Controllers\Api\ConcentratePointController as ApiConcentratePointController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\TransactionOrderReceiveController as ApiTransactionOrderReceiveController;
use App\Http\Controllers\Api\TransactionOrderSendController as ApiTransactionOrderSendController;
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

    Route::get('/transaction-order-send', [TransactionOrderSendController::class, 'index'])
        ->name('transaction-order-send.index');
    Route::get('/transaction-order-receive', [TransactionOrderReceiveController::class, 'index'])
        ->name('transaction-order-receive.index');

    Route::get('/concentrate-order-send', [ConcentrateOrderSendController::class, 'index'])
        ->name('concentrate-order-send.index');
    Route::get('/concentrate-order-receive', [ConcentrateOrderReceiveController::class, 'index'])
        ->name('concentrate-order-receive.index');
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
    Route::get('/user/{id}', [ApiUserController::class, 'show'])->name('user.show');
    Route::get('/get-all-user', [ApiUserController::class, 'getAll'])->name('user.get-all');

    // crud transaction point
    Route::apiResource('/transaction-point', ApiTransactionPointController::class)->names('transactioin-point');
    Route::get('/get-district-transaction-point/{province_id}', [ApiTransactionPointController::class, 'getDistrict'])
        ->name('transaction-point.get-district');
    Route::get('/get-admin-transaction-point', [ApiTransactionPointController::class, 'getTransactionAdmin'])
        ->name('transaction-point.get-admin');

    // crud transaction point
    Route::apiResource('/concentrate-point', ApiConcentratePointController::class);
    Route::get('/get-district-concentrate-point/{province_id}', [ApiConcentratePointController::class, 'getDistrict'])
        ->name('concentrate-point.get-district');
    Route::get('/get-admin-concentrate-point', [ApiConcentratePointController::class, 'getConcentrateAdmin'])
        ->name('concentrate-point.get-admin');

    // get region of point
    Route::get('/get-province-all', [RegionController::class, 'getProvinceAll'])->name('region.province-all');
    Route::get('/get-district-all/{id}', [RegionController::class, 'getDistrict'])->name('region.get-district');

    // crud transaction order send
    Route::apiResource('/transaction-order-send', ApiTransactionOrderSendController::class);
    Route::get('/get-concentrate-transaction-order/{province_id}', [ApiTransactionOrderSendController::class, 'getConcentratePoint'])
        ->name('transaction-order-send.get-concentrate');
    Route::get('/change-peding-transaction-order-send/{id}', [ApiTransactionOrderSendController::class, 'changeTransactionStatus'])
        ->name('transaction-order-send.change-transaction-status');
    Route::get('/change-status-transaction-des-order-send/{id}', [ApiTransactionOrderSendController::class, 'changeTransactionDesStatus'])
        ->name('transaction-order-send.change-transaction-des-send');

    // crud transaction order receive
    Route::apiResource('/transaction-order-receive', ApiTransactionOrderReceiveController::class);
    Route::get('/change-status-transaction-order-receive/{id}', [ApiTransactionOrderReceiveController::class, 'changeTransactionStatus'])
        ->name('transaction-order-receive.change-transaction-receive');

    // crud concentrate order send
    Route::get('/concentrate-order-send', [ApiConcentrateOrderSendController::class, 'index'])
        ->name('concentrate-order-send.index');
    Route::get('/get-concentrate-in-concentrate-order-send/{province_id}', [ApiConcentrateOrderSendController::class, 'getConcentratePoint'])
        ->name('concentrate-order-send.get-concentrate');
    Route::get('/change-status-concentrate-order-send/{id}', [ApiConcentrateOrderSendController::class, 'changeConcentrateStatus'])
        ->name('concentrate-order-send.change-concentrate-send');
    Route::get('/change-status-concentrate-des-order-send/{id}', [ApiConcentrateOrderSendController::class, 'changeConcentrateDesStatus'])
        ->name('concentrate-order-send.change-concentrate-des-send');

    // crud concentrate order receive
    Route::get('/concentrate-order-receive', [ApiConcentrateOrderReceiveController::class, 'index'])
        ->name('concentrate-order-receive.index');
    Route::get('/change-status-concentrate-order-receive/{id}', [ApiConcentrateOrderReceiveController::class, 'changeConcentrateStatus'])
        ->name('concentrate-order-receive.change-concentrate-receive');
    Route::get('/change-status-concentrate-des-order-receive/{id}', [ApiConcentrateOrderReceiveController::class, 'changeConcentrateDesStatus'])
        ->name('concentrate-order-receive.change-concentrate-des-receive');
});

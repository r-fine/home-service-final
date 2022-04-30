<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProviderProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Routes for Admin
Route::prefix('admin')->group(function () {
    Route::name('admin.')->group(function () {
        Route::group(['middleware' => ['auth', 'role:admin']], function () {
            Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
            // Routes for user verification
            Route::get('/user-verification/{id}', [AdminController::class, 'user_verification'])->name('verify.user');
            Route::get('/unverified-user-list', [AdminController::class, 'show_unverified_providers'])->name('unverified.provider.list');
            // Resource Routes
            Route::resources([
                'categories' => CategoryController::class,
                'services' => ServiceController::class,
            ]);
            // Routes for Order management
            Route::prefix('order')->group(function () {
                Route::name('order.')->group(function () {
                    Route::get('/order-list', [OrderController::class, 'index'])->name('index');
                    Route::get('/accept/{item}', [OrderItemController::class, 'orderStatusAccepted'])->name('accept');
                    Route::get('/prepare/{item}', [OrderItemController::class, 'orderStatusPreparing'])->name('prepare');
                    Route::get('/complete/{item}', [OrderItemController::class, 'orderStatusCompleted'])->name('complete');
                    Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
                    Route::put('/{order}', [OrderController::class, 'update'])->name('update');
                    Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');
                    Route::get('/{item}/assign/provider', [OrderItemController::class, 'edit'])->name('item.edit');
                    Route::put('/item/{item}', [OrderItemController::class, 'assignProvider'])->name('item.assign.provider');
                });
            });
            Route::get('s-provider/list', [ProviderProfileController::class, 'index'])->name('s_provider.index');
            Route::delete('s-provider/{profile}', [ProviderProfileController::class, 'destroy'])->name('s_provider.destroy');
        });
    });
});

Route::prefix('provider')->group(function () {
    Route::name('provider.')->group(function () {
        Route::prefix('order')->group(function () {
            Route::name('order.')->group(function () {
                Route::group(['middleware' => ['auth', 'role:s_provider']], function () {
                    Route::get('/complete/{item}', [OrderItemController::class, 'orderStatusCompleted'])->name('complete');
                });
            });
        });
    });
});

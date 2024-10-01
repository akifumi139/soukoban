<?php

declare(strict_types=1);

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SettingController;
use App\Livewire\MovementHistory;
use App\Livewire\MyStuff;
use App\Livewire\StockManager\AddStock;
use App\Livewire\StockManager\DeleteStock;
use App\Livewire\Stockroom;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'index')->name('login');
        Route::get('/login', 'index')->name('login');
        Route::post('login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });

Route::middleware('auth')->group(function () {
    Route::prefix('stockroom')
        ->name('stockroom')
        ->get('/', Stockroom::class);

    Route::prefix('myStuff')
        ->name('myStuff')
        ->get('/', MyStuff::class);

    Route::prefix('stock-manager')
        ->name('stock-manager.')
        ->group(function () {
            Route::get('add', AddStock::class)->name('add');
            Route::get('delete', DeleteStock::class)->name('delete');

        });

    Route::prefix('history')
        ->name('history')
        ->get('/', MovementHistory::class);

    Route::prefix('settings')
        ->name('settings.')
        ->group(function () {
            Route::get('/', SettingController::class)->name('index');

            Route::controller(PasswordController::class)
                ->prefix('password')
                ->name('password.')
                ->group(function () {
                    Route::get('', 'edit')->name('edit');
                    Route::post('', 'update')->name('update');
                });

            Route::controller(AccountController::class)
                ->prefix('accounts')
                ->name('accounts.')
                ->group(function () {
                    Route::get('', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('', 'store')->name('store');
                    Route::get('{account}', 'edit')->name('edit');
                    Route::post('{account}', 'update')->name('update');
                    Route::delete('{account}', 'destroy')->name('destroy');
                });
        });

});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/soukoban/livewire/update', $handle);
});

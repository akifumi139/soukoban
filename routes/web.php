<?php

use App\Http\Controllers\AuthController;
use App\Livewire\DeleteStock;
use App\Livewire\ProductBoard;
use App\Livewire\ProductHistory;
use App\Livewire\StockManager;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('login', 'login')->name('login');
    });


Route::middleware('auth')->group(function () {
    Route::prefix('在庫管理')
        ->name('stockManager')
        ->group(function () {
            Route::get('/', StockManager::class);
            Route::get('delete', DeleteStock::class)->name('.delete');
        });


    Route::prefix('在庫一覧')
        ->name('productBoard')
        ->get('/', ProductBoard::class);

    Route::prefix('移動履歴')
        ->name('productHistory')
        ->get('/', ProductHistory::class);
});


Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/soukoban/livewire/update', $handle);
});

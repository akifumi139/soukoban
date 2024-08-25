<?php

use App\Http\Controllers\AuthController;
use App\Livewire\ProductBoard;
use App\Livewire\ProductHistory;
use App\Livewire\StockManager;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('login', 'login')->name('login');
    });


Route::middleware('auth')->group(function () {
    Route::prefix('在庫管理')
        ->name('stockManager')
        ->get('/', StockManager::class);

    Route::prefix('在庫一覧')
        ->name('productBoard')
        ->get('/', ProductBoard::class);

    Route::prefix('移動履歴')
        ->name('productHistory')
        ->get('/', ProductHistory::class);
});

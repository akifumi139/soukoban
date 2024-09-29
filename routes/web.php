<?php

declare(strict_types=1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SettingController;
use App\Livewire\DeleteStock;
use App\Livewire\MovementHistory;
use App\Livewire\MyStuff;
use App\Livewire\RoomManager\AddStock;
use App\Livewire\RoomManager\CategoryManager;
use App\Livewire\RoomManager\StockManager;
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
    Route::prefix('roomManager')
        ->name('roomManager')
        ->group(function () {
            Route::get('/', StockManager::class);
            Route::get('add', AddStock::class)->name('.add');
            Route::get('delete', DeleteStock::class)->name('.delete');
            Route::get('categories/manager', CategoryManager::class)->name('.category');
        });

    Route::prefix('stockroom')
        ->name('stockroom')
        ->get('/', Stockroom::class);

    Route::prefix('myStuff')
        ->name('myStuff')
        ->get('/', MyStuff::class);

    Route::prefix('history')
        ->name('history')
        ->get('/', MovementHistory::class);

    Route::prefix('settings')
        ->name('settings.')
        ->group(function () {
            Route::get('/', SettingController::class)->name('index');
        });

});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/soukoban/livewire/update', $handle);
});

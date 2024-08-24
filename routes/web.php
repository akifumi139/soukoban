<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('login', 'login')->name('login');
    });


Route::middleware('auth')->group(function () {
    Route::controller(StockController::class)
        ->prefix('stocks')
        ->name('stocks.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});

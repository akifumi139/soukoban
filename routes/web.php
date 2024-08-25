<?php

use App\Http\Controllers\AuthController;
use App\Livewire\ProductBoard;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('login', 'login')->name('login');
    });


Route::middleware('auth')->group(function () {
    Route::prefix('在庫一覧')
        ->name('productBoard')
        ->get('/', ProductBoard::class);
});

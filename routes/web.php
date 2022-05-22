<?php

use App\Http\Controllers\Banned\BannedController;
use App\Http\Controllers\Guest\WelcomeController;
use App\Http\Controllers\Pages\DashboardController;
use App\Http\Controllers\Webgame\Demo\DemoController;
use Illuminate\Support\Facades\Route;

//======================================================================
// Routes for guests only - pages and demo routines.
//======================================================================
Route::middleware('guest')->name('guest.')->group(function () {
    Route::get('/', WelcomeController::class)->name('welcome');

    Route::prefix('demo')->name('demo.')->group(function () {
        Route::get('/', [DemoController::class, 'index'])->name('index');
        Route::get('/{game}', [DemoController::class, 'show'])->name('show');
    });
});

//======================================================================
// Routes for authorised users - irrespective of ban status.
//======================================================================
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

});

//======================================================================
// Routes for authorised users, who have been banned, only.
//======================================================================
Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/banned', BannedController::class)->name('banned');
});

//======================================================================
// Routes for authorised users who are not banned - most routes will go here!
//======================================================================
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'banned'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

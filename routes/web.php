<?php

use App\Http\Controllers\Banned\BannedController;
use App\Http\Controllers\Guest\WelcomeController;
use App\Http\Controllers\Pages\DashboardController;
use Illuminate\Support\Facades\Route;

//======================================================================
// Routes for guests only - pages and demo routines.
//======================================================================
Route::middleware('guest')->name('guest.')->group(function () {
    Route::get('/', WelcomeController::class)->name('welcome');
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

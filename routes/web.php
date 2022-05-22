<?php

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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
});

//======================================================================
// Routes for authorised users who are not banned - most routes will go here.
//======================================================================

<?php

use App\Http\Controllers\Pages\FaqController;
use App\Http\Controllers\Pages\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('pages.home');
Route::get('/faqs', FaqController::class)->name('pages.faqs');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});

require __DIR__.'/auth.php';

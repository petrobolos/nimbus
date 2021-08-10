<?php

use App\Http\Controllers\Account\BannedController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Pages\DemoController;
use App\Http\Controllers\Pages\FaqController;
use App\Http\Controllers\Pages\FeedController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Resources\AbilityController;
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

Auth::routes();

/*
 * Routes for guests.
 */
Route::middleware(['guest'])->group(function () {
    Route::get('/', HomeController::class)->name('pages.home');
    Route::get('faqs', FaqController::class)->name('pages.faqs');

    Route::prefix('demo')->name('demo.')->group(function () {
        Route::get('', DemoController::class)->name('show');
    });
});

/*
 * Routes for authorised users regardless of ban status.
 */
Route::middleware(['auth'])->group(function () {
    Route::get('feed', FeedController::class)->name('pages.feed');
});

/*
 * Routes for banned authorised users.
 */
Route::middleware(['auth', 'banned'])->group(function () {
    Route::get('banned', BannedController::class)->name('account.banned');
});

/*
 * Routes for unbanned authorised users.
 */
Route::middleware(['auth', 'unbanned'])->group(function () {
    Route::prefix('game')->name('game.')->group(function () {
        Route::get('', '\App\Http\Controllers\GamesController@index')->name('show');
    });
});

/*
 * Routes for administrators.
 */
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::resource('abilities', AbilityController::class);
    });
});

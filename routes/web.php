<?php

use App\Http\Controllers\Account\BannedController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Api\Game\DemoController as ApiDemoController;
use App\Http\Controllers\Pages\DemoController;
use App\Http\Controllers\Pages\FaqController;
use App\Http\Controllers\Pages\FeedController;
use App\Http\Controllers\Pages\HomeController;
use App\Http\Controllers\Resources\AbilityController;
use App\Http\Controllers\Resources\FighterController;
use App\Http\Controllers\Resources\GameController as ResourceGameController;
use App\Http\Controllers\Resources\PerkController;
use App\Http\Controllers\Resources\PlayerController;
use App\Http\Controllers\Resources\RaceController;
use App\Http\Controllers\Resources\StatController;
use Illuminate\Support\Facades\Route;

//======================================================================
// Special Laravel or third-party library routes go here.
//======================================================================
Auth::routes();


//======================================================================
// Routes for guests only - pages and demo routines.
//======================================================================
Route::middleware(['guest'])->group(function () {
    Route::name('pages.')->group(function () {
        Route::get('/', HomeController::class)->name('home');
        Route::get('/faqs', FaqController::class)->name('faqs');
    });

    Route::name('demo.')->group(function () {
        Route::get('/demo', DemoController::class)->name('show');

        Route::name('ajax.')->group(function () {
            Route::put('/demo/sync', [ApiDemoController::class, 'sync'])->name('sync');
            Route::post('/demo/heartbeat', [ApiDemoController::class, 'heartbeat'])->name('heartbeat');
        });
    });
});


//======================================================================
// Routes for authorised users - irrespective of ban status.
//======================================================================
Route::middleware(['auth'])->group(function () {
    Route::name('pages.')->group(function () {
        Route::get('/feed', FeedController::class)->name('feed');
    });
});


//======================================================================
// Routes for authorised users, who have been banned, only.
//======================================================================
Route::middleware(['auth', 'banned'])->group(function () {
    Route::name('account.')->group(function () {
        Route::get('/banned', BannedController::class)->name('banned');
    });
});

//======================================================================
// Routes for administrators only.
//======================================================================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::name('dashboard.')->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('show');
        Route::resource('/dashboard/abilities', AbilityController::class);
        Route::resource('/dashboard/fighters', FighterController::class);
        Route::resource('/dashboard/games', ResourceGameController::class);
        Route::resource('/dashboard/perks', PerkController::class);
        Route::resource('/dashboard/players', PlayerController::class);
        Route::resource('/dashboard/races', RaceController::class);
        Route::resource('/dashboard/stats', StatController::class);
    });
});

//======================================================================
// Routes for authorised users who are not banned - most routes will go here.
//======================================================================
Route::middleware(['auth', 'unbanned'])->group(function () {
    Route::name('game.')->group(function () {
        // Game routes will go here.
    });
});

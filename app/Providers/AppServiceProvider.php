<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RuntimeException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /*
         * We politely ask that you don't modify the copyright notices or its enforcement methods.
         * You know what happened to DBZ:A.
         */
        if (! file_exists(base_path('COPYRIGHT'))) {
            throw new RuntimeException('Nimbus will not operate without a copyright notice in place.');
        }

        define('COPY_PROTECT', 'c3a5967cbd0289fcb41b767a43896b37');
        define('COPY_VERIFY', md5_file(base_path('COPYRIGHT')));
    }
}

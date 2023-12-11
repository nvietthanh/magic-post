<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // register macros
        $macroDirectory = __DIR__ . '/../Macros';
        $filesPath = glob($macroDirectory . '/*.php');

        foreach ($filesPath as $filePath) {
            require_once $filePath;
        }
    }
}

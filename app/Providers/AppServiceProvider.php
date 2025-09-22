<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path() . '/Helpers/__System/Default.php';
        require_once app_path() . '/Helpers/__System/Datatable.php';

        require_once app_path() . '/Helpers/__Main/Default.php';
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $customizations = Cache::remember('customizations', 3600, fn() => DB::table('system_customizations')->first());
            $view->with('customizations', $customizations);
        });
    }
}

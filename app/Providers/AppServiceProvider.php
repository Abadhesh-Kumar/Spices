<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Throwable;

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
        Paginator::useTailwind();

        try {
            if (Schema::hasTable('site_settings')) {
                View::composer('*', function ($view) {
                    $view->with('siteSettings', SiteSetting::current());
                });
            }
        } catch (Throwable) {
            // The settings table may not be available yet during first migrations.
        }
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use App\Services\ArticleService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(ArticleService::class, function ($app) {
            return new ArticleService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::setLocale('fa');


    }
}

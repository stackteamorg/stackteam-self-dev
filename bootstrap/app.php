<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {

            Route::pattern('locale', 'ar|de|en|es|fa|fr|ru'); 

            Route::middleware([SetLocale::class])->group(function () {

                Route::prefix('{locale}')
                    ->group(base_path('routes/taas.php'));

                Route::prefix('{locale}/blog')
                    ->group(base_path('routes/blog.php'));

            });
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

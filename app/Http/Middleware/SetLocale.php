<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale'); // دریافت مقدار locale از URL
        if (!in_array($locale, ['ar', 'de','en','es','fa','fr','ru'])) {
            $locale = config('app.locale'); // مقدار پیش‌فرض
        }
        
        App::setLocale($locale);

        return $next($request);
    }
}

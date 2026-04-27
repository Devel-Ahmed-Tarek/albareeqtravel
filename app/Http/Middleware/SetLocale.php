<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $locale): Response
    {
        $supported = config('app.supported_locales', ['ar', 'en']);
        if (! in_array($locale, $supported, true)) {
            $locale = 'ar';
        }
        App::setLocale($locale);
        if (class_exists(Carbon::class)) {
            Carbon::setLocale($locale);
        }

        return $next($request);
    }
}

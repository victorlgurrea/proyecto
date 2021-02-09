<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (! App::has('locale')) {
           App::setLocale('locale',Config::get('app.locale'));
        }
        App::setLocale(session('locale'));
        return $next($request);
    }
}

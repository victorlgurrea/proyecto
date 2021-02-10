<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Session;

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
 /*       if (! App::has('locale')) {
           App::setLocale('locale',Config::get('app.locale'));
        }
        App::setLocale(session('locale'));
 */

        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        } else {
            session()->put('locale', Config::get('app.locale'));  
        }
        return $next($request);
    }
}

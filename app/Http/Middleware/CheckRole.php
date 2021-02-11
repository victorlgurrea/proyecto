<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->hasRole($role)) {
            //return redirect('home');
            return redirect()->route('home')->with('error',__('no_permissions'));
            // opción 1
            // abort(403, 'No tienes autorización para ingresar.');
        }

        return $next($request);
    }
}

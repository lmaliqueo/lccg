<?php

namespace App\Http\Middleware;

use Closure;

class AccesoUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        if (\Auth::user()->administrador()) {
            return $next($request);
        }
        foreach ($params as $rol) {
            if (\Auth::user()->hasRole($rol)) {
                return $next($request);
            }
        }
        return abort(401);
    }
}

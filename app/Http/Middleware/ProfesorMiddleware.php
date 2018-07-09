<?php

namespace App\Http\Middleware;

use Closure;

class ProfesorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $rol = null)
    {
        $user = \Auth::user();
        if (($rol == 2) && ($user->profesor())) {
            return abort(401);
        }elseif ($user->profesor() || $user->administrador()) {
            return $next($request);
        }
        return abort(401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class JefeUtpMiddleware
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
        if (($rol == 2) && ($user->jefeUtp())) {
            return abort(401);
        }elseif($user->jefeUtp() || $user->administrador()) {
            return $next($request);
        }
        return abort(401);
    }
}

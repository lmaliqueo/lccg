<?php

namespace App\Http\Middleware;

use Closure;

class DirectorMiddleware
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
        if (($rol == 2) && ($user->director())) {
            return abort(401);
        }elseif($user->director() || $user->administrador() || ($rol != null)) {
            return $next($request);
        }
        return abort(401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class InspectorMiddleware
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
        if (($rol == 2) && ($user->inspector())) {
            return abort(401);
        }elseif($user->inspector() || $user->administrador()) {
            return $next($request);
        }
        return abort(401);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\PeriodoAcademico;

class PeriodoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $periodo = PeriodoAcademico::where('pac_estado', 1);
        if ($periodo->count()) {
            return $next($request);
        }else{
            return abort(412);
        }
    }
}

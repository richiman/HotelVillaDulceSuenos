<?php

namespace App\Http\Middleware;

use App\Empleado;
use Closure;

class session
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
        $activacion = \App\Activacion::first();

        if($activacion != null && $activacion->clave == "@P7!C4C!0N"){
            $cookie = $request->cookie('hvdsSession');

            if($cookie == null){
                return redirect(route('login'));
            }
            return $next($request);
        }
        return redirect(route('noActivo'));

    }
}

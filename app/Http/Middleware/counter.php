<?php

namespace App\Http\Middleware;

use App\Visita;
use Closure;
use Illuminate\Support\Facades\Cookie;
class counter
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
        if($request->cookie('visita') != null){
            return $next($request);
        }else{
            $cookie = Cookie::make('visita',true,180);
            Cookie::queue($cookie);
            date_default_timezone_set("America/Mexico_City");
            $hoy = date("Y-m-j");
            $visita = Visita::where('fecha', '=', $hoy)->first();
            if($visita == null){
                $v = new Visita;
                $v->fecha = $hoy;
                $v->count = 1;
                $v->save();
            }else{
                $visita->count = $visita->count+1;
                $visita->save();
            }
            return $next($request);
        }
    }
}

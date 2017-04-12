<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    //public function handle($request, Closure $next, $guard = null) Implementación por defecto, eliminar después
    public function handle($request, Closure $next, ...$guards)
    {
        /*
         * Solucion a que el middleware guest
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('/admin/dashboard');
                }
                break;
            case 'client':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('dashboard.inicio');
                }
                break;
        }
        */
        //Si no se otorga ningun guard, se verficará si hay una sesion iniciada
        // en el guard seleccionado como default
        if (empty($guards)) {
            if (Auth::check()) {
                return redirect('/dashboard/inicio');
            }
        }
        //Se recorre el array $guards para verificar uno a uno si en
        //alguno hay una sesión iniciada, si es así, redirecciona al dashboard principal
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect('/dashboard/inicio');
            }
        }
        /* Implementacion por defecto
         * if (Auth::guard($guard)->check()) {
            return redirect('/dashboard/inicio');
        }*/

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAuthenticated
{
    /**
     * Maneja una solicitud entrante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Comprobación de depuración
        // dd('Estás entrando al middleware');

        // Verifica si el usuario está autenticado
        if (!Auth::check()) {
            // Redirecciona a la ruta de login si el usuario no está autenticado
            return redirect()->route('login');
        }

        // Si el usuario está autenticado, continúa con la solicitud
        return $next($request);
    }
}

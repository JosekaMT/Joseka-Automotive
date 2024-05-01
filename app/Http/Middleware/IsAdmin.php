<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        // Verifica si el usuario autenticado es administrador
        if (Auth::user() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Si no es administrador, redireccionar o dar un error
        abort(403, 'Unauthorized access.');
    }
}

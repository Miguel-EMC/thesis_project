<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUserActive
{

    // validar si el usuario se encuentra activo
    public function handle(Request $request, Closure $next)
    {
        // Se obtiene la ruta que gestiona la petición
        $user = $request->route('user');
        // Si el usuario no esta activo
        if (!$user->state)
        {
            return abort(403, 'This action is unauthorized.');
        }
        // Si el usuario esta activo pasa a realizar las siguientes acciones
        return $next($request);
    }
}

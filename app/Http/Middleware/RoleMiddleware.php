<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $userRol = session('usuario_rol');

        if (!$userRol || !in_array($userRol, $roles)) {
            return redirect('/login')->with('error', 'Acceso denegado.');
        }

        return $next($request);
    }
}

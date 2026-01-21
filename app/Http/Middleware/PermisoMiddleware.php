<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PermisoMiddleware
{
    /**
     * Handle an incoming request.
     * Valida que el usuario tenga los permisos especificados
     *
     * Uso en rutas:
     * Route::get('/ruta', [Controller::class, 'metodo'])->middleware('permiso:ver_cursos');
     * Route::get('/ruta', [Controller::class, 'metodo'])->middleware('permiso:ver_cursos,crear_curso');
     */
    public function handle(Request $request, Closure $next, ...$permisos)
    {
        // Obtener los permisos del usuario desde la sesión
        $usuarioPermisos = session('usuario_permisos', []);

        // Verificar que el usuario tenga al menos uno de los permisos requeridos
        foreach ($permisos as $permiso) {
            if (in_array($permiso, $usuarioPermisos)) {
                return $next($request);
            }
        }

        // Si no tiene permiso, redirigir al login con mensaje de error
        return redirect('/login')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}

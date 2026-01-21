<?php

namespace App\Helpers;

class PermisoHelper
{
    /**
     * Verifica si el usuario actual tiene un permiso específico
     *
     * @param string $nombrePermiso El nombre del permiso a verificar
     * @return bool True si el usuario tiene el permiso, false en caso contrario
     */
    public static function tiene($nombrePermiso)
    {
        $permisos = session('usuario_permisos', []);
        return in_array($nombrePermiso, $permisos);
    }

    /**
     * Verifica si el usuario tiene ANY de los permisos indicados
     *
     * @param array $permisos Array de nombres de permisos
     * @return bool True si tiene al menos uno de los permisos
     */
    public static function tieneAlguno($permisos)
    {
        $usuarioPermisos = session('usuario_permisos', []);

        foreach ($permisos as $permiso) {
            if (in_array($permiso, $usuarioPermisos)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verifica si el usuario tiene TODOS los permisos indicados
     *
     * @param array $permisos Array de nombres de permisos
     * @return bool True si tiene todos los permisos
     */
    public static function tieneTodos($permisos)
    {
        $usuarioPermisos = session('usuario_permisos', []);

        foreach ($permisos as $permiso) {
            if (!in_array($permiso, $usuarioPermisos)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Retorna todos los permisos del usuario actual
     *
     * @return array Array de nombres de permisos
     */
    public static function todos()
    {
        return session('usuario_permisos', []);
    }
}

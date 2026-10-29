<?php

namespace App\Support;

class ProyectoGradoAccess
{
    public static function canManageSchedule(): bool
    {
        return (string) session('usuario_id') === '8'
            || (string) session('profesor_id') === '1';
    }
}

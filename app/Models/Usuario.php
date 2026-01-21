<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';

    protected $fillable = [
        'username',
        'email',
        'password',
        'estado',
        'idRol',
        'id_profesor'
    ];

    // Un usuario pertenece a un rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idRol');
    }

    // Un usuario puede ser profesor
    public function profesor()
    {
        return $this->hasOne(Profesor::class, 'idUsuario');
    }

    // Verificar si el usuario tiene un permiso específico
    public function tienePermiso($nombrePermiso)
    {
        $rol = $this->rol()->first();
        if (!$rol) {
            return false;
        }

        return $rol->permisos()
            ->where('nombrePermiso', $nombrePermiso)
            ->exists();
    }

    // Obtener todos los permisos del usuario
    public function permisos()
    {
        $rol = $this->rol()->first();
        if (!$rol) {
            return collect([]);
        }

        return $rol->permisos();
    }


}

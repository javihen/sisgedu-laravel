<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'username',
        'email',
        'password',
        'estado',
        'idrol',
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
}

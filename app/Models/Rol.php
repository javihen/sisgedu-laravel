<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //use HasFactory;

    protected $table = 'roles';

    protected $fillable = ['nombreRol'];

    // Un rol tiene muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'idRol');
    }

    // Un rol tiene muchos permisos (relación muchos a muchos)
    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'rolPermiso', 'idRol', 'idPermiso');
    }
}

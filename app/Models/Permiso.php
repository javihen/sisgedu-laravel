<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    //use HasFactory;

    protected $table = 'permisos';

    protected $fillable = ['nombrePermiso'];

    // Muchos permisos pueden pertenecer a muchos roles
    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'idPermiso', 'idRol');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    protected $primaryKey = 'id_estudiante';
    protected $keyType = 'string';
    // La clave primaria no es autoincremental
    public $incrementing = false;
    protected $fillable = [
        'id_estudiante',
        'estado',
        'rude',
        'ci',
        'nombres',
        'appaterno',
        'apmaterno',
        'genero',
        'fecha_nacimiento',
        'observacion',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $fillable = [
        'id',
        'nombre_curso',
        'turno',
        'nivel',
        'grado',
        'paralelo',
    ];
}

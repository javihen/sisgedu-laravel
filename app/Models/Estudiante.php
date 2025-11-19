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

    //esta funcion nos recupera todas las inscripciones de un estudiante
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_estudiante', 'id_estudiante');
    }


    public function getIdCursoAttribute()
    {
        return $this->inscripciones()->first()?->id_curso;
    }
}

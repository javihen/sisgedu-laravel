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

    // esta funcion nos recupera todas las inscripciones de un estudiante
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_estudiante', 'id_estudiante');
    }

    public function getIdCursoAttribute()
    {
        return $this->inscripciones()->first()?->id_curso;
    }

    public function asistencias()
    {
        return $this->hasMany(DetalleAsistencia::class, 'idEstudiante');
    }

    /**
     * Relación: un estudiante tiene muchas citaciones
     */
    public function citaciones()
    {
        return $this->hasMany(Citacion::class, 'idEstudiante', 'id_estudiante');
    }

    public function detalleCitaciones()
    {
        return $this->hasMany(detalleCitacion::class, 'id_estudiante', 'id_estudiante');
    }

    public function proyectoGrado()
    {
        return $this->hasOne(ProyectoGrado::class, 'idEstudiante', 'id_estudiante');
    }

    public function proyectoEstudiantes()
    {
        return $this->hasMany(
            ProyectoEstudiante::class,
            'id_estudiante',
            'id_estudiante'
        );
    }
    public function nombreCapitalizado($nombre)
    {
        return ucwords(strtolower(trim($nombre)));
    }
    function obtenerIniciales($nombre)
    {
        $palabras = explode(' ', trim($nombre));
        $iniciales = '';

        foreach ($palabras as $palabra) {
            if ($palabra != '') {
                $iniciales .= strtoupper(substr($palabra, 0, 1));
            }
        }

        return $iniciales;
    }
}

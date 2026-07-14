<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';

    protected $primaryKey = 'id_profesor';

    protected $fillable = [
        'ci',
        'rda',
        'nombres',
        'appaterno',
        'apmaterno',
        'genero',
        'fechaNac',
        'fuenteFinan',
        'nivelFormacion',
        'estado',
        'observacion',
    ];

    // un profesor puede tener muchas asignaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'id_profesor', 'id_profesor');
    }

    // un profesor puede tener muchas asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'idProfesor', 'id_profesor');
    }

    // Relación: un profesor tiene muchas citaciones
    public function citaciones()
    {
        return $this->hasMany(Citacion::class, 'idProfesor', 'id_profesor');
    }

    // un profesor puede tener muchos asesorias de cursos
    public function asesoresCursos()
    {
        return $this->hasMany(AsesoresCursos::class, 'id_profesor', 'id_profesor');
    }
}

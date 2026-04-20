<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citacion extends Model
{
    protected $table = 'citaciones';
    protected $primaryKey = 'idCitacion';
    protected $fillable = [
    'idEstudiante',
    'idCurso',
    'idProfesor',
    'idMateria',
    'idGestion',
    'fecha',
    'hora',
    'motivo',
    'periodo',
    'tipo'
];
    protected $casts = [
        'fecha' => 'date',
    ];
    public $timestamps = true;

    /**
     * Relación: una citación pertenece a un estudiante
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id_estudiante');
    }

    /**
     * Relación: una citación pertenece a un curso
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'id');
    }

    /**
     * Relación: una citación pertenece a un profesor
     */
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'idProfesor', 'id_profesor');
    }

    /**
     * Relación: una citación pertenece a una materia
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'idMateria', 'id_materia');
    }

    /**
     * Relación: una citación pertenece a una gestión
     */
    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'idGestion', 'id_gestion');
    }
}

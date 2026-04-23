<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entrevista extends Model
{
    protected $primaryKey = 'idEntrevista';
    public $timestamps = true;

    protected $fillable = [
        'idEstudiante',
        'idProfesor',
        'fecha',
        'hora',
        'observaciones',
        'acuerdos',
        'asistio',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'time',
        'asistio' => 'boolean',
    ];

    /**
     * Relación: Entrevista pertenece a un Estudiante
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id_estudiante');
    }

    /**
     * Relación: Entrevista pertenece a un Profesor
     */
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'idProfesor', 'id_profesor');
    }

    /**
     * Relación: Entrevista tiene muchos Compromisos
     */
    public function compromisos()
    {
        return $this->hasMany(Compromiso::class, 'idEntrevista', 'idEntrevista');
    }
}

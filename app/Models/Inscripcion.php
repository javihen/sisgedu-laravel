<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    protected $primaryKey = 'id_inscripcion';
    protected $fillable = ['id_estudiante', 'id_curso', 'gestion'];

    /**
     * Relación: una inscripción pertenece a un estudiante
     */
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_estudiante');
    }

    /**
     * Relación: una inscripción pertenece a un curso
     */
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso', 'id');
    }
}

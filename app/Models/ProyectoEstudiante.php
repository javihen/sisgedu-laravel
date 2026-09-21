<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoEstudiante extends Model
{
    protected $table = 'proyecto_estudiantes';

    protected $primaryKey = 'idproyecto_estudiantes';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'idProyecto',
        'id_estudiante',
    ];

    // Relación con ProyectoGrado
    public function proyectoGrado()
    {
        return $this->belongsTo(
            ProyectoGrado::class,
            'idProyecto',
            'idProyecto'
        );
    }

    // Relación con Estudiante
    public function estudiante()
    {
        return $this->belongsTo(
            Estudiante::class,
            'id_estudiante',
            'id_estudiante'
        );
    }
}

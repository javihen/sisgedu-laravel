<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoGradoAsistencias extends Model
{
    protected $table = 'proyecto_grado_asistencias';

    protected $primaryKey = 'id_asistencia';

    protected $fillable = [
        'id_sesion',
        'id_estudiante',
        'estado_asistencia',
        'hora_llegada',
        'entregable',
        'observaciones',
        'entregable_presentado',
        'validado',
    ];

    protected $casts = [
        'entregable_presentado' => 'boolean',
        'validado' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Sesión
    |--------------------------------------------------------------------------
    */

    public function sesion()
    {
        return $this->belongsTo(
            ProyectoGradoSesion::class,
            'id_sesion',
            'id_sesion'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Estudiante dentro del proyecto
    |--------------------------------------------------------------------------
    */

    public function proyectoEstudiante()
    {
        return $this->belongsTo(
            ProyectoEstudiante::class,
            'id_estudiante',
            'id_estudiante'
        );
    }
}

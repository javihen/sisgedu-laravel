<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleAsistencia extends Model
{
    protected $table = 'detalle_asistencias';
    protected $primaryKey = 'idDetalle';

    protected $fillable = [
        'idAsistencia',
        'idEstudiante',
        'estado',
        'observacion'
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'idAsistencia', 'idAsistencia');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id_estudiante');
    }
}

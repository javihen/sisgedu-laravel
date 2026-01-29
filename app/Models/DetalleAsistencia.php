<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleAsistencia extends Model
{
    //
    protected $primaryKey = 'idDetalle';

    protected $fillable = [
        'idAsistencia',
        'idEstudiante',
        'estado',
        'observacion'
    ];

    public function asistencia()
    {
        return $this->belongsTo(Asistencia::class, 'idAsistencia');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }
}

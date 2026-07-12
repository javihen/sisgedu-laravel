<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class detalleCitacion extends Model
{
    protected $table = 'detalle_citaciones';

    protected $primaryKey = 'idDetalleCitacion';

    protected $fillable = [
        'estado',
        'observacion',
        'id_estudiante',
        'idCitacionV2',
    ];

    // un estudiante puede tener muchas citaciones, pero una citacion pertenece a un estudiante
    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_estudiante');
    }

    // una citacion puede tener muchos detalles de citacion, pero un detalle de citacion pertenece a una citacion
    public function citacionV2()
    {
        return $this->belongsTo(CitacionV2::class, 'idCitacionV2', 'idCitacionV2');
    }
}

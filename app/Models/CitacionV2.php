<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CitacionV2 extends Model
{
    protected $table = 'citacion_v2_s';
    protected $primaryKey = 'idCitacionV2';
    protected $fillable = [
        'idAsignacion',
        'fecha',
        'hora',
        'estado',
        'motivo',
        'observacion',
    ];
    //"Una citación pertenece a una asignación."
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'idAsignacion', 'idAsignacion');
    }
}

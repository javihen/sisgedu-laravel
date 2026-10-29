<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoGradoSorteoDetalle extends Model
{
    protected $table = 'proyecto_grado_sorteo_detalles';

    protected $primaryKey = 'idDetalle';

    protected $fillable = [
        'idSorteo',
        'idProyecto',
        'numeroMesa',
        'orden',
        'fechaDefensa',
        'horaInicio',
        'horaFin',
    ];

    protected $casts = [
        'fechaDefensa' => 'date',
        'numeroMesa' => 'integer',
        'orden' => 'integer',
    ];

    public function sorteo()
    {
        return $this->belongsTo(ProyectoGradoSorteo::class, 'idSorteo', 'idSorteo');
    }

    public function proyecto()
    {
        return $this->belongsTo(ProyectoGrado::class, 'idProyecto', 'idProyecto');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromedioHistoricoBth extends Model
{
    protected $table = 'promedios_historicos_bth';

    protected $fillable = [
        'id_estudiante',
        'id_materia',
        'anio',
        'promedio',
    ];

    protected $casts = [
        'id_materia' => 'integer',
        'anio' => 'integer',
        'promedio' => 'decimal:2',
    ];
}

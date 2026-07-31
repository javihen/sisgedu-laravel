<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoDefensa extends Model
{
    protected $table = 'proyecto_defensas';

    protected $primaryKey = 'idDefensa';

    protected $fillable = [

        'idProyecto',
        'fecha',
        'hora',
        'aula',
        'estado',
        'observacion',

    ];

    protected $casts = [

        'fecha' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function proyecto()
    {
        return $this->belongsTo(ProyectoGrado::class, 'idProyecto', 'idProyecto');
    }
}

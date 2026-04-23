<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compromiso extends Model
{
    protected $primaryKey = 'idCompromiso';
    public $timestamps = true;

    protected $fillable = [
        'idEntrevista',
        'descripcion',
        'responsable',
        'fechaLimite',
        'estado',
        'fechaCumplimiento',
    ];

    protected $casts = [
        'fechaLimite' => 'date',
        'fechaCumplimiento' => 'date',
    ];

    /**
     * Relación: Compromiso pertenece a una Entrevista
     */
    public function entrevista()
    {
        return $this->belongsTo(Entrevista::class, 'idEntrevista', 'idEntrevista');
    }
}

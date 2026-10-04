<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoSeguimiento extends Model
{
    protected $table = 'proyecto_seguimientos';

    protected $primaryKey = 'idSeguimiento';

    protected $fillable = [
        'idProyecto',
        'fecha',
        'titulo',
        'descripcion',
        'porcentaje',
        'observacion',
    ];

    protected $casts = [
        'fecha' => 'date',
        'porcentaje' => 'integer',
    ];

    public function proyecto()
    {
        return $this->belongsTo(ProyectoGrado::class, 'idProyecto', 'idProyecto');
    }
}

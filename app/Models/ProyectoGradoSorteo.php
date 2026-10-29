<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoGradoSorteo extends Model
{
    protected $table = 'proyecto_grado_sorteos';

    protected $primaryKey = 'idSorteo';

    protected $fillable = [
        'idGestion',
        'fechaSorteo',
        'numeroMesas',
        'estado',
        'idUsuario',
    ];

    protected $casts = [
        'fechaSorteo' => 'datetime',
        'numeroMesas' => 'integer',
    ];

    public function detalles()
    {
        return $this->hasMany(ProyectoGradoSorteoDetalle::class, 'idSorteo', 'idSorteo');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'idGestion', 'id_gestion');
    }
}

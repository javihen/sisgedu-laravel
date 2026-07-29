<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionSistema extends Model
{
    protected $table = 'configuracion_sistema';

    protected $fillable = [

        'fecha_inicio',

        'fecha_cierre',

        'estado',

    ];
}

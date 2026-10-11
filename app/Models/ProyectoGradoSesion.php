<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoGradoSesion extends Model
{
    protected $table = 'proyecto_grado_sesiones';

    protected $primaryKey = 'id_sesion';

    protected $fillable = [
        'idProyecto',
        'idGestion',
        'numero_sesion',
        'fecha_programada',
        'hora_inicio',
        'hora_fin',
        'tipo_sesion',
        'tema',
        'observaciones',
        'estado',
    ];

    protected $casts = [
        'fecha_programada' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Asistencias de la sesión
    |--------------------------------------------------------------------------
    */

    public function asistencias()
    {
        return $this->hasMany(ProyectoGradoAsistencias::class, 'id_sesion', 'id_sesion');
    }

    public function proyecto()
    {
        return $this->belongsTo(ProyectoGrado::class, 'idProyecto', 'idProyecto');
    }
}

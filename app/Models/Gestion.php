<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    protected $table = 'gestiones';

    protected $primaryKey = 'id_gestion';

    protected $fillable = [
        'anio',
        'fechaI',
        'fechaF',
        'estado',
    ];

    // una gestión tiene muchas asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'id_gestion', 'id_gestion');
    }

    // una gestión tiene muchas citaciones
    public function citaciones()
    {
        return $this->hasMany(Citacion::class, 'idGestion', 'id_gestion');
    }

    // una gestión tiene muchos asesores de cursos
    public function asesoresCursos()
    {
        return $this->hasMany(AsesoresCursos::class, 'id_gestion', 'id_gestion');
    }
}

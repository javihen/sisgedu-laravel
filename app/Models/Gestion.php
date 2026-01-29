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

    public function asistencias()
{
    return $this->hasMany(Asistencia::class, 'id_gestion', 'id_gestion');
}

}

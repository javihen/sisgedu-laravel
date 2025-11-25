<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    protected $table = 'profesores';
    protected $primaryKey = 'id_profesor';
    protected $fillable = [
        'ci',
        'rda',
        'nombres',
        'appaterno',
        'apmaterno',
        'genero',
        'fechaNac',
        'fuenteFinan',
        'nivelFormacion',
        'estado',
        'observacion',
    ];
}

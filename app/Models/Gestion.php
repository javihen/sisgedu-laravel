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
}

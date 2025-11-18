<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $primaryKey = 'id_inscripcion';
    protected $fillable = ['id_inscripcion', 'id_estudiante', 'id_curso', 'gestion'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';
    protected $primaryKey = 'id_materia';
    protected $fillable = [
        'id_materia',
        'nivel',
        'campo',
        'area',
        'abreviatura',
        'orden',
    ];
    public function asignaciones()
    {
        /* Una materia tiene muchas (hasMany) asignaciones */
        return $this->hasMany(Asignacion::class, 'id_materia', 'id_materia');
    }
}

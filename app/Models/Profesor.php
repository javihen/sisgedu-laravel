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
    public function asignaciones()
    {
        /* un profesor tiene varias (hasMany) asignaciones */
        return $this->hasMany(Asignacion::class, 'id_profesor', 'id_profesor');
    }

    public function asistencias()
{
    return $this->hasMany(Asistencia::class, 'idProfesor', 'id_profesor');
}

}

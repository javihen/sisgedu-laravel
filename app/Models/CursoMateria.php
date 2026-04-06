<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CursoMateria extends Model
{
    protected $table = 'curso_materia';
    protected $primaryKey = 'idCursoMateria';

    protected $fillable = [
        'idCurso',
        'idMateria',
        'idGestion',
        'horas_mes'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'idMateria');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'idGestion');
    }

    public function exclusiones()
    {
        return $this->hasMany(EstudianteMateria::class, 'idCursoMateria');
    }
}

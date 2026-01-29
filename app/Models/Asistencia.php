<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'asistencias';
    protected $primaryKey = 'idAsistencia';

    protected $fillable = [
        'fecha',
        'hora',
        'descripcion',
        'idProfesor',
        'idMateria',
        'idCurso',
        'id_gestion'
    ];

    // Relaciones
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'idProfesor', 'id_profesor');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'idMateria', 'id_materia');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'id');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'id_gestion', 'id_gestion');
    }

    public function detalles()
{
    return $this->hasMany(DetalleAsistencia::class, 'idAsistencia');
}

}

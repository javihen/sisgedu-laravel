<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    protected $table = 'asignaciones';
    protected $primaryKey = 'idAsignacion';

    protected $fillable = [
        'id_materia',
        'idcurso',
        'id_profesor',
        'id_gestion'
    ];

    // 🔗 RELACIONES

    public function materia()
    {
        /* Varias asignaciones pertenece a (belongs to) una materia */
        return $this->belongsTo(Materia::class, 'id_materia', 'id_materia');
    }

    public function curso()
    {
        /* Varias asignaciones pertenece a (belongs to) un curso */
        return $this->belongsTo(Curso::class, 'idcurso', 'id');
    }

    public function profesor()
    {
        /* Varias asignaciones pertenece a (belongs to) un profesor */
        return $this->belongsTo(Profesor::class, 'id_profesor', 'id_profesor');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AsesoresCursos extends Model
{
    protected $table = 'asesores_cursos';

    protected $primaryKey = 'idAsesorCurso';

    protected $fillable = [
        'estado',
        'observaciones',
        'id_profesor',
        'id',
        'id_gestion',
    ];

    // un asesor puede tener muchos cursos
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'id_profesor', 'id_profesor');
    }

    // un curso puede tener muchos asesores
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id', 'id');
    }

    // una gestion puede tener muchos asesores
    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'id_gestion', 'id_gestion');
    }
}

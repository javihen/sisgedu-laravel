<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoGrado extends Model
{
    protected $table = 'proyectos_grado';

    protected $primaryKey = 'idProyecto';

    protected $fillable = [

        'idEstudiante',
        'idProfesorTutor',
        'idCurso',
        'idGestion',
        'titulo',
        'lineaInvestigacion',
        'descripcion',
        'estado',
        'fechaInicio',
        'fechaDefensa',
        'notaFinal',
        'observacion',

    ];

    protected $casts = [

        'fechaInicio' => 'date',
        'fechaDefensa' => 'date',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idEstudiante', 'id_estudiante');
    }

    public function tutor()
    {
        return $this->belongsTo(Profesor::class, 'idProfesorTutor', 'id_profesor');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'idCurso', 'id');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'idGestion', 'id_gestion');
    }

    public function tribunales()
    {
        return $this->hasMany(ProyectoTribunal::class, 'idProyecto', 'idProyecto');
    }

    public function defensa()
    {
        return $this->hasOne(ProyectoDefensa::class, 'idProyecto', 'idProyecto');
    }
}

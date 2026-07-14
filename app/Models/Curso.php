<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    // Indica a Eloquent que la clave primaria es string
    protected $keyType = 'string';

    // La clave primaria no es autoincremental
    public $incrementing = false;

    protected $fillable = [
        'id',
        'nombre_curso',
        'turno',
        'nivel',
        'grado',
        'paralelo',
    ];

    /**
     * Accessor que devuelve un nombre legible formateado del curso.
     * Ejemplo: "1º PRIMARIA A"
     */
    public function getDisplayNameAttribute()
    {
        // Mapear nivel numérico a texto
        $nivelMap = [
            0 => 'INICIAL',
            1 => 'PRIMARIA',
            2 => 'SECUNDARIA',
        ];

        $grado = $this->grado;
        $paralelo = $this->paralelo;
        $nivelText = $nivelMap[$this->nivel] ?? 'NIVEL '.$this->nivel;

        // Formatear grado como ordinal (1 -> 1º)
        $ordinal = is_numeric($grado) ? $grado.'o' : $grado;

        $parts = array_filter([$ordinal, $nivelText, $paralelo]);

        return implode(' ', $parts);
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'id_curso');
    }

    // un curso tiene muchas citaciones
    public function citaciones()
    {
        return $this->hasMany(Citacion::class, 'idCurso', 'id');
    }

    // un curso puede tener muchas asignaciones
    public function asignaciones()
    {
        /* Un curso tiene muchas (hasMany) asignaciones */
        return $this->hasMany(Asignacion::class, 'idcurso', 'id');
    }

    // un curso puede tener muchas asistencias
    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'idCurso', 'id');
    }

    // un curso puede tener muchas materias
    public function materiasPlan()
    {
        return $this->hasMany(CursoMateria::class, 'idCurso');
    }

    // un curso puede tener muchos asesores
    public function asesores()
    {
        return $this->hasMany(AsesoresCursos::class, 'id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $table = 'notas';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'calificacion',
        'periodo',
        'id_estudiante',
        'idAsignacion',
        'id_gestion',
    ];

    protected $casts = [
        'calificacion' => 'decimal:2',
        'periodo' => 'integer',
        'idAsignacion' => 'integer',
        'id_gestion' => 'integer',
    ];

    // 🔗 RELACIONES

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'id_estudiante', 'id_estudiante');
    }

    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'idAsignacion', 'idAsignacion');
    }

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'id_gestion', 'id_gestion');
    }
}

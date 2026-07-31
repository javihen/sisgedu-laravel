<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectoTribunal extends Model
{
    protected $table = 'proyecto_tribunales';

    protected $primaryKey = 'idTribunal';

    protected $fillable = [

        'idProyecto',
        'idProfesor',
        'cargo',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relaciones
    |--------------------------------------------------------------------------
    */

    public function proyecto()
    {
        return $this->belongsTo(ProyectoGrado::class, 'idProyecto', 'idProyecto');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'idProfesor', 'id_profesor');
    }
}

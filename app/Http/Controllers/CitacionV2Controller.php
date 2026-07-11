<?php

namespace App\Http\Controllers;

use App\Models\CitacionV2;
use App\Models\Gestion;
use App\Models\Asignacion;
use Illuminate\Http\Request;

class CitacionV2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener la gestión activa
        //$gestionActiva = Gestion::where('estado', 'A')->first();
        $id = session('profesor_id'); // Obtener el ID del profesor autenticado
        $asignaciones = Asignacion::select('asignaciones.*')
            ->join('cursos', 'cursos.id', '=', 'asignaciones.idcurso')
            ->join('materias', 'materias.id_materia', '=', 'asignaciones.id_materia') // opcional
            ->where('asignaciones.id_profesor', $id)
            ->where('id_gestion', session('gestion_activa'))
            ->where('cursos.nivel', '2')
            ->orderBy('cursos.nivel', 'asc')
            ->orderBy('cursos.grado', 'asc')
            ->orderBy('cursos.paralelo', 'asc')
            ->with(['curso', 'materia']) // si quieres los modelos relacionados además
            ->get();

        //return view('curso.curso-profesor', compact('asignaciones'));
        return view('citacion.listas', compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CitacionV2 $citacionV2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitacionV2 $citacionV2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CitacionV2 $citacionV2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitacionV2 $citacionV2)
    {
        //
    }
}

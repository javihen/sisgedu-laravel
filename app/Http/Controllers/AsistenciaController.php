<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::with(['profesor', 'materia', 'curso', 'gestion'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('asistencias.index', compact('asistencias'));
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
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'idProfesor' => 'required',
            'idMateria' => 'required',
            'idCurso' => 'required',
            'id_gestion' => 'required',
        ]);

        Asistencia::create($request->all());

        return redirect()->back()->with('success', 'Asistencia registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cursos = curso::all();                  /* Obtiene todas las tuplas de la tabla Cursos de la BD */
        return view('curso.index');              /* Retorna el frontend de curso */
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
        /* Validamos las entradas del formulario puesto que deben de estar completas */
        $request->validate([
            'nombre_curso' => 'required',
            'turno' => 'required',
            'nivel' => 'required|integer',
            'grado' => 'required',
            'paralelo' => 'required',
        ]);
        /* Subimos los datos a la tabla Curso usando el modelo Curso */
        Curso::create($request->all());
        //return redirect()->route('curso.index')->with('success', 'Post created successfully.');
        return redirect()->route('curso.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

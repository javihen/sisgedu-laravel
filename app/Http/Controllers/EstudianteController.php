<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los estudiantes ordenados ascendentemente por 'nombres'
        $estudiantes = Estudiante::orderBy('appaterno', 'asc')->get();

        return view('estudiante.index', compact('estudiantes'));
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
        //dd($request->all());
        try {
            //si existen datos $request->curso lo insertaremos en la tabla de inscripciones

            // Normalizar y convertir a mayúsculas los campos de texto
            $toUpper = fn($v) => $v === null ? null : mb_strtoupper(trim($v), 'UTF-8');

            Estudiante::create([
                'id_estudiante' => $toUpper($request->codigo),
                'estado' => $toUpper($request->estado),
                'rude' => $toUpper($request->rude),
                'ci' => $toUpper($request->ci),
                'nombres' => $toUpper($request->nombres),
                'appaterno' => $toUpper($request->appaterno),
                'apmaterno' => $toUpper($request->apmaterno),
                'genero' => $toUpper($request->genero),
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'observacion' => $toUpper($request->observacion),
            ]);
            return redirect()->route('estudiante.index')->with('success', 'El estudiante se registro satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al registrar el estudiante.' . $e->getMessage());
        }
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

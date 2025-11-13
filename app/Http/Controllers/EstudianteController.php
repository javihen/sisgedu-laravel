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
        //
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
            'rude' => 'required',
            'ci' => 'required',
            'nombres' => 'required',
            'genero' => 'required',
            'fecha_nacimiento' => 'required',
        ]);
        try {
            Estudiante::create([
                'id_estudiante' => 'E' . $request->nivel . '' . $request->grado . '' . $request->paralelo,
                'rude' => $request->rude,
                'ci' => $request->ci,
                'nombres' => $request->nombres,
                'appaterno' => $request->appaterno,
                'apmaterno' => $request->apmaterno,
                'genero' => $request->genero,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'observacion' => $request->observacion,
            ]);
            return redirect()->route('estudiante.index')->with('success', 'El estudiante se registro satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index');
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

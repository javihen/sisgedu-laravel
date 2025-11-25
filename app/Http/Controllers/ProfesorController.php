<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('profesor.index');
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
        try {

        $request->validate([
            'ci' => 'required',
            'rda' => 'required',
            'nombres' => 'required|string|max:255',
            'genero' => 'required|in:M,F',
            'nivelFormacion' => 'required|string|max:255',
        ]);

        Profesor::create([
            'ci' => $request->ci,
            'rda' => $request->rda,
            'nombres' => $request->nombres,
            'appaterno' => $request->appaterno,
            'apmaterno' => $request->apmaterno,
            'genero' => $request->genero,
            'fechaNac' => $request->fechaNac,
            'fuenteFinan' => $request->fuenteFinan,
            'nivelFormacion' => $request->nivelFormacion,
            'observacion' => $request->observacion,
        ]);
        return redirect()->route('profesor.index')->with('success', 'Profesor creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('profesor.index')->with('error', 'Error al crear el profesor: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profesor $profesor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profesor $profesor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profesor $profesor)
    {
        //
    }
}

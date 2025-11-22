<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inicial = Materia::where('nivel', 0)   // FILTRA SOLO NIVEL 0
            ->orderBy('orden', 'asc')                  // ORDENA POR "orden" ASCENDENTE
            ->get();
        $primaria = Materia::where('nivel', 1)   // FILTRA SOLO NIVEL 0
            ->orderBy('orden', 'asc')                  // ORDENA POR "orden" ASCENDENTE
            ->get();
        $secundaria = Materia::where('nivel', 2)   // FILTRA SOLO NIVEL 0
            ->orderBy('orden', 'asc')                  // ORDENA POR "orden" ASCENDENTE
            ->get();

        return view('materia.index', compact('inicial', 'primaria', 'secundaria'));


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
        $request->validate([
            'id_materia' => 'required|unique:materias,id_materia',
            'nivel' => 'required',
            'campo' => 'required',
            'area' => 'required',
            'abreviatura' => 'required',
            'orden' => 'required|integer',
        ]);
        try {

        Materia::create([
            'id_materia' => $request->id_materia,
            'nivel' => $request->nivel,
            'campo' => $request->campo,
            'area' => $request->area,
            'abreviatura' => $request->abreviatura,
            'orden' => $request->orden,
        ]);

        return redirect()->route('materia.index')->with('success', 'Materia creada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->route('materia.index')->with('error', 'Error al crear la materia: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materia $materia)
    {
        //
    }
}

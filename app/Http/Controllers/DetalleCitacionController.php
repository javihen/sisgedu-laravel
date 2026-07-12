<?php

namespace App\Http\Controllers;

use App\Models\detalleCitacion;
use Illuminate\Http\Request;

class DetalleCitacionController extends Controller
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
        // crear un nuevo detalle de citación
        $detalleCitacion = new detalleCitacion;
        $detalleCitacion->estado = $request->estado;
        $detalleCitacion->observacion = $request->observacion;
        $detalleCitacion->id_estudiante = $request->id_estudiante;
        $detalleCitacion->idCitacionV2 = $request->idCitacionV2;
        $detalleCitacion->save();

        return response()->json(['message' => 'Detalle de citación creado exitosamente', 'detalleCitacion' => $detalleCitacion], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(detalleCitacion $detalleCitacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalleCitacion $detalleCitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detalleCitacion $detalleCitacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(detalleCitacion $detalleCitacion)
    {
        //
    }
}

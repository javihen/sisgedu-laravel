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
        $profesores = Profesor::orderBy('appaterno','asc')->get();

        return view('profesor.index', compact('profesores'));
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
            $toUpper = fn($v) => $v === null ? null : mb_strtoupper(trim($v), 'UTF-8');

        Profesor::create([
            'ci' => $request->ci,
            'rda' => $request->rda,
            'nombres' =>$toUpper($request->nombres),
            'appaterno' => $toUpper($request->appaterno),
            'apmaterno' => $toUpper($request->apmaterno),
            'genero' => $request->genero,
            'fechaNac' => $request->fechaNac,
            'fuenteFinan' => $request->fuenteFinan,
            'nivelFormacion' => $toUpper($request->nivelFormacion),
            'observacion' => $toUpper($request->observacion),
        ]);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'Profesor creado exitosamente.'
        ]);
        return redirect()->route('profesor.index')->with('success', 'Profesor creado exitosamente.');

        } catch (\Exception $e) {
            session()->flash('swal', [
            'icon' => 'error',
            'title' => 'Que mal!',
            'text' => 'Error al crear el profesor.'
        ]);
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
    public function destroy($profesor)
    {
        try{
            $prof = Profesor::findOrFail($profesor);
            $prof->delete();
            session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Genial!!',
            'text' => 'Profesor eliminado exitosamente.'
        ]);
            return redirect()->route('profesor.index')->with('success', 'Profesor eliminado exitosamente.');
        } catch (\Exception $e) {
            session()->flash('swal', [
            'icon' => 'error',
            'title' => 'Que mal!',
            'text' => 'Error al borrar el profesor.'
        ]);
            return redirect()->route('profesor.index')->with('error', 'Error al eliminar el profesor: ' . $e->getMessage());
        }
    }

    public function perfil($id)
    {
        $profesor = Profesor::findOrFail($id);
        return view('profesor.perfil', compact('profesor'));
    }
}

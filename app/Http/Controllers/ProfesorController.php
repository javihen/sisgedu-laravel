<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\Asignacion;
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
    public function update(Request $request, string $id)
    {
        try{
            $profesor = Profesor::where('id_profesor', $id)->first();
            if (!$profesor) {
                return redirect()->route('profesor.index')->with('error', 'Profesor no encontrado.');
            }

            $profesor->update([
                'ci' => $request->ci,
                'rda' => $request->rda,
                'nombres' => mb_strtoupper(trim($request->nombres), 'UTF-8'),
                'appaterno' => mb_strtoupper(trim($request->appaterno), 'UTF-8'),
                'apmaterno' => mb_strtoupper(trim($request->apmaterno), 'UTF-8'),
                'genero' => $request->genero,
                'fechaNac' => $request->fechaNac,
                'fuenteFinan' => $request->fuenteFinan,
                'nivelFormacion' => mb_strtoupper(trim($request->nivelFormacion), 'UTF-8'),
                'observacion' => mb_strtoupper(trim($request->observacion), 'UTF-8'),
            ]);
            session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Genial!!',
            'text' => 'Profesor actualizado exitosamente.'
        ]);
            return redirect()->route('profesor.index')->with('success', 'Profesor actualizado exitosamente
.');
        } catch (\Exception $e) {
            session()->flash('swal', [
            'icon' => 'error',
            'title' => 'Que mal!',
            'text' => 'Error al actualizar el profesor.'
        ]);
            return redirect()->route('profesor.index')->with('error', 'Error al actualizar el
    profesor: ' . $e->getMessage());

        }
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
        //En la consulta nos falta realizar la ordenacion por turno, nivel, grado y paralelo

        $asignaciones = Asignacion::select('asignaciones.*')
            ->join('cursos', 'cursos.id', '=', 'asignaciones.idcurso')
            ->join('materias', 'materias.id_materia', '=', 'asignaciones.id_materia') // opcional
            ->where('asignaciones.id_profesor', $id)
            ->orderBy('cursos.nivel', 'asc')
            ->orderBy('cursos.turno', 'asc')
            ->orderBy('cursos.paralelo', 'asc')
            ->with(['curso', 'materia']) // si quieres los modelos relacionados además
            ->get();

        //    return $asignaciones;

        return view('profesor.perfil', compact('profesor', 'asignaciones'));
    }
}

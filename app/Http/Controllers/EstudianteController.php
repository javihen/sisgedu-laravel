<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * Import students from file
     */
    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,csv',
        ]);

        try {
            $file = $request->file('archivo');
            $path = $file->store('imports');

            // Aquí puedes agregar lógica para procesar el archivo
            // Por ahora solo retornamos un mensaje de éxito
            
            return redirect()->route('estudiante.index')->with('success', 'Importación procesada correctamente. Se agregarán pronto los estudiantes.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al importar el archivo: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }
        return response()->json($estudiante);
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
        $request->validate([
            'rude' => 'required',
            'ci' => 'required',
            'nombres' => 'required',
            'genero' => 'required',
            'fecha_nacimiento' => 'required',
        ]);

        try {
            $estudiante = Estudiante::find($id);
            if (!$estudiante) {
                return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado.');
            }

            $estudiante->update([
                'estado' => $request->input('estado', 'E'),
                'rude' => $request->rude,
                'ci' => $request->ci,
                'nombres' => $request->nombres,
                'appaterno' => $request->appaterno,
                'apmaterno' => $request->apmaterno,
                'genero' => $request->genero,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'observacion' => $request->observacion,
            ]);

            return redirect()->route('estudiante.index')->with('success', 'El estudiante se actualizó satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al actualizar el estudiante: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $estudiante = Estudiante::find($id);
            if (!$estudiante) {
                return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado.');
            }
            $estudiante->delete();
            return redirect()->route('estudiante.index')->with('success', 'El estudiante fue eliminado satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al eliminar el estudiante: ' . $e->getMessage());
        }
    }
}

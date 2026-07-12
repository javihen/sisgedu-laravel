<?php

namespace App\Http\Controllers;

use App\Models\CitacionV2;
use App\Models\Gestion;
use App\Models\Asignacion;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CitacionV2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener la gestión activa
        //$gestionActiva = Gestion::where('estado', 'A')->first();
        $id = session('profesor_id'); // Obtener el ID del profesor autenticado
        $asignaciones = Asignacion::select('asignaciones.*')
            ->join('cursos', 'cursos.id', '=', 'asignaciones.idcurso')
            ->join('materias', 'materias.id_materia', '=', 'asignaciones.id_materia') // opcional
            ->where('asignaciones.id_profesor', $id)
            ->where('id_gestion', session('gestion_activa'))
            ->where('cursos.nivel', '2')
            ->orderBy('cursos.nivel', 'asc')
            ->orderBy('cursos.grado', 'asc')
            ->orderBy('cursos.paralelo', 'asc')
            ->with(['curso', 'materia']) // si quieres los modelos relacionados además
            ->get();

        //return view('curso.curso-profesor', compact('asignaciones'));
        return view('citacion.listas', compact('asignaciones'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CitacionV2 $citacionV2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitacionV2 $citacionV2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CitacionV2 $citacionV2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitacionV2 $citacionV2)
    {
        //
    }

    public function estudiantesPorCurso($id)
    {
        $curso = Curso::findOrFail($id);

        $query = Inscripcion::where('id_curso', $id)
            ->with('estudiante');

        if (session('gestion_activa')) {
            $query->where('id_gestion', session('gestion_activa'));
        }

        $estudiantes = $query->get()
            ->pluck('estudiante')
            ->filter()
            ->sortBy(function ($estudiante) {
                return trim(($estudiante->appaterno ?? '') . ' ' . ($estudiante->apmaterno ?? '') . ' ' . ($estudiante->nombres ?? ''));
            })
            ->values();

        $profesorId = session('profesor_id');
        $asignacionId = null;

        if ($profesorId) {
            $asignacion = Asignacion::where('idcurso', $id)
                ->where('id_profesor', $profesorId)
                ->where('id_gestion', session('gestion_activa'))
                ->first();

            $asignacionId = $asignacion?->idAsignacion;
        }

        return view('citacion.partials.estudiantes-modal-content', compact('curso', 'estudiantes', 'profesorId', 'asignacionId'));
    }

    public function registrar(Request $request)
    {
        $request->validate([
            'idEstudiante' => 'required|string',
            'idProfesor' => 'required|integer',
            'idAsignacion' => 'required|integer',
        ]);

        try {
            $citacion = CitacionV2::create([
                'idAsignacion' => $request->idAsignacion,
                'fecha' => now()->toDateString(),
                'hora' => now()->toTimeString(),
                'estado' => 'Citado',
                'motivo' => 'Citación desde modal',
                'observacion' => 'Registro generado desde el modal de estudiantes',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Estudiante citado correctamente.',
                'citacionId' => $citacion->idCitacionV2,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error al registrar citación desde modal', [
                'request' => $request->all(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No se pudo registrar la citación.',
            ], 500);
        }
    }
}

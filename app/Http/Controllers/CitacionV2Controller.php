<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\CitacionV2;
use App\Models\Curso;
use App\Models\Inscripcion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CitacionV2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener la gestión activa
        // $gestionActiva = Gestion::where('estado', 'A')->first();
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

        // return view('curso.curso-profesor', compact('asignaciones'));
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

    /**
     * Nuevo método: carga la vista del modal usando la asignación específica del profesor.
     * Esto permite que cada materia del mismo curso tenga su propia sesión de CitacionV2.
     */
    public function estudiantesPorAsignacion($idAsignacion)
    {
        $profesorId = session('profesor_id');
        $gestionActiva = session('gestion_activa');

        $asignacion = Asignacion::find($idAsignacion);

        if (! $asignacion || ! $profesorId || ! $gestionActiva) {
            return view('citacion.partials.estudiantes-modal-content', [
                'curso' => null,
                'estudiantes' => collect(),
                'profesorId' => $profesorId,
                'asignacionId' => $idAsignacion,
            ]);
        }

        $curso = $asignacion->curso;
        $asignacionId = $asignacion->idAsignacion;

        // Cambio: se busca la sesión más reciente para esa asignación concreta y no para el curso completo.
        $citacionActual = CitacionV2::where('idAsignacion', $asignacionId)
            ->latest('idCitacionV2')
            ->first();

        if (! $citacionActual) {
            DB::beginTransaction();

            try {
                $citacionActual = CitacionV2::create([
                    'idAsignacion' => $asignacionId,
                    'fecha' => now()->toDateString(),
                    'hora' => now()->toTimeString(),
                    'estado' => 'ABIERTO',
                    'motivo' => '',
                    'observacion' => '',
                ]);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollBack();

                Log::error('Error al crear la sesión de Aula Abierta por asignación', [
                    'idAsignacion' => $asignacionId,
                    'error' => $e->getMessage(),
                ]);

                return view('citacion.partials.estudiantes-modal-content', [
                    'curso' => $curso,
                    'estudiantes' => collect(),
                    'profesorId' => $profesorId,
                    'asignacionId' => $asignacionId,
                ]);
            }
        }

        $query = Inscripcion::where('id_curso', $asignacion->idcurso)
            ->with('estudiante');

        if ($gestionActiva) {
            $query->where('id_gestion', $gestionActiva);
        }

        $estudiantes = $query->get()
            ->pluck('estudiante')
            ->filter()
            ->sortBy(function ($estudiante) {
                return trim(($estudiante->appaterno ?? '').' '.($estudiante->apmaterno ?? '').' '.($estudiante->nombres ?? ''));
            })
            ->values();

        // Cambio: se obtienen los estudiantes ya citados para esa sesión específica de la asignación.
        $detallesRegistrados = \App\Models\detalleCitacion::where('idCitacionV2', $citacionActual->idCitacionV2)
            ->pluck('id_estudiante')
            ->toArray();

        return view('citacion.partials.estudiantes-modal-content', compact('curso', 'estudiantes', 'profesorId', 'asignacionId', 'citacionActual', 'detallesRegistrados'));
    }

    /**
     * Método legacy para compatibilidad con la ruta anterior del curso.
     * Mantiene el flujo aunque el modal ahora se abre con la asignación concreta.
     */
    public function estudiantesPorCurso($id)
    {
        $curso = Curso::findOrFail($id);
        $profesorId = session('profesor_id');
        $gestionActiva = session('gestion_activa');

        if (! $profesorId || ! $gestionActiva) {
            return view('citacion.partials.estudiantes-modal-content', [
                'curso' => $curso,
                'estudiantes' => collect(),
                'profesorId' => $profesorId,
                'asignacionId' => null,
            ]);
        }

        $asignacion = Asignacion::where('idcurso', $id)
            ->where('id_profesor', $profesorId)
            ->where('id_gestion', $gestionActiva)
            ->first();

        $asignacionId = $asignacion?->idAsignacion;

        if (! $asignacionId) {
            return view('citacion.partials.estudiantes-modal-content', [
                'curso' => $curso,
                'estudiantes' => collect(),
                'profesorId' => $profesorId,
                'asignacionId' => null,
            ]);
        }

        return $this->estudiantesPorAsignacion($asignacionId);
    }

    /**
     * Recibe el id del estudiante y la asignación seleccionada desde la vista.
     * Consulta si ya existe un detalle para esa misma citación y estudiante.
     * Valida la información mínima y registra el estudiante solo si aún no fue agregado.
     * Devuelve una respuesta JSON para controlar el botón desde AJAX.
     */
    public function registrar(Request $request)
    {
        $request->validate([
            'idEstudiante' => ['required', 'string'],
            'idAsignacion' => ['required', 'integer'],
            'idProfesor' => ['nullable', 'integer'],
        ]);

        $profesorId = $request->idProfesor ?: session('profesor_id');
        $gestionActiva = session('gestion_activa');

        if (! $profesorId || ! $gestionActiva) {
            return response()->json([
                'success' => false,
                'message' => 'No existe una sesión activa de profesor o gestión.',
            ], 422);
        }

        $asignacion = Asignacion::find($request->idAsignacion);
        if (! $asignacion) {
            return response()->json([
                'success' => false,
                'message' => 'La asignación seleccionada no existe.',
            ], 404);
        }

        try {
            $citacion = CitacionV2::where('idAsignacion', $request->idAsignacion)
                ->where('estado', 'ABIERTO')
                ->latest('idCitacionV2')
                ->first();

            if (! $citacion) {
                $citacion = DB::transaction(function () use ($request) {
                    return CitacionV2::create([
                        'idAsignacion' => $request->idAsignacion,
                        'fecha' => now()->toDateString(),
                        'hora' => now()->toTimeString(),
                        'estado' => 'ABIERTO',
                        'motivo' => '',
                        'observacion' => '',
                    ]);
                });
            }

            $detalleExistente = \App\Models\detalleCitacion::where('idCitacionV2', $citacion->idCitacionV2)
                ->where('id_estudiante', $request->idEstudiante)
                ->first();

            if ($detalleExistente) {
                return response()->json([
                    'success' => true,
                    'message' => 'El estudiante ya fue registrado en esta sesión.',
                    'alreadyRegistered' => true,
                ]);
            }

            $detalle = DB::transaction(function () use ($citacion, $request) {
                return \App\Models\detalleCitacion::create([
                    'estado' => 'Pendiente',
                    'observacion' => '',
                    'id_estudiante' => $request->idEstudiante,
                    'idCitacionV2' => $citacion->idCitacionV2,
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Estudiante registrado correctamente.',
                'alreadyRegistered' => false,
                'detalleId' => $detalle->idDetalleCitacion,
                'citacionId' => $citacion->idCitacionV2,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error al registrar estudiante en la citación', [
                'request' => $request->all(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No se pudo registrar el estudiante.',
            ], 500);
        }
    }

    /**
     * Recibe el id del estudiante y la asignación seleccionada desde la vista.
     * Alterna el registro del estudiante en detalleCitacion para la sesión activa.
     * Si ya existe un registro, lo elimina; si no, lo crea.
     * Devuelve una respuesta JSON para actualizar el botón desde AJAX.
     */
    public function toggleRegistro(Request $request)
    {
        $request->validate([
            'idEstudiante' => ['required', 'string'],
            'idAsignacion' => ['required', 'integer'],
        ]);

        $citacion = CitacionV2::where('idAsignacion', $request->idAsignacion)
            ->latest('idCitacionV2')
            ->first();

        if (! $citacion) {
            return response()->json([
                'success' => false,
                'message' => 'No existe una sesión activa para esta asignación.',
            ], 404);
        }

        if ($citacion->estado === 'CERRADO') {
            return response()->json([
                'success' => false,
                'message' => 'La sesión ya está cerrada; no se pueden registrar más estudiantes.',
            ], 409);
        }

        $detalleExistente = \App\Models\detalleCitacion::where('idCitacionV2', $citacion->idCitacionV2)
            ->where('id_estudiante', $request->idEstudiante)
            ->first();

        if ($detalleExistente) {
            $detalleExistente->delete();

            return response()->json([
                'success' => true,
                'removed' => true,
                'message' => 'Estudiante removido de la sesión.',
            ]);
        }

        $detalle = DB::transaction(function () use ($citacion, $request) {
            return \App\Models\detalleCitacion::create([
                'estado' => 'Pendiente',
                'observacion' => '',
                'id_estudiante' => $request->idEstudiante,
                'idCitacionV2' => $citacion->idCitacionV2,
            ]);
        });

        return response()->json([
            'success' => true,
            'removed' => false,
            'message' => 'Estudiante registrado correctamente.',
            'detalleId' => $detalle->idDetalleCitacion,
        ]);
    }

    /**
     * Recibe el id de la asignación seleccionada.
     * Consulta la citación abierta para esa asignación y la actualiza a CERRADO.
     * Devuelve una respuesta JSON para indicar si el cierre fue exitoso.
     */
    public function cerrarSesion(Request $request)
    {
        $request->validate([
            'idAsignacion' => 'required|integer',
        ]);

        try {
            $citacion = CitacionV2::where('idAsignacion', $request->idAsignacion)
                ->where('estado', 'ABIERTO')
                ->latest('idCitacionV2')
                ->first();

            if (! $citacion) {
                return response()->json([
                    'success' => false,
                    'message' => 'No existe una sesión abierta para esta asignación.',
                ], 404);
            }

            $citacion->estado = 'CERRADO';
            $citacion->save();

            return response()->json([
                'success' => true,
                'message' => 'Sesión cerrada correctamente.',
                'citacionId' => $citacion->idCitacionV2,
            ]);
        } catch (\Throwable $e) {
            Log::error('Error al cerrar la sesión de Aula Abierta', [
                'request' => $request->all(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No se pudo cerrar la sesión.',
            ], 500);
        }
    }

    /**
     * Recibe el id de la asignación seleccionada.
     * Consulta la citación cerrada y obtiene solo los estudiantes registrados en detalleCitacion.
     * Devuelve un PDF con el listado generado a partir de esa sesión.
     */
    public function imprimirListado($idAsignacion)
    {
        $citacion = CitacionV2::where('idAsignacion', $idAsignacion)
            ->where('estado', 'CERRADO')
            ->latest('idCitacionV2')
            ->firstOrFail();

        $detalles = \App\Models\detalleCitacion::where('idCitacionV2', $citacion->idCitacionV2)
            ->with('estudiante')
            ->get();

        $asignacion = Asignacion::findOrFail($idAsignacion);
        $curso = $asignacion->curso;

        $pdf = Pdf::loadView('citacion.pdf-listado', compact('citacion', 'detalles', 'asignacion', 'curso'));

        return $pdf->stream('listado-aula-abierta.pdf');
    }
}

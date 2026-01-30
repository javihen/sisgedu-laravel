<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Asignacion;
use App\Models\DetalleAsistencia;
use App\Models\Inscripcion;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asistencias = Asistencia::with(['profesor', 'materia', 'curso', 'gestion'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('asistencias.index', compact('asistencias'));
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
        // Si es una solicitud JSON (desde el formulario de asistencia)
        if ($request->isJson()) {
            $request->validate([
                'fecha' => 'required|date',
                'hora' => 'required',
                'idCurso' => 'required|string',
                'detalles' => 'required|array',
            ]);

            try {
                // Obtener el profesor desde la sesión (sistema de login personalizado)
                $idProfesor = null;
                if (session('usuario_id')) {
                    $usuario = Usuario::find(session('usuario_id'));
                    // Intentar obtener id_profesor (cubriendo posibles diferencias de mayúsculas/minúsculas en la propiedad)
                    $idProfesor = $usuario ? ($usuario->id_profesor ?? $usuario->id_Profesor) : null;
                }

                if (!$idProfesor) {
                    return response()->json([
                        'success' => false,
                        'message' => 'No se puede registrar: El usuario actual no tiene un perfil de profesor asociado.'
                    ], 422);
                }

                // Obtener automáticamente la materia que dicta este profesor en este curso
                $asignacion = Asignacion::where('idcurso', $request->idCurso)
                    ->where('id_profesor', $idProfesor)
                    ->where('id_gestion', session('gestion_activa'))
                    ->first();
                $idMateria = $asignacion ? $asignacion->id_materia : null;

                // Crear registro de asistencia
                $asistencia = Asistencia::create([
                    'fecha' => $request->fecha,
                    'hora' => $request->hora,
                    'descripcion' => $request->descripcion ?? null,
                    'idCurso' => $request->idCurso,
                    'idProfesor' => $idProfesor,
                    'idMateria' => $idMateria,
                    'id_gestion' => session('gestion_activa') ?? null, // Usar la gestión de la sesión
                ]);

                // Crear detalles de asistencia
                foreach ($request->detalles as $detalle) {
                    DetalleAsistencia::create([
                        'idAsistencia' => $asistencia->idAsistencia,
                        'idEstudiante' => $detalle['idEstudiante'],
                        'estado' => $detalle['estado'],
                        'observacion' => $detalle['observacion'] ?? null,
                    ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Asistencia registrada correctamente',
                    'asistencia_id' => $asistencia->idAsistencia
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al registrar la asistencia: ' . $e->getMessage()
                ], 500);
            }
        }

        // Si es una solicitud tradicional
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'idProfesor' => 'required',
            'idMateria' => 'required',
            'idCurso' => 'required',
            'id_gestion' => 'required',
        ]);

        Asistencia::create($request->all());

        return redirect()->back()->with('success', 'Asistencia registrada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }

    /**
     * Obtener estudiantes inscritos en un curso
     */
    public function obtenerInscritosPorCurso($idCurso)
    {
        try {
            $inscritos = Inscripcion::where('id_curso', $idCurso)
                ->where('id_gestion', session('gestion_activa'))
                ->with('estudiante')
                ->get();

            return response()->json($inscritos);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener inscritos: ' . $e->getMessage()
            ], 500);
        }
    }
}

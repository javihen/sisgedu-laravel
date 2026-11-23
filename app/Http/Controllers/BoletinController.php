<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Nota;
use App\Models\Asignacion;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BoletinController extends Controller
{
    public function obtenerBoletin(Request $request, $idEstudiante): JsonResponse
    {
        $validated = $request->validate([
            'id_curso' => 'nullable|string|exists:cursos,id',
        ]);
        $idCurso = $validated['id_curso'] ?? null;

        try {
            $estudiante = Estudiante::with(['inscripciones.curso'])->find($idEstudiante);

            if (! $estudiante) {
                return response()->json(['error' => 'Estudiante no encontrado.'], 404);
            }

            $notas = Nota::with(['asignacion.materia', 'asignacion.profesor', 'asignacion.curso', 'gestion'])
                ->where('id_estudiante', $idEstudiante)
                ->when($idCurso, function ($query) use ($idCurso) {
                    $gestionActiva = session('gestion_activa');
                    $query->where('notas.id_gestion', $gestionActiva)
                        ->whereHas('asignacion', function ($asignacionQuery) use ($idCurso, $gestionActiva) {
                            $asignacionQuery->where('idcurso', $idCurso)
                                ->where('id_gestion', $gestionActiva);
                        });
                })
                ->orderBy('idAsignacion')
                ->orderBy('periodo')
                ->get();

            $asignaciones = [];
            foreach ($notas as $nota) {
                $asignacion = $nota->asignacion;

                if (! $asignacion || ! $asignacion->materia) {
                    continue;
                }

                $idAsignacion = $asignacion->idAsignacion;
                if (! isset($asignaciones[$idAsignacion])) {
                    $materia = $asignacion->materia;
                    $profesor = $asignacion->profesor;

                    $asignaciones[$idAsignacion] = [
                        'idAsignacion' => $idAsignacion,
                        /* 'materia' => trim($materia->area . ($materia->campo ? ': ' . $materia->campo : '')), */
                        'materia' => trim($materia->area),
                        'profesor' => $profesor ? trim($profesor->nombres . ' ' . $profesor->appaterno . ' ' . $profesor->apmaterno) : 'No asignado',
                        // Guardamos también el orden para poder ordenar más abajo
                        'orden' => isset($materia->orden) ? (int) $materia->orden : 0,
                        'notas' => [
                            '1' => null,
                            '2' => null,
                            '3' => null,
                        ],
                        'notasOriginales' => [
                            '1' => null,
                            '2' => null,
                            '3' => null,
                        ],
                        'promedio_final' => null,
                    ];
                }

                $asignaciones[$idAsignacion]['notas'][(string) $nota->periodo] = is_numeric($nota->calificacion)
                    ? round($nota->calificacion)
                    : null;
                $asignaciones[$idAsignacion]['notasOriginales'][(string) $nota->periodo] = is_numeric($nota->calificacion)
                    ? (string) $nota->calificacion
                    : null;
            }

            if ($idCurso) {
                $asignacionesCurso = Asignacion::with(['materia', 'profesor'])
                    ->where('idcurso', $idCurso)
                    ->where('id_gestion', session('gestion_activa'))
                    ->get();

                foreach ($asignacionesCurso as $asignacionCurso) {
                    $idAsignacion = $asignacionCurso->idAsignacion;

                    if (isset($asignaciones[$idAsignacion]) || ! $asignacionCurso->materia) {
                        continue;
                    }

                    $materia = $asignacionCurso->materia;
                    $profesor = $asignacionCurso->profesor;
                    $asignaciones[$idAsignacion] = [
                        'idAsignacion' => $idAsignacion,
                        'materia' => trim($materia->area),
                        'profesor' => $profesor ? trim($profesor->nombres . ' ' . $profesor->appaterno . ' ' . $profesor->apmaterno) : 'No asignado',
                        'orden' => isset($materia->orden) ? (int) $materia->orden : 0,
                        'notas' => [
                            '1' => null,
                            '2' => null,
                            '3' => null,
                        ],
                        'notasOriginales' => [
                            '1' => null,
                            '2' => null,
                            '3' => null,
                        ],
                        'promedio_final' => null,
                    ];
                }
            }

            foreach ($asignaciones as $key => $row) {
                $periodos = array_filter($row['notas'], fn($value) => is_numeric($value));
                $asignaciones[$key]['promedio_final'] = count($periodos)
                    ? round(array_sum($periodos) / count($periodos))
                    : null;
            }

            // Ordenar las asignaciones por el campo 'orden' de la materia (ascendente)
            $asignaciones = collect($asignaciones)->sortBy('orden')->values()->all();

            $inscripcion = $estudiante->inscripciones->firstWhere('id_curso', $idCurso)
                ?? $estudiante->inscripciones->first();
            $curso = $notas->first()?->asignacion?->curso ?? $inscripcion?->curso;
            $gestion = $notas->first()?->gestion;

            $response = [
                'estudiante' => [
                    'id' => $estudiante->id_estudiante,
                    'nombre_completo' => trim("{$estudiante->appaterno} {$estudiante->apmaterno} {$estudiante->nombres}"),
                    'rude' => $estudiante->rude,
                    'estado' => $estudiante->estado,
                    'observacion' => $estudiante->observacion,
                    'curso' => $curso?->display_name ?? 'Sin curso asignado',
                    'nivel' => match ($curso ? (int) $curso->nivel : null) {
                        0 => 'Inicial',
                        1 => 'Primaria',
                        2 => 'Secundaria Comunitaria Productiva',
                        default => 'No disponible',
                    },
                    'turno' => match ($curso?->turno) {
                        'M' => 'Mañana',
                        'T' => 'Tarde',
                        'N' => 'Noche',
                        default => 'No disponible',
                    },
                    'gestion' => $gestion?->anio ?? session('gestion') ?? 'Sin gestión registrada',
                ],
                'asignaciones' => array_values($asignaciones),
            ];

            return response()->json($response);
        } catch (Throwable $exception) {
            Log::error('Error obtener boletin: ' . $exception->getMessage(), ['idEstudiante' => $idEstudiante]);

            return response()->json([
                'error' => 'Ocurrió un error al obtener el boletín. Intente de nuevo más tarde.',
            ], 500);
        }
    }

    public function actualizarCalificaciones(Request $request, $idEstudiante): JsonResponse
    {
        $validated = $request->validate([
            'id_curso' => 'required|string|exists:cursos,id',
            'calificaciones' => 'required|array|min:1',
            'calificaciones.*' => 'required|array:1,2,3',
            'calificaciones.*.1' => 'present|nullable|numeric|decimal:0,2|between:0,100',
            'calificaciones.*.2' => 'present|nullable|numeric|decimal:0,2|between:0,100',
            'calificaciones.*.3' => 'present|nullable|numeric|decimal:0,2|between:0,100',
        ], [
            'calificaciones.*.1.present' => 'Se deben enviar las calificaciones de los tres trimestres.',
            'calificaciones.*.2.present' => 'Se deben enviar las calificaciones de los tres trimestres.',
            'calificaciones.*.3.present' => 'Se deben enviar las calificaciones de los tres trimestres.',
            'calificaciones.*.*.numeric' => 'Cada calificación debe ser un número.',
            'calificaciones.*.*.decimal' => 'Cada calificación admite como máximo dos decimales.',
            'calificaciones.*.*.between' => 'Cada calificación debe estar entre 0 y 100.',
        ]);

        $idGestion = session('gestion_activa');
        if (! $idGestion) {
            return response()->json([
                'error' => 'No hay una gestión activa para guardar las calificaciones.',
            ], 422);
        }

        $estudiante = Estudiante::find($idEstudiante);
        if (! $estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado.'], 404);
        }

        $inscritoEnCurso = $estudiante->inscripciones()
            ->where('id_curso', $validated['id_curso'])
            ->where('id_gestion', $idGestion)
            ->exists();

        if (! $inscritoEnCurso) {
            return response()->json([
                'error' => 'El estudiante no está inscrito en este curso durante la gestión activa.',
            ], 403);
        }

        $idsAsignacion = array_keys($validated['calificaciones']);
        $idsAsignacionesValidos = Asignacion::where('idcurso', $validated['id_curso'])
            ->where('id_gestion', $idGestion)
            ->whereIn('idAsignacion', $idsAsignacion)
            ->pluck('idAsignacion')
            ->map(fn ($id) => (string) $id)
            ->all();

        if (count($idsAsignacionesValidos) !== count($idsAsignacion)) {
            return response()->json([
                'error' => 'Una o más materias no pertenecen al curso y gestión seleccionados.',
            ], 403);
        }

        DB::transaction(function () use ($validated, $idEstudiante, $idGestion): void {
            foreach ($validated['calificaciones'] as $idAsignacion => $periodos) {
                foreach ([1, 2, 3] as $periodo) {
                    $notaQuery = Nota::where('id_estudiante', $idEstudiante)
                        ->where('idAsignacion', $idAsignacion)
                        ->where('id_gestion', $idGestion)
                        ->where('periodo', $periodo);
                    $calificacion = $periodos[$periodo] ?? null;

                    if ($calificacion === null) {
                        $notaQuery->delete();
                        continue;
                    }

                    $nota = $notaQuery->orderBy('id')->first();
                    if ($nota) {
                        $nota->update(['calificacion' => $calificacion]);
                        $notaQuery->where('id', '!=', $nota->id)->delete();
                    } else {
                        Nota::create([
                            'id_estudiante' => $idEstudiante,
                            'idAsignacion' => $idAsignacion,
                            'id_gestion' => $idGestion,
                            'periodo' => $periodo,
                            'calificacion' => $calificacion,
                        ]);
                    }
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Las calificaciones se guardaron correctamente.',
        ]);
    }
}

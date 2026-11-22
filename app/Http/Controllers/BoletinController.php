<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Nota;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
                        'promedio_final' => null,
                    ];
                }

                $asignaciones[$idAsignacion]['notas'][(string) $nota->periodo] = is_numeric($nota->calificacion)
                    ? round($nota->calificacion)
                    : null;
            }

            foreach ($asignaciones as $key => $row) {
                $periodos = array_filter($row['notas'], fn($value) => is_numeric($value));
                $asignaciones[$key]['promedio_final'] = count($periodos)
                    ? round(array_sum($periodos) / count($periodos))
                    : null;
            }

            // Ordenar las asignaciones por el campo 'orden' de la materia (ascendente)
            $asignaciones = collect($asignaciones)->sortBy('orden')->values()->all();

            $curso = $notas->first()?->asignacion?->curso ?? $estudiante->inscripciones->first()?->curso;
            $gestion = $notas->first()?->gestion;

            $response = [
                'estudiante' => [
                    'id' => $estudiante->id_estudiante,
                    'nombre_completo' => trim("{$estudiante->appaterno} {$estudiante->apmaterno} {$estudiante->nombres}"),
                    'curso' => $curso?->display_name ?? 'Sin curso asignado',
                    'gestion' => $gestion?->anio ?? 'Sin gestión registrada',
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
}

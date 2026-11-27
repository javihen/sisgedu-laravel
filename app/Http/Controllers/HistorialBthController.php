<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Nota;
use App\Models\PromedioHistoricoBth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class HistorialBthController extends Controller
{
    private const ANIOS = [2022, 2023, 2024, 2025, 2026];

    public function obtener(Request $request, string $idEstudiante): JsonResponse
    {
        $validated = $request->validate([
            'id_curso' => 'required|string|exists:cursos,id',
        ]);
        $estudiante = Estudiante::find($idEstudiante);

        if (! $estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado.'], 404);
        }

        if (! $this->estaInscritoEnCurso($estudiante, $validated['id_curso'])) {
            return response()->json(['error' => 'El estudiante no está inscrito en este curso durante la gestión activa.'], 403);
        }

        $materias = $this->materiasDelCurso($validated['id_curso']);
        $promedios = PromedioHistoricoBth::query()
            ->where('id_estudiante', $idEstudiante)
            ->whereIn('id_materia', $materias->pluck('id_materia'))
            ->whereIn('anio', self::ANIOS)
            ->get()
            ->groupBy('id_materia');
        $promediosFinales = $this->promediosFinalesGestion($idEstudiante, $validated['id_curso']);

        $filas = $materias->map(function ($materia) use ($promedios, $promediosFinales) {
            $valores = $promedios->get($materia->id_materia, collect())
                ->keyBy('anio')
                ->map(fn (PromedioHistoricoBth $registro) => (int) round((float) $registro->promedio));
            $promedioFinalGestion = $promediosFinales->get($materia->id_materia);
            $promediosAnuales = collect(self::ANIOS)
                ->mapWithKeys(fn (int $anio) => [
                    $anio => $anio === 2026 && $promedioFinalGestion !== null
                        ? $promedioFinalGestion
                        : $valores->get($anio),
                ]);
            $ultimasTres = collect([
                $valores->get(2024),
                $valores->get(2025),
                $promedioFinalGestion ?? $valores->get(2026),
            ])->filter(fn ($promedio) => $promedio !== null);

            return [
                'id_materia' => $materia->id_materia,
                'materia' => trim($materia->area),
                'promedios' => $promediosAnuales->all(),
                'promedio_2026_automatico' => $promedioFinalGestion !== null,
                'promedio_ultimas_tres' => $ultimasTres->isNotEmpty()
                    ? round($ultimasTres->avg(), 2)
                    : null,
            ];
        })->values();

        return response()->json([
            'estudiante' => [
                'id' => $estudiante->id_estudiante,
                'nombre' => trim("{$estudiante->appaterno} {$estudiante->apmaterno} {$estudiante->nombres}"),
            ],
            'anios' => self::ANIOS,
            'materias' => $filas,
        ]);
    }

    public function actualizar(Request $request, string $idEstudiante): JsonResponse
    {
        $reglas = [
            'id_curso' => 'required|string|exists:cursos,id',
            'promedios' => 'required|array|min:1',
            'promedios.*' => 'required|array:'.implode(',', self::ANIOS),
        ];

        foreach (self::ANIOS as $anio) {
            $reglas["promedios.*.{$anio}"] = [
                $anio === 2026 ? 'sometimes' : 'present',
                'nullable',
                'integer',
                'between:0,100',
            ];
        }

        $validated = $request->validate($reglas, [
            'promedios.*.*.integer' => 'Cada promedio debe ser un número entero.',
            'promedios.*.*.between' => 'Cada promedio debe estar entre 0 y 100.',
        ]);
        $idGestion = session('gestion_activa');

        if (! $idGestion) {
            return response()->json(['error' => 'No hay una gestión activa para verificar el curso.'], 422);
        }

        $estudiante = Estudiante::find($idEstudiante);
        if (! $estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado.'], 404);
        }

        if (! $this->estaInscritoEnCurso($estudiante, $validated['id_curso'])) {
            return response()->json(['error' => 'El estudiante no está inscrito en este curso durante la gestión activa.'], 403);
        }

        $idsMaterias = array_map('intval', array_keys($validated['promedios']));
        $idsMateriasPermitidos = $this->materiasDelCurso($validated['id_curso'])
            ->pluck('id_materia')
            ->map(fn ($id) => (int) $id)
            ->all();

        if (array_diff($idsMaterias, $idsMateriasPermitidos)) {
            return response()->json(['error' => 'Una o más materias no pertenecen al curso seleccionado.'], 403);
        }

        $promediosFinales = $this->promediosFinalesGestion($idEstudiante, $validated['id_curso']);

        DB::transaction(function () use ($validated, $idEstudiante, $promediosFinales) {
            foreach ($validated['promedios'] as $idMateria => $promediosPorAnio) {
                foreach (self::ANIOS as $anio) {
                    if ($anio === 2026 && $promediosFinales->has($idMateria)) {
                        PromedioHistoricoBth::query()
                            ->where('id_estudiante', $idEstudiante)
                            ->where('id_materia', $idMateria)
                            ->where('anio', $anio)
                            ->delete();
                        continue;
                    }

                    if (! array_key_exists($anio, $promediosPorAnio)) {
                        continue;
                    }

                    $promedio = $promediosPorAnio[$anio];
                    $consulta = PromedioHistoricoBth::query()
                        ->where('id_estudiante', $idEstudiante)
                        ->where('id_materia', $idMateria)
                        ->where('anio', $anio);

                    if ($promedio === null || $promedio === '') {
                        $consulta->delete();
                        continue;
                    }

                    $consulta->updateOrCreate([
                        'id_estudiante' => $idEstudiante,
                        'id_materia' => $idMateria,
                        'anio' => $anio,
                    ], ['promedio' => $promedio]);
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Los promedios históricos se guardaron correctamente.',
        ]);
    }

    private function estaInscritoEnCurso(Estudiante $estudiante, string $idCurso): bool
    {
        $idGestion = session('gestion_activa');

        return $idGestion && $estudiante->inscripciones()
            ->where('id_curso', $idCurso)
            ->where('id_gestion', $idGestion)
            ->exists();
    }

    private function materiasDelCurso(string $idCurso): Collection
    {
        return Asignacion::query()
            ->with('materia')
            ->where('idcurso', $idCurso)
            ->where('id_gestion', session('gestion_activa'))
            ->get()
            ->pluck('materia')
            ->filter()
            ->unique('id_materia')
            ->values();
    }

    private function promediosFinalesGestion(string $idEstudiante, string $idCurso): Collection
    {
        $gestionId = session('gestion_activa');
        $gestion = $gestionId ? Gestion::find($gestionId) : null;

        if (! $gestion || (int) $gestion->anio !== 2026) {
            return collect();
        }

        $notasPorMateria = Nota::query()
            ->join('asignaciones', 'notas.idAsignacion', '=', 'asignaciones.idAsignacion')
            ->where('notas.id_estudiante', $idEstudiante)
            ->where('notas.id_gestion', $gestionId)
            ->where('asignaciones.idcurso', $idCurso)
            ->where('asignaciones.id_gestion', $gestionId)
            ->whereIn('notas.periodo', [1, 2, 3])
            ->get([
                'asignaciones.id_materia',
                'notas.periodo',
                'notas.calificacion',
            ])
            ->groupBy('id_materia');

        return $notasPorMateria
            ->map(function (Collection $notasMateria) {
                $promediosTrimestrales = $notasMateria
                    ->groupBy('periodo')
                    ->map(fn (Collection $notasTrimestre) => $notasTrimestre->avg('calificacion'));

                if ($promediosTrimestrales->count() !== 3) {
                    return null;
                }

                return (int) round($promediosTrimestrales->avg());
            })
            ->filter(fn ($promedio) => $promedio !== null);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Estudiante;
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

        $filas = $materias->map(function ($materia) use ($promedios) {
            $valores = $promedios->get($materia->id_materia, collect())
                ->keyBy('anio')
                ->map(fn (PromedioHistoricoBth $registro) => (float) $registro->promedio);
            $ultimasTres = $valores->only([2024, 2025, 2026])->values();

            return [
                'id_materia' => $materia->id_materia,
                'materia' => trim($materia->area),
                'promedios' => collect(self::ANIOS)
                    ->mapWithKeys(fn (int $anio) => [$anio => $valores->get($anio)])
                    ->all(),
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
            $reglas["promedios.*.{$anio}"] = ['present', 'nullable', 'numeric', 'decimal:0,2', 'between:0,100'];
        }

        $validated = $request->validate($reglas, [
            'promedios.*.*.numeric' => 'Cada promedio debe ser un número.',
            'promedios.*.*.decimal' => 'Cada promedio admite como máximo dos decimales.',
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

        DB::transaction(function () use ($validated, $idEstudiante) {
            foreach ($validated['promedios'] as $idMateria => $promediosPorAnio) {
                foreach (self::ANIOS as $anio) {
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
}

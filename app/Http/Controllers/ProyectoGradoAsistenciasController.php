<?php

namespace App\Http\Controllers;

use App\Models\ProyectoGradoAsistencias;
use App\Models\ProyectoGradoSesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProyectoGradoAsistenciasController extends Controller
{
    public function index(string $idSesion)
    {
        $sesion = ProyectoGradoSesion::with([
            'asistencias.estudiante:id_estudiante,nombres,appaterno,apmaterno',
        ])->findOrFail($idSesion);

        return response()->json($sesion->asistencias);
    }

    public function store(Request $request, string $idSesion)
    {
        $sesion = ProyectoGradoSesion::with([
            'proyecto.estudiante',
            'proyecto.proyectoEstudiantes',
        ])->findOrFail($idSesion);
        $validated = $request->validate([
            'asistencias' => ['required', 'array', 'min:1'],
            'asistencias.*.id_estudiante' => [
                'required',
                'string',
                'distinct',
                'exists:estudiantes,id_estudiante',
            ],
            'asistencias.*.estado_asistencia' => [
                'required',
                Rule::in(['Presente', 'Retraso', 'Falta Justificada', 'Falta Injustificada']),
            ],
            'asistencias.*.hora_llegada' => ['nullable', 'date_format:H:i'],
            'asistencias.*.entregable' => ['nullable', 'string'],
            'asistencias.*.observaciones' => ['nullable', 'string'],
            'asistencias.*.entregable_presentado' => ['sometimes', 'boolean'],
            'asistencias.*.validado' => ['sometimes', 'boolean'],
        ]);

        $integrantes = collect([$sesion->proyecto->estudiante])
            ->merge($sesion->proyecto->proyectoEstudiantes->map->estudiante)
            ->filter()
            ->unique('id_estudiante')
            ->pluck('id_estudiante')
            ->map(fn ($id) => (string) $id)
            ->all();
        $idsEnviados = collect($validated['asistencias'])
            ->pluck('id_estudiante')
            ->map(fn ($id) => (string) $id);

        if ($idsEnviados->diff($integrantes)->isNotEmpty()
            || collect($integrantes)->diff($idsEnviados)->isNotEmpty()) {
            throw ValidationException::withMessages([
                'asistencias' => 'Debe incluir exactamente a los integrantes del proyecto.',
            ]);
        }

        $asistencias = DB::transaction(function () use ($sesion, $validated) {
            foreach ($validated['asistencias'] as $datos) {
                $sesion->asistencias()->updateOrCreate(
                    ['id_estudiante' => $datos['id_estudiante']],
                    [
                        'estado_asistencia' => $datos['estado_asistencia'],
                        'hora_llegada' => $datos['hora_llegada'] ?? null,
                        'entregable' => $datos['entregable'] ?? null,
                        'observaciones' => $datos['observaciones'] ?? null,
                        'entregable_presentado' => $datos['entregable_presentado'] ?? false,
                        'validado' => $datos['validado'] ?? true,
                    ]
                );
            }

            return $sesion->asistencias()->with('estudiante')->get();
        });

        return response()->json([
            'message' => 'Asistencias del postulate registradas correctamente.',
            'asistencias' => $asistencias,
        ]);
    }

    public function show(string $idSesion, string $idAsistencia)
    {
        $asistencia = ProyectoGradoAsistencias::with('estudiante')
            ->where('id_sesion', $idSesion)
            ->whereKey($idAsistencia)
            ->firstOrFail();

        return response()->json($asistencia);
    }

    public function update(Request $request, string $idSesion, string $idAsistencia)
    {
        $asistencia = ProyectoGradoAsistencias::where('id_sesion', $idSesion)
            ->whereKey($idAsistencia)
            ->firstOrFail();
        $validated = $request->validate([
            'estado_asistencia' => [
                'sometimes',
                Rule::in(['Presente', 'Retraso', 'Falta Justificada', 'Falta Injustificada']),
            ],
            'hora_llegada' => ['nullable', 'date_format:H:i'],
            'entregable' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
            'entregable_presentado' => ['sometimes', 'boolean'],
            'validado' => ['sometimes', 'boolean'],
        ]);
        $asistencia->update($validated);

        return response()->json($asistencia->fresh([
            'estudiante:id_estudiante,nombres,appaterno,apmaterno',
        ]));
    }

    public function destroy(string $idSesion, string $idAsistencia)
    {
        $asistencia = ProyectoGradoAsistencias::where('id_sesion', $idSesion)
            ->whereKey($idAsistencia)
            ->firstOrFail();
        $asistencia->delete();

        return response()->json(['message' => 'Asistencia eliminada correctamente.']);
    }
}

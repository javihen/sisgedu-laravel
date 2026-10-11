<?php

namespace App\Http\Controllers;

use App\Models\ProyectoGrado;
use App\Models\ProyectoGradoSesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProyectoGradoSesionController extends Controller
{
    public function index(string $idProyecto)
    {
        $proyecto = ProyectoGrado::with([
            'estudiante:id_estudiante,nombres,appaterno,apmaterno,ci',
            'proyectoEstudiantes.estudiante:id_estudiante,nombres,appaterno,apmaterno,ci',
        ])->findOrFail($idProyecto);

        $integrantes = collect([$proyecto->estudiante])
            ->merge($proyecto->proyectoEstudiantes->pluck('estudiante'))
            ->filter()
            ->unique('id_estudiante')
            ->values()
            ->map(fn ($estudiante) => [
                'id_estudiante' => $estudiante->id_estudiante,
                'nombre' => trim(implode(' ', array_filter([
                    $estudiante->nombres,
                    $estudiante->appaterno,
                    $estudiante->apmaterno,
                ]))),
                'ci' => $estudiante->ci,
            ]);

        $sesiones = ProyectoGradoSesion::with([
            'asistencias.estudiante:id_estudiante,nombres,appaterno,apmaterno',
        ])
            ->where('idProyecto', $proyecto->idProyecto)
            ->orderByDesc('numero_sesion')
            ->get();

        return response()->json([
            'proyecto' => [
                'idProyecto' => $proyecto->idProyecto,
                'idGestion' => $proyecto->idGestion,
                'titulo' => $proyecto->titulo,
            ],
            'integrantes' => $integrantes,
            'numero_siguiente' => ((int) $sesiones->max('numero_sesion')) + 1,
            'sesiones' => $sesiones,
        ]);
    }

    public function store(Request $request, string $idProyecto)
    {
        $validated = $request->validate([
            'fecha_programada' => ['required', 'date'],
            'hora_inicio' => ['nullable', 'date_format:H:i'],
            'hora_fin' => ['nullable', 'date_format:H:i', 'after:hora_inicio'],
            'tipo_sesion' => ['nullable', 'string', 'max:50'],
            'tema' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
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

        $proyecto = ProyectoGrado::with([
            'estudiante:id_estudiante,nombres,appaterno,apmaterno,ci',
            'proyectoEstudiantes.estudiante:id_estudiante,nombres,appaterno,apmaterno,ci',
        ])->findOrFail($idProyecto);

        $integrantes = collect([$proyecto->estudiante])
            ->merge($proyecto->proyectoEstudiantes->pluck('estudiante'))
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
                'asistencias' => 'Debe incluir exactamente a los integrantes de este proyecto.',
            ]);
        }

        $sesion = DB::transaction(function () use ($proyecto, $validated) {
            ProyectoGrado::whereKey($proyecto->getKey())->lockForUpdate()->firstOrFail();

            $numeroSesion = ((int) ProyectoGradoSesion::where('idProyecto', $proyecto->idProyecto)
                ->lockForUpdate()
                ->max('numero_sesion')) + 1;

            $sesion = ProyectoGradoSesion::create([
                'idProyecto' => $proyecto->idProyecto,
                'idGestion' => $proyecto->idGestion,
                'numero_sesion' => $numeroSesion,
                'fecha_programada' => $validated['fecha_programada'],
                'hora_inicio' => $validated['hora_inicio'] ?? null,
                'hora_fin' => $validated['hora_fin'] ?? null,
                'tipo_sesion' => $validated['tipo_sesion'] ?? 'Ordinaria',
                'tema' => $validated['tema'] ?? null,
                'observaciones' => $validated['observaciones'] ?? null,
                'estado' => 'Finalizada',
            ]);

            $sesion->asistencias()->createMany(array_map(
                fn ($asistencia) => [
                    ...$asistencia,
                    'hora_llegada' => $asistencia['hora_llegada'] ?? null,
                    'entregable' => $asistencia['entregable'] ?? null,
                    'observaciones' => $asistencia['observaciones'] ?? null,
                    'entregable_presentado' => $asistencia['entregable_presentado'] ?? false,
                    'validado' => $asistencia['validado'] ?? true,
                ],
                $validated['asistencias']
            ));

            return $sesion->load('asistencias.estudiante');
        });

        return response()->json([
            'message' => 'Sesión y asistencias registradas correctamente.',
            'sesion' => $sesion,
        ], 201);
    }

    public function show(string $idProyecto, string $idSesion)
    {
        $sesion = ProyectoGradoSesion::with([
            'asistencias.estudiante:id_estudiante,nombres,appaterno,apmaterno',
        ])
            ->where('idProyecto', $idProyecto)
            ->whereKey($idSesion)
            ->firstOrFail();

        return response()->json($sesion);
    }

    public function update(Request $request, string $idProyecto, string $idSesion)
    {
        $sesion = ProyectoGradoSesion::where('idProyecto', $idProyecto)
            ->whereKey($idSesion)
            ->firstOrFail();
        $validated = $request->validate([
            'fecha_programada' => ['sometimes', 'date'],
            'hora_inicio' => ['nullable', 'date_format:H:i'],
            'hora_fin' => ['nullable', 'date_format:H:i', 'after:hora_inicio'],
            'tipo_sesion' => ['sometimes', 'string', 'max:50'],
            'tema' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
            'estado' => ['sometimes', Rule::in(['Programada', 'En proceso', 'Finalizada', 'Cancelada'])],
        ]);

        $sesion->update($validated);

        return response()->json($sesion->fresh([
            'asistencias.estudiante:id_estudiante,nombres,appaterno,apmaterno',
        ]));
    }

    public function destroy(string $idProyecto, string $idSesion)
    {
        $sesion = ProyectoGradoSesion::where('idProyecto', $idProyecto)
            ->whereKey($idSesion)
            ->firstOrFail();
        $sesion->delete();

        return response()->json(['message' => 'Sesión eliminada correctamente.']);
    }
}

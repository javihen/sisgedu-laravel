<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Profesor;
use App\Models\ProyectoEstudiante;
use App\Models\ProyectoGrado;
use App\Models\ProyectoGradoSorteo;
use App\Models\ProyectoSeguimiento;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;

class ProyectoGradoController extends Controller
{
    public function index()
    {
        $ultimoSorteo = null;
        if (session('gestion_activa')) {
            $ultimoSorteo = ProyectoGradoSorteo::where('idGestion', session('gestion_activa'))
                ->where('estado', 'confirmado')
                ->latest('idSorteo')
                ->first();
        }

        $proyectosSorteo = ProyectoGrado::with([
            'estudiante',
            'tutor',
            'curso',
            'gestion',
            'defensa',
            'tribunales.profesor',
            'proyectoEstudiantes.estudiante',
        ])
            ->orderBy('idProyecto')
            ->get();

        $proyectos = ProyectoGrado::with([
            'estudiante',
            'tutor',
            'curso',
            'gestion',
            'tribunales.profesor',
            'defensa',
            'proyectoEstudiantes.estudiante',
            'dictamenOficial',
        ])->orderBy('titulo', 'asc')
            ->paginate(6);

        $gestionActual = session('gestion_activa');
        $estudiantesDisponibles = DB::table('inscripciones as i')
            ->join('estudiantes as e', 'e.id_estudiante', '=', 'i.id_estudiante')
            ->where('e.estado', 'E')
            ->join('cursos as c', 'c.id', '=', 'i.id_curso')
            ->where('c.grado', 6)
            ->where('c.nivel', 2)
            ->where('i.id_gestion', $gestionActual)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('proyecto_estudiantes as pe')
                    ->whereColumn('pe.id_estudiante', 'i.id_estudiante');
            })
            ->orderBy('e.nombres', 'asc')
            ->get();
            $totalLecturaMetodologica = ProyectoGrado::whereHas('dictamenOficial', function ($query) {
                $query->where('titulo', 'En lectura metodológica');
            })->count();

            /* Proyectos faltantes */
            $dictamen = ProyectoGrado::with(['seguimientos' => function ($query) {
            $query->where('titulo', 'LIKE', '%Dictamen%');
                }
            ])
            ->whereHas('seguimientos', function ($query) {
                $query->where('titulo', 'LIKE', '%Habilitado%');
            })
            ->get();

        return view(
            'proyectoGrado.index',
            compact('proyectos', 'estudiantesDisponibles', 'totalLecturaMetodologica', 'dictamen', 'proyectosSorteo', 'ultimoSorteo')
        );
    }

    public function seguimiento(string $idProyecto)
    {
        $proyecto = ProyectoGrado::with([
            'estudiante',
            'proyectoEstudiantes.estudiante',
            'tutor',
            'curso',
            'gestion',
            'tribunales.profesor',
            'defensa',
            'seguimientos',
        ])->findOrFail($idProyecto);

        return view(
            'proyectoGrado.seguimiento',
            compact('proyecto')
        );
    }

    public function guardarDictamen(Request $request, string $idProyecto)
    {
        $proyecto = ProyectoGrado::findOrFail($idProyecto);
        abort_unless(
            session('profesor_id') !== null
                && (string) session('profesor_id') === (string) $proyecto->idProfesorTutor,
            403,
            'Solo el tutor designado puede registrar el dictamen del proyecto.'
        );

        $validated = $request->validate([
            'dictamen_estado' => ['required', 'in:sin_visto_bueno,en_lectura,informe_favorable,habilitado_defensa'],
            'fecha_dictamen' => ['required', 'date'],
            'tipo_resolucion' => ['required', 'in:unanimidad,mayoria,menores,reestructuracion'],
            'observaciones' => ['nullable', 'string', 'max:5000'],
            'declaracion_jurada' => ['accepted'],
        ]);

        $estados = [
            'sin_visto_bueno' => 'Sin visto bueno',
            'en_lectura' => 'En lectura metodológica',
            'informe_favorable' => 'Informe favorable',
            'habilitado_defensa' => 'Habilitado para la defensa',
        ];
        $resoluciones = [
            'unanimidad' => 'Aprobado por Unanimidad (2/2)',
            'mayoria' => 'Aprobado por Mayoría con Respaldo Técnico',
            'menores' => 'Con Observaciones Menores no Impeditivas',
            'reestructuracion' => 'Rechazado para Reestructuración Profunda',
        ];

        DB::transaction(function () use ($proyecto, $validated, $estados, $resoluciones) {
            ProyectoGrado::whereKey($proyecto->getKey())->lockForUpdate()->firstOrFail();

            $dictamen = ProyectoSeguimiento::where('idProyecto', $proyecto->idProyecto)
                ->where('titulo', 'like', 'Dictamen oficial:%')
                ->lockForUpdate()
                ->orderByDesc('idSeguimiento')
                ->first();

            if ($dictamen && str_starts_with($dictamen->titulo, 'Dictamen oficial: Habilitado para la defensa')) {
                abort(403, 'El dictamen no se puede modificar después de habilitar la defensa.');
            }

            $attributes = [
                'fecha' => $validated['fecha_dictamen'],
                'titulo' => 'Dictamen oficial: ' . $estados[$validated['dictamen_estado']],
                'descripcion' => $resoluciones[$validated['tipo_resolucion']],
                'observacion' => $validated['observaciones'] ?? null,
            ];

            if ($dictamen) {
                $dictamen->update($attributes);
            } else {
                $proyecto->seguimientos()->create($attributes);
            }
        });

        return redirect()
            ->route('proyectoGrado.index')
            ->with('success', 'Dictamen oficial guardado correctamente.');
    }

    public function generarSorteo(Request $request)
    {
        $validated = $request->validate([
            'numeroMesas' => ['required', 'integer', 'min:1', 'max:20'],
            'fechaDefensa' => ['required', 'date', 'after_or_equal:today'],
        ]);

        $idGestion = session('gestion_activa');
        if (!$idGestion || !Gestion::whereKey($idGestion)->exists()) {
            throw ValidationException::withMessages([
                'gestion' => 'No hay una gestión activa para registrar el sorteo.',
            ]);
        }

        $proyectos = ProyectoGrado::with([
            'estudiante',
            'tutor',
            'curso',
            'gestion',
            'tribunales.profesor',
            'proyectoEstudiantes.estudiante',
        ])->orderBy('idProyecto')->get();

        if ($proyectos->isEmpty()) {
            throw ValidationException::withMessages([
                'proyectos' => 'No hay proyectos registrados para realizar el sorteo.',
            ]);
        }

        $cantidadMesas = (int) $validated['numeroMesas'];
        if ($cantidadMesas > $proyectos->count()) {
            throw ValidationException::withMessages([
                'numeroMesas' => 'El número de mesas no puede superar la cantidad de proyectos registrados.',
            ]);
        }

        $proyectosPorMesa = (int) ceil($proyectos->count() / $cantidadMesas);
        if ($proyectosPorMesa > 16) {
            throw ValidationException::withMessages([
                'numeroMesas' => 'La cantidad seleccionada supera los 16 horarios disponibles por mesa. Aumente el número de mesas.',
            ]);
        }

        $fechaDefensa = $validated['fechaDefensa'];
        $proyectosMezclados = $proyectos->shuffle()->values();
        $mesas = collect(range(1, $cantidadMesas))->map(fn (int $numeroMesa) => [
            'numeroMesa' => $numeroMesa,
            'proyectos' => [],
        ])->all();
        $asignaciones = [];

        foreach ($proyectosMezclados as $indice => $proyecto) {
            $numeroMesa = ($indice % $cantidadMesas) + 1;
            $orden = intdiv($indice, $cantidadMesas) + 1;
            [$horaInicio, $horaFin] = $this->horarioSorteo($orden);
            $asignacion = [
                'proyecto' => $proyecto,
                'numeroMesa' => $numeroMesa,
                'orden' => $orden,
                'fechaDefensa' => $fechaDefensa,
                'horaInicio' => $horaInicio->format('H:i:s'),
                'horaFin' => $horaFin->format('H:i:s'),
            ];

            $mesas[$numeroMesa - 1]['proyectos'][] = $asignacion;
            $asignaciones[] = [
                'idProyecto' => $proyecto->idProyecto,
                'numeroMesa' => $numeroMesa,
                'orden' => $orden,
                'fechaDefensa' => $fechaDefensa,
                'horaInicio' => $horaInicio->format('H:i:s'),
                'horaFin' => $horaFin->format('H:i:s'),
            ];
        }

        $request->session()->put('proyecto_grado_sorteo_borrador', [
            'idGestion' => (int) $idGestion,
            'numeroMesas' => $cantidadMesas,
            'fechaDefensa' => $fechaDefensa,
            'proyectoIds' => $proyectos->pluck('idProyecto')->map(fn ($id) => (int) $id)->all(),
            'asignaciones' => $asignaciones,
        ]);

        return response()->json([
            'html' => view('proyectoGrado.partials.sorteo-proyectos', [
                'mesas' => $mesas,
                'proyectosCount' => $proyectos->count(),
                'fechaDefensa' => $fechaDefensa,
            ])->render(),
            'proyectos' => $proyectos->count(),
            'mesas' => $cantidadMesas,
        ]);
    }

    public function exportarSorteoPdf()
    {
        $idGestion = session('gestion_activa');
        abort_unless($idGestion, 404, 'No hay una gestión activa seleccionada.');

        $sorteo = ProyectoGradoSorteo::with([
            'gestion',
            'detalles' => fn ($query) => $query->orderBy('numeroMesa')->orderBy('orden'),
            'detalles.proyecto.estudiante',
            'detalles.proyecto.proyectoEstudiantes.estudiante',
            'detalles.proyecto.tutor',
            'detalles.proyecto.curso',
            'detalles.proyecto.tribunales.profesor',
        ])
            ->where('idGestion', $idGestion)
            ->where('estado', 'confirmado')
            ->latest('idSorteo')
            ->firstOrFail();

        $detallesPorMesa = $sorteo->detalles->groupBy('numeroMesa');
        $mesas = collect(range(1, $sorteo->numeroMesas))
            ->map(fn (int $numeroMesa) => [
                'numeroMesa' => $numeroMesa,
                'proyectos' => $detallesPorMesa->get($numeroMesa, collect()),
            ]);

        $pdf = Pdf::loadView('proyectoGrado.pdf-sorteo', [
            'sorteo' => $sorteo,
            'mesas' => $mesas,
            'institucion' => 'Unidad Educativa Cristiano Vida Nueva',
            'generadoPor' => session('usuario_nombre', 'Sistema de Gestión Educativa'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('cronograma-sorteo-' . $sorteo->idSorteo . '.pdf');
    }

    private function horarioSorteo(int $orden): array
    {
        $horasFin = [
            '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
            '12:00', '12:30', '14:00', '14:30', '15:00', '15:30',
            '16:00', '16:30', '17:00', '17:30',
        ];

        if (!isset($horasFin[$orden - 1])) {
            throw ValidationException::withMessages([
                'numeroMesas' => 'Se superó la cantidad de horarios disponibles por mesa.',
            ]);
        }

        $horaFin = Carbon::createFromFormat('H:i', $horasFin[$orden - 1]);
        $horaInicio = $horaFin->copy()->subMinutes(30);

        return [$horaInicio, $horaFin];
    }

    public function confirmarSorteo(Request $request)
    {
        $borrador = $request->session()->get('proyecto_grado_sorteo_borrador');

        if (!$borrador) {
            throw ValidationException::withMessages([
                'sorteo' => 'Primero debe generar un sorteo antes de confirmarlo.',
            ]);
        }

        if ((string) $borrador['idGestion'] !== (string) session('gestion_activa')) {
            throw ValidationException::withMessages([
                'sorteo' => 'La gestión activa cambió. Genere nuevamente el sorteo antes de confirmar.',
            ]);
        }

        $sorteo = DB::transaction(function () use ($borrador) {
            $proyectosActuales = ProyectoGrado::query()
                ->orderBy('idProyecto')
                ->lockForUpdate()
                ->pluck('idProyecto')
                ->map(fn ($id) => (int) $id)
                ->all();
            $proyectosDelBorrador = $borrador['proyectoIds'];
            sort($proyectosActuales);
            sort($proyectosDelBorrador);

            if ($proyectosActuales !== $proyectosDelBorrador) {
                throw ValidationException::withMessages([
                    'sorteo' => 'Los proyectos registrados cambiaron. Genere nuevamente el sorteo antes de confirmar.',
                ]);
            }

            $sorteo = ProyectoGradoSorteo::create([
                'idGestion' => $borrador['idGestion'],
                'numeroMesas' => $borrador['numeroMesas'],
                'estado' => 'confirmado',
                'idUsuario' => session('usuario_id'),
            ]);

            $ahora = now();
            $detalles = array_map(fn (array $asignacion) => [
                'idSorteo' => $sorteo->idSorteo,
                ...$asignacion,
                'created_at' => $ahora,
                'updated_at' => $ahora,
            ], $borrador['asignaciones']);

            DB::table('proyecto_grado_sorteo_detalles')->insert($detalles);

            return $sorteo;
        });

        $request->session()->forget('proyecto_grado_sorteo_borrador');

        return response()->json([
            'message' => 'El cronograma fue confirmado y registrado correctamente.',
            'idSorteo' => $sorteo->idSorteo,
        ]);
    }

    public function searchXCurso(string $id)
    {
        $proyectos = ProyectoGrado::with([
            'estudiante',
            'tutor',
            'curso',
            'gestion',
            'tribunales.profesor',
            'defensa',
            'proyectoEstudiantes.estudiante',
            'dictamenOficial',
        ])->where('idCurso', $id)
            ->orderBy('titulo', 'asc')
            ->get();

        $estudiantesDisponibles = Estudiante::where('estado', 'E')
            ->whereDoesntHave('proyectoGrado')
            ->whereDoesntHave('proyectoEstudiantes')
            ->whereHas('inscripciones', function ($query) use ($id) {
                $query->where('id_curso', $id);
            })
            ->orderBy('nombres', 'asc')
            ->get();

        return view(
            'proyectoGrado.index',
            compact('proyectos', 'estudiantesDisponibles')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Se mostrara las gestiones, cursos y profesores para mostrar en la vista
        $gestiones = Gestion::orderByDesc('id_gestion')->get();
        $cursos = Curso::orderBy('nombre')->get();
        $profesores = Profesor::orderBy('nombre')->get();

        return view(
            'proyectoGrado.create',
            compact(
                'gestiones',
                'cursos',
                'profesores'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $idGestion = $request->input('idGestion', session('gestion_activa'));
        $idCurso = $request->input('idCurso');

        if (! $idCurso && $request->filled('idEstudiante')) {
            $idCurso = DB::table('inscripciones')
                ->where('id_estudiante', $request->idEstudiante)
                ->where('id_gestion', $idGestion)
                ->value('id_curso');
        }

        $tutoresDelModal = [
            '21' => ['Judith', 'Flores', 'Solar'],
            '67' => ['Roger', 'Cori', null],
            '66' => ['Jose Luis', 'Quisbert', 'Quisbert'],
            '1' => ['Javier Henry', 'Quispe', 'Pinto'],
        ];
        $tutorSeleccionado = $request->input('idProfesorTutor');

        if (isset($tutoresDelModal[$tutorSeleccionado])) {
            [$nombres, $appaterno, $apmaterno] = $tutoresDelModal[$tutorSeleccionado];
            $tutor = Profesor::where('nombres', 'like', "%{$nombres}%")
                ->where('appaterno', 'like', "%{$appaterno}%")
                ->when($apmaterno, fn ($query) => $query->where('apmaterno', 'like', "%{$apmaterno}%"))
                ->first();

            $tutorSeleccionado = $tutor?->id_profesor;
        }

        $estudiantesAdicionales = collect($request->input('idEstudiantes', []))
            ->filter(fn ($idEstudiante) => $idEstudiante && $idEstudiante !== 'none')
            ->values()
            ->all();

        $request->merge([
            'idCurso' => $idCurso,
            'idGestion' => $idGestion,
            'idProfesorTutor' => $tutorSeleccionado,
            'idEstudiantes' => $estudiantesAdicionales,
        ]);

        // Se enviaran los datos a ser registrado en la tabla
        $request->validate([
            'idEstudiante' => 'required|string|exists:estudiantes,id_estudiante',
            'idEstudiantes' => 'nullable|array',
            'idEstudiantes.*' => 'string|exists:estudiantes,id_estudiante',
            'idProfesorTutor' => 'required|integer|exists:profesores,id_profesor',
            'idCurso' => 'required|string|exists:cursos,id',
            'idGestion' => 'required|integer|exists:gestiones,id_gestion',
            'titulo' => 'required|max:300',
            'modalidad' => 'nullable|string|max:150',
            'descripcion' => 'nullable|string',
            'fechaInicio' => 'nullable|date',
            'fechaDefensa' => 'nullable|date',
            'observacion' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $proyecto = ProyectoGrado::create([
                'idEstudiante' => $request->idEstudiante,
                'idProfesorTutor' => $request->idProfesorTutor,
                'idCurso' => $request->idCurso,
                'idGestion' => $request->idGestion,
                'titulo' => $request->titulo,
                'lineaInvestigacion' => $request->modalidad,
                'descripcion' => $request->descripcion,
                'estado' => 'REGISTRADO',
                'fechaInicio' => $request->fechaInicio,
                'fechaDefensa' => $request->fechaDefensa,
                'observacion' => $request->observacion,
            ]);

            $estudiantes = collect($request->input('idEstudiantes', []))
                ->prepend($request->idEstudiante)
                ->unique()
                ->values();

            foreach ($estudiantes as $idEstudiante) {
                ProyectoEstudiante::create([
                    'idProyecto' => $proyecto->idProyecto,
                    'id_estudiante' => $idEstudiante,
                ]);
            }
        });

        return redirect()
            ->route('proyectoGrado.index')
            ->with('success', 'Proyecto registrado');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostraremos el listado de todos los proyectos
        $proyecto = ProyectoGrado::with([
            'estudiante',
            'tutor',
            'curso',
            'gestion',
            'tribunales.profesor',
            'defensa',
        ])->findOrFail($id);

        return view(
            'proyectoGrado.show',
            compact('proyecto')
        );

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Se enviara los datos para la edicion de datos al proyecto de grado
        $proyecto = ProyectoGrado::findOrFail($id);
        $gestiones = Gestion::all();
        $cursos = Curso::all();
        $profesores = Profesor::all();

        return view(
            'proyectoGrado.edit',
            compact(
                'proyecto',
                'gestiones',
                'cursos',
                'profesores'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Se enviaran los datos para la actualizacion de datos a la tabla
        $proyecto = ProyectoGrado::findOrFail($id);
        $proyecto->update([
            'idProfesorTutor' => $request->idProfesorTutor,
            'titulo' => $request->titulo,
            'lineaInvestigacion' => $request->lineaInvestigacion,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
            'fechaInicio' => $request->fechaInicio,
            'fechaDefensa' => $request->fechaDefensa,
            'observacion' => $request->observacion,
        ]);

        return redirect()
            ->route('proyectoGrado.index')
            ->with('success', 'Proyecto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Se realizara para la eliminacion de proyecto el id
        ProyectoGrado::findOrFail($id)->delete();

        return back()->with(
            'success',
            'Proyecto eliminado'
        );
    }

    public function pruebas()
    {
        /* $id = 'C26B';

         $estudiantes = Estudiante::with('proyectoGrado')
             ->whereHas('inscripciones', function ($query) use ($id) {
                 $query->where('id_curso', $id);
             })
             ->get();

          $estudiantes2 = DB::table('inscripciones')
             ->join(
                 'estudiantes',
                 'estudiantes.id_estudiante',
                 '=',
                 'inscripciones.id_estudiante'
             )
             ->leftJoin(
                 'proyectos_grado',
                 'proyectos_grado.idEstudiante',
                 '=',
                 'estudiantes.id_estudiante'
             )
             ->where('inscripciones.id_curso', 'C26A')
             ->select(
                 'estudiantes.id_estudiante',
                 'estudiantes.nombre',
                 'estudiantes.apellido',
                 'proyectos_grado.id_proyecto',
                 'proyectos_grado.nombre_proyecto'
             )
             ->get();
         $proyectos = Estudiante::with('proyectoGrado.tutor')
             ->whereHas('inscripciones', function ($query) use ($id) {
                 $query->where('id_curso', $id);
             })->orderBy('nombres', 'asc')
             ->get();
         dd($proyectos);

         dd([
             'idProyecto' => $estudiante->proyectoGrado->idProyecto,
             'idProfesorTutor' => $estudiante->proyectoGrado->idProfesorTutor,
         ]);*/
        /* $idProyecto = '5';
        $proyecto = ProyectoGrado::with([
            'estudiante',
            'proyectoEstudiantes.estudiante',
            'tutor',
            'curso',
            'gestion',
            'tribunales.profesor',
            'defensa',
            'seguimientos',
        ])->findOrFail($idProyecto); */
    $proyectos = ProyectoGrado::with([
        'seguimientos' => function ($query) {
            $query->where('titulo', 'LIKE', '%Dictamen%');
        }
    ])
    ->whereHas('seguimientos', function ($query) {
        $query->where('titulo', 'LIKE', '%Informe favorable%');
    })
    ->get();
        dd($proyectos);
    }

    public function login()
    {
        return view('proyectoGrado.login');
    }

    public function asignacion()
    {
        return view('proyectoGrado.asignacion');
    }

    public function distribucion()
    {
        return view('proyectoGrado.distribucion');
    }
}

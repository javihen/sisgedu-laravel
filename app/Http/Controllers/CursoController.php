<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Asignacion;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Inscripcion;
use App\Models\Nota;
use Barryvdh\DomPDF\Facade\Pdf;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$cursos = curso::all();                  /* Obtiene todas las tuplas de la tabla Cursos de la BD */
        $gestionActiva = session('gestion_activa');
        $Minicial = Curso::where('nivel', 0)->where('turno', 'M')->withCount([
            'inscripciones as total_estudiantes' => function ($query) use ($gestionActiva) {
                $query->where('id_gestion', $gestionActiva);
            }
        ])->orderBy('grado')->orderBy('paralelo')->get();
        $Tinicial = Curso::where('nivel', 0)->where('turno', 'T')->withCount([
            'inscripciones as total_estudiantes' => function ($query) use ($gestionActiva) {
                $query->where('id_gestion', $gestionActiva);
            }
        ])->orderBy('grado')->orderBy('paralelo')->get();
        $Mprimaria = Curso::where('nivel', 1)->where('turno', 'M')->withCount([
            'inscripciones as total_estudiantes' => function ($query) use ($gestionActiva) {
                $query->where('id_gestion', $gestionActiva);
            }
        ])->orderBy('grado')->orderBy('paralelo')->get();
        $Tprimaria = Curso::where('nivel', 1)->where('turno', 'T')->withCount([
            'inscripciones as total_estudiantes' => function ($query) use ($gestionActiva) {
                $query->where('id_gestion', $gestionActiva);
            }
        ])->orderBy('grado')->orderBy('paralelo')->get();
        $Msecundaria = Curso::where('nivel', 2)
            ->where('turno', 'M')
            ->withCount([
                'inscripciones as total_estudiantes' => function ($query) use ($gestionActiva) {
                    $query->where('id_gestion', $gestionActiva);
                }
            ])
            ->orderBy('grado')
            ->orderBy('paralelo')
            ->get();

        $Tsecundaria = Curso::where('nivel', 2)->where('turno', 'T')->withCount([
            'inscripciones as total_estudiantes' => function ($query) use ($gestionActiva) {
                $query->where('id_gestion', $gestionActiva);
            }
        ])->orderBy('grado')->orderBy('paralelo')->get();

        $coursesForNavigation = collect([
            $Minicial,
            $Tinicial,
            $Mprimaria,
            $Tprimaria,
            $Msecundaria,
            $Tsecundaria,
        ])->flatten(1)->map(fn (Curso $curso) => [
            'id' => $curso->id,
            'nivel' => (int) $curso->nivel,
            'grado' => (int) $curso->grado,
            'paralelo' => (string) $curso->paralelo,
            'turno' => $curso->turno,
        ])->values();

        return view('curso.index', compact(
            'Minicial',
            'Tinicial',
            'Mprimaria',
            'Tprimaria',
            'Msecundaria',
            'Tsecundaria',
            'coursesForNavigation'
        ));
    }

    public function reporteMatricula()
    {
        $gestionId = session('gestion_activa');
        abort_if(! $gestionId, 409, 'No hay una gestión activa para generar el reporte.');

        $gestion = Gestion::findOrFail($gestionId);
        $cursos = Curso::withCount([
            'inscripciones as total_estudiantes' => function ($query) use ($gestionId) {
                $query->where('id_gestion', $gestionId);
            },
        ])
            ->orderBy('nivel')
            ->orderBy('turno')
            ->orderBy('grado')
            ->orderBy('paralelo')
            ->get();

        $niveles = [
            0 => 'Inicial en Familia Comunitaria',
            1 => 'Primaria Comunitaria Vocacional',
            2 => 'Secundaria Comunitaria Productiva',
        ];

        $pdf = Pdf::loadView('curso.reporte-matricula', [
            'gestion' => $gestion,
            'cursos' => $cursos,
            'niveles' => $niveles,
            'totalEstudiantes' => $cursos->sum('total_estudiantes'),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream("reporte_matricula_{$gestion->anio}.pdf");
    }

    public function validarRude()
    {
        $gestionId = session('gestion_activa');
        abort_if(! $gestionId, 409, 'No hay una gestión activa para validar los RUDE.');

        $gestion = Gestion::findOrFail($gestionId);
        $estudiantes = Estudiante::query()
            ->select('id_estudiante', 'rude', 'nombres', 'appaterno', 'apmaterno')
            ->whereHas('inscripciones', function ($query) use ($gestionId) {
                $query->where('id_gestion', $gestionId);
            })
            ->with(['inscripciones' => function ($query) use ($gestionId) {
                $query->where('id_gestion', $gestionId)->with('curso');
            }])
            ->orderBy('appaterno')
            ->orderBy('apmaterno')
            ->orderBy('nombres')
            ->get();

        $rudesDuplicados = $estudiantes
            ->filter(fn (Estudiante $estudiante) => trim((string) $estudiante->rude) !== '')
            ->groupBy(fn (Estudiante $estudiante) => mb_strtoupper(trim($estudiante->rude)))
            ->filter(fn ($grupo) => $grupo->count() > 1);
        $estudiantesSinRude = $estudiantes
            ->filter(fn (Estudiante $estudiante) => trim((string) $estudiante->rude) === '');

        return view('curso.validar-rude', compact(
            'gestion',
            'rudesDuplicados',
            'estudiantesSinRude'
        ));
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
        /* Validamos las entradas del formulario puesto que deben de estar completas */
        $request->validate([
            'turno' => 'required',
            'nivel' => 'required|integer',
            'grado' => 'required|integer',
            'paralelo' => 'required',
        ]);
        /* Subimos los datos a la tabla Curso usando el modelo Curso */
        //Curso::create($request->all());
        //return redirect()->route('curso.index')->with('success', 'Post created successfully.');
        try {
            Curso::create([
                'id' => 'C' . $request->nivel . '' . $request->grado . '' . $request->paralelo,
                'nombre_curso' => $request->turno . '' . $request->nivel . '' . $request->grado . '' . $request->paralelo,
                'turno' => $request->turno,
                'nivel' => $request->nivel,
                'grado' => $request->grado,
                'paralelo' => $request->paralelo,
            ]);
            return redirect()->route('curso.index')->with('success', 'El curso se creo satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('curso.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //no sera necesario puesto que el curso no se editara sino se eliminara y se creara uno nuevo
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cursos = Curso::find($id);
        $cursos->delete();

        //DB::table('cursos')->where('id', $id)->delete();  otra forma de eliminar
        return redirect()->route('curso.index')->with('success', 'El curso se elimino satisfactoriamente.');
    }

    public function getCursos($turno, $nivel)
    {
        // Filtramos cursos por categoría y subcategoría (ajusta los campos según tu base de datos)
        $cursos = Curso::where('turno', $turno) //tenemos problemas subrayadospero es cuestion del editor aunque todavia estamos en la busqueda de la soucion
            ->where('nivel', $nivel)
            ->get()
            ->map(function ($curso) {
                return [
                    'idCurso' => $curso->id,
                    'nombreCurso' => $curso->display_name, // usa el accesor definido en el modelo
                ];
            });

        return response()->json($cursos);
    }

    /**
     * Devuelve todos los cursos (id y nombre) en JSON.
     */
    public function listAll()
    {
        $cursos = Curso::orderBy('nivel')->orderBy('grado')->orderBy('paralelo')->get()->map(function ($curso) {
            return [
                'idCurso' => $curso->id,
                'nombreCurso' => $curso->display_name,
            ];
        });

        return response()->json($cursos);
    }

    public function getCursosNivel($nivel){
        $cursos = Curso::where('nivel',$nivel)->get()->map(function($curso){
            return [
                'idCurso' => $curso->id,
                'nombreCurso' => $curso->display_name,
            ];
        });
        return response()->json($cursos);
    }

    public function CursosAsignados($id)
    {
        $asignaciones = Asignacion::select('asignaciones.*')
            ->join('cursos', 'cursos.id', '=', 'asignaciones.idcurso')
            ->join('materias', 'materias.id_materia', '=', 'asignaciones.id_materia') // opcional
            ->where('asignaciones.id_profesor', $id)
            ->where('id_gestion', session('gestion_activa'))
            ->orderBy('cursos.nivel', 'asc')
            ->orderBy('cursos.grado', 'asc')
            ->orderBy('cursos.paralelo', 'asc')
            ->with(['curso', 'materia']) // si quieres los modelos relacionados además
            ->get();

        return view('curso.curso-profesor', compact('asignaciones'));
    }

    public function centralizadorPdf($id)
    {
        $curso = Curso::findOrFail($id);
        $gestionId = session('gestion_activa');
        $gestion = Gestion::find($gestionId);

        $asignaciones = Asignacion::with('materia')
            ->where('idcurso', $id)
            ->where('id_gestion', $gestionId)
            ->get()
            ->filter(fn ($asignacion) => $asignacion->materia)
            ->sortBy(fn ($asignacion) => $asignacion->materia->orden)
            ->values();

        $inscripciones = Inscripcion::with('estudiante')
            ->where('id_curso', $id)
            ->where('id_gestion', $gestionId)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'E');
            })
            ->get()
            ->unique('id_estudiante')
            ->sortBy(function ($inscripcion) {
                $estudiante = $inscripcion->estudiante;

                return mb_strtolower(trim($estudiante->appaterno . ' ' . $estudiante->apmaterno . ' ' . $estudiante->nombres));
            })
            ->values();

        $calificaciones = [];
        $idEstudiantes = $inscripciones->pluck('id_estudiante');
        $idAsignaciones = $asignaciones->pluck('idAsignacion');

        if ($idEstudiantes->isNotEmpty() && $idAsignaciones->isNotEmpty()) {
            $notas = Nota::where('id_gestion', $gestionId)
                ->whereIn('periodo', [1, 2, 3])
                ->whereIn('id_estudiante', $idEstudiantes)
                ->whereIn('idAsignacion', $idAsignaciones)
                ->get();

            foreach ($notas as $nota) {
                $calificaciones[$nota->id_estudiante][$nota->idAsignacion][$nota->periodo] = (float) $nota->calificacion;
            }
        }

        $pdf = Pdf::loadView('curso.pdf-centralizador', compact(
            'curso',
            'gestion',
            'asignaciones',
            'inscripciones',
            'calificaciones'
        ))->setPaper('a3', 'landscape');

        return $pdf->stream("centralizador_{$curso->id}_" . ($gestion?->anio ?? 'gestion') . '.pdf');
    }

    public function reprobaciones($id)
    {
        $curso = Curso::findOrFail($id);
        $gestionId = session('gestion_activa');
        $gestion = Gestion::find($gestionId);

        $notas = Nota::with(['estudiante', 'asignacion.materia', 'asignacion.profesor'])
            ->where('id_gestion', $gestionId)
            ->whereIn('periodo', [1, 2, 3])
            ->whereHas('asignacion', function ($query) use ($id, $gestionId) {
                $query->where('idcurso', $id)
                    ->where('id_gestion', $gestionId);
            })
            ->whereHas('estudiante.inscripciones', function ($query) use ($id, $gestionId) {
                $query->where('id_curso', $id)
                    ->where('id_gestion', $gestionId);
            })
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'E');
            })
            ->orderBy('id_estudiante')
            ->orderBy('idAsignacion')
            ->orderBy('periodo')
            ->get();

        $estudiantes = $notas->groupBy('id_estudiante')
            ->map(function ($notasEstudiante) {
                $estudiante = $notasEstudiante->first()->estudiante;
                $materias = $notasEstudiante->groupBy('idAsignacion')
                    ->map(function ($notasAsignacion) {
                        $asignacion = $notasAsignacion->first()->asignacion;
                        $notasPorPeriodo = $notasAsignacion->keyBy('periodo');
                        $calificaciones = collect([1, 2, 3])->mapWithKeys(function ($periodo) use ($notasPorPeriodo) {
                            $nota = $notasPorPeriodo->get($periodo);

                            return [$periodo => $nota ? (float) $nota->calificacion : null];
                        });
                        $calificacionesRegistradas = $calificaciones->filter(fn ($nota) => $nota !== null);
                        $promedioFinal = $calificacionesRegistradas->avg();

                        if ($promedioFinal === null) {
                            return null;
                        }

                        $promedioFinal = round($promedioFinal);
                        if ($promedioFinal >= 51) {
                            return null;
                        }

                        $profesor = $asignacion->profesor;

                        return [
                            'materia' => $asignacion->materia?->area ?? 'Materia sin nombre',
                            'profesor' => $profesor
                                ? trim($profesor->nombres . ' ' . $profesor->appaterno . ' ' . $profesor->apmaterno)
                                : 'No asignado',
                            'notas' => $calificaciones->all(),
                            'promedio_final' => $promedioFinal,
                            'orden' => $asignacion->materia?->orden ?? 0,
                        ];
                    })
                    ->filter()
                    ->sortBy('orden')
                    ->values();

                if ($materias->isEmpty()) {
                    return null;
                }

                return [
                    'id' => $estudiante->id_estudiante,
                    'nombre' => trim($estudiante->appaterno . ' ' . $estudiante->apmaterno . ' ' . $estudiante->nombres),
                    'rude' => $estudiante->rude,
                    'materias' => $materias,
                ];
            })
            ->filter()
            ->sortBy('nombre')
            ->values();

        $totalAlumnos = Inscripcion::where('id_curso', $id)
            ->where('id_gestion', $gestionId)
            ->whereHas('estudiante', function ($query) {
                $query->where('estado', 'E');
            })
            ->distinct()
            ->count('id_estudiante');
        $totalMateriasReprobadas = $estudiantes->sum(fn ($estudiante) => $estudiante['materias']->count());

        return view('curso.reprobaciones', compact(
            'curso',
            'gestion',
            'estudiantes',
            'totalAlumnos',
            'totalMateriasReprobadas'
        ));
    }
}

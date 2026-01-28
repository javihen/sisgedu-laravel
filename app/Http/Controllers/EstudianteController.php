<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buscar = request()->get('buscar');

        // Carga inscripciones y el curso asociado para cada estudiante ademas hacemos el filtro de busqueda
        $estudiantes = Estudiante::with([
            'inscripciones' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'));
            },
            'inscripciones.curso'
        ])
            ->whereHas('inscripciones', function ($query) {
                $query->where('id_gestion', session('gestion_activa'));
            })
            ->when($buscar, function ($query, $buscar) {
                $query->whereRaw("UPPER(CONCAT(nombres, ' ', appaterno, ' ', apmaterno)) LIKE ?", ['%' . strtoupper($buscar) . '%'])
                    ->orWhereRaw("UPPER(id_estudiante) LIKE ?", ['%' . strtoupper($buscar) . '%'])
                    ->orWhereRaw("UPPER(ci) LIKE ?", ['%' . strtoupper($buscar) . '%']);
            })
            ->orderBy('appaterno', 'asc')
            ->get();

        //dd($estudiantes);
        $estadisticas = Curso::withCount([
            // HOMBRES EFECTIVOS
            'inscripciones as hombres_efectivos' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'))
                ->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'M')
                        ->where('estado', 'E');
                });
            },

            // MUJERES EFECTIVAS
            'inscripciones as mujeres_efectivas' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'))->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'F')
                        ->where('estado', 'E');
                });
            },

            // HOMBRES RETIRADOS
            'inscripciones as hombres_retirados' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'))->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'M')
                        ->where('estado', 'R');
                });
            },

            // MUJERES RETIRADAS
            'inscripciones as mujeres_retiradas' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'))->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'F')
                        ->where('estado', 'R');
                });
            },

            // HOMBRES ABANDONO
            'inscripciones as hombres_abandono' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'))->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'M')
                        ->where('estado', 'A');
                });
            },

            // MUJERES ABANDONO
            'inscripciones as mujeres_abandono' => function ($q) {
                $q->where('id_gestion', session('gestion_activa'))->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'F')
                        ->where('estado', 'A');
                });
            },

        ])->orderBy('nivel', 'asc')->orderBy('grado', 'asc')->orderBy('paralelo', 'asc')->get();


        return view('estudiante.index', compact('estudiantes', 'estadisticas'));
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
        //dd($request->all());
        try {
            //si existen datos $request->curso lo insertaremos en la tabla de inscripciones
            $idCurso = $request->input('id_curso');
            // Normalizar y convertir a mayúsculas los campos de texto
            $toUpper = fn($v) => $v === null ? null : mb_strtoupper(trim($v), 'UTF-8');

            Estudiante::create([
                'id_estudiante' => $toUpper($request->codigo),
                'estado' => $toUpper($request->estado),
                'rude' => $toUpper($request->rude),
                'ci' => $toUpper($request->ci),
                'nombres' => $toUpper($request->nombres),
                'appaterno' => $toUpper($request->appaterno),
                'apmaterno' => $toUpper($request->apmaterno),
                'genero' => $toUpper($request->genero),
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'observacion' => $toUpper($request->observacion),
            ]);
            DB::table('inscripciones')->insert([
                'id_estudiante' => $toUpper($request->codigo),
                'id_curso' => $idCurso,
                'id_gestion' => session('gestion_activa'), // o cualquier otro valor predeterminado
            ]);
            return redirect()->route('estudiante.index')->with('success', 'El estudiante se registro satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al registrar el estudiante.' . $e->getMessage());
        }
    }

    /**
     * Import students from file
     */
    public function import(Request $request)
    {
        //capturamos el valor de idcurso del select en el formulario
        $idCurso = $request->input('idCurso');
        $data = json_decode($request->excelData, true);

        // Primera fila es encabezado
        $headers = $data[0];
        unset($data[0]); // quitar encabezados

        foreach ($data as $row) {
            if (count($row) < 7) continue; // evitar filas vacías

            Estudiante::create([
                'id_estudiante'      => $row[0] ?? null,
                'rude'        => $row[1] ?? null,
                'ci'   => $row[2] ?? null,
                'nombres' => $row[3] ?? null,
                'appaterno' => $row[4] ?? null,
                'apmaterno'    => $row[5] ?? null,
                'genero' => $row[6] ?? null,
                'estado' => 'E',
                'fecha_nacimiento' => $row[7] ?? null,
            ]);
        }
        foreach ($data as $row) {
            if (count($row) < 1) continue; // evitar filas vacías

            // Insertar inscripción usando el idCurso capturado
            Inscripcion::create([
                'id_estudiante' => $row[0] ?? null,
                'id_curso' => $idCurso,
                'id_gestion' => session('gestion_activa'),
            ]);
        }

        return back()->with('success', 'Estudiantes importados e inscritos correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }
        return response()->json($estudiante);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'codigo' => 'required',
            'nombres' => 'required',
            'appaterno' => 'required',
            'apmaterno' => 'required',
        ]);
        $toUpper = fn($v) => $v === null ? null : mb_strtoupper(trim($v), 'UTF-8');

        try {
            //capturamos el valor de idcurso del select en el formulario
            $idCurso = $request->input('id_curso');
            $estudiante = Estudiante::where('id_estudiante', $id)->first();
            if (!$estudiante) {
                return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado.');
            }

            $estudiante->update([
                'estado' => $toUpper($request->estado),
                'rude' => $toUpper($request->rude),
                'ci' => $toUpper($request->ci),
                'nombres' => $toUpper($request->nombres),
                'appaterno' => $toUpper($request->appaterno),
                'apmaterno' => $toUpper($request->apmaterno),
                'genero' => $toUpper($request->genero),
                'fecha_nacimiento' => $toUpper($request->fecha_nacimiento),
                'observacion' => $toUpper($request->observacion),
            ]);

            $codigoEstudiante = $toUpper($request->codigo);
            $gestionActual = session('gestion_activa');
            $idCursoNuevo = $idCurso;

            $inscripcion = DB::table('inscripciones')
                ->where('id_estudiante', $codigoEstudiante)
                ->where('id_gestion', $gestionActual)
                ->first();

            if (!$inscripcion) {

                DB::table('inscripciones')->insert([
                    'id_estudiante' => $codigoEstudiante,
                    'id_curso' => $idCursoNuevo,
                    'id_gestion' => $gestionActual,
                ]);
            } else {

                DB::table('inscripciones')
                    ->where('id_estudiante', $codigoEstudiante)
                    ->where('id_gestion', $gestionActual)
                    ->update([
                        'id_curso' => $idCursoNuevo,
                    ]);
            }



            return redirect()->route('estudiante.index')->with('success', 'El estudiante se actualizó satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al actualizar el estudiante: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $estudiante = Estudiante::find($id);
            if (!$estudiante) {
                return redirect()->route('estudiante.index')->with('error', 'Estudiante no encontrado.');
            }
            $estudiante->delete();
            return redirect()->route('estudiante.index')->with('success', 'El estudiante fue eliminado satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('estudiante.index')->with('error', 'Ocurrió un error al eliminar el estudiante: ' . $e->getMessage());
        }
    }
    public function estudiantexcurso(string $id)
    {
        // Ejemplo de consulta con join
            $estudiantes = Inscripcion::where('id_curso', $id)
                ->with('estudiante')
                ->where('id_gestion', session('gestion_activa'))
                ->get()
                ->pluck('estudiante');

        $curso = Curso::where('id', $id)->first();


        // Enviar datos a estudiante/estudiantexcurso.blade.php
        return view('estudiante.estudiantexcurso', compact('estudiantes', 'curso'));
    }

    public function estudiantexasistencia(string $id)
    {
        // Ejemplo de consulta con join
            $estudiantes = Inscripcion::where('id_curso', $id)
                ->with('estudiante')
                ->where('id_gestion', session('gestion_activa'))
                ->get()
                ->pluck('estudiante');

        $curso = Curso::where('id', $id)->first();

        return view('curso.cursoxasistencia', compact('estudiantes', 'curso'));
    }
    /**
     * Genera un PDF con el listado de estudiantes de un curso
     */
    public function reportePDF(string $id)
    {
        $estudiantes = Inscripcion::where('id_curso', $id)
            ->with('estudiante')
            ->where('id_gestion', session('gestion_activa'))
            ->get()
            ->pluck('estudiante');

        $curso = Curso::where('id', $id)->first();

        $pdf = Pdf::loadView('estudiante.reporte_pdf', compact('curso', 'estudiantes'));

        $fileName = 'listado_' . ($curso->display_name ?? 'curso') . '.pdf';

        return $pdf->stream($fileName);
    }

    /**
     * Obtiene todos los estudiantes en formato JSON
     */
    public function getAllEstudiantes()
    {
        //$estudiantes = Estudiante::all();
        $gestion = session('gestion_activa');

        $estudiantes = Estudiante::whereDoesntHave('inscripciones', function ($query) use ($gestion) {
            $query->where('id_gestion', $gestion);
        })
            ->orderBy('appaterno', 'asc')
            ->get();

        return response()->json($estudiantes);
    }

    /**
     * Inscribe múltiples estudiantes en un curso
     */
    public function inscribirMultiples(Request $request)
    {
        try {
            $estudianteIds = $request->input('estudiante_ids', []);
            $idCurso = $request->input('id_curso');
            $idGestion = session('gestion_activa');

            if (empty($estudianteIds) || !$idCurso || !$idGestion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Datos incompletos para realizar la inscripción'
                ], 400);
            }

            $inscritos = 0;
            $errores = [];

            foreach ($estudianteIds as $idEstudiante) {
                try {
                    // Verificar si ya existe una inscripción
                    $existe = Inscripcion::where('id_estudiante', $idEstudiante)
                        ->where('id_curso', $idCurso)
                        ->where('id_gestion', $idGestion)
                        ->exists();

                    if (!$existe) {
                        Inscripcion::create([
                            'id_estudiante' => $idEstudiante,
                            'id_curso' => $idCurso,
                            'id_gestion' => $idGestion
                        ]);
                        $inscritos++;
                    }
                } catch (\Exception $e) {
                    $errores[] = "Error al inscribir estudiante $idEstudiante: " . $e->getMessage();
                }
            }

            return response()->json([
                'success' => true,
                'inscritos' => $inscritos,
                'errores' => $errores,
                'message' => "$inscritos estudiante(s) inscrito(s) correctamente"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la inscripción: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cambiar el género del estudiante al inverso
     */
    public function cambiarGenero($id)
    {
        try {
            $estudiante = Estudiante::findOrFail($id);

            // Cambiar el género al inverso
            $estudiante->genero = $estudiante->genero === 'M' ? 'F' : 'M';
            $estudiante->save();

            return response()->json([
                'success' => true,
                'genero' => $estudiante->genero,
                'message' => 'Género actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el género: ' . $e->getMessage()
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buscar = request()->get('buscar');

        // Carga inscripciones y el curso asociado para cada estudiante ademas hacemos el filtro de busqueda
        $estudiantes = Estudiante::with('inscripciones.curso')
            ->when($buscar, function ($query, $buscar) {
                $query->whereRaw("UPPER(CONCAT(nombres, ' ', appaterno, ' ', apmaterno)) LIKE ?", ['%' . strtoupper($buscar) . '%'])
                    ->orWhereRaw("UPPER(id_estudiante) LIKE ?", ['%' . strtoupper($buscar) . '%'])
                    ->orWhereRaw("UPPER(ci) LIKE ?", ['%' . strtoupper($buscar) . '%']);
            })
            ->orderBy('appaterno', 'asc')
            ->get();

        $estadisticas = Curso::withCount([
            // HOMBRES EFECTIVOS
            'inscripciones as hombres_efectivos' => function ($q) {
                $q->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'M')
                        ->where('estado', 'E');
                });
            },

            // MUJERES EFECTIVAS
            'inscripciones as mujeres_efectivas' => function ($q) {
                $q->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'F')
                        ->where('estado', 'E');
                });
            },

            // HOMBRES RETIRADOS
            'inscripciones as hombres_retirados' => function ($q) {
                $q->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'M')
                        ->where('estado', 'R');
                });
            },

            // MUJERES RETIRADAS
            'inscripciones as mujeres_retiradas' => function ($q) {
                $q->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'F')
                        ->where('estado', 'R');
                });
            },

            // HOMBRES ABANDONO
            'inscripciones as hombres_abandono' => function ($q) {
                $q->whereHas('estudiante', function ($q) {
                    $q->where('genero', 'M')
                        ->where('estado', 'A');
                });
            },

            // MUJERES ABANDONO
            'inscripciones as mujeres_abandono' => function ($q) {
                $q->whereHas('estudiante', function ($q) {
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
                'gestion' => date('Y'), // o cualquier otro valor predeterminado
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
            DB::table('inscripciones')->insert([
                'id_estudiante' => $row[0] ?? null,
                'id_curso' => $idCurso,
                'id_gestion' => session('gestion_activa'), // o cualquier otro valor predeterminado
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
            $gestionActual = date('Y');
            $idCursoNuevo = $idCurso;

            $inscripcion = DB::table('inscripciones')
                ->where('id_estudiante', $codigoEstudiante)
                ->where('gestion', $gestionActual)
                ->first();

            if (!$inscripcion) {

                DB::table('inscripciones')->insert([
                    'id_estudiante' => $codigoEstudiante,
                    'id_curso' => $idCursoNuevo,
                    'gestion' => $gestionActual,
                ]);
            } else {

                DB::table('inscripciones')
                    ->where('id_estudiante', $codigoEstudiante)
                    ->where('gestion', $gestionActual)
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
}

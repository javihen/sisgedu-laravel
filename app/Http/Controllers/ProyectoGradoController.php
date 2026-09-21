<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Profesor;
use App\Models\ProyectoGrado;
use App\Models\ProyectoEstudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoGradoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DESDE AQUI COMENZAREMOS CON LA PAGINA DE INICIO
        /* $estudiantes = Estudiante::with([
            'proyectos',
        ])->get(); */
        $id = 'C26';
        $proyectos = Estudiante::with('proyectoGrado.tutor')
            ->where('estado', 'E')
            ->whereHas('inscripciones', function ($query) use ($id) {
                $query->where('id_curso', 'LIKE', $id.'%');
            })->orderBy('nombres', 'asc')
            ->get();

            /** Listar a los estudiantes que no esten registrados en proyectos */

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
                ->from('proyectos_grado as p')
                ->whereColumn('p.idEstudiante', 'i.id_estudiante');
        })
        ->orderby('e.nombres', 'asc')
        ->get();

        return view(
            'proyectoGrado.index',
            compact('proyectos', 'estudiantesDisponibles')
        );





    }

    public function searchXCurso(string $id)
    {
        // Se listara a los proyectos de grado por curso y con sus estudiantes y tutor
        $proyectos = Estudiante::with('proyectoGrado.tutor')
            ->where('estado', 'E')
            ->whereHas('inscripciones', function ($query) use ($id) {
                $query->where('id_curso', $id);
            })->orderBy('nombres', 'asc')
            ->get();

        return view(
            'proyectoGrado.index',
            compact('proyectos')
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

        if (!$idCurso && $request->filled('idEstudiante')) {
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
            'lineaInvestigacion' => 'nullable|string|max:150',
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
                'lineaInvestigacion' => $request->lineaInvestigacion,
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

        /** Listar a todos los estudiantes que este inscritos en el grado 6to de la presente gestion que no esten registrados en la proyectos de grado */


        /**  */






    }
}

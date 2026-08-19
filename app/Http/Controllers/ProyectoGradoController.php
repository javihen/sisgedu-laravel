<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Gestion;
use App\Models\Profesor;
use App\Models\ProyectoGrado;
use Illuminate\Http\Request;

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

        return view(
            'proyectoGrado.index',
            compact('proyectos')
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
        // Se enviaran los datos a ser registrado en la tabla
        $request->validate([
            'idEstudiante' => 'required|string',
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

        ProyectoGrado::create([
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
        $id = 'C26B';

        $estudiantes = Estudiante::with('proyectoGrado')
            ->whereHas('inscripciones', function ($query) use ($id) {
                $query->where('id_curso', $id);
            })
            ->get();

        /* $estudiantes2 = DB::table('inscripciones')
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
            ->get(); */
        $proyectos = Estudiante::with('proyectoGrado.tutor')
            ->whereHas('inscripciones', function ($query) use ($id) {
                $query->where('id_curso', $id);
            })->orderBy('nombres', 'asc')
            ->get();
        dd($proyectos);

        dd([
            'idProyecto' => $estudiante->proyectoGrado->idProyecto,
            'idProfesorTutor' => $estudiante->proyectoGrado->idProfesorTutor,
        ]);

    }
}

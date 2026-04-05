<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Curso;
use App\Models\Gestion;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Http\Request;

class AsignacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validación manual para redirigir de vuelta con errores
        if (!$request->id_profesor) {
            return redirect()->back()->withErrors(['id_profesor' => 'Debe seleccionar un docente.']);
        }
        if (!$request->id_materia) {
            return redirect()->back()->withErrors(['id_materia' => 'Debe seleccionar una materia.']);
        }
        if (empty($request->idcurso)) {
            return redirect()->back()->withErrors(['idcurso' => 'Debe seleccionar al menos un curso.']);
        }

        try{
            $id = $request->id_profesor;

            // Asegurar que idcurso sea siempre un array
            $cursos = is_array($request->idcurso) ? $request->idcurso : [$request->idcurso];

            $asignacionesCreadas = 0;
            $errores = [];

            foreach($cursos as $idcurso) {
                $asignacionExistente = Asignacion::where('idcurso', $idcurso)
                    ->where('id_materia', $request->id_materia)
                    ->where('id_gestion', session('gestion_activa'))
                    ->first();

                if(!$asignacionExistente) {
                    Asignacion::create([
                        'id_profesor'=>$request->id_profesor,
                        'idcurso'=>$idcurso,
                        'id_materia'=>$request->id_materia,
                        'id_gestion'=> session('gestion_activa'),
                    ]);
                    $asignacionesCreadas++;
                } else {
                    $profesorAsignado = $asignacionExistente->profesor->nombres . ' ' . $asignacionExistente->profesor->appaterno . ' ' . $asignacionExistente->profesor->apmaterno;
                    $errores[] = 'La materia ya está asignada al profesor ' . $profesorAsignado . ' en el curso ' . $asignacionExistente->curso->display_name;
                }
            }

            if($asignacionesCreadas > 0) {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => 'Bien hecho!',
                    'text' => 'Se registraron ' . $asignacionesCreadas . ' asignaciones con éxito.' . (!empty($errores) ? ' Algunas ya existían.' : '')
                ]);
            }

            if(!empty($errores)) {
                session()->flash('swal', [
                    'icon' => 'info',
                    'title' => 'Información',
                    'text' => implode(' ', $errores)
                ]);
            }

            return redirect()->route('profesor.perfil', $id);
        }catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Disculpa!',
                'text' => 'Tuvimos un problema al registrar las asignaciones.'
            ]);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Asignacion $asignacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignacion $asignacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asignacion $asignacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($asignacion)
    {
        $asig = Asignacion::findOrFail($asignacion);
        $id = $asig->id_profesor;
        try {
            $asig->delete();
            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Genial!!',
                'text' => 'Asignacion eliminada exitosamente.'
            ]);
            return redirect()->route('profesor.perfil',$id);
        } catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Que mal!',
                'text' => 'Error al borrar la asignacion.'
            ]);
            return redirect()->route('profesor.perfil', $id)->with('error', 'Error al eliminar el profesor: ' . $e->getMessage());
        }
    }

    public function asignacionxcurso(Request $request)
    {
        $profesores = Profesor::where('estado', 1)->get();
        $materias = Materia::all();
        $niveles = [
            0 => 'Inicial en Familia Comunitaria',
            1 => 'Primaria Comunitaria Vocacional',
            2 => 'Secundaria Comunitaria Productiva',
        ];

        $turnos = [
            'M' => 'Mañana',
            'T' => 'Tarde'
        ];

        $selectedTurno = $request->query('turno', '');
        $selectedNivel = $request->query('nivel', '');
        $selectedMateria = $request->query('id_materia', '');

        if ($selectedNivel !== '' && $selectedMateria !== '') {
            $existeMateria = Materia::where('id_materia', $selectedMateria)
                ->where('nivel', $selectedNivel)
                ->exists();

            if (! $existeMateria) {
                $selectedMateria = '';
            }
        }

        $cursos = collect();

        if ($selectedTurno !== '' && $selectedNivel !== '') {
            if ($selectedMateria !== '') {
                $cursos = Curso::where('turno', $selectedTurno)
                    ->where('nivel', $selectedNivel)
                    ->with(['asignaciones' => function($q) use ($selectedMateria) {
                        $q->where('id_materia', $selectedMateria)
                          ->where('id_gestion', session('gestion_activa'))
                          ->with('profesor');
                    }])
                    ->get();
            } else {
                $cursos = Curso::where('turno', $selectedTurno)
                    ->where('nivel', $selectedNivel)
                    ->get();
            }
        }

        // Datos para el árbol dinámico
        $cursosTree = Curso::all()->groupBy(['turno', 'nivel', 'grado', 'paralelo']);

        return view('curso.asignacionxcurso', [
            'profesores' => $profesores,
            'materias' => $materias,
            'niveles' => $niveles,
            'turnos' => $turnos,
            'cursos' => $cursos,
            'selectedTurno' => $selectedTurno,
            'selectedNivel' => $selectedNivel,
            'selectedMateria' => $selectedMateria,
            'cursosTree' => $cursosTree
        ]);
    }
}

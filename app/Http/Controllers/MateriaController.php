<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Profesor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inicial = Materia::where('nivel', 0)
            ->orderBy('orden', 'asc')
            ->get();
        $primaria = Materia::where('nivel', 1)
            ->orderBy('orden', 'asc')
            ->get();
        $secundaria = Materia::where('nivel', 2)
            ->orderBy('orden', 'asc')
            ->get();

        return view('materia.index', compact('inicial', 'primaria', 'secundaria'));


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
        $request->validate([
            'id_materia' => 'required|unique:materias,id_materia',
            'nivel' => 'required',
            'campo' => 'required',
            'area' => 'required',
            'abreviatura' => 'required',
            'orden' => 'required|integer',
        ]);
        try {

        Materia::create([
            'id_materia' => $request->id_materia,
            'nivel' => $request->nivel,
            'campo' => $request->campo,
            'area' => $request->area,
            'abreviatura' => $request->abreviatura,
            'orden' => $request->orden,
        ]);

        return redirect()->route('materia.index')->with('success', 'Materia creada exitosamente.');

        } catch (\Exception $e) {
            return redirect()->route('materia.index')->with('error', 'Error al crear la materia: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Materia $materia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materia $materia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try{
        $materia = Materia::findOrFail($id);
        if ($materia)
        $materia->delete();
        return redirect()->route('materia.index')->with('success', 'La materia fue eliminado satisfactoriamente.');
        } catch (\Exception $e) {
            return redirect()->route('materia.index')->with('error', 'Ocurrió un error al eliminar la materia: ' . $e->getMessage());
        }
    }

    public function getMateriasByNivel($nivel){
        $materias = Materia::where('nivel', (int)$nivel)->orderBy('orden', 'asc')->get()->map(function($materia){
            return [
                'idMateria' => $materia->id_materia,
                'nombreMateria' => $materia->area,
            ];
        });
        return response()->json($materias);
    }

    public function asignacion(Request $request){
        // Datos base para el formulario
        $profesores = Profesor::all();

        $selectedTurno = $request->query('turno', '');
        $selectedNivel = $request->query('nivel', '');
        $selectedMateria = $request->query('id_materia', '');

        $materias = Materia::when($selectedNivel !== '', function ($query) use ($selectedNivel) {
            return $query->where('nivel', $selectedNivel);
        })->orderBy('orden', 'asc')->get();

        $niveles = [
            0 => 'Inicial En familia comunitaria',
            1 => 'Primaria Comunitaria Vocacional',
            2 => 'Secundaria Comunitaria Productiva'
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

    public function asignacion1(Request $request){
        // Datos base para el formulario
        $profesores = Profesor::all();

        $selectedTurno = $request->query('turno', '');
        $selectedNivel = $request->query('nivel', '');
        $selectedMateria = $request->query('id_materia', '');

        $materias = Materia::when($selectedNivel !== '', function ($query) use ($selectedNivel) {
            return $query->where('nivel', $selectedNivel);
        })->orderBy('orden', 'asc')->get();

        $niveles = [
            0 => 'Inicial En familia comunitaria',
            1 => 'Primaria Comunitaria Vocacional',
            2 => 'Secundaria Comunitaria Productiva'
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

        return view('materia.asignacion', compact('profesores', 'materias', 'niveles', 'turnos', 'cursos', 'selectedTurno', 'selectedNivel', 'selectedMateria'));
    }
}

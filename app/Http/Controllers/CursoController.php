<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$cursos = curso::all();                  /* Obtiene todas las tuplas de la tabla Cursos de la BD */

        $Minicial = Curso::where('nivel', 0)->where('turno', 'M')->orderBy('grado')->orderBy('paralelo')->get();
        $Tinicial = Curso::where('nivel', 0)->where('turno', 'T')->orderBy('grado')->orderBy('paralelo')->get();
        $Mprimaria = Curso::where('nivel', 1)->where('turno', 'M')->orderBy('grado')->orderBy('paralelo')->get();
        $Tprimaria = Curso::where('nivel', 1)->where('turno', 'T')->orderBy('grado')->orderBy('paralelo')->get();
        $Msecundaria = Curso::where('nivel', 2)->where('turno', 'M')->orderBy('grado')->orderBy('paralelo')->get();
        $Tsecundaria = Curso::where('nivel', 2)->where('turno', 'T')->orderBy('grado')->orderBy('paralelo')->get();
        return view('curso.index', compact('Minicial', 'Tinicial', 'Mprimaria', 'Tprimaria', 'Msecundaria', 'Tsecundaria'));              /* Retorna el frontend de curso con la variable donde se guardara todas las tuplas */
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
}

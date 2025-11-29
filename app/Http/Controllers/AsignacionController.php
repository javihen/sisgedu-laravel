<?php

namespace App\Http\Controllers;

use App\Models\Asignacion;
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
        $id = $request->idprofesor;
        $toUpper = fn($v) => $v === null ? null : mb_strtoupper(trim($v), 'UTF-8');
        try{
            $request->validate([
                'idprofesor'=>'required',
                'idcurso'=>'required',
                'idmateria'=>'required',
            ]);
            $asignacion=Asignacion::where('id_profesor', $request->idprofesor)->where('idcurso',$request->idcurso)->where('id_materia',$request->idmateria)->get();
            if($asignacion->isEmpty()){
            Asignacion::create([
                'id_profesor'=>$request->idprofesor,
                'idcurso'=>$request->idcurso,
                'id_materia'=>$request->idmateria,
                'gestion'=>'2025',
            ]);
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => 'Bien hecho!',
                    'text' => 'Se registro la asignacion con exito.'
                ]);
            return redirect()->route('profesor.perfil', $id);
            }else{
                $profesorAsignado = Asignacion::with('profesor')
                ->where('idcurso', $request->idcurso)
                ->where('id_materia', $request->idmateria)
                ->first();
                    $nombreProfesor = $profesorAsignado->profesor->nombres . ' ' . $profesorAsignado->profesor->appaterno.' '.$profesorAsignado->profesor->apmaterno;
                session()->flash('swal', [
                    'icon' => 'info',
                    'title' => 'La materia ya fue asignada!',
                    'text' => 'El profesor(a) '.$nombreProfesor.' da la clase de '.$toUpper($profesorAsignado->materia->area).' .'
                ]);
                    return redirect()->route('profesor.perfil', $id);

            }
        }catch (\Exception $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'DiScUlPa!',
                'text' => 'Tuvimos un problema al registrar la asignacion.'
            ]);
            return redirect()->route('profesor.perfil', $id)->with('error', $e);
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
    public function destroy(Asignacion $asignacion)
    {
        //
    }
}

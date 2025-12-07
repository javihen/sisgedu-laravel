<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gestiones = Gestion::orderBy('anio','asc')->get();
        return view('panel', compact('gestiones'));
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
        try {

        $request->validate([
            'fechaI' => 'required',
            'fechaF' => 'required',
            'anio' => 'required',
        ]);

        Gestion::create([
            'anio' => $request->anio,
            'fechaI' => $request->fechaI,
            'fechaF' => $request->fechaF,
        ]);
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'la gestion se ha creado exitosamente.'
        ]);
        return redirect()->route('panel');

        } catch (\Exception $e) {
            session()->flash('swal', [
            'icon' => 'error',
            'title' => 'Que mal!',
            'text' => 'Error al crear la gestion crear el profesor.'
        ]);
            return redirect()->route('panel')->with('error', 'Error al crear el profesor: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Gestion $gestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gestion $gestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gestion $gestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gestion $gestion)
    {
        //
    }

    public function cambiarEstado($id)
    {
        try{
            Gestion::query()->update(['estado' => 'I']);
            $gestion = Gestion::findOrFail($id);
            $gestion->estado = 'A';
            $gestion->save();
            session(['gestion_activa' => $gestion->id_gestion]);
            session(['gestion' => $gestion->anio]);
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '.: Gestion '.$gestion->anio.' :.',
                'text' => 'la gestion se activo exitosamente.'
            ]);
            return back();
        }catch(\exception $e){
            return back()->with('error', 'tuvimos un problema');
        }


    }
}

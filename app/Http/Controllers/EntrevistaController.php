<?php

namespace App\Http\Controllers;

use App\Models\Entrevista;
use App\Models\Compromiso;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EntrevistaController extends Controller
{
    /**
     * Listar todas las entrevistas
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $entrevistas = Entrevista::with('estudiante', 'profesor')
            ->orderBy('fecha', 'desc')
            ->paginate(15);

        return view('entrevista.index', compact('entrevistas'));
    }

    /**
     * Mostrar formulario de creación de entrevista
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $estudiantes = Estudiante::all();

        return view('entrevista.create', compact('estudiantes'));
    }

    /**
     * Guardar una entrevista y sus compromisos asociados
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar datos de la entrevista
        $validated = $request->validate([
            'idEstudiante' => 'required|string|exists:estudiantes,id_estudiante',
            'idProfesor' => 'required|integer|exists:profesores,id_profesor',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'observaciones' => 'nullable|string',
            'acuerdos' => 'nullable|string',
            'asistio' => 'required|boolean',
            // Compromisos arrays
            'descripcion' => 'nullable|array',
            'descripcion.*' => 'string',
            'responsable' => 'nullable|array',
            'responsable.*' => 'string',
            'fechaLimite' => 'nullable|array',
            'fechaLimite.*' => 'date',
        ]);

        try {
            // Crear la entrevista
            $entrevista = Entrevista::create([
                'idEstudiante' => $validated['idEstudiante'],
                'idProfesor' => $validated['idProfesor'],
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'observaciones' => $validated['observaciones'] ?? null,
                'acuerdos' => $validated['acuerdos'] ?? null,
                'asistio' => $validated['asistio'],
            ]);

            // Guardar compromisos si existen
            if (!empty($validated['descripcion'])) {
                foreach ($validated['descripcion'] as $key => $descripcion) {
                    if ($descripcion) { // Solo crear si hay descripción
                        Compromiso::create([
                            'idEntrevista' => $entrevista->idEntrevista,
                            'descripcion' => $descripcion,
                            'responsable' => $validated['responsable'][$key] ?? null,
                            'fechaLimite' => $validated['fechaLimite'][$key] ?? null,
                            'estado' => 'pendiente',
                        ]);
                    }
                }
            }

            return redirect()->route('entrevistas.show', $entrevista->idEntrevista)
                ->with('success', 'Entrevista registrada correctamente');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al guardar la entrevista: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar detalles de una entrevista
     *
     * @param Entrevista $entrevista
     * @return \Illuminate\View\View
     */
    public function show(Entrevista $entrevista)
    {
        $entrevista->load('estudiante', 'profesor', 'compromisos');

        return view('entrevista.show', compact('entrevista'));
    }

    /**
     * Mostrar formulario de edición
     *
     * @param Entrevista $entrevista
     * @return \Illuminate\View\View
     */
    public function edit(Entrevista $entrevista)
    {
        $estudiantes = Estudiante::all();
        $entrevista->load('compromisos');

        return view('entrevista.edit', compact('entrevista', 'estudiantes'));
    }

    /**
     * Actualizar una entrevista
     *
     * @param \Illuminate\Http\Request $request
     * @param Entrevista $entrevista
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Entrevista $entrevista)
    {
        $validated = $request->validate([
            'idEstudiante' => 'required|string|exists:estudiantes,id_estudiante',
            'idProfesor' => 'required|integer|exists:profesores,id_profesor',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'observaciones' => 'nullable|string',
            'acuerdos' => 'nullable|string',
            'asistio' => 'required|boolean',
            'descripcion' => 'nullable|array',
            'descripcion.*' => 'string',
            'responsable' => 'nullable|array',
            'responsable.*' => 'string',
            'fechaLimite' => 'nullable|array',
            'fechaLimite.*' => 'date',
        ]);

        try {
            $entrevista->update([
                'idEstudiante' => $validated['idEstudiante'],
                'idProfesor' => $validated['idProfesor'],
                'fecha' => $validated['fecha'],
                'hora' => $validated['hora'],
                'observaciones' => $validated['observaciones'] ?? null,
                'acuerdos' => $validated['acuerdos'] ?? null,
                'asistio' => $validated['asistio'],
            ]);

            // Eliminar compromisos anteriores y crear nuevos
            $entrevista->compromisos()->delete();

            if (!empty($validated['descripcion'])) {
                foreach ($validated['descripcion'] as $key => $descripcion) {
                    if ($descripcion) {
                        Compromiso::create([
                            'idEntrevista' => $entrevista->idEntrevista,
                            'descripcion' => $descripcion,
                            'responsable' => $validated['responsable'][$key] ?? null,
                            'fechaLimite' => $validated['fechaLimite'][$key] ?? null,
                            'estado' => 'pendiente',
                        ]);
                    }
                }
            }

            return redirect()->route('entrevistas.show', $entrevista->idEntrevista)
                ->with('success', 'Entrevista actualizada correctamente');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error al actualizar la entrevista: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar una entrevista
     *
     * @param Entrevista $entrevista
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Entrevista $entrevista)
    {
        try {
            $entrevista->compromisos()->delete();
            $entrevista->delete();

            return redirect()->route('entrevistas.index')
                ->with('success', 'Entrevista eliminada correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar la entrevista: ' . $e->getMessage());
        }
    }
}



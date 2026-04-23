<?php

namespace App\Http\Controllers;

use App\Models\Entrevista;
use App\Models\Compromiso;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EntrevistaController extends Controller
{
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
}


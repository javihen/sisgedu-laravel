<?php

namespace App\Http\Controllers;

use App\Models\Citacion;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Gestion;
use App\Models\Profesor;
use App\Imports\CitacionImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CitacionController extends Controller
{
    /**
     * Display a listing of the resource with active gestion
     */
    public function index()
    {
        // Obtener la gestión activa
        $gestionActiva = Gestion::where('estado', 'A')->first();

        // Filtrar citaciones por gestión activa
        $query = Citacion::with(['estudiante', 'profesor', 'materia', 'curso', 'gestion'])
            ->orderBy('fecha', 'desc');

        if ($gestionActiva) {
            $query->where('idGestion', $gestionActiva->id_gestion);
        }

        $citaciones = $query->get();

        return view('citacion.index', compact('citaciones', 'gestionActiva'));
    }

    /**
     * Show the form for importing citaciones
     */
    public function showImportForm()
    {
        $cursos = Curso::all();
        $gestiones = Gestion::where('estado', 'A')->get();
        $profesores = Profesor::all();

        return view('citacion.import', compact('cursos', 'gestiones', 'profesores'));
    }

    /**
     * Import citaciones from Excel
     */
    public function import(Request $request)
    {
        try {
            // Validar los datos del formulario
            $request->validate([
                'archivo' => 'required|file|mimes:xlsx,xls,csv',
                'idProfesor' => 'required|integer|exists:profesores,id_profesor',
                'idCurso' => 'required|string|exists:cursos,id',
                'idGestion' => 'required|integer|exists:gestiones,id_gestion',
                'fecha' => 'required|date',
                'hora' => 'required|date_format:H:i',
                'motivo' => 'nullable|string|max:255',
                'periodo' => 'nullable|string|max:255',
                'tipo' => 'required|in:individual,grupal',
            ]);

            $file = $request->file('archivo');
            $idProfesor = '1';
            $idGestion = $request->idGestion;
            $idCurso = $request->idCurso;
            $fecha = $request->fecha;
            $hora = $request->hora;
            $motivo = $request->motivo;
            $periodo = $request->periodo;
            $tipo = $request->tipo;

            // Ejecutar la importación
            $importer = new CitacionImport($idProfesor, $idGestion, $idCurso, $fecha, $hora, $motivo, $periodo, $tipo);
            $importer->import($file);

            return redirect()->route('citacion.index')
                ->with('success', 'Citaciones importadas correctamente.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al importar las citaciones: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'idEstudiante' => 'required|string|exists:estudiantes,id_estudiante',
            'idCurso' => 'required|string|exists:cursos,id',
            'idProfesor' => 'required|integer|exists:profesores,id_profesor',
            'idMateria' => 'required|integer|exists:materias,id_materia',
            'idGestion' => 'required|integer|exists:gestiones,id_gestion',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string|max:255',
            'periodo' => 'nullable|string|max:255',
            'tipo' => 'required|in:individual,grupal',
        ]);

        Citacion::create($request->all());

        return redirect()->route('citacion.index')
            ->with('success', 'Citación creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Citacion $citacion)
    {
        return view('citacion.show', compact('citacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Citacion $citacion)
    {
        $cursos = Curso::all();
        $profesores = \App\Models\Profesor::all();
        $materias = Materia::all();
        $gestiones = Gestion::all();

        return view('citacion.edit', compact('citacion', 'cursos', 'profesores', 'materias', 'gestiones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citacion $citacion)
    {
        $request->validate([
            'idEstudiante' => 'required|string|exists:estudiantes,id_estudiante',
            'idCurso' => 'required|string|exists:cursos,id',
            'idProfesor' => 'required|integer|exists:profesores,id_profesor',
            'idMateria' => 'required|integer|exists:materias,id_materia',
            'idGestion' => 'required|integer|exists:gestiones,id_gestion',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'motivo' => 'required|string|max:255',
            'periodo' => 'nullable|string|max:255',
            'tipo' => 'required|in:individual,grupal',
        ]);

        $citacion->update($request->all());

        return redirect()->route('citacion.index')
            ->with('success', 'Citación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citacion $citacion)
    {
        $citacion->delete();

        return redirect()->route('citacion.index')
            ->with('success', 'Citación eliminada correctamente.');
    }

    /**
     * Generate PDF for a specific course
     */
    public function generarPDFCurso($idCurso)
    {
        try {
            // Obtener el curso
            $curso = Curso::findOrFail($idCurso);

            // Obtener la gestión activa
            $gestionActiva = Gestion::where('estado', 'A')->first();

            // Obtener citaciones del curso en gestión activa
            $citaciones = Citacion::with(['estudiante', 'profesor', 'materia'])
                ->where('idCurso', $idCurso)
                ->where('idGestion', $gestionActiva->id_gestion ?? 0)
                ->orderBy('fecha', 'asc')
                ->get();

            if ($citaciones->isEmpty()) {
                return redirect()->route('citacion.index')
                    ->with('error', 'No hay citaciones para este curso.');
            }

            $pdf = Pdf::loadView('citacion.pdf-curso', [
                'curso' => $curso,
                'citaciones' => $citaciones,
                'gestion' => $gestionActiva,
            ]);

            return $pdf->download("citaciones_{$idCurso}_" . date('Y-m-d') . ".pdf");

        } catch (\Exception $e) {
            return redirect()->route('citacion.index')
                ->with('error', 'Error al generar PDF: ' . $e->getMessage());
        }
    }

    /**
     * Generate PDF for all citaciones (general)
     */
    public function generarPDFGeneral()
    {
        try {
            // Obtener la gestión activa
            $gestionActiva = Gestion::where('estado', 'A')->first();

            // Obtener todas las citaciones en gestión activa
            $citaciones = Citacion::with(['estudiante', 'profesor', 'materia', 'curso'])
                ->where('idGestion', $gestionActiva->id_gestion ?? 0)
                ->orderBy('fecha', 'asc')
                ->get();

            if ($citaciones->isEmpty()) {
                return redirect()->route('citacion.index')
                    ->with('error', 'No hay citaciones para generar PDF.');
            }

            // Agrupar por curso
            $citacionesPorCurso = $citaciones->groupBy('idCurso');

            $pdf = Pdf::loadView('citacion.pdf-general', [
                'citacionesPorCurso' => $citacionesPorCurso,
                'gestion' => $gestionActiva,
                'totalCitaciones' => $citaciones->count(),
            ]);

            return $pdf->download("citaciones_general_" . date('Y-m-d') . ".pdf");

        } catch (\Exception $e) {
            return redirect()->route('citacion.index')
                ->with('error', 'Error al generar PDF: ' . $e->getMessage());
        }
    }

    /**
     * Generate PDF for estudiante (citaciones por estudiante)
     */
    public function generarPDFEstudiante($idEstudiante)
    {
        try {
            // Obtener el estudiante
            $estudiante = \App\Models\Estudiante::findOrFail($idEstudiante);

            // Obtener la gestión activa
            $gestionActiva = Gestion::where('estado', 'A')->first();

            // Obtener citaciones del estudiante
            $citaciones = Citacion::with(['profesor', 'materia', 'curso'])
                ->where('idEstudiante', $idEstudiante)
                ->where('idGestion', $gestionActiva->id_gestion ?? 0)
                ->orderBy('fecha', 'asc')
                ->get();

            if ($citaciones->isEmpty()) {
                return redirect()->route('citacion.index')
                    ->with('error', 'No hay citaciones para este estudiante.');
            }

            $pdf = Pdf::loadView('citacion.pdf-estudiante', [
                'estudiante' => $estudiante,
                'citaciones' => $citaciones,
                'gestion' => $gestionActiva,
            ]);

            return $pdf->download("citaciones_{$idEstudiante}_" . date('Y-m-d') . ".pdf");

        } catch (\Exception $e) {
            return redirect()->route('citacion.index')
                ->with('error', 'Error al generar PDF: ' . $e->getMessage());
        }
    }
}

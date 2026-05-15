<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromedioFinalController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('id_curso');
        $cursoSeleccionado = null;

        if ($courseId) {
            $cursoSeleccionado = Curso::find($courseId);
        }

        $cursosTree = Curso::all()->groupBy(['turno', 'nivel', 'grado', 'paralelo']);
        $resultados = $this->PromedioFinal($courseId);

        $totalEstudiantes = $resultados->count();
        $promedioGeneral = $totalEstudiantes ? round($resultados->avg('promedio_final'), 2) : 0;
        $totalAprobados = $resultados->where('estado', 'APROBADO')->count();
        $totalReprobados = $resultados->where('estado', 'REPROBADO')->count();

        return view('promedios-finales.index', [
            'cursosTree' => $cursosTree,
            'cursoSeleccionado' => $cursoSeleccionado,
            'resultados' => $resultados,
            'totalEstudiantes' => $totalEstudiantes,
            'promedioGeneral' => $promedioGeneral,
            'totalAprobados' => $totalAprobados,
            'totalReprobados' => $totalReprobados,
            'courseId' => $courseId,
        ]);
    }

    public function PromedioFinal(?string $courseId = null)
    {
        $query = Inscripcion::select([
            'estudiantes.id_estudiante',
            DB::raw("CONCAT(estudiantes.nombres, ' ', estudiantes.appaterno, ' ', estudiantes.apmaterno) as nombre_completo"),
            'cursos.nombre_curso as curso',
            DB::raw('gestiones.anio as gestion'),
            DB::raw('COUNT(notas.id) as cantidad_notas'),
            DB::raw('ROUND(COALESCE(AVG(notas.calificacion), 0), 2) as promedio_final'),
            DB::raw("CASE WHEN COALESCE(AVG(notas.calificacion), 0) >= 51 THEN 'APROBADO' ELSE 'REPROBADO' END as estado"),
            'estudiantes.appaterno',
            'estudiantes.apmaterno',
        ])
            ->join('estudiantes', 'inscripciones.id_estudiante', '=', 'estudiantes.id_estudiante')
            ->join('cursos', 'inscripciones.id_curso', '=', 'cursos.id')
            ->join('gestiones', 'inscripciones.id_gestion', '=', 'gestiones.id_gestion')
            ->leftJoin('notas', function ($join) {
                $join->on('notas.id_estudiante', '=', 'inscripciones.id_estudiante')
                    ->on('notas.id_gestion', '=', 'inscripciones.id_gestion');
            })
            ->when($courseId, function ($query, $courseId) {
                return $query->where('inscripciones.id_curso', $courseId);
            })
            ->when(session('gestion_activa'), function ($query, $gestionActiva) {
                return $query->where('inscripciones.id_gestion', $gestionActiva);
            })
            ->groupBy(
                'estudiantes.id_estudiante',
                'estudiantes.nombres',
                'estudiantes.appaterno',
                'estudiantes.apmaterno',
                'cursos.nombre_curso',
                'gestiones.anio'
            )
            ->orderBy('cursos.nombre_curso')
            ->orderBy('estudiantes.appaterno')
            ->orderBy('estudiantes.apmaterno')
            ->get();

        return $query;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Asignacion;
use App\Models\Gestion;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Curso;
use Illuminate\Support\Facades\DB;
use App\Imports\NotasImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class NotaController extends Controller
{
    /**
     * Mostrar formulario de importación
     */
    public function importForm()
    {
        $gestiones = Gestion::all();
        $materias = Materia::all();
        $estudiantes = Estudiante::all();

        return view('notas.import', compact('gestiones', 'materias', 'estudiantes'));
    }

    /**
     * Procesar la importación del archivo Excel
     * Formato: Materias en columnas (F1:P1), Estudiantes en filas (A7:A...)
     */
    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls|max:2048',
            'periodo' => 'required|integer|min:1|max:4',
            'id_gestion' => 'required|integer|exists:gestiones,id_gestion',
        ], [
            'archivo.required' => 'El archivo es obligatorio',
            'archivo.file' => 'El archivo debe ser un archivo válido',
            'archivo.mimes' => 'El archivo debe ser Excel (.xlsx o .xls)',
            'archivo.max' => 'El archivo no debe pesar más de 2MB',
            'periodo.required' => 'El período es obligatorio',
            'periodo.integer' => 'El período debe ser un número',
            'periodo.min' => 'El período debe ser mayor a 0',
            'periodo.max' => 'El período máximo es 4',
            'id_gestion.required' => 'La gestión es obligatoria',
            'id_gestion.exists' => 'La gestión seleccionada no existe',
        ]);

        try {
            // Crear instancia de importador
            $import = new NotasImport(
                $request->input('periodo'),
                $request->input('id_gestion')
            );

            // Procesar archivo
            $rutaArchivo = $request->file('archivo')->getRealPath();
            $import->procesar($rutaArchivo);

            $notasCreadas = $import->getNotasCreadas();
            $errores = $import->getErrores();

            // Preparar mensaje
            $mensaje = "Se importaron exitosamente {$notasCreadas} notas.";
            if (!empty($errores)) {
                $mensaje .= " Se encontraron " . count($errores) . " errores que fueron omitidos.";
            }

            return redirect()->route('notas.import-form')
                ->with('success', $mensaje)
                ->with('errores', $errores);

        } catch (\Exception $e) {
            return redirect()->route('notas.import-form')
                ->with('error', "Error en la importación: {$e->getMessage()}");
        }
    }

    /**
     * Listar todas las notas
     */
    public function index(Request $request)
    {
        $selectedGestion = $request->get('id_gestion', session('gestion_activa'));
        $selectedPeriodo = $request->get('periodo');
        $selectedNivel = $request->get('nivel');

        $gestiones = Gestion::all();
        $periodos = [1 => '1er Bimestre', 2 => '2do Bimestre', 3 => '3er Bimestre', 4 => '4to Bimestre'];
        $niveles = [
            0 => 'Inicial en Familia Comunitaria',
            1 => 'Primaria Comunitaria Vocacional',
            2 => 'Secundaria Comunitaria Productiva',
        ];

        // Inicializar variables vacías por defecto
        $materias = collect();
        $courses = collect();
        $matrix = [];

        // Solo procesar datos si se ha enviado el formulario de búsqueda
        if ($request->has('id_gestion')) {
            // Obtener materias para las columnas (Headers)
            $materiasQuery = Materia::query();
            if ($selectedNivel !== null && $selectedNivel !== '') {
                $materiasQuery->where('nivel', $selectedNivel);
            }
            $materias = $materiasQuery->pluck('area', 'id_materia');

            // Determinar qué cursos mostrar en las filas
            $cursosQuery = Curso::query();
            if ($selectedNivel !== null && $selectedNivel !== '') {
                $cursosQuery->where('nivel', $selectedNivel);
            }
            $courses = $cursosQuery->orderBy('nivel')->orderBy('grado')->orderBy('paralelo')->get()->pluck('display_name', 'id');

            // Construir la matriz de conteo de notas
            $notasQuery = Nota::join('asignaciones', 'notas.idAsignacion', '=', 'asignaciones.idAsignacion')
                ->select('asignaciones.idcurso', 'asignaciones.id_materia', DB::raw('count(*) as total'));

            if ($selectedGestion) $notasQuery->where('notas.id_gestion', $selectedGestion);
            if ($selectedPeriodo) $notasQuery->where('notas.periodo', $selectedPeriodo);

            $results = $notasQuery->groupBy('asignaciones.idcurso', 'asignaciones.id_materia')->get();

            foreach ($results as $row) {
                $matrix[$row->idcurso][$row->id_materia] = $row->total;
            }
        }

        return view('notas.index', compact(
            'gestiones', 'periodos', 'niveles', 'materias', 'courses', 'matrix',
            'selectedGestion', 'selectedPeriodo', 'selectedNivel'
        ));
    }

    /**
     * Mostrar centralizador por curso
     */
    public function showCentralizador(Request $request, $idCurso)
    {
        $selectedGestion = $request->get('id_gestion', session('gestion_activa'));
        $selectedPeriodo = $request->get('periodo');
        $selectedNivel = $request->get('nivel');

        $gestiones = Gestion::all();
        $periodos = [1 => '1er Bimestre', 2 => '2do Bimestre', 3 => '3er Bimestre', 4 => '4to Bimestre'];

        $curso = Curso::findOrFail($idCurso);

        $notasQuery = Nota::with(['estudiante', 'asignacion.materia'])
            ->whereHas('asignacion', function ($query) use ($idCurso) {
                $query->where('idcurso', $idCurso);
            })
            ->when($selectedGestion, function ($query, $selectedGestion) {
                $query->where('id_gestion', $selectedGestion);
            })
            ->when($selectedPeriodo, function ($query, $selectedPeriodo) {
                $query->where('periodo', $selectedPeriodo);
            });

        $notas = $notasQuery->get();

        $materiaIds = Asignacion::where('idcurso', $idCurso)
            ->when($selectedGestion, function ($query, $selectedGestion) {
                $query->where('id_gestion', $selectedGestion);
            })
            ->pluck('id_materia')
            ->unique()
            ->toArray();

        $materias = Materia::whereIn('id_materia', $materiaIds)
            ->orderBy('orden')
            ->get();

        $studentIdsFromNotas = $notas->pluck('id_estudiante')->unique()->toArray();
        $studentIdsFromInscripciones = Estudiante::whereHas('inscripciones', function ($query) use ($idCurso) {
            $query->where('id_curso', $idCurso);
        })->pluck('id_estudiante')->toArray();

        $studentIds = array_values(array_unique(array_merge($studentIdsFromNotas, $studentIdsFromInscripciones)));

        $students = Estudiante::whereIn('id_estudiante', $studentIds)
            ->orderBy('appaterno')
            ->orderBy('apmaterno')
            ->orderBy('nombres')
            ->get();

        $studentNotes = [];
        foreach ($notas as $nota) {
            if ($nota->asignacion && $nota->asignacion->materia) {
                $studentNotes[$nota->id_estudiante][$nota->asignacion->materia->id_materia] = $nota->calificacion;
            }
        }

        return view('notas.centralizador', compact(
            'curso', 'gestiones', 'periodos', 'materias', 'students', 'studentNotes',
            'selectedGestion', 'selectedPeriodo', 'selectedNivel'
        ));
    }

    /**
     * Eliminar notas por periodo y curso
     */
    public function deleteByPeriodo(Request $request)
    {
        $request->validate([
            'id_gestion' => 'required|integer|exists:gestiones,id_gestion',
            'periodo' => 'required|integer|min:1|max:4',
            'id_curso' => 'required|exists:cursos,id',
        ]);

        $idGestion = $request->input('id_gestion');
        $periodo = $request->input('periodo');
        $idCurso = $request->input('id_curso');

        $deleted = Nota::where('id_gestion', $idGestion)
            ->where('periodo', $periodo)
            ->whereHas('asignacion', function ($query) use ($idCurso) {
                $query->where('idcurso', $idCurso);
            })
            ->delete();

        return redirect()->route('notas.index', [
            'id_gestion' => $idGestion,
            'periodo' => $periodo,
            'nivel' => $request->input('nivel'),
        ])->with('success', "Se eliminaron {$deleted} calificaciones del curso seleccionado.");
    }

    /**
     * PASO 2: Subir archivo y obtener lista de hojas
     * POST - Recibe archivo Excel
     * Retorna: JSON con nombres de hojas
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls|max:2048',
        ], [
            'archivo.required' => 'El archivo es obligatorio',
            'archivo.file' => 'El archivo debe ser un archivo válido',
            'archivo.mimes' => 'El archivo debe ser Excel (.xlsx o .xls)',
            'archivo.max' => 'El archivo no debe pesar más de 2MB',
        ]);

        try {
            // Guardar archivo temporalmente
            $archivo = $request->file('archivo');
            $nombreTemporal = 'temp_notas_' . time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();

            // Asegurar que el directorio de destino existe en storage/app/imports
            if (!Storage::disk('local')->exists('imports')) {
                Storage::disk('local')->makeDirectory('imports');
            }

            $rutaArchivo = $archivo->storeAs('imports', $nombreTemporal, 'local');

            if (!$rutaArchivo) {
                throw new \Exception('No se pudo guardar el archivo en el almacenamiento temporal.');
            }

            // Obtener la ruta absoluta real usando el disco local para evitar errores de ruta en Windows
            $rutaAbsoluta = Storage::disk('local')->path($rutaArchivo);

            // Leer hojas del Excel
            $spreadsheet = IOFactory::load($rutaAbsoluta);
            $hojas = [];

            foreach ($spreadsheet->getSheetNames() as $nombreHoja) {
                $hojas[] = $nombreHoja;
            }

            return response()->json([
                'success' => true,
                'archivo' => $rutaArchivo,
                'hojas' => $hojas,
                'mensaje' => 'Archivo cargado correctamente. Se encontraron ' . count($hojas) . ' hojas.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al procesar archivo: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * PASO 3: Obtener preview de una hoja específica
     * POST - Recibe ruta del archivo y nombre de hoja
     * Retorna: JSON con datos de preview (encabezados + primeras 5 filas)
     */
    public function previewSheet(Request $request)
    {
        $request->validate([
            'archivo' => 'required|string',
            'hoja' => 'required|string',
        ]);

        try {
            // Usar Storage::path para obtener la ruta absoluta correcta
            $rutaCompleta = Storage::disk('local')->path($request->input('archivo'));

            if (!Storage::disk('local')->exists($request->input('archivo'))) {
                throw new \Exception('El archivo temporal no existe');
            }

            $spreadsheet = IOFactory::load($rutaCompleta);
            $sheet = $spreadsheet->getSheetByName($request->input('hoja'));

            if (!$sheet) {
                throw new \Exception('La hoja no existe');
            }

            // Obtener encabezados (fila 1)
            $encabezados = [];
            for ($col = 1; $col <= 16; $col++) {
                $valor = $sheet->getCellByColumnAndRow($col, 1)->getValue();
                $encabezados[] = !empty($valor) ? $valor : '';
            }

            // Obtener datos desde la fila 3 hasta la última con nombres
            $datos = [];
            $highestRow = $sheet->getHighestRow();
            for ($row = 3; $row <= $highestRow; $row++) {
                $nombre = $sheet->getCellByColumnAndRow(3, $row)->getValue();

                // Si estamos en la sección de estudiantes (7+) y no hay nombre, paramos el preview
                if ($row >= 7 && (is_null($nombre) || trim((string)$nombre) === '')) {
                    break;
                }

                $fila = [];
                for ($col = 1; $col <= 16; $col++) {
                    $valor = $sheet->getCellByColumnAndRow($col, $row)->getValue();
                    $fila[] = $valor !== null ? $valor : '';
                }
                $datos[] = $fila;
            }

            return response()->json([
                'success' => true,
                'encabezados' => $encabezados,
                'datos' => $datos,
                'totalFilas' => $sheet->getHighestRow(),
                'mensaje' => 'Preview cargado correctamente.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error al obtener preview: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * PASO 4: Importar datos de la hoja seleccionada
     * POST - Recibe archivo, hoja, período y gestión
     * Procesa todas las filas e importa a la base de datos
     */
    public function importData(Request $request)
    {
        $request->validate([
            'archivo' => 'required|string',
            'hoja' => 'required|string',
            'periodo' => 'required|integer|min:1|max:4',
            'id_gestion' => 'required|integer|exists:gestiones,id_gestion',
        ]);

        try {
            // Usar Storage::path para obtener la ruta absoluta correcta
            $rutaCompleta = Storage::disk('local')->path($request->input('archivo'));

            if (!Storage::disk('local')->exists($request->input('archivo'))) {
                throw new \Exception('El archivo temporal no existe');
            }

            // Crear instancia del importador
            $import = new NotasImport(
                $request->input('periodo'),
                $request->input('id_gestion')
            );

            // Procesar específicamente la hoja seleccionada
            $import->procesarHoja($rutaCompleta, $request->input('hoja'));

            $notasCreadas = $import->getNotasCreadas();
            $errores = $import->getErrores();

            // Limpiar archivo temporal
            Storage::delete($request->input('archivo'));

            return response()->json([
                'success' => true,
                'notasCreadas' => $notasCreadas,
                'errores' => $errores,
                'mensaje' => "Se importaron exitosamente {$notasCreadas} notas.",
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error en la importación: ' . $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Descargar plantilla de ejemplo
     */
    public function descargarPlantilla()
    {
        $rutaPlantilla = storage_path('app/notas_plantilla_' . time() . '.xlsx');

        try {
            $this->crearPlantilla($rutaPlantilla);
            return response()->download($rutaPlantilla, 'notas_plantilla.xlsx')->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al generar plantilla: ' . $e->getMessage());
        }
    }

    /**
     * Crear archivo plantilla de ejemplo con formato de matriz
     * Formato:
     * - F1:P1 contienen los IDs de materias
     * - A7:A... contienen los IDs de estudiantes
     * - F7:P... contienen las celdas para notas
     */
    private function crearPlantilla($rutaDestino)
    {
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('1A SECUNDARIA');

        // ===== CELDA B1: ID DEL CURSO (Requerido para la importación) =====
        $sheet->setCellValue('B1', 'ID_DEL_CURSO'); // Aquí debería ir el ID real si el método recibiera el objeto Curso
        $sheet->getStyle('B1')->getFont()->setBold(true)->getColor()->setRGB('FF0000');

        // Obtener algunas materias como ejemplo
        $materias = Materia::limit(11)->get(); // F a P = 11 columnas
        $estudiantes = Estudiante::limit(10)->get(); // A partir de fila 7

        // ===== FILA 1: Encabezados (Título) =====
        $sheet->mergeCells('D2:E2');
        $sheet->setCellValue('D2', '1A SECUNDARIA');
        $sheet->getStyle('D2')->getFont()->setSize(14)->setBold(true);
        $sheet->getStyle('D2')->getFill()->setFillType('solid')->getStartColor()->setRGB('90EE90');
        $sheet->getStyle('D2')->getAlignment()->setHorizontal('center');

        // ===== FILA 3: ASESORES =====
        $sheet->setCellValue('D3', 'ASESORES:');
        $sheet->getStyle('D3')->getFont()->setBold(true);

        // ===== FILA 4-5: Encabezado de tabla =====
        $sheet->setCellValue('C4', 'AREA');
        $sheet->getStyle('C4')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('C4')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00');

        $sheet->setCellValue('C5', 'APELLIDOS Y NOMBRES');
        $sheet->getStyle('C5')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('C5')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFF00');

        // Relleno de IDs de materias en la fila 1
        $col = 6; // Comienza en F (columna 6)
        foreach ($materias as $index => $materia) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);

            // Fila 1: ID de materia
            $sheet->setCellValue($colLetter . '1', $materia->id_materia);
            $sheet->getStyle($colLetter . '1')->getFont()->setBold(true)->setSize(10);

            // Fila 5: Nombre de materia
            $sheet->setCellValue($colLetter . '5', $materia->nombre_materia);
            $sheet->getStyle($colLetter . '5')->getFont()->setBold(true)->setSize(10);
            $sheet->getStyle($colLetter . '5')->getFill()->setFillType('solid')->getStartColor()->setRGB('FFC7CE');
            $sheet->getStyle($colLetter . '5')->getAlignment()->setWrapText(true);

            // Fila 6: "1T" (Trimestre)
            $sheet->setCellValue($colLetter . '6', '1T');
            $sheet->getStyle($colLetter . '6')->getFont()->setBold(true);

            $col++;
        }

        // ===== FILAS 7+: Estudiantes y datos =====
        $row = 7;
        $numeroEstudiante = 1;

        foreach ($estudiantes as $estudiante) {
            // Número correlativo
            $sheet->setCellValue('A' . $row, $numeroEstudiante);
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal('center');

            // ID de estudiante
            $sheet->setCellValue('B' . $row, $estudiante->id_estudiante);

            // Nombres y apellidos
            $nombreCompleto = $estudiante->nombres . ' ' . $estudiante->appaterno . ' ' . $estudiante->apmaterno;
            $sheet->setCellValue('C' . $row, $nombreCompleto);

            // Estado
            $sheet->setCellValue('D' . $row, $estudiante->estado);

            // Celdas para notas (F:P vacías, listas para llenar)
            $col = 6;
            foreach ($materias as $index => $materia) {
                $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
                // Dejar vacío para que el usuario complete
                $sheet->setCellValue($colLetter . $row, '');
                $sheet->getStyle($colLetter . $row)->getFill()->setFillType('solid')->getStartColor()->setRGB('FFFFFF');
                $col++;
            }

            $row++;
            $numeroEstudiante++;
        }

        // Ajustar ancho de columnas
        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(12);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10);

        for ($col = 6; $col <= 16; $col++) {
            $colLetter = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colLetter)->setWidth(12);
        }

        // Congelar filas superiores
        $sheet->freezePane('A7');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($rutaDestino);
    }
}

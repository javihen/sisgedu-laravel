<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Asignacion;
use App\Models\Gestion;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Imports\NotasImport;
use Illuminate\Http\Request;

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
    public function index()
    {
        $notas = Nota::with(['estudiante', 'asignacion', 'gestion'])
            ->paginate(15);

        return view('notas.index', compact('notas'));
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


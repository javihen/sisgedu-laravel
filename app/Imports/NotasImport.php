<?php

namespace App\Imports;

use App\Models\Nota;
use App\Models\Estudiante;
use App\Models\Asignacion;
use App\Models\Gestion;
use App\Models\Materia;
use PhpOffice\PhpSpreadsheet\IOFactory;

class NotasImport
{
    protected $periodo = 1;
    protected $idGestion = 1;
    protected $errores = [];
    protected $notasCreadas = 0;

    /**
     * Constructor
     */
    public function __construct($periodo = 1, $idGestion = 1)
    {
        $this->periodo = $periodo;
        $this->idGestion = $idGestion;
    }

    /**
     * Procesar el archivo Excel
     * Formato:
     * - F1:P1 contienen los idMateria
     * - A7:A... contienen los id_estudiante
     * - F7:P... contienen las notas (intersecciones)
     */
    public function procesar($filePath)
    {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();

            //0. Obtenemos el Id del curso que se encuentra ubicado en la celda B1
            $idCurso = $sheet->getCellByColumnAndRow(2, 1)->getValue();
            if (empty($idCurso)) {
                throw new \Exception("No se encontró el ID del curso en la celda B1");
            }
            // 1. Obtener IDs de materias desde F1:P1
            $idsMaterias = [];
            for ($col = 6; $col <= 18; $col++) { // F=6 hasta P=16
                $cell = $sheet->getCellByColumnAndRow($col, 1);
                $valor = trim($cell->getValue());
                if (!empty($valor)) {
                    $idsMaterias[$col] = (int) $valor;
                }
            }
            //dd($idsMaterias);
            if (empty($idsMaterias)) {
                throw new \Exception("No se encontraron IDs de materias en las celdas F1:P1");
            }

            // 2. Obtener IDs de estudiantes desde A7 en adelante
            $row = 7;
            $notasCount = 0;

            while ($row <= $sheet->getHighestRow()) {
                $idEstudiante = trim($sheet->getCellByColumnAndRow(2, $row)->getValue()); // Columna B (según el formato B7:B...)
                //dd($idEstudiante);
                // Si no hay ID de estudiante, terminar
                if (empty($idEstudiante)) {
                    break;
                }

                // Verificar que el estudiante existe
                $estudiante = Estudiante::find($idEstudiante);
                //dd($estudiante);
                if (!$estudiante) {
                    $this->errores[] = "Fila {$row}: Estudiante {$idEstudiante} no existe";
                    $row++;
                    continue;
                }

                // 3. Procesar las notas (intersecciones) para este estudiante
                foreach ($idsMaterias as $col => $idMateria) {
                    $notaCell = $sheet->getCellByColumnAndRow($col, $row);
                    $calificacion = $notaCell->getValue();

                    // Si la celda está vacía, saltar
                    if (is_null($calificacion) || $calificacion === '') {
                        continue;
                    }

                    // Validar calificación
                    if (!is_numeric($calificacion)) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: Valor '{$calificacion}' no es numérico";
                        continue;
                    }

                    $calificacion = (float) $calificacion;

                    if ($calificacion < 0 || $calificacion > 100) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: Calificación {$calificacion} fuera de rango (0-100)";
                        continue;
                    }

                    // Verificar que la materia existe (a través de asignación)
                    $asignacion = Asignacion::where('id_materia', $idMateria)
                        ->where('id_gestion', $this->idGestion)
                        ->where('idcurso', $idCurso)
                        ->first();

                    if (!$asignacion) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: No existe asignación para esta materia en la gestión actual";
                        continue;
                    }

                    // Crear la nota
                    try {
                        Nota::updateOrCreate([
                            'periodo' => $this->periodo,
                            'id_estudiante' => $idEstudiante,
                            'idAsignacion' => $asignacion->idAsignacion,
                            'id_gestion' => $this->idGestion,
                        ], [
                            'calificacion' => $calificacion,
                        ]);
                        $notasCount++;
                    } catch (\Exception $e) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: Error al guardar: {$e->getMessage()}";
                    }
                }

                $row++;
            }

            $this->notasCreadas = $notasCount;
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Error procesando archivo: {$e->getMessage()}");
        }
    }

    /**
     * Procesar una hoja específica del archivo Excel
     * Recibe la ruta del archivo y el nombre de la hoja a procesar
     */
    public function procesarHoja($filePath, $nombreHoja)
    {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getSheetByName($nombreHoja);

            if (!$sheet) {
                throw new \Exception("La hoja '{$nombreHoja}' no existe en el archivo");
            }

            // 0. Obtener ID del curso de la celda B1
            $idCurso = $sheet->getCellByColumnAndRow(2, 1)->getValue();
            if (empty($idCurso)) {
                throw new \Exception("No se encontró el ID del curso en la celda B1");
            }

            // 1. Obtener IDs de materias desde F1:P1
            $idsMaterias = [];
            for ($col = 6; $col <= 18; $col++) { // F=6 hasta P=16
                $cell = $sheet->getCellByColumnAndRow($col, 1);
                $valor = trim($cell->getValue());
                if (!empty($valor)) {
                    $idsMaterias[$col] = (int) $valor;
                }
            }

            if (empty($idsMaterias)) {
                throw new \Exception("No se encontraron IDs de materias en las celdas F1:P1");
            }

            // 2. Procesar estudiantes y notas desde fila 7 en adelante
            $row = 7;
            $notasCount = 0;

            while ($row <= $sheet->getHighestRow()) {
                $idEstudiante = trim($sheet->getCellByColumnAndRow(2, $row)->getValue()); // Columna B

                // Si no hay ID de estudiante, terminar
                if (empty($idEstudiante)) {
                    break;
                }

                // Verificar que el estudiante existe
                $estudiante = Estudiante::find($idEstudiante);
                if (!$estudiante) {
                    $this->errores[] = "Fila {$row}: Estudiante {$idEstudiante} no existe";
                    $row++;
                    continue;
                }

                // 3. Procesar las notas para este estudiante
                foreach ($idsMaterias as $col => $idMateria) {
                    $notaCell = $sheet->getCellByColumnAndRow($col, $row);
                    $calificacion = $notaCell->getValue();

                    // Si la celda está vacía, saltar
                    if (is_null($calificacion) || $calificacion === '') {
                        continue;
                    }

                    // Validar calificación
                    if (!is_numeric($calificacion)) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: Valor '{$calificacion}' no es numérico";
                        continue;
                    }

                    $calificacion = (float) $calificacion;

                    if ($calificacion < 0 || $calificacion > 100) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: Calificación {$calificacion} fuera de rango (0-100)";
                        continue;
                    }

                    // Verificar asignación
                    $asignacion = Asignacion::where('id_materia', $idMateria)
                        ->where('id_gestion', $this->idGestion)
                        ->where('idcurso', $idCurso)
                        ->first();

                    if (!$asignacion) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: No existe asignación para esta materia en la gestión actual";
                        continue;
                    }

                    // Crear la nota
                    try {
                        Nota::updateOrCreate([
                            'periodo' => $this->periodo,
                            'id_estudiante' => $idEstudiante,
                            'idAsignacion' => $asignacion->idAsignacion,
                            'id_gestion' => $this->idGestion,
                        ], [
                            'calificacion' => $calificacion,
                        ]);
                        $notasCount++;
                    } catch (\Exception $e) {
                        $this->errores[] = "Fila {$row}, Materia {$idMateria}: Error al guardar: {$e->getMessage()}";
                    }
                }

                $row++;
            }

            $this->notasCreadas = $notasCount;
            return true;
        } catch (\Exception $e) {
            throw new \Exception("Error procesando hoja: {$e->getMessage()}");
        }
    }

    /**
     * Obtener errores de validación
     */
    public function getErrores()
    {
        return $this->errores;
    }

    /**
     * Obtener cantidad de notas creadas
     */
    public function getNotasCreadas()
    {
        return $this->notasCreadas;
    }

    /**
     * Setter para período
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
        return $this;
    }

    /**
     * Setter para gestión
     */
    public function setIdGestion($idGestion)
    {
        $this->idGestion = $idGestion;
        return $this;
    }
}

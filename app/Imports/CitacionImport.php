<?php

namespace App\Imports;

use App\Models\Citacion;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Curso;

class CitacionImport
{
    protected $idProfesor;
    protected $idGestion;
    protected $idCurso;
    protected $fecha;
    protected $hora;
    protected $motivo;
    protected $periodo;
    protected $tipo;

    /**
     * Constructor que recibe parámetros necesarios para la importación
     */
    public function __construct($idProfesor, $idGestion, $idCurso, $fecha, $hora, $motivo = null, $periodo = null, $tipo = 'individual')
    {
        $this->idProfesor = $idProfesor;
        $this->idGestion = $idGestion;
        $this->idCurso = $idCurso;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->motivo = $motivo ?? 'Citación Registrada';
        $this->tipo = $tipo;
        $this->periodo = $periodo;
    }

    /**
     * @param Collection $collection
     *
     * Procesa el archivo Excel.
     * Estructura esperada:
     * - F1..P1: encabezados de materias (IDs o nombres)
     * - A7..A* : IDs de estudiantes
     * - F7..P*: valores 1 indican creación de citación
     */
    public function import($file)
    {
        $filePath = is_string($file) ? $file : $file->getRealPath();

        if (!file_exists($filePath)) {
            return;
        }

        $xlsx = \Shuchkin\SimpleXLSX::parse($filePath);
        if (! $xlsx) {
            return;
        }

        $rows = $xlsx->rows();
        $this->processRows($rows);
    }

    private function processRows(array $rows)
    {
        if (empty($rows)) {
            return;
        }

        // Leer encabezados de materias en la fila 1, desde columna F a P
        $headers = [];
        for ($colIndex = 5; $colIndex <= 15; $colIndex++) {
            $headers[$colIndex] = trim((string) ($rows[0][$colIndex] ?? ''));
        }

        if (empty(array_filter($headers))) {
            return;
        }

        // Procesar filas a partir de la fila 7 (índice 6)
        $rowIndex = 6;
        while (isset($rows[$rowIndex])) {
            $idEstudiante = trim((string) ($rows[$rowIndex][0] ?? ''));

            if ($idEstudiante === '' || $idEstudiante === null) {
                break;
            }

            $estudiante = Estudiante::find($idEstudiante);
            if (!$estudiante) {
                $rowIndex++;
                continue;
            }

            foreach ($headers as $colIndex => $headerValue) {
                $cellValue = $rows[$rowIndex][$colIndex] ?? null;
                if ((string) $cellValue !== '1' && (int) $cellValue !== 1) {
                    continue;
                }

                $idMateria = $this->obtenerIdMateria($headerValue);
                if (!$idMateria) {
                    continue;
                }

                $materia = Materia::find($idMateria);
                if (!$materia) {
                    continue;
                }

                try {
                    Citacion::create([
                        'idEstudiante' => $idEstudiante,
                        'idCurso' => $this->idCurso,
                        'idProfesor' => $this->idProfesor,
                        'idMateria' => $idMateria,
                        'idGestion' => $this->idGestion,
                        'fecha' => $this->fecha,
                        'hora' => $this->hora,
                        'motivo' => $this->motivo,
                        'periodo' => $this->periodo,
                        'tipo' => $this->tipo,
                    ]);
                } catch (\Exception $e) {
                    continue;
                }
            }

            $rowIndex++;
        }
    }

    /**
     * Intenta obtener el ID de la materia desde el encabezado
     * Puede ser un ID directo o un nombre que se busca en la BD
     */
    private function obtenerIdMateria($headerValue)
    {
        if (!$headerValue) {
            return null;
        }

        // Si el encabezado es un número, asumimos que es el ID de la materia
        if (is_numeric($headerValue)) {
            return (int)$headerValue;
        }

        // Si es texto, buscar la materia por área o abreviatura
        $materia = Materia::where('area', 'like', "%{$headerValue}%")
            ->orWhere('abreviatura', 'like', "%{$headerValue}%")
            ->first();

        return $materia?->id_materia;
    }
}

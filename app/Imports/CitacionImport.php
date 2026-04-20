<?php

namespace App\Imports;

use App\Models\Citacion;
use App\Models\Estudiante;
use App\Models\Materia;
use App\Models\Curso;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

class CitacionImport implements ToCollection
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
     * Importa el archivo usando Laravel Excel
     */
    public function import($file)
    {
        Excel::import($this, $file);
    }

    /**
     * Recibe las filas del Excel y procesa el contenido
     */
    public function collection(Collection $rows)
    {
        $this->processRows($rows->toArray());
    }

    private function processRows(array $rows)
    {
        if (empty($rows)) {
            return;
        }

        // Leer encabezados de materias en la primera fila, sobre las columnas desde la segunda columna.
        $headers = [];
        $totalCols = count($rows[0]);
        for ($colIndex = 5; $colIndex < 16; $colIndex++) {
            $headers[$colIndex] = trim((string) ($rows[0][$colIndex] ?? ''));
        }
        //dd($headers);
        if (empty(array_filter($headers))) {
            return;
        }

        // Procesar filas a partir de la segunda fila
        $rowIndex = 6;
        while (isset($rows[$rowIndex])) {
            $idEstudiante = trim((string) ($rows[$rowIndex][0] ?? ''));

            /* dd([
                'fila' => $rowIndex,
                'idEstudiante' => $idEstudiante,
                'estado_columna_E' => $rows[$rowIndex][4] ?? null
            ]); */

            if ($idEstudiante === '') {
                break;
            }

            $estado = strtolower(trim((string) ($rows[$rowIndex][4] ?? '')));

            if ($estado !== 'efectivo') {
                $rowIndex++;
                continue;
            }
            $estudiante = Estudiante::find($idEstudiante);
            if (!$estudiante) {
                $rowIndex++;
                continue;
                }

            foreach ($headers as $colIndex => $headerValue) {
                $cellValue = $rows[$rowIndex][$colIndex] ?? null;
                $cellNormalized = strtolower(trim((string) $cellValue));
                //dd($cellNormalized);
                if (!in_array($cellNormalized, ['1', 'x', 'yes'], true)) {
                    continue;
                }

                //$idMateria = $this->obtenerIdMateria($headerValue);
                $idMateria = (int) $headerValue;
                if (!$idMateria) {
                    continue;
                }

                /* if (!Materia::find($idMateria)) {
                    continue;
                } */

                try {

                    Citacion::create([
                        'idEstudiante' => $idEstudiante,
                        'idCurso' => $this->idCurso,
                        'idProfesor' => $this->idProfesor,
                        'idMateria' => $idMateria,
                        'idGestion' => $this->idGestion,
                        'fecha' => $this->fecha,
                        'hora' => $this->hora,
                        'motivo' => 'Aula Abierta',
                        'periodo' => $this->periodo,
                        'tipo' => $this->tipo,
                    ]);
                } catch (\Exception $e) {
                    dd($e->getMessage());
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

        if (is_numeric($headerValue)) {
            return (int) $headerValue;
        }

        return Materia::where('area', 'like', "%{$headerValue}%")
            ->orWhere('abreviatura', 'like', "%{$headerValue}%")
            ->orWhere('nombre', 'like', "%{$headerValue}%")
            ->first()?->id_materia;
    }
}

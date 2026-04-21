<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Citaciones - {{ $curso->nombre_curso ?? 'Curso' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #38BC9B;
            padding-bottom: 15px;
        }

        .header h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .header .subtitle {
            color: #666;
            font-size: 13px;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 12px;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 4px;
        }

        .info-item {
            flex: 1;
        }

        .info-label {
            font-weight: bold;
            color: #38BC9B;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #38BC9B;
            color: white;
        }

        th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #38BC9B;
            font-size: 12px;
        }

        td {
            padding: 10px 12px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .fecha-generacion {
            text-align: right;
            font-size: 11px;
            color: #999;
            margin-bottom: 20px;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            background-color: #f5f5f5;
            border-radius: 4px;
        }

        .stats {
            background-color: #e8f5f1;
            padding: 10px;
            border-left: 4px solid #38BC9B;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .citation-card {
            border: 1px solid #38BC9B;
            border-radius: 0;
            padding: 20px;
            margin-bottom: 30px;
            background-color: #fff;
            box-shadow: none;
            page-break-inside: avoid;
        }

        .citation-card h2 {
            margin-bottom: 15px;
            font-size: 16px;
            text-transform: uppercase;
            color: #38BC9B;
            border-bottom: 2px solid #38BC9B;
            padding-bottom: 8px;
        }

        .citation-info {
            margin-bottom: 15px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .citation-info p {
            margin: 5px 0;
            font-size: 12px;
        }

        .citation-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .citation-table thead {
            background-color: #38BC9B;
            color: white;
        }

        .citation-table th {
            padding: 10px;
            text-align: left;
            font-size: 11px;
            border: 1px solid #38BC9B;
        }

        .citation-table td {
            padding: 10px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        .citation-table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .page-break {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="fecha-generacion">
        Generado: {{ now()->format('d/m/Y H:i') }}
    </div>

    <div class="header">
        <h1>UNIDAD EDUCATIVA CONVENIO NIVEL SECUNDARIA</h1>
        <h1>CRISTIANO VIDA NUEVA – TURNO MAÑANA</h1>
        <div class="subtitle">CITACIONES - REPORTE POR CURSO</div>
    </div>

    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Curso:</span> {{ $curso->nombre_curso ?? 'N/A' }}
        </div>
        <div class="info-item">
            <span class="info-label">Gestión:</span> {{ $gestion->anio ?? 'N/A' }}
        </div>
        <div class="info-item">
            <span class="info-label">Total de Citaciones:</span> {{ $citaciones->count() }}
        </div>
    </div>

    @if ($citaciones->count() > 0)
        <div class="stats">
            <strong>Resumen:</strong> Se registran {{ $citaciones->count() }} citaciones en este curso.
            @php
                $individuales = $citaciones->where('tipo', 'individual')->count();
                $grupales = $citaciones->where('tipo', 'grupal')->count();
            @endphp
            Individuales: {{ $individuales }} | Grupales: {{ $grupales }}
        </div>

        @php
            $citacionesAgrupadas = $citaciones->groupBy(function ($citacion) {
                return $citacion->idEstudiante .
                    '|' .
                    ($citacion->fecha?->format('Y-m-d') ?? '') .
                    '|' .
                    $citacion->hora .
                    '|' .
                    ($citacion->motivo ?? '') .
                    '|' .
                    ($citacion->periodo ?? '') .
                    '|' .
                    $citacion->tipo;
            });
        @endphp

        @foreach ($citacionesAgrupadas as $group)
            @php
                $first = $group->first();
                // Obtener materias y profesores usando la tabla asignaciones
                $materias = $group
                    ->map(function ($citacion) {
                        // Buscar en asignaciones usando id_materia del curso
                        $asignacion = \App\Models\Asignacion::where('id_materia', $citacion->idMateria)
                            ->where('idcurso', $citacion->idCurso)
                            ->first();

                        // Obtener el profesor desde la asignación
                        $nombreProfesor = 'N/A';
                        if ($asignacion && $asignacion->profesor) {
                            $nombreProfesor =
                                trim(
                                    ($asignacion->profesor->nombres ?? '') .
                                        ' ' .
                                        ($asignacion->profesor->appaterno ?? '') .
                                        ' ' .
                                        ($asignacion->profesor->apmaterno ?? ''),
                                ) ?:
                                'N/A';
                        }

                        return [
                            'nombre' => $citacion->materia?->area ?? 'N/A',
                            'profesor' => $nombreProfesor,
                        ];
                    })
                    ->filter(function ($item) {
                        return $item['nombre'] !== 'N/A' || $item['profesor'] !== 'N/A';
                    })
                    ->unique(function ($item) {
                        return $item['nombre'] . '|' . $item['profesor'];
                    })
                    ->values()
                    ->all();
            @endphp

            <div class="citation-card">
                <h2>UNIDAD EDUCATIVA CONVENIO NIVEL SECUNDARIA</h2>
                <H3>CRISTIANO VIDA NUEVA – TURNO TARDE</H3>
                <div class="citation-info">
                    <div>
                        <p>Se cita al padre/madre de familia o tutor del/la
                            estudiante:<strong>{{ $first->estudiante->nombres ?? 'N/A' }}</strong> del curso <strong>5to
                                "C"</strong> a
                            la entrevista que
                            se llevara acabo el dia <strong>Jueves a partir de horas 11:00 am</strong> para informar
                            sobre el
                            aprovechamiento acadmico de sus hijo(a), en las areas del <strong>PRIMER TRIMESTRE
                                2026</strong>. La NO
                            asistencia sera tomada en cuenta en acta y no se aceptara reclamos posteriores en caso de
                            reprobacion en el trimestre correspondiente. debe pasar SOLO en las Areas que tiene
                            observacion (tiqueado) que acontinuacion se detallan: </p>

                    </div>
                    {{-- <div>
                        <p><strong>Fecha:</strong> {{ $first->fecha->format('d/m/Y') }}</p>
                        <p><strong>Hora:</strong> {{ $first->hora }}</p>
                    </div> --}}
                </div>

                {{-- <div style="margin-bottom: 15px;">
                    <p><strong>Motivo:</strong> {{ $first->motivo ?? 'N/A' }}</p>
                    <p><strong>Tipo:</strong> {{ ucfirst($first->tipo) }}
                        @if ($first->periodo)
                            | <strong>Período:</strong> {{ $first->periodo }}
                        @endif
                    </p>
                </div> --}}

                @if (count($materias) > 0)
                    <table class="citation-table">
                        <thead>
                            <tr>
                                <th>MATERIA</th>
                                <th>PROFESOR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materias as $materia)
                                <tr>
                                    <td>{{ $materia['nombre'] }}</td>
                                    <td>{{ $materia['profesor'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                <p><strong>Nota:</strong> El padre de familia o apoderado debe asistir junto a su hijo(a) y portar esta
                    citación.</p>
                <p style="margin-top: 20px; color: #666;">La Paz, {{ now()->format('F \\d\\e Y') }}</p>
            </div>

            @if ($loop->iteration % 5 == 0 && !$loop->last)
                <div class="page-break"></div>
            @endif
        @endforeach
    @else
        <div class="no-data">
            No hay citaciones registradas para este curso.
        </div>
    @endif

    <div class="footer">
        <p><strong>Nota:</strong> El padre de familia o apoderado debe asistir junto a su hijo(a) y portar esta
            citación.</p>
        <p style="margin-top: 20px; color: #666;">La Paz, {{ now()->format('F \\d\\e Y') }}</p>
        <p style="margin-top: 30px; color: #999; font-size: 10px;">Este documento fue generado automáticamente por el
            Sistema de Gestión Educativa</p>
    </div>
</body>

</html>

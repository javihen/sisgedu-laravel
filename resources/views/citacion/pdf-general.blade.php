<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Citaciones - Reporte General</title>
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
            color: #38BC9B;
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

        .curso-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }

        .curso-title {
            background-color: #38BC9B;
            color: white;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 10px;
            font-size: 14px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #e8f5f1;
            color: #38BC9B;
        }

        th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #38BC9B;
            font-size: 11px;
        }

        td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            font-size: 10px;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
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

        .resumen-general {
            background-color: #e8f5f1;
            padding: 15px;
            border-left: 4px solid #38BC9B;
            margin-bottom: 20px;
            font-size: 12px;
        }

        .resumen-general strong {
            color: #38BC9B;
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
        <h1>REPORTE GENERAL DE CITACIONES</h1>
        <div class="subtitle">Educación</div>
    </div>

    <div class="info-section">
        <div class="info-item">
            <span class="info-label">Gestión:</span> {{ $gestion->anio ?? 'N/A' }}
        </div>
        <div class="info-item">
            <span class="info-label">Total de Citaciones:</span> {{ $totalCitaciones }}
        </div>
        <div class="info-item">
            <span class="info-label">Total de Cursos:</span> {{ $citacionesPorCurso->count() }}
        </div>
    </div>

    <div class="resumen-general">
        <strong>Resumen General:</strong> Se registran <strong>{{ $totalCitaciones }}</strong> citaciones distribuidas
        en <strong>{{ $citacionesPorCurso->count() }}</strong> cursos para la gestión
        {{ $gestion->anio ?? 'actual' }}.
    </div>

    @forelse ($citacionesPorCurso as $idCurso => $citacionesCurso)
        @php
            $curso = $citacionesCurso->first()->curso;
            $individuales = $citacionesCurso->where('tipo', 'individual')->count();
            $grupales = $citacionesCurso->where('tipo', 'grupal')->count();
        @endphp

        <div class="curso-section">
            <div class="curso-title">
                {{ $curso->nombre_curso ?? 'Curso: N/A' }} ({{ $citacionesCurso->count() }} citaciones)
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Nro</th>
                        <th>Estudiante</th>
                        <th>Materia</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Motivo</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citacionesCurso as $citacion)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $citacion->estudiante->nombres ?? 'N/A' }}
                                {{ $citacion->estudiante->appaterno ?? '' }}
                            </td>
                            <td>{{ $citacion->materia->abreviatura ?? 'N/A' }}</td>
                            <td>{{ $citacion->fecha->format('d/m/Y') }}</td>
                            <td>{{ $citacion->hora }}</td>
                            <td>{{ $citacion->motivo }}</td>
                            <td>{{ ucfirst($citacion->tipo) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @empty
        <div style="text-align: center; padding: 20px; background-color: #f5f5f5; border-radius: 4px;">
            No hay citaciones registradas.
        </div>
    @endforelse

    <div class="footer">
        <p>Este documento fue generado automáticamente por el Sistema de Gestión Educativa</p>
    </div>
</body>

</html>

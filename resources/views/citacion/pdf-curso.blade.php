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
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 18px;
            background-color: #fff;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            page-break-inside: avoid;
        }

        .citation-card h2 {
            margin-bottom: 12px;
            font-size: 18px;
            text-transform: uppercase;
            color: #1a6d4e;
        }

        .citation-card p {
            margin-bottom: 8px;
            font-size: 12px;
            line-height: 1.4;
        }

        .citation-card strong {
            color: #1f7a5b;
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
        <h1>REPORTE DE CITACIONES</h1>
        <div class="subtitle">Educación</div>
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
                $materias = $group->pluck('materia.abreviatura')->filter()->unique()->values()->all();
            @endphp

            <div class="citation-card">
                <h2>CITACIÓN</h2>
                <p><strong>Estudiante:</strong>
                    {{ $first->estudiante->nombres ?? 'N/A' }}
                    {{ $first->estudiante->appaterno ?? '' }}
                    {{ $first->estudiante->apmaterno ?? '' }}
                </p>
                <p><strong>Materias citadas:</strong> {{ count($materias) ? implode(', ', $materias) : 'N/A' }}</p>
                <p><strong>Fecha:</strong> {{ $first->fecha->format('d/m/Y') }}</p>
                <p><strong>Hora:</strong> {{ $first->hora }}</p>
                <p><strong>Tipo:</strong> {{ ucfirst($first->tipo) }}</p>
                <p><strong>Motivo:</strong> {{ $first->motivo }}</p>
                <p><strong>Período:</strong> {{ $first->periodo ?? '-' }}</p>
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
        <p>Este documento fue generado automáticamente por el Sistema de Gestión Educativa</p>
    </div>
</body>

</html>

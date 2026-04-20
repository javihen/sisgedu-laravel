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

        <table>
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Estudiante</th>
                    <th>Materia</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Motivo</th>
                    <th>Período</th>
                    <th>Tipo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citaciones as $citacion)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $citacion->estudiante->nombres ?? 'N/A' }}
                            {{ $citacion->estudiante->appaterno ?? '' }}
                            {{ $citacion->estudiante->apmaterno ?? '' }}
                        </td>
                        <td>{{ $citacion->materia->abreviatura ?? 'N/A' }}</td>
                        <td>{{ $citacion->fecha->format('d/m/Y') }}</td>
                        <td>{{ $citacion->hora }}</td>
                        <td>{{ $citacion->motivo }}</td>
                        <td>{{ $citacion->periodo ?? '-' }}</td>
                        <td>{{ ucfirst($citacion->tipo) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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

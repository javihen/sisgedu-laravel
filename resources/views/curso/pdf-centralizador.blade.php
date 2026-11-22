<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Centralizador de notas - {{ $curso->display_name }}</title>
    <style>
        @page {
            size: A3 landscape;
            margin: 8mm;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body {
            color: #1e293b;
            font-family: DejaVu Sans, sans-serif;
            font-size: 7px;
        }

        h1 {
            color: #123b70;
            font-size: 16px;
            margin: 0 0 3px;
            text-align: center;
        }

        .subtitle {
            color: #475569;
            font-size: 9px;
            margin: 0 0 10px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            table-layout: fixed;
            width: 100%;
        }

        th,
        td {
            border: 0.5px solid #94a3b8;
            overflow-wrap: anywhere;
            padding: 3px 2px;
            text-align: center;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        .number-column {
            width: 7mm;
        }

        .student-column {
            text-align: left;
            width: 40mm;
        }

        .grade-column {
            width: 5mm;
        }

        .fixed-heading {
            background: #123b70;
            color: #fff;
            font-size: 7px;
            font-weight: bold;
        }

        .subject-heading {
            background: #1d4ed8;
            color: #fff;
            font-size: 7px;
            font-weight: bold;
        }

        .period-heading {
            background: #dbeafe;
            color: #1e3a8a;
            font-weight: bold;
        }

        .student-name {
            font-size: 7px;
            text-align: left;
        }

        .score-fail {
            background: #fee2e2;
            color: #b91c1c;
            font-weight: bold;
        }

        .score-pass {
            background: #dcfce7;
            color: #15803d;
            font-weight: bold;
        }

        .score-missing {
            background: #f1f5f9;
            color: #64748b;
        }

        .legend {
            color: #475569;
            font-size: 7px;
            margin-top: 8px;
            text-align: right;
        }

        .legend-fail {
            color: #b91c1c;
            font-weight: bold;
        }

        .legend-pass {
            color: #15803d;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>Centralizador de calificaciones</h1>
    <p class="subtitle">
        {{ $curso->display_name }}
        &nbsp;|&nbsp;
        Gestión {{ $gestion?->anio ?? 'Sin gestión activa' }}
        &nbsp;|&nbsp;
        {{ $inscripciones->count() }} estudiantes
    </p>

    <table>
        <colgroup>
            <col class="number-column">
            <col class="student-column">
            @foreach ($asignaciones as $asignacion)
                @for ($columna = 0; $columna < 4; $columna++)
                    <col class="grade-column">
                @endfor
            @endforeach
        </colgroup>
        <thead>
            <tr>
                <th rowspan="2" class="fixed-heading">N.º</th>
                <th rowspan="2" class="fixed-heading student-column">Estudiante</th>
                @foreach ($asignaciones as $asignacion)
                    <th colspan="4" class="subject-heading">{{ $asignacion->materia->area }}</th>
                @endforeach
            </tr>
            <tr>
                @foreach ($asignaciones as $asignacion)
                    <th class="period-heading">1.º</th>
                    <th class="period-heading">2.º</th>
                    <th class="period-heading">3.º</th>
                    <th class="period-heading">Final</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($inscripciones as $inscripcion)
                @php
                    $estudiante = $inscripcion->estudiante;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="student-name">
                        {{ trim($estudiante->appaterno . ' ' . $estudiante->apmaterno . ' ' . $estudiante->nombres) }}
                    </td>
                    @foreach ($asignaciones as $asignacion)
                        @php
                            $notasMateria = $calificaciones[$estudiante->id_estudiante][$asignacion->idAsignacion] ?? [];
                            $notasRegistradas = array_filter($notasMateria, fn ($nota) => is_numeric($nota));
                            $promedioFinal = count($notasRegistradas)
                                ? round(array_sum($notasRegistradas) / count($notasRegistradas))
                                : null;
                        @endphp
                        @foreach ([1, 2, 3] as $periodo)
                            @php
                                $nota = $notasMateria[$periodo] ?? null;
                                $notaRedondeada = is_numeric($nota) ? round($nota) : null;
                                $claseNota = $notaRedondeada === null
                                    ? 'score-missing'
                                    : ($notaRedondeada < 51 ? 'score-fail' : 'score-pass');
                            @endphp
                            <td class="{{ $claseNota }}">{{ $notaRedondeada ?? '—' }}</td>
                        @endforeach
                        <td class="{{ $promedioFinal === null ? 'score-missing' : ($promedioFinal < 51 ? 'score-fail' : 'score-pass') }}">
                            {{ $promedioFinal ?? '—' }}
                        </td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td colspan="{{ max(2, 2 + $asignaciones->count() * 4) }}">No hay estudiantes inscritos en este curso para la gestión activa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="legend">
        <span class="legend-fail">Rojo: menor a 51</span>
        &nbsp;&nbsp;
        <span class="legend-pass">Verde: 51 o más</span>
        &nbsp;&nbsp;
        Gris: sin calificación
    </div>
</body>

</html>

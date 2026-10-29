<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cronograma oficial de defensas BTH</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 24mm 12mm 16mm;
        }

        body {
            color: #17212b;
            font-family: DejaVu Sans, sans-serif;
            font-size: 8.5pt;
        }

        .page-header {
            border-bottom: 2px solid #174b69;
            margin-bottom: 12px;
            padding-bottom: 9px;
            width: 100%;
        }

        .brand-mark {
            background: #174b69;
            border: 2px solid #c8a951;
            border-radius: 50%;
            color: #fff;
            font-size: 16pt;
            font-weight: bold;
            height: 50px;
            line-height: 50px;
            text-align: center;
            width: 50px;
        }

        .brand-name {
            color: #174b69;
            font-size: 14pt;
            font-weight: bold;
            margin: 0;
        }

        .brand-subtitle {
            color: #536575;
            font-size: 8pt;
            margin: 3px 0 0;
        }

        .report-title {
            color: #174b69;
            font-size: 13pt;
            font-weight: bold;
            margin: 13px 0 3px;
            text-transform: uppercase;
        }

        .report-meta {
            color: #536575;
            font-size: 8pt;
            margin: 0;
        }

        .mesa-heading {
            background: #eaf1f5;
            border-left: 4px solid #174b69;
            margin: 11px 0 7px;
            padding: 7px 9px;
        }

        .mesa-heading strong {
            color: #174b69;
            font-size: 10pt;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        thead {
            display: table-header-group;
        }

        th {
            background: #174b69;
            color: #fff;
            font-size: 7pt;
            padding: 7px 5px;
            text-align: left;
            text-transform: uppercase;
        }

        td {
            border-bottom: 1px solid #d5dde3;
            padding: 6px 5px;
            vertical-align: top;
        }

        tbody tr:nth-child(even) {
            background: #f5f8fa;
        }

        .order,
        .time {
            color: #174b69;
            font-weight: bold;
            white-space: nowrap;
        }

        .project-title {
            font-weight: bold;
        }

        .muted {
            color: #596b78;
            font-size: 7.5pt;
        }

        .empty {
            color: #596b78;
            padding: 12px;
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        .footer {
            bottom: -9mm;
            color: #667784;
            font-size: 7pt;
            position: fixed;
            text-align: right;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="footer">
        Generado {{ now()->format('d/m/Y H:i') }} · Sorteo #{{ $sorteo->idSorteo }} · Gestión
        {{ $sorteo->gestion?->anio ?? $sorteo->idGestion }}
    </div>

    @foreach ($mesas as $mesa)
        <header class="page-header">
            <table>
                <tr>
                    <td style="border:0;width:62px;padding:0 12px 0 0">
                        <div class="brand-mark">VN</div>
                    </td>
                    <td style="border:0;padding:0">
                        <h1 class="brand-name">{{ $institucion }}</h1>
                        <p class="brand-subtitle">Bachillerato Técnico Humanístico · Sistema de Gestión Educativa</p>
                        <h2 class="report-title">Cronograma oficial de defensas de proyectos de grado</h2>
                        <p class="report-meta">
                            Gestión {{ $sorteo->gestion?->anio ?? $sorteo->idGestion }} ·
                            Fecha de defensa
                            {{ $sorteo->detalles->first()?->fechaDefensa?->format('d/m/Y') ?? 'No registrada' }} ·
                            Sorteo #{{ $sorteo->idSorteo }} ·
                            Confirmado {{ $sorteo->updated_at?->format('d/m/Y H:i') }} ·
                            Generado por {{ $generadoPor }}
                        </p>
                    </td>
                </tr>
            </table>
        </header>

        <div class="mesa-heading">
            <strong>Mesa de tribunal #{{ str_pad((string) $mesa['numeroMesa'], 2, '0', STR_PAD_LEFT) }}</strong>
            <span class="muted"> · {{ $mesa['proyectos']->count() }} defensas · Turnos de 30 minutos</span>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width:5%">Orden</th>
                    <th style="width:13%">Horario</th>
                    <th style="width:28%">Título del proyecto</th>
                    <th style="width:19%">Postulante(s)</th>
                    <th style="width:17%">Tutor</th>
                    <th style="width:10%">Curso</th>
                    <th style="width:8%">Línea de investigación</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mesa['proyectos'] as $detalle)
                    @php
                        $proyecto = $detalle->proyecto;
                        $postulantes = collect([$proyecto?->estudiante])
                            ->merge($proyecto?->proyectoEstudiantes->pluck('estudiante') ?? collect())
                            ->filter()
                            ->unique('id_estudiante');
                    @endphp
                    <tr>
                        <td class="order">{{ str_pad((string) $detalle->orden, 2, '0', STR_PAD_LEFT) }}</td>
                        <td class="time">
                            {{ substr((string) $detalle->horaInicio, 0, 5) }}–{{ substr((string) $detalle->horaFin, 0, 5) }}
                        </td>
                        <td>
                            <div class="project-title">{{ $proyecto?->titulo ?? 'Proyecto no disponible' }}</div>
                            <div class="muted">Registro #{{ $proyecto?->idProyecto ?? $detalle->idProyecto }} ·
                                {{ $proyecto?->estado ?? 'Estado no registrado' }}</div>
                            @if ($proyecto?->tribunales->isNotEmpty())
                                <div class="muted">Tribunal:
                                    @foreach ($proyecto->tribunales as $tribunal)
                                        {{ trim(implode(' ', array_filter([$tribunal->profesor?->nombres, $tribunal->profesor?->appaterno, $tribunal->profesor?->apmaterno]))) }}@if (!$loop->last), @endif
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td>
                            @forelse ($postulantes as $postulante)
                                {{ trim(implode(' ', array_filter([$postulante->nombres, $postulante->appaterno, $postulante->apmaterno]))) }}@if (!$loop->last)<br>@endif
                            @empty
                                Sin postulante asociado
                            @endforelse
                        </td>
                        <td>
                            @if ($proyecto?->tutor)
                                {{ trim(implode(' ', array_filter([$proyecto->tutor->nombres, $proyecto->tutor->appaterno, $proyecto->tutor->apmaterno]))) }}
                            @else
                                Sin tutor asignado
                            @endif
                        </td>
                        <td>{{ $proyecto?->curso?->display_name ?? 'No registrado' }}</td>
                        <td>{{ $proyecto?->lineaInvestigacion ?: 'No registrada' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="empty" colspan="7">No hay proyectos asignados a esta mesa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>

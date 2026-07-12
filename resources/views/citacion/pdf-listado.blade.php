<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado Aula Abierta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #111827;
        }

        .header {
            border-bottom: 2px solid #4b5563;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
        }

        .subtitle {
            font-size: 11px;
            color: #6b7280;
            margin-top: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #d1d5db;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .muted {
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="header">
        <p class="title">Listado Aula Abierta</p>
        <p class="subtitle">Asignación: {{ $asignacion->curso->display_name ?? 'Sin curso' }} · Materia:
            {{ $asignacion->materia->nombre ?? ($asignacion->materia->name ?? 'Sin materia') }}</p>
        <p class="subtitle">Sesión: {{ $citacion->estado }} · Fecha: {{ $citacion->fecha }} · Hora: {{ $citacion->hora }}
        </p>
    </div>

    @if ($detalles->isEmpty())
        <p class="muted">No se registraron estudiantes en esta sesión.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Observación</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles as $index => $detalle)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ trim(($detalle->estudiante->appaterno ?? '') . ' ' . ($detalle->estudiante->apmaterno ?? '') . ' ' . ($detalle->estudiante->nombres ?? '')) }}
                        </td>
                        <td>{{ $detalle->estado }}</td>
                        <td>{{ $detalle->observacion ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>

</html>

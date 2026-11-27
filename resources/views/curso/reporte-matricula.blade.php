<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Reporte General de Matrícula</title>
    <style>
        @page {
            margin: 18mm;
        }

        body {
            color: #1e293b;
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        h1,
        p {
            margin: 0 0 8px;
            text-align: center;
        }

        h1 {
            color: #123b70;
            font-size: 18px;
        }

        table {
            border-collapse: collapse;
            margin-top: 16px;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #94a3b8;
            padding: 6px;
        }

        th {
            background: #123b70;
            color: #fff;
            text-align: left;
        }

        td:last-child,
        .total {
            text-align: right;
        }

        .total {
            font-size: 13px;
            font-weight: bold;
            margin-top: 14px;
        }
    </style>
</head>

<body>
    <h1>Reporte General de Matrícula</h1>
    <p>Gestión {{ $gestion->anio }}</p>

    <table>
        <thead>
            <tr>
                <th>Nivel</th>
                <th>Turno</th>
                <th>Curso</th>
                <th>Estudiantes inscritos</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cursos as $curso)
                <tr>
                    <td>{{ $niveles[$curso->nivel] ?? 'Nivel ' . $curso->nivel }}</td>
                    <td>{{ $curso->turno === 'M' ? 'Mañana' : 'Tarde' }}</td>
                    <td>{{ $curso->display_name }}</td>
                    <td>{{ $curso->total_estudiantes }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay cursos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="total">Total de matrículas: {{ $totalEstudiantes }}</p>
</body>

</html>

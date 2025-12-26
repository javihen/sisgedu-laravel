<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Listado de Estudiantes - {{ $curso->display_name ?? 'Curso' }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .meta {
            margin-bottom: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: .3px solid #000;
            padding: 3px;
        }

        th {
            background: #eee;
        }

        .celdaF {
            width: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Listado de Estudiantes</h2>
        <div class="meta">Curso: {{ $curso->display_name ?? '—' }}</div>
    </div>

    <table style="font-size: 8px;">
        <thead>
            <tr>
                <th>Nro.</th>

                <th>Estudiante</th>

                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
                <th class="celdaF"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estudiantes as $i => $estudiante)
                <tr>
                    <td style="text-align:center;">{{ $i + 1 }}</td>
                    {{-- <td style="text-align:center;">{{ $estudiante->id_estudiante }}</td> --}}
                    <td>
                        {{-- Enlace al listado en la aplicación para facilitar navegación desde PDF --}}
                        {{-- <a href="{{ url('/estudiante-curso/'.$curso->id.'#estudiante-'.$estudiante->id_estudiante) }}">{{ $estudiante->appaterno }} {{ $estudiante->apmaterno }} {{ $estudiante->nombres }}</a>
 --}} {{ $estudiante->appaterno }} {{ $estudiante->apmaterno }}
                        {{ $estudiante->nombres }}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="position: fixed; bottom: 10px; right: 10px; font-size: 10px;">Generado: {{ date('d/m/Y H:i') }}</div>
</body>

</html>

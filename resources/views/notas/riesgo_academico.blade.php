@extends('layouts.navhorizontal')

@section('content')
    @php
        $gestionActual = $gestion ?? (session('gestion') ?? now()->year);
        $estudiantesRiesgo = collect($estudiantes ?? []);
        $valor = function ($item, $keys, $default = null) {
            foreach ((array) $keys as $key) {
                $value = is_array($item) ? $item[$key] ?? null : data_get($item, $key);
                if ($value !== null && $value !== '') {
                    return $value;
                }
            }
            return $default;
        };
        $numero = function ($value) {
            return is_numeric($value) ? (float) $value : null;
        };
        $estado = function ($necesita) {
            if ($necesita === null || $necesita > 100) {
                return ['label' => 'Riesgo crítico', 'class' => 'critical', 'icon' => '!', 'tone' => 'red'];
            }
            if ($necesita >= 70) {
                return ['label' => 'En riesgo', 'class' => 'attention', 'icon' => '!', 'tone' => 'amber'];
            }
            return ['label' => 'Recuperable', 'class' => 'recoverable', 'icon' => '✓', 'tone' => 'green'];
        };

        $filas = collect();
        foreach ($estudiantesRiesgo as $estudiante) {
            $materias = $valor($estudiante, ['materias', 'subjects', 'detalles'], []);
            if (empty($materias)) {
                $materias = [$estudiante];
            }

            $nombre = $valor($estudiante, ['nombre', 'estudiante', 'name', 'nombre_completo'], 'Estudiante sin nombre');
            $cursoEstudiante = $valor($estudiante, ['curso', 'curso_nombre'], $curso ?? '');
            $paraleloEstudiante = $valor($estudiante, ['paralelo', 'seccion'], $paralelo ?? '');
            $detalles = collect();

            foreach ($materias as $materia) {
                $t1 = $numero($valor($materia, ['t1', 'primer_trimestre', 'nota1', 'nota_1']));
                $t2 = $numero($valor($materia, ['t2', 'segundo_trimestre', 'nota2', 'nota_2']));
                $t3 = $numero($valor($materia, ['t3', 'tercer_trimestre', 'nota3', 'nota_3']));
                if ($t1 === null || $t2 === null) {
                    continue;
                }
                $necesita = max(0, 51 * 3 - $t1 - $t2);
                $resultado = $estado($necesita);
                $promedioMaximo = round(($t1 + $t2 + 100) / 3, 2);
                $detalle = [
                    'materia' => $valor(
                        $materia,
                        ['materia', 'nombre_materia', 'subject', 'name'],
                        'Materia sin nombre',
                    ),
                    't1' => $t1,
                    't2' => $t2,
                    't3' => $t3,
                    'necesita' => $necesita,
                    'promedio_maximo' => $promedioMaximo,
                    'estado' => $resultado,
                ];
                $detalles->push($detalle);
                $filas->push(
                    array_merge($detalle, [
                        'estudiante' => $nombre,
                        'curso' => trim($cursoEstudiante . ' ' . $paraleloEstudiante),
                        'detalles' => $detalles,
                    ]),
                );
            }
        }

        $cantidadEstudiantes = $filas->pluck('estudiante')->unique()->count();
        $cantidadMaterias = $filas->count();
        $cantidadRecuperables = $filas->where('estado.class', 'recoverable')->pluck('estudiante')->unique()->count();
        $cantidadAlcanzables = $filas->where('necesita', '<=', 100)->count();
        $estudiantesAgrupados = $filas->groupBy('estudiante');
    @endphp

    <style>
        .riesgo-page {
            --riesgo-blue: #1261d6;
            --riesgo-ink: #26364a;
            --riesgo-muted: #68778b;
            --riesgo-line: #e4e9f0;
            color: var(--riesgo-ink);
            font-family: "Poppins", sans-serif;
            padding: 0 1rem 2rem;
        }

        .riesgo-card {
            background: #fff;
            border: 1px solid var(--riesgo-line);
            border-radius: 9px;
            box-shadow: 0 2px 8px rgba(38, 54, 74, .06);
        }

        .riesgo-title {
            border-left: 4px solid var(--riesgo-blue);
            padding: .15rem 0 .15rem 1rem;
        }

        .riesgo-kpi {
            position: relative;
            overflow: hidden;
            padding: 1rem 1.15rem;
            min-height: 94px;
        }

        .riesgo-kpi::after {
            content: '';
            position: absolute;
            right: -18px;
            bottom: -25px;
            width: 76px;
            height: 76px;
            border-radius: 50%;
            background: currentColor;
            opacity: .06;
        }

        .riesgo-kpi .value {
            color: var(--riesgo-ink);
            font-size: 1.55rem;
            font-weight: 700;
            line-height: 1;
        }

        .riesgo-kpi .label {
            color: var(--riesgo-muted);
            font-size: .7rem;
            font-weight: 600;
            letter-spacing: .02em;
        }

        .riesgo-kpi.red {
            color: #d94848;
            border-top: 3px solid #e36a6a;
        }

        .riesgo-kpi.amber {
            color: #d78b16;
            border-top: 3px solid #e6aa47;
        }

        .riesgo-kpi.green {
            color: #15946d;
            border-top: 3px solid #43b88e;
        }

        .riesgo-kpi.blue {
            color: var(--riesgo-blue);
            border-top: 3px solid #5e91e2;
        }

        .riesgo-filter label {
            display: block;
            color: var(--riesgo-muted);
            font-size: .68rem;
            font-weight: 600;
            margin-bottom: .35rem;
        }

        .riesgo-filter input,
        .riesgo-filter select {
            width: 100%;
            border: 1px solid #d8e0eb;
            border-radius: 5px;
            color: #334155;
            font-size: .76rem;
            min-height: 36px;
            padding: .45rem .65rem;
            background: #fff;
            outline: none;
        }

        .riesgo-filter input:focus,
        .riesgo-filter select:focus {
            border-color: var(--riesgo-blue);
            box-shadow: 0 0 0 2px rgba(18, 97, 214, .1);
        }

        .riesgo-table {
            border-collapse: collapse;
            width: 100%;
            font-size: .72rem;
        }

        .riesgo-table th {
            background: #1261d6;
            color: #fff;
            font-size: .67rem;
            font-weight: 600;
            padding: .75rem .55rem;
            text-align: left;
            white-space: nowrap;
        }

        .riesgo-table td {
            border-bottom: 1px solid #edf0f4;
            padding: .72rem .55rem;
            vertical-align: middle;
        }

        .riesgo-table tbody tr:hover {
            background: #f7faff;
        }

        .riesgo-table .student-name {
            color: #26364a;
            font-weight: 600;
        }

        .riesgo-table .student-index {
            color: #738196;
            font-weight: 600;
        }

        .grade {
            display: inline-flex;
            min-width: 27px;
            justify-content: center;
            border-radius: 4px;
            padding: .23rem .3rem;
            background: #f0f3f7;
            font-weight: 600;
        }

        .grade.missing {
            color: #8a96a6;
            background: #f7f8fa;
        }

        .risk-badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            border-radius: 999px;
            padding: .28rem .55rem;
            font-size: .65rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .risk-badge i {
            align-items: center;
            border-radius: 50%;
            display: inline-flex;
            font-size: .58rem;
            font-style: normal;
            height: 15px;
            justify-content: center;
            width: 15px;
        }

        .risk-badge.critical {
            background: #fff0f0;
            color: #c63e43;
        }

        .risk-badge.critical i {
            background: #d95357;
            color: #fff;
        }

        .risk-badge.attention {
            background: #fff8e8;
            color: #a9690b;
        }

        .risk-badge.attention i {
            background: #e4a336;
            color: #fff;
        }

        .risk-badge.recoverable {
            background: #eaf8f3;
            color: #137b5d;
        }

        .risk-badge.recoverable i {
            background: #2ba77c;
            color: #fff;
        }

        .detail-button,
        .report-button {
            border: 0;
            border-radius: 5px;
            cursor: pointer;
            font-size: .68rem;
            font-weight: 600;
            padding: .48rem .65rem;
            white-space: nowrap;
        }

        .detail-button {
            background: #eaf2ff;
            color: #145dc1;
        }

        .detail-button:hover {
            background: #dbeaff;
        }

        .report-button {
            background: #1261d6;
            color: #fff;
        }

        .riesgo-empty {
            color: #52705f;
            background: #f0faf5;
            border: 1px solid #ccebdd;
            border-radius: 6px;
            padding: 1.1rem;
            text-align: center;
            font-size: .8rem;
        }

        .risk-modal {
            align-items: center;
            background: rgba(24, 39, 58, .5);
            display: none;
            inset: 0;
            justify-content: center;
            padding: 1rem;
            position: fixed;
            z-index: 100;
        }

        .risk-modal.open {
            display: flex;
        }

        .risk-dialog {
            background: #fff;
            border-radius: 9px;
            box-shadow: 0 16px 45px rgba(24, 39, 58, .2);
            max-height: 90vh;
            max-width: 760px;
            overflow: auto;
            width: 100%;
        }

        .risk-modal-header {
            border-bottom: 1px solid var(--riesgo-line);
            display: flex;
            justify-content: space-between;
            padding: 1.1rem 1.25rem;
        }

        .risk-close {
            background: transparent;
            border: 0;
            color: #718096;
            cursor: pointer;
            font-size: 1.3rem;
            line-height: 1;
        }

        .risk-modal-body {
            padding: 1.25rem;
        }

        .detail-table {
            border-collapse: collapse;
            font-size: .72rem;
            width: 100%;
        }

        .detail-table th {
            color: var(--riesgo-muted);
            font-size: .65rem;
            padding: .55rem;
            text-align: left;
        }

        .detail-table td {
            border-top: 1px solid #edf0f4;
            padding: .65rem .55rem;
        }


        }
    </style>

    <div class="riesgo-page*">
        <div
            class=" rounded border border-slate-200 bg-white mb-1 flex flex-col justify-between gap-4 p-4 sm:flex-row sm:items-center">
            <div class="riesgo-title">
                <h1 class="m-0 text-base font-semibold text-black sm:text-lg">Riesgo Académico</h1>
                <p class="m-0 mt-1 text-[11px] text-slate-500">Estudiantes con materias en riesgo de reprobación en la
                    gestión actual</p>
            </div>
            <div class="flex items-center gap-2 text-xs font-semibold text-blue-700"><i class="fa-solid fa-calendar-days"></i>
                Gestión {{ $gestionActual }}</div>
        </div>

        <div class="flex flex-row">
            <div class="basis-3/4">
                <div class="  h-fit rounded border border-slate-200 bg-white mb-4 flex flex-row justify-start gap-4 p-4">
                    <div class="w-fit px-5 border-r border-slate-200 flex flex-col justify-center items-center">
                        <P>Curso</P>
                        <p class="font-bold">5to Secundaria A </p>
                    </div>
                    <div class="w-fit px-5 border-r border-slate-200  flex flex-col justify-center items-center">
                        <p>Estudiante</p>
                        <p class="font-bold">38</p>
                    </div>
                </div>
                <div class="bg-white rounded border border-slate-200 p-4">
                    <table class="w-full">
                        <thead class="bg-[#0052D7] text-white text-xs">
                            <tr>
                                <th>Materia</th>
                                <th>1er Trim.</th>
                                <th>2do Trim.</th>
                                <th>3er Trim.</th>
                                <th>Necesita</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="basis-1/4">
                <div class="rounded border border-slate-200 bg-white mb-4 flex flex-row justify-start gap-4 p-4">
                    <div class="w-full flex flex-crow gap-1 justify-center mt-4 h-48">
                        <i data-lucide="school"></i>
                        <p> Unidad Educativa Cristiano "Vida Nueva"</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="mb-4 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-4">
            <div class="riesgo-card riesgo-kpi red">
                <div class="label">ESTUDIANTES EN RIESGO</div>
                <div class="value mt-3">{{ $cantidadEstudiantes }}</div>
            </div>
            <div class="riesgo-card riesgo-kpi amber">
                <div class="label">MATERIAS EN RIESGO</div>
                <div class="value mt-3">{{ $cantidadMaterias }}</div>
            </div>
            <div class="riesgo-card riesgo-kpi green">
                <div class="label">ESTUDIANTES RECUPERABLES</div>
                <div class="value mt-3">{{ $cantidadRecuperables }}</div>
            </div>
            <div class="riesgo-card riesgo-kpi blue">
                <div class="label">REQUIEREN CALIFICACIÓN &ge; 51</div>
                <div class="value mt-3">{{ $cantidadAlcanzables }}</div>
            </div>
        </div> --}}

        {{--  <form class="riesgo-card riesgo-filter mb-4 grid grid-cols-1 gap-3 p-4 sm:grid-cols-2 lg:grid-cols-5" method="GET"
            action="{{ request()->url() }}">
            <div><label for="curso">Curso</label><select id="curso" name="curso">
                    <option value="">Todos los cursos</option>
                    <option @selected(request('curso', $curso ?? '') == '5to Secundaria')>5to Secundaria</option>
                    <option @selected(request('curso', $curso ?? '') == '6to Secundaria')>6to Secundaria</option>
                </select></div>
            <div><label for="paralelo">Paralelo</label><select id="paralelo" name="paralelo">
                    <option value="">Todos</option>
                    <option @selected(request('paralelo', $paralelo ?? '') == 'A')>A</option>
                    <option @selected(request('paralelo', $paralelo ?? '') == 'B')>B</option>
                    <option @selected(request('paralelo', $paralelo ?? '') == 'C')>C</option>
                </select></div>
            <div><label for="materia">Materia</label><select id="materia" name="materia">
                    <option value="">Todas las materias</option>
                    @foreach ($filas->pluck('materia')->unique() as $nombreMateria)
                        <option @selected(request('materia') == $nombreMateria)>{{ $nombreMateria }}</option>
                    @endforeach
                </select>
            </div>
            <div><label for="estado">Estado de riesgo</label><select id="estado" name="estado">
                    <option value="">Todos los estados</option>
                    <option value="critical" @selected(request('estado') == 'critical')>Riesgo crítico</option>
                    <option value="attention" @selected(request('estado') == 'attention')>En riesgo</option>
                    <option value="recoverable" @selected(request('estado') == 'recoverable')>Recuperable</option>
                </select></div>
            <div><label for="buscar">Buscar estudiante</label><input id="buscar" name="buscar"
                    value="{{ request('buscar') }}" placeholder="Nombre del estudiante..."></div>
            <div class="flex items-end gap-2 sm:col-span-2 lg:col-span-5"><button class="report-button" type="submit"><i
                        class="fa-solid fa-filter mr-1"></i> Aplicar filtros</button><a class="detail-button"
                    href="{{ request()->url() }}">Limpiar</a></div>
        </form> --}}

        <div class="riesgo-card overflow-hidden">
            <div
                class="flex flex-col gap-1 border-b border-slate-100 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="m-0 text-sm font-semibold text-slate-700">Estudiantes con materias en riesgo</h2>
                    <h1 class="font-bold text-slate-800">5to Secundaria A</h1>
                </div><button type="button" class="report-button"><i class="fa-solid fa-file-arrow-down mr-1"></i></button>
            </div>
            @if ($filas->isEmpty())
                <div class="p-4">
                    <div class="riesgo-empty"><i class="fa-solid fa-circle-check mr-1"></i> No existen estudiantes en riesgo
                        académico</div>
                </div>
            @else
                <div class="table-scroll">
                    <table class="riesgo-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Estudiante</th>
                                <th>Curso</th>
                                <th>Materia</th>
                                <th>1er Trim.</th>
                                <th>2do Trim.</th>
                                <th>3er Trim.</th>
                                <th>Necesita</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estudiantesAgrupados as $nombreEstudiante => $materiasEstudiante)
                                @foreach ($materiasEstudiante as $indice => $fila)
                                    <tr>
                                        <td class="student-index">{{ sprintf('%02d', $loop->parent->iteration) }}</td>
                                        <td>
                                            @if ($indice === 0)
                                                <span class="student-name">{{ $nombreEstudiante }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($indice === 0)
                                                {{ $fila['curso'] }}
                                            @endif
                                        </td>
                                        <td class="font-medium text-slate-600">{{ $fila['materia'] }}</td>
                                        <td><span class="grade">{{ $fila['t1'] }}</span></td>
                                        <td><span class="grade">{{ $fila['t2'] }}</span></td>
                                        <td><span
                                                class="grade {{ $fila['t3'] === null ? 'missing' : '' }}">{{ $fila['t3'] ?? '--' }}</span>
                                        </td>
                                        <td><strong
                                                class="{{ $fila['necesita'] > 100 ? 'text-red-600' : 'text-slate-700' }}">{{ $fila['necesita'] > 100 ? 'No alcanza' : $fila['necesita'] }}</strong>
                                            @if ($fila['necesita'] > 100)
                                                <small class="block text-[9px] text-slate-400">Máx.
                                                    {{ number_format($fila['promedio_maximo'], 2) }}</small>
                                            @endif
                                        </td>
                                        <td><span
                                                class="risk-badge {{ $fila['estado']['class'] }}"><i>{{ $fila['estado']['icon'] }}</i>{{ $fila['estado']['label'] }}</span>
                                        </td>
                                        <td>
                                            @if ($indice === 0)
                                                <button type="button" class="detail-button"
                                                    data-modal="student-modal-{{ $loop->parent->iteration }}">Ver
                                                    detalle</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @if (!$estudiantesAgrupados->isEmpty())
        @foreach ($estudiantesAgrupados as $nombreEstudiante => $materiasEstudiante)
            <div class="risk-modal" id="student-modal-{{ $loop->iteration }}" role="dialog" aria-modal="true"
                aria-labelledby="student-title-{{ $loop->iteration }}">
                <div class="risk-dialog">
                    <div class="risk-modal-header">
                        <div>
                            <p class="m-0 text-[10px] font-semibold uppercase tracking-wide text-blue-600">Estudiante</p>
                            <h2 class="m-0 mt-1 text-base font-semibold text-slate-700"
                                id="student-title-{{ $loop->iteration }}">{{ $nombreEstudiante }}</h2>
                            <p class="m-0 mt-1 text-[11px] text-slate-500">Curso:
                                {{ $materiasEstudiante->first()['curso'] }}</p>
                        </div><button type="button" class="risk-close" aria-label="Cerrar">&times;</button>
                    </div>
                    <div class="risk-modal-body">
                        <table class="detail-table">
                            <thead>
                                <tr>
                                    <th>Materia</th>
                                    <th>1er</th>
                                    <th>2do</th>
                                    <th>3er</th>
                                    <th>Necesita</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiasEstudiante as $detalle)
                                    <tr>
                                        <td class="font-semibold text-slate-600">{{ $detalle['materia'] }}</td>
                                        <td>{{ $detalle['t1'] }}</td>
                                        <td>{{ $detalle['t2'] }}</td>
                                        <td>{{ $detalle['t3'] ?? '--' }}</td>
                                        <td>{{ $detalle['necesita'] > 100 ? 'No puede alcanzar 51' : $detalle['necesita'] }}
                                        </td>
                                        <td><span
                                                class="risk-badge {{ $detalle['estado']['class'] }}"><i>{{ $detalle['estado']['icon'] }}</i>{{ $detalle['estado']['label'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('[data-modal]').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.getElementById(button.dataset.modal).classList.add('open');
                });
            });
            document.querySelectorAll('.risk-modal').forEach(function(modal) {
                modal.addEventListener('click', function(event) {
                    if (event.target === modal || event.target.closest('.risk-close')) modal
                        .classList.remove('open');
                });
            });
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') document.querySelectorAll('.risk-modal.open').forEach(function(
                    modal) {
                    modal.classList.remove('open');
                });
            });
        });
    </script>
@endsection

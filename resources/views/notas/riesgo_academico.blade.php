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
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="max-w-[1400px] mx-auto flex flex-col lg:flex-row gap-6 items-start">
                <!-- BEGIN: LeftPrimaryColumn -->
                <section class="flex-1 w-full bg-white rounded-lg shadow-sm border border-slate-200/70 p-5"
                    data-purpose="student-risk-card">
                    <!-- Title & Context -->
                    <div class="mb-4">
                        <h2 class="text-base font-bold text-slate-900 leading-tight">Riesgo Académico</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Estudiantes con materias en riesgo de reprobación en la
                            gestión actual</p>
                    </div>
                    <!-- Divider Line -->
                    <div class="border-t border-slate-100 my-4"></div>
                    <!-- Filter & Statistics Meta Row -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-4 text-sm">
                        <div class="flex items-center divide-x divide-slate-300">
                            <!-- Curso Info -->
                            <div class="pr-6">
                                <span class="text-xs text-slate-400 block font-normal leading-none mb-1">Curso</span>
                                <span
                                    class="font-bold text-slate-900 text-sm">{{ $cursoSeleccionado?->display_name ?? 'Todos los cursos' }}</span>
                            </div>
                            <!-- Estudiantes Count -->
                            <div class="pl-6">
                                <span class="text-xs text-slate-400 block font-normal leading-none mb-1">Estudiantes</span>
                                <span class="font-bold text-slate-900 text-sm">{{ $cantidadEstudiantes }}</span>
                            </div>
                        </div>
                        <!-- Report Export / Print Action Icons -->
                        <div class="flex items-center space-x-2">
                            <!-- Export Document Button -->
                            <button aria-label="Exportar boletín"
                                class="p-2 border border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 rounded transition-colors shadow-2xs"
                                type="button">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <!-- Print Button -->
                            <button aria-label="Imprimir registro"
                                class="p-2 border border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 rounded transition-colors shadow-2xs"
                                type="button">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- BEGIN: AcademicRiskTable -->
                    <div class="overflow-x-auto rounded border border-blue-600/20">
                        <div class="min-w-[650px]">
                            <!-- Blue Table Header -->
                            <div class="bg-[#005edb] text-white text-xs font-semibold px-4 py-2.5 flex items-center">
                                <div class="w-12">No</div>
                                <div class="w-48 sm:w-56">Estudiante</div>
                                <div class="flex-1">Materia</div>
                                <div class="w-10 text-center">1er</div>
                                <div class="w-10 text-center">2do</div>
                                <div class="w-12 text-center">3er</div>
                                <div class="w-44 text-right pr-2"></div>
                            </div>
                            @forelse ($estudiantesAgrupados as $nombreEstudiante => $materiasEstudiante)
                                <div class="px-4 py-4 hover:bg-slate-50/70 transition-colors border-b border-slate-200">
                                    <div class="flex items-start">
                                        <div class="w-12 text-xs text-slate-500 font-medium pt-1">
                                            #{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                        <div class="w-48 sm:w-56 text-xs font-medium text-slate-800 pt-1 pr-2">
                                            {{ $nombreEstudiante }}</div>
                                        <div class="flex-1 space-y-2.5">
                                            @foreach ($materiasEstudiante as $detalle)
                                                <div class="flex items-center text-xs">
                                                    <div class="flex-1">
                                                        <p class="font-medium text-slate-800 text-xs leading-tight">
                                                            {{ $detalle['materia'] }}</p>
                                                    </div>
                                                    <div class="w-10 text-center text-xs text-slate-700">
                                                        {{ $detalle['t1'] }}</div>
                                                    <div class="w-10 text-center text-xs text-slate-700">
                                                        {{ $detalle['t2'] }}</div>
                                                    <div class="w-12 text-center"><span
                                                            class="inline-block bg-[#e2e8f0] text-slate-800 font-semibold px-2 py-0.5 rounded text-[11px]">{{ $detalle['t3'] ?? '--' }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="w-44 flex justify-end pl-2 pt-1">
                                            <button
                                                class="bg-[#00875a] hover:bg-[#00754e] text-white text-xs px-3 py-1.5 rounded flex items-center space-x-1.5 shadow-sm transition-colors whitespace-nowrap"
                                                type="button" data-modal="student-modal-{{ $loop->iteration }}">
                                                <span class="font-medium text-[11px]">Boletín de calificaciones</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="px-4 py-8 text-center text-xs text-slate-500">No hay estudiantes con riesgo
                                    académico para los filtros seleccionados.</div>
                            @endforelse
                        </div>
                    </div>
                    <!-- END: AcademicRiskTable -->
                    <!-- Empty spacer or bottom helper area matching clean desktop view -->
                    <div class="h-44"></div>
                </section>
                <!-- END: LeftPrimaryColumn -->
                <!-- BEGIN: RightSidebarCard -->
                <aside class="w-full lg:w-72 bg-white rounded-lg shadow-sm border border-slate-200/80 p-4 flex-shrink-0"
                    data-purpose="school-course-selector">
                    <!-- Institutional Header -->
                    <div class="flex items-center space-x-2.5 pb-3 border-b border-slate-100 mb-3">
                        <svg class="w-5 h-5 text-slate-800 flex-shrink-0" fill="none" stroke="currentColor"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <h3 class="text-xs font-semibold text-slate-800 leading-snug">
                            Unidad Educativa Cristiano "Vida Nueva"
                        </h3>
                    </div>
                    <!-- Grades and Sections Selection Grid -->
                    <form action="{{ route('notas.riesgo-academico') }}" method="GET" id="curso-riesgo-form">
                        <input type="hidden" name="id_gestion" value="{{ $selectedGestion }}">
                        <input type="hidden" name="nivel" value="{{ $selectedNivel }}">
                        <input type="hidden" name="id_curso" id="curso-riesgo-id">
                    </form>
                    <div class="space-y-2 text-xs" id="curso-riesgo-selector">
                        <!-- Primero -->
                        <div class="flex items-center justify-between">
                            <span class="text-slate-700 font-normal w-16">Primero</span>
                            <div class="flex space-x-1.5">
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C21A">A</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C21B">B</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C21C">C</button>
                            </div>
                        </div>
                        <!-- Segundo -->
                        <div class="flex items-center justify-between">
                            <span class="text-slate-700 font-normal w-16">Segundo</span>
                            <div class="flex space-x-1.5">
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C22A">A</button>
                                <!-- Active button fill (#34495E) matching screenshot -->
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C22B">B</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C22C">C</button>
                            </div>
                        </div>
                        <!-- Tercero -->
                        <div class="flex items-center justify-between">
                            <span class="text-slate-700 font-normal w-16">Tercero</span>
                            <div class="flex space-x-1.5">
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C23A">A</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C23B">B</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C23C">C</button>
                            </div>
                        </div>
                        <!-- Cuarto -->
                        <div class="flex items-center justify-between">
                            <span class="text-slate-700 font-normal w-16">Cuarto</span>
                            <div class="flex space-x-1.5">
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C24A">A</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C24B">B</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C24C">C</button>
                            </div>
                        </div>
                        <!-- Quinto -->
                        <div class="flex items-center justify-between">
                            <span class="text-slate-700 font-normal w-16">Quinto</span>
                            <div class="flex space-x-1.5">
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C25A">A</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C25B">B</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C25C">C</button>
                            </div>
                        </div>
                        <!-- Sexto -->
                        <div class="flex items-center justify-between">
                            <span class="text-slate-700 font-normal w-16">Sexto</span>
                            <div class="flex space-x-1.5">
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C26A">A</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C26B">B</button>
                                <button
                                    class="w-8 h-7 text-xs border border-slate-300 rounded text-slate-700 hover:bg-slate-50 transition-colors"
                                    type="button" id="C26C">C</button>
                            </div>
                        </div>
                    </div>
                </aside>
                <!-- END: RightSidebarCard -->
            </div>
        </main>

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
            const cursoRiesgoForm = document.getElementById('curso-riesgo-form');
            const cursoRiesgoId = document.getElementById('curso-riesgo-id');

            document.querySelectorAll('#curso-riesgo-selector button[id]').forEach(function(button) {
                button.addEventListener('click', function() {
                    cursoRiesgoId.value = button.id;
                    cursoRiesgoForm.submit();
                });
            });

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

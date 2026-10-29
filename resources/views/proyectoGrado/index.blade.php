@extends('layouts.navhorizontal')

@section('content')
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&amp;family=Public+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <style>
        @layer base {

            html,
            body {
                margin: 0;
                padding: 0;
            }

            body {
                overscroll-behavior: none;
            }

            main>:first-child {
                margin-top: 0 !important;
            }

            main>:last-child {
                margin-bottom: 0 !important;
            }
        }

        ::-webkit-scrollbar {
            display: none;
        }
    </style>
    <main class="w-full flex-1 px-gutter-lg pb-gutter-lg">
        <div class="flex flex-col w-full gap-gutter-lg">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-gutter-md">
                <div class="flex flex-col">
                    <div class="flex items-center gap-2 mb-1">
                        <span
                            class="px-2 py-0.5 rounded bg-primary text-on-primary font-data-mono text-label-md uppercase tracking-wider">Módulo
                            BTH</span>
                        <span class="font-data-mono text-label-md text-outline">CICLO ACADÉMICO 2026</span>
                    </div>
                    <h1 class="font-display text-display text-on-surface tracking-tight">Monitoreo de Proyectos de Grado
                    </h1>

                </div>
                <div class="flex items-center gap-3">
                    <button id="abrir-modal-sorteo" type="button"
                        class="flex items-center gap-2 px-4 py-2 bg-primary hover:bg-primary/90 text-on-primary rounded shadow-sm transition-all font-label-lg text-label-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">casino</span>
                        <span>Sorteo de proyectos</span>
                    </button>
                    {{-- <button
                        class="flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded shadow-sm transition-all font-label-lg text-label-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px] text-on-surface-variant">file_download</span>
                        <span>Exportar Cuadro XLS</span>
                    </button> --}}
                    <button id="abrir-modal-registro-proyecto" type="button"
                        class="flex items-center gap-2 px-4 py-2 bg-secondary hover:bg-secondary/90 text-on-secondary rounded shadow-sm transition-all font-label-lg text-label-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        <span>Nuevo Registro de Proyecto</span>
                    </button>
                </div>
                <p class="text-body-sm text-on-surface-variant">
                    Horas de cierre de cada turno: 08:30, 09:00, 09:30, 10:00, 10:30, 11:00, 11:30, 12:00,
                    12:30, 13:30, 14:00, 14:30, 15:00, 15:30, 16:00, 16:30, 17:00 y 17:30.
                </p>
            </div>
            @if (session('success'))
                <div class="rounded-lg bg-secondary-container px-4 py-3 text-on-secondary-container" role="status">
                    {{ session('success') }}
                </div>
            @endif
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-gutter-md">
                <div
                    class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-primary/5 pointer-events-none">
                    </div>
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Proyectos
                                Registrados</span>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span class="font-display text-display text-primary">{{ $proyectos->total() }}</span>
                                <span class="font-data-mono text-body-sm text-secondary font-semibold">100%
                                    ACTIVO</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                            <span class="material-symbols-outlined text-[22px]">assignment</span>
                        </div>
                    </div>
                    <div
                        class="mt-4 pt-3 bg-surface-container-low/50 -mx-inset-card -mb-inset-card px-inset-card py-2 flex items-center justify-between text-body-sm">
                        <span class="text-on-surface-variant">Tecnica Tecnologica Especializada</span>
                        {{-- <span class="text-outline-variant">•</span>
                        <span class="text-on-surface-variant">8 Excelencia / Monog.</span> --}}
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-secondary/5 pointer-events-none">
                    </div>
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Avance
                                Global del Ciclo</span>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span
                                    class="font-display text-display text-secondary">{{ number_format(($dictamen->count() * 100) / $proyectos->total(), 2) }}%</span>
                                <span
                                    class="font-label-md text-label-md text-secondary bg-secondary-container px-1.5 py-0.5 rounded font-semibold">+4.2%
                                    mes</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined text-[22px]">trending_up</span>
                        </div>
                    </div>
                    <div
                        class="mt-4 pt-3 bg-surface-container-low/50 -mx-inset-card -mb-inset-card px-inset-card py-2 flex flex-col gap-1.5">
                        <div class="w-full bg-surface-container-highest h-1.5 rounded-full overflow-hidden">
                            <div class="bg-secondary h-full rounded-full transition-all duration-500" style="width: 78.4%">
                            </div>
                        </div>
                        <div class="flex justify-between text-body-sm text-outline font-data-mono">
                            <span>Meta: 90% Nov</span>
                            <span>Diferencial:
                                -{{ number_format((($proyectos->total() - $dictamen->count()) * 100) / $proyectos->total(), 2) }}%</span>
                        </div>
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-error/5 pointer-events-none">
                    </div>
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Observados
                                / En Riesgo</span>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span
                                    class="font-display text-display text-error">{{ $proyectos->total() - $dictamen->count() }}</span>
                                <span
                                    class="font-label-md text-label-md text-error bg-error-container px-1.5 py-0.5 rounded font-semibold">Acción
                                    Urgente</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-error-container flex items-center justify-center text-on-error-container">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            {{--  <span class="material-symbols-outlined ">warning</span> --}}
                        </div>
                    </div>
                    <div
                        class="mt-4
                                pt-3 bg-surface-container-low/50 -mx-inset-card -mb-inset-card px-inset-card py-2 flex
                                items-center justify-between text-body-sm">
                        <span class="text-error font-medium">Tribunal pendiente</span>
                        {{-- <span class="text-outline-variant">•</span>
                        <span class="text-on-surface-variant">2 Perfil desfasado</span> --}}
                    </div>
                </div>
                <div
                    class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-tertiary/5 pointer-events-none">
                    </div>
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Defensas
                                Programadas</span>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span class="font-display text-display text-on-surface">{{ $dictamen->count() }}</span>
                                <span class="font-data-mono text-body-sm text-tertiary font-semibold">PROYECTO</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
                            <span class="material-symbols-outlined text-[22px]">gavel</span>
                        </div>
                    </div>
                    <div
                        class="mt-4 pt-3 bg-surface-container-low/50 -mx-inset-card -mb-inset-card px-inset-card py-2 flex items-center justify-between text-body-sm">
                        <span class="text-on-surface font-medium">81 Agendadas hoy</span>
                        {{-- <span class="text-outline-variant">•</span>
                        <span class="text-secondary font-medium">10 Con tribunal OK</span> --}}
                    </div>
                </div>
            </div>
            {{-- <div class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-gutter-sm pb-4">
                    <div>
                        <h2 class="font-headline-sm text-headline-sm text-on-surface">Embudo Progresivo de Fases
                            Ministeriales</h2>
                        <p class="font-body-sm text-on-surface-variant">Estado secuencial de la cohorte 2024 en base
                            al Reglamento de Modalidades de Graduación BTH.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="font-data-mono text-body-sm text-outline flex items-center gap-1">
                            <span class="w-2 h-2 rounded-full bg-secondary"></span> 46 Proyectos Totales
                        </span>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter-md pt-2">
                    <div
                        class="bg-surface-container-low rounded-lg p-4 relative overflow-hidden flex flex-col justify-between group hover:bg-surface-container transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-data-mono-bold text-data-mono-bold text-primary">FASE 01</span>
                            <span
                                class="px-2 py-0.5 rounded text-label-md font-semibold bg-secondary-container text-on-secondary-container flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">check_circle</span> 100%
                            </span>
                        </div>
                        <h3 class="font-headline-sm text-label-lg font-semibold text-on-surface mb-1">Aprobación de
                            Perfil</h3>
                        <p class="font-body-sm text-on-surface-variant mb-4">Registro ministerial de tema, objetivos
                            y delimitación socio-productiva.</p>
                        <div>
                            <div class="flex items-baseline justify-between mb-1">
                                <span class="font-data-mono-bold text-headline-sm text-on-surface">46<span
                                        class="text-body-sm font-normal text-on-surface-variant">/46</span></span>
                                <span class="font-data-mono text-body-sm text-secondary">Finalizado</span>
                            </div>
                            <div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-full"></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-surface-container-low rounded-lg p-4 relative overflow-hidden flex flex-col justify-between group hover:bg-surface-container transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-data-mono-bold text-data-mono-bold text-primary">FASE 02</span>
                            <span
                                class="px-2 py-0.5 rounded text-label-md font-semibold bg-primary-fixed text-on-primary-fixed">84.7%</span>
                        </div>
                        <h3 class="font-headline-sm text-label-lg font-semibold text-on-surface mb-1">Marco
                            Aplicativo</h3>
                        <p class="font-body-sm text-on-surface-variant mb-4">Desarrollo empírico, prototipo tangible
                            y sistematización de campo.</p>
                        <div>
                            <div class="flex items-baseline justify-between mb-1">
                                <span class="font-data-mono-bold text-headline-sm text-on-surface">39<span
                                        class="text-body-sm font-normal text-on-surface-variant">/46</span></span>
                                <span class="font-data-mono text-body-sm text-primary">7 en redacción</span>
                            </div>
                            <div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden">
                                <div class="bg-primary-container h-full rounded-full" style="width: 84.7%"></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-surface-container-low rounded-lg p-4 relative overflow-hidden flex flex-col justify-between group hover:bg-surface-container transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-data-mono-bold text-data-mono-bold text-primary">FASE 03</span>
                            <span
                                class="px-2 py-0.5 rounded text-label-md font-semibold bg-surface-container-highest text-on-surface">60.8%</span>
                        </div>
                        <h3 class="font-headline-sm text-label-lg font-semibold text-on-surface mb-1">Revisión de
                            Tribunal</h3>
                        <p class="font-body-sm text-on-surface-variant mb-4">Emisión de dictámenes metodológicos y
                            actas de conformidad.</p>
                        <div>
                            <div class="flex items-baseline justify-between mb-1">
                                <span class="font-data-mono-bold text-headline-sm text-on-surface">28<span
                                        class="text-body-sm font-normal text-on-surface-variant">/46</span></span>
                                <span class="font-data-mono text-body-sm text-tertiary">11 en lectura</span>
                            </div>
                            <div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden">
                                <div class="bg-tertiary-container h-full rounded-full" style="width: 60.8%"></div>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-surface-container-low rounded-lg p-4 relative overflow-hidden flex flex-col justify-between group hover:bg-surface-container transition-colors">
                        <div class="flex items-center justify-between mb-3">
                            <span class="font-data-mono-bold text-data-mono-bold text-primary">FASE 04</span>
                            <span
                                class="px-2 py-0.5 rounded text-label-md font-semibold bg-secondary-container text-on-secondary-container">30.4%</span>
                        </div>
                        <h3 class="font-headline-sm text-label-lg font-semibold text-on-surface mb-1">Defensa Final
                            &amp; Empastado</h3>
                        <p class="font-body-sm text-on-surface-variant mb-4">Sustentación oral, deliberación jurada
                            y acta oficial de calificación.</p>
                        <div>
                            <div class="flex items-baseline justify-between mb-1">
                                <span class="font-data-mono-bold text-headline-sm text-on-surface">14<span
                                        class="text-body-sm font-normal text-on-surface-variant">/46</span></span>
                                <span class="font-data-mono text-body-sm text-secondary">Defensas fijadas</span>
                            </div>
                            <div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden">
                                <div class="bg-secondary h-full rounded-full" style="width: 30.4%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div
                class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col md:flex-row items-center justify-between gap-gutter-md">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-gutter-md w-full md:w-auto flex-1">
                    <div class="flex flex-col">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Modalidad
                            de Titulación</label>
                        <div class="relative">
                            <select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 focus:outline-none focus:bg-surface-container"
                                id="filter-modalidad">
                                <option value="todos">Todas las Modalidades (81)</option>
                                <option value="socio">Proyecto de emprendimiento Productivo (24)</option>
                                <option value="emprendimiento">Proyecto de Innovacion (14)</option>
                                <option value="tesis">Practica Laboral Comunitaria (8)</option>
                                <option value="tesis">Proyecto de Servicio Social Comunitario (8)</option>
                                <option value="tesis">Proyecto de Presentacion Artistica (8)</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Turno
                            Académico</label>
                        <div class="relative">
                            <select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 focus:outline-none focus:bg-surface-container"
                                id="filter-turno">
                                <option value="todos">Todos los Turnos</option>
                                <option value="manana">Mañana (Sistemas Informaticos)</option>
                                <option value="tarde">Tarde (Sistemas Informaticos)</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Tutor
                            Metodológico</label>
                        <div class="relative">
                            <select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 focus:outline-none focus:bg-surface-container"
                                id="filter-asesor">
                                <option value="todos">Todos los Docentes Tutores</option>
                                <option value="mamani">Lic. Javier Henry Quispe Pinto</option>
                                <option value="gutierrez">Lic. Jose Luis Quisbert Quisbert</option>
                                <option value="valdez">Lic. Roger Cori</option>
                                <option value="quispe">Lic. Judith Flores Solar</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2 self-end md:self-auto w-full md:w-auto justify-end">
                    <div class="relative w-full sm:w-64">
                        <span
                            class="material-symbols-outlined absolute left-3 top-2.5 text-on-surface-variant text-[18px]">search</span>
                        <input
                            class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded pl-9 pr-3 py-2 focus:outline-none focus:bg-surface-container"
                            placeholder="Buscar por código o estudiante..." type="text" />
                    </div>
                    <button
                        class="p-2 rounded bg-surface-container-low hover:bg-surface-container text-on-surface transition-colors"
                        title="Limpiar Filtros">
                        <span class="material-symbols-outlined text-[20px]">filter_alt_off</span>
                    </button>
                </div>
            </div> --}}
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-gutter-lg items-start">
                <div class="xl:col-span-8 flex flex-col gap-gutter-md">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
                        <div class="px-inset-card py-4 bg-surface-container-low/60 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary text-[22px]">table_chart</span>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface">Listado Central de
                                    Proyectos de Grado</h2>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-primary/10 text-primary font-data-mono text-body-sm font-semibold">{{ $proyectos->count() }}
                                    Mostrados</span>
                            </div>
                            <div class="flex items-center gap-2 text-label-md text-on-surface-variant">
                                <span class="flex items-center gap-1"><span
                                        class="w-2 h-2 rounded-full bg-secondary"></span> En Plazo</span>
                                <span class="flex items-center gap-1"><span
                                        class="w-2 h-2 rounded-full bg-tertiary-container"></span> Observado</span>
                                <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-error"></span>
                                    Riesgo</span>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
                                        <th class="py-3 px-4">Código / Proyecto</th>
                                        <th class="py-3 px-4">Postulantes</th>
                                        <th class="py-3 px-4">Modalidad</th>
                                        <th class="py-3 px-4">Tribunal Dictaminador</th>
                                        <th class="py-3 px-4 text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-container-low text-body-sm">
                                    @forelse ($proyectos as $proyecto)
                                        @php
                                            $participantes = collect([$proyecto->estudiante])
                                                ->merge($proyecto->proyectoEstudiantes->pluck('estudiante'))
                                                ->filter()
                                                ->unique('id_estudiante');
                                        @endphp
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">PG-2026-{{ $proyecto->idProyecto }}</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">{{ $proyecto->titulo }}</span>
                                                    <span class="font-label-md text-outline mt-1">
                                                        {{ $proyecto->curso?->display_name ?? $proyecto->idCurso }}
                                                        · Gestión
                                                        {{ $proyecto->gestion?->anio ?? $proyecto->idGestion }}
                                                        · <br> Esp. Sistemas Informaticos
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    @forelse ($participantes as $estudiante)
                                                        <div class="flex flex-row items-center gap-2">
                                                            <div
                                                                class="w-6 h-6 rounded-full bg-secondary-container flex items-center justify-center font-data-mono-bold text-[10px] text-secondary">
                                                                *</div>
                                                            <span class="font-body-md text-on-surface font-medium">
                                                                {{ trim($estudiante->nombres . ' ' . $estudiante->appaterno . ' ' . $estudiante->apmaterno) }}
                                                            </span>
                                                            {{-- <span
                                                                class="font-data-mono text-outline">{{ $estudiante->id_estudiante }}</span> --}}
                                                        </div>
                                                    @empty
                                                        <span class="text-outline">Sin estudiante asociado</span>
                                                    @endforelse
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">

                                                    @if ($proyecto->lineaInvestigacion == 'PI')
                                                        Proyecto de Innovacion
                                                    @elseif ($proyecto->lineaInvestigacion == 'PS')
                                                        Proyecto de Servicio Social Comunitario
                                                    @elseif ($proyecto->lineaInvestigacion == 'PC')
                                                        Proyecto de Presentacion Artistica
                                                    @elseif ($proyecto->lineaInvestigacion == 'SC')
                                                        Practica Laboral Comunitaria
                                                    @elseif ($proyecto->lineaInvestigacion == 'SC')
                                                        Proyecto de emprendimiento Productivo
                                                    @else
                                                        Sin modalidad asignada
                                                    @endif

                                                </span>
                                                <div class="font-body-sm text-outline mt-1">
                                                    Tutor:
                                                    @if ($proyecto->tutor)
                                                        Lic.
                                                        {{ trim($proyecto->tutor->nombres . ' ' . $proyecto->tutor->appaterno . ' ' . $proyecto->tutor->apmaterno) }}
                                                    @else
                                                        Sin tutor asignado
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1">
                                                    @forelse ($proyecto->tribunales as $tribunal)
                                                        <span class="font-body-md text-on-surface font-medium">
                                                            {{ $tribunal->profesor ? trim($tribunal->profesor->nombres . ' ' . $tribunal->profesor->appaterno . ' ' . $tribunal->profesor->apmaterno) : 'Profesor no disponible' }}
                                                        </span>
                                                        <span
                                                            class="font-label-md text-outline">{{ $tribunal->cargo }}</span>
                                                    @empty
                                                        <span class="text-outline">Sin tribunal asignado</span>
                                                    @endforelse
                                                    @php
                                                        $dictamenTitulo = $proyecto->dictamenOficial?->titulo;
                                                        $dictamenEstado = match ($dictamenTitulo) {
                                                            'Dictamen oficial: Sin visto bueno' => 'sin_visto_bueno',
                                                            'Dictamen oficial: Informe favorable'
                                                                => 'informe_favorable',
                                                            'Dictamen oficial: Habilitado para la defensa'
                                                                => 'habilitado_defensa',
                                                            default => 'en_lectura',
                                                        };
                                                        $dictamenEtiqueta = match ($dictamenEstado) {
                                                            'sin_visto_bueno' => 'Sin visto bueno',
                                                            'informe_favorable' => 'Informe favorable',
                                                            'habilitado_defensa' => 'Habilitado para la defensa',
                                                            default => 'En lectura metodológica',
                                                        };
                                                        $esTutorDesignado =
                                                            (string) session('profesor_id') ===
                                                            (string) $proyecto->idProfesorTutor;
                                                    @endphp
                                                    @if ($dictamenEstado === 'habilitado_defensa')
                                                        <span
                                                            class="font-label-md text-secondary flex items-center gap-0.5 mt-1"
                                                            aria-label="Dictamen bloqueado: {{ $dictamenEtiqueta }}">
                                                            <span
                                                                class="material-symbols-outlined text-[14px]">verified</span>
                                                            {{ $dictamenEtiqueta }}
                                                        </span>
                                                    @elseif ($esTutorDesignado)
                                                        <button type="button"
                                                            class="abrir-modal-dictamen font-label-md text-primary flex items-center gap-0.5 mt-1 cursor-pointer text-left"
                                                            data-project-id="{{ $proyecto->idProyecto }}"
                                                            data-project-code="PG-2026-{{ $proyecto->idProyecto }}"
                                                            data-project-title="{{ $proyecto->titulo }}"
                                                            data-project-course="{{ $proyecto->curso?->display_name ?? $proyecto->idCurso }}"
                                                            data-project-modality="{{ match ($proyecto->lineaInvestigacion) {
                                                                'PI' => 'Proyecto de Innovación',
                                                                'PS' => 'Proyecto de Servicio Social Comunitario',
                                                                'PC' => 'Proyecto de Presentación Artística',
                                                                'SC' => 'Práctica Laboral Comunitaria',
                                                                default => 'Sin modalidad asignada',
                                                            } }}"
                                                            data-project-rude="{{ $proyecto->estudiante?->rude ?? 'No registrado' }}"
                                                            data-project-students="{{ json_encode(
                                                                $participantes->map(
                                                                        fn($estudiante) => [
                                                                            'nombre' => trim($estudiante->nombres . ' ' . $estudiante->appaterno . ' ' . $estudiante->apmaterno),
                                                                            'ci' => $estudiante->ci ?: 'No registrado',
                                                                        ],
                                                                    )->values(),
                                                            ) }}"
                                                            data-project-tutor="{{ $proyecto->tutor ? trim($proyecto->tutor->nombres . ' ' . $proyecto->tutor->appaterno . ' ' . $proyecto->tutor->apmaterno) : 'Sin tutor asignado' }}"
                                                            data-project-tribunals="{{ json_encode(
                                                                $proyecto->tribunales->map(
                                                                        fn($tribunal) => [
                                                                            'nombre' => $tribunal->profesor
                                                                                ? trim(
                                                                                    $tribunal->profesor->nombres .
                                                                                        ' ' .
                                                                                        $tribunal->profesor->appaterno .
                                                                                        ' ' .
                                                                                        $tribunal->profesor->apmaterno,
                                                                                )
                                                                                : 'Profesor no disponible',
                                                                            'cargo' => $tribunal->cargo,
                                                                        ],
                                                                    )->values(),
                                                            ) }}"
                                                            data-dictamen-state="{{ $dictamenEstado }}"
                                                            data-dictamen-date="{{ $proyecto->dictamenOficial?->fecha?->format('Y-m-d') }}"
                                                            data-dictamen-resolution="{{ match ($proyecto->dictamenOficial?->descripcion) {
                                                                'Aprobado por Unanimidad (2/2)' => 'unanimidad',
                                                                'Aprobado por Mayoría con Respaldo Técnico' => 'mayoria',
                                                                'Con Observaciones Menores no Impeditivas' => 'menores',
                                                                'Rechazado para Reestructuración Profunda' => 'reestructuracion',
                                                                default => '',
                                                            } }}"
                                                            data-dictamen-observations="{{ $proyecto->dictamenOficial?->observacion }}"
                                                            data-default-date="{{ now()->toDateString() }}"
                                                            aria-label="Registrar o editar dictamen de {{ $proyecto->titulo }}">
                                                            <span class="material-symbols-outlined text-[14px]">
                                                                {{ $dictamenEstado === 'informe_favorable' ? 'task_alt' : ($dictamenEstado === 'sin_visto_bueno' ? 'cancel' : 'hourglass_top') }}
                                                            </span>
                                                            {{ $dictamenEtiqueta }}
                                                        </button>
                                                    @else
                                                        <span
                                                            class="font-label-md text-on-surface-variant flex items-center gap-0.5 mt-1">
                                                            <span class="material-symbols-outlined text-[14px]">
                                                                {{ $dictamenEstado === 'informe_favorable' ? 'task_alt' : ($dictamenEstado === 'sin_visto_bueno' ? 'cancel' : 'hourglass_top') }}
                                                            </span>
                                                            {{ $dictamenEtiqueta }}
                                                        </span>
                                                    @endif
                                                    @if ($proyecto->defensa)
                                                        <span class="font-label-md text-secondary mt-1">
                                                            Defensa:
                                                            {{ $proyecto->defensa->fecha?->format('d/m/Y') ?? 'Sin fecha' }}
                                                            {{ $proyecto->defensa->hora ? ' · ' . $proyecto->defensa->hora : '' }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-middle text-center">
                                                {{-- <a href="{{ route('proyectoGrado.show', $proyecto->idProyecto) }}"
                                                    class="inline-flex p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                    title="Ver expediente completo">
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </a> --}}
                                                <a href="{{ route('proyectoGrado.seguimiento', $proyecto->idProyecto) }}"
                                                    class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                    title="Ver seguimiento del proyecto"
                                                    aria-label="Ver seguimiento del proyecto {{ $proyecto->idProyecto }}">
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </a>
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                    title="Registrar Observación">
                                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="py-8 px-4 text-center text-on-surface-variant">
                                                No hay proyectos de grado registrados.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                @if (false)
                                    <tbody class="divide-y divide-surface-container-low text-body-sm">
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">PRY-2024-01</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">Sistema
                                                        Automatizado de Riego por Goteo con Sensor IoT</span>
                                                    <span class="font-label-md text-outline mt-1">Especialidad:
                                                        Agroecología</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center font-data-mono-bold text-[10px] text-primary">
                                                            RC</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Rodrigo
                                                            Condori</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-secondary-container flex items-center justify-center font-data-mono-bold text-[10px] text-secondary">
                                                            AT</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Ana
                                                            Ticona Flores</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">Socio-Comunitario</span>
                                                <div class="font-body-sm text-outline mt-1">Tutor: Ing. C. Mamani</div>
                                            </td>
                                            {{-- <td class="py-3.5 px-4 align-top">
                                            <div class="flex flex-col gap-1 w-24">
                                                <div class="flex justify-between items-center">
                                                    <span
                                                        class="font-data-mono-bold text-secondary text-body-sm">95%</span>
                                                    <span
                                                        class="px-1.5 py-0.2 rounded bg-secondary-container text-on-secondary-container text-[10px] font-semibold">Listo</span>
                                                </div>
                                                <div
                                                    class="w-full bg-surface-container-highest h-1.5 rounded-full overflow-hidden">
                                                    <div class="bg-secondary h-full rounded-full" style="width: 95%">
                                                    </div>
                                                </div>
                                                <span class="text-[11px] text-outline">Empastado Aprob.</span>
                                            </div>
                                        </td> --}}
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-body-md text-on-surface font-medium">Lic. Ramiro
                                                        Zeballos</span>
                                                    <span
                                                        class="font-label-md text-secondary flex items-center gap-0.5 mt-0.5">
                                                        <span class="material-symbols-outlined text-[14px]">done_all</span>
                                                        Dictamen Favorable
                                                    </span>
                                                </div>
                                            </td>
                                            {{-- <td class="py-3.5 px-4 align-top">
                                            <div class="flex flex-col">
                                                <span class="font-data-mono text-on-surface font-semibold">14 Nov,
                                                    10:00</span>
                                                <span class="font-label-md text-outline">Auditorio Magna</span>
                                            </div>
                                        </td> --}}
                                            <td class="py-3.5 px-4 align-middle text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                        title="Ver Expediente Completo">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">folder_open</span>
                                                    </button>
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                        title="Registrar Observación">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">edit_note</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">PRY-2024-04</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">Plataforma
                                                        Web de Facturación y Control de Stock para PYMEs</span>
                                                    <span class="font-label-md text-outline mt-1">Especialidad:
                                                        Sistemas
                                                        Informáticos</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center font-data-mono-bold text-[10px] text-primary">
                                                            GM</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Gabriel
                                                            Mendoza</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">Emprendimiento</span>
                                                <div class="font-body-sm text-outline mt-1">Tutor: Ing. F. Valdez</div>
                                            </td>

                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-body-md text-on-surface font-medium">Lic. Martha
                                                        Gutiérrez</span>
                                                    <span
                                                        class="font-label-md text-tertiary flex items-center gap-0.5 mt-0.5">
                                                        <span class="material-symbols-outlined text-[14px]">pending</span>
                                                        Corrección solicitada
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="py-3.5 px-4 align-middle text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                        title="Ver Expediente Completo">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">folder_open</span>
                                                    </button>
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                        title="Registrar Observación">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">edit_note</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-error">PRY-2024-09</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">Prototipo
                                                        de Secadora Solar Asistida para Frutos del Valle</span>
                                                    <span class="font-label-md text-outline mt-1">Especialidad:
                                                        Mecánica
                                                        Industrial</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-error-container flex items-center justify-center font-data-mono-bold text-[10px] text-on-error-container">
                                                            JL</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Javier
                                                            Limachi</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-error-container flex items-center justify-center font-data-mono-bold text-[10px] text-on-error-container">
                                                            DC</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">David
                                                            Choque P.</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">Socio-Comunitario</span>
                                                <div class="font-body-sm text-outline mt-1">Tutor: Ing. E. Ramos</div>
                                            </td>

                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-body-md text-on-surface font-medium">Ing. Walter
                                                        Blanco</span>
                                                    <span
                                                        class="font-label-md text-error flex items-center gap-0.5 mt-0.5">
                                                        <span class="material-symbols-outlined text-[14px]">report</span>
                                                        Sin Visto Bueno Cap. 3
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="py-3.5 px-4 align-middle text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                        title="Ver Expediente Completo">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">folder_open</span>
                                                    </button>
                                                    <button class="p-1.5 hover:bg-surface-container rounded text-error"
                                                        title="Registrar Notificación">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">notification_important</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">PRY-2024-12</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">Elaboración
                                                        de Harina Funcional de Quinua y Tarwi Enriquecida</span>
                                                    <span class="font-label-md text-outline mt-1">Especialidad:
                                                        Transformación de Alimentos</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center font-data-mono-bold text-[10px] text-on-surface">
                                                            SA</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Silvia
                                                            Arce Luna</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">Tesis
                                                    / Excelencia</span>
                                                <div class="font-body-sm text-outline mt-1">Tutor: Lic. E. Morales
                                                </div>
                                            </td>

                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-body-md text-on-surface font-medium">Dra. Beatriz
                                                        Soliz</span>
                                                    <span
                                                        class="font-label-md text-secondary flex items-center gap-0.5 mt-0.5">
                                                        <span
                                                            class="material-symbols-outlined text-[14px]">check_circle</span>
                                                        Informe Favorable 100/100
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="py-3.5 px-4 align-middle text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                        title="Ver Expediente Completo">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">folder_open</span>
                                                    </button>
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                        title="Registrar Observación">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">edit_note</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">PRY-2024-18</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">Unidad
                                                        Móvil de Soldadura Especializada para Maquinaria Agrícola</span>
                                                    <span class="font-label-md text-outline mt-1">Especialidad:
                                                        Metalmecánica</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center font-data-mono-bold text-[10px] text-primary">
                                                            MQ</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Mauricio
                                                            Quispe</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-surface-container-highest flex items-center justify-center font-data-mono-bold text-[10px] text-on-surface">
                                                            OV</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Omar
                                                            Villca</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">Emprendimiento</span>
                                                <div class="font-body-sm text-outline mt-1">Tutor: Prof. H. Tapia</div>
                                            </td>

                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-body-md text-on-surface font-medium">Ing. Gonzalo
                                                        Paredes</span>
                                                    <span
                                                        class="font-label-md text-primary flex items-center gap-0.5 mt-0.5">
                                                        <span
                                                            class="material-symbols-outlined text-[14px]">hourglass_top</span>
                                                        En lectura metodológica
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="py-3.5 px-4 align-middle text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                        title="Ver Expediente Completo">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">folder_open</span>
                                                    </button>
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                        title="Registrar Observación">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">edit_note</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-surface-container-low/40 transition-colors group">
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">PRY-2024-22</span>
                                                    <span
                                                        class="font-label-lg text-body-sm font-semibold text-on-surface mt-0.5 max-w-[220px] leading-snug">Sistema
                                                        de Registro y Certificación BTH en Red Local Segura</span>
                                                    <span class="font-label-md text-outline mt-1">Especialidad:
                                                        Sistemas
                                                        Informáticos</span>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col gap-1.5">
                                                    <div class="flex items-center gap-2">
                                                        <div
                                                            class="w-6 h-6 rounded-full bg-primary-fixed flex items-center justify-center font-data-mono-bold text-[10px] text-primary">
                                                            KL</div>
                                                        <span
                                                            class="font-body-md text-on-surface font-medium truncate max-w-[130px]">Karen
                                                            Lopez</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3.5 px-4 align-top">
                                                <span
                                                    class="inline-block px-2 py-0.5 rounded bg-surface-container-high text-on-surface font-label-md text-label-md">Socio-Comunitario</span>
                                                <div class="font-body-sm text-outline mt-1">Tutor: Ing. F. Valdez</div>
                                            </td>

                                            <td class="py-3.5 px-4 align-top">
                                                <div class="flex flex-col">
                                                    <span class="font-body-md text-on-surface font-medium">Lic. J. H.
                                                        Quispe</span>
                                                    <span
                                                        class="font-label-md text-secondary flex items-center gap-0.5 mt-0.5">
                                                        <span class="material-symbols-outlined text-[14px]">verified</span>
                                                        Habilitada Defensa
                                                    </span>
                                                </div>
                                            </td>
                                            {{-- <td class="py-3.5 px-4 align-top">
                                            <div class="flex flex-col">
                                                <span class="font-data-mono text-on-surface font-semibold">14 Nov,
                                                    11:30</span>
                                                <span class="font-label-md text-outline">Auditorio BTH</span>
                                            </div>
                                        </td> --}}
                                            <td class="py-3.5 px-4 align-middle text-center">
                                                <div class="flex items-center justify-center gap-1">
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                        title="Ver Expediente Completo">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">folder_open</span>
                                                    </button>
                                                    <button
                                                        class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                        title="Registrar Observación">
                                                        <span
                                                            class="material-symbols-outlined text-[18px]">edit_note</span>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                        <div
                            class="px-inset-card py-3 bg-surface-container-low/40 flex flex-col sm:flex-row items-center justify-between gap-2">
                            <span class="font-body-sm text-outline">
                                Mostrando {{ $proyectos->firstItem() ?? 0 }} a {{ $proyectos->lastItem() ?? 0 }}
                                de {{ $proyectos->total() }} proyectos registrados
                            </span>
                            <div class="flex items-center gap-1">
                                @if ($proyectos->onFirstPage())
                                    <span
                                        class="px-2.5 py-1 rounded bg-surface-container text-on-surface-variant text-body-sm font-data-mono opacity-50 cursor-not-allowed"
                                        aria-disabled="true">« Anterior</span>
                                @else
                                    <a href="{{ $proyectos->previousPageUrl() }}"
                                        class="px-2.5 py-1 rounded bg-surface-container text-on-surface text-body-sm font-data-mono hover:bg-surface-container-high">«
                                        Anterior</a>
                                @endif

                                @foreach ($proyectos->getUrlRange(1, $proyectos->lastPage()) as $page => $url)
                                    @if ($page === $proyectos->currentPage())
                                        <span
                                            class="px-2.5 py-1 rounded bg-primary text-on-primary text-body-sm font-data-mono"
                                            aria-current="page">{{ $page }}</span>
                                    @else
                                        <a href="{{ $url }}"
                                            class="px-2.5 py-1 rounded bg-surface-container text-on-surface text-body-sm font-data-mono hover:bg-surface-container-high">{{ $page }}</a>
                                    @endif
                                @endforeach

                                @if ($proyectos->hasMorePages())
                                    <a href="{{ $proyectos->nextPageUrl() }}"
                                        class="px-2.5 py-1 rounded bg-surface-container text-on-surface text-body-sm font-data-mono hover:bg-surface-container-high">Siguiente
                                        »</a>
                                @else
                                    <span
                                        class="px-2.5 py-1 rounded bg-surface-container text-on-surface-variant text-body-sm font-data-mono opacity-50 cursor-not-allowed"
                                        aria-disabled="true">Siguiente »</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="xl:col-span-4 flex flex-col gap-gutter-md">
                    <div class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col">
                        <div class="flex items-center justify-between pb-3">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-secondary text-[22px]">calendar_today</span>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface">Defensas del Día</h2>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-data-mono-bold text-label-md">{{ strtoupper(now()->locale('es')->translatedFormat('D')) }}
                                {{ strtoupper(now()->locale('es')->translatedFormat('d M')) }}</span>
                        </div>
                        <p class="font-body-sm text-on-surface-variant mb-4">Cronograma de defensas públicas orales
                            y constitución de tribunales evaluadores.</p>
                        <div class="flex flex-col gap-3">
                            {{-- <div
                                class="p-3 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all flex flex-col gap-2 relative overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary"></div>
                                <div class="flex items-start justify-between">
                                    <span class="font-data-mono-bold text-headline-sm text-primary">09:00 -
                                        10:15</span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container text-label-md font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">group</span> Jurado
                                        Completo
                                    </span>
                                </div>
                                <div>
                                    <span class="font-data-mono text-label-md text-outline">PRY-2024-01 •
                                        AGROECOLOGÍA</span>
                                    <h3
                                        class="font-label-lg text-body-md font-semibold text-on-surface leading-tight mt-0.5">
                                        Sistema Automatizado de Riego por Goteo con Sensor IoT</h3>
                                </div>
                                <div class="flex items-center justify-between text-body-sm text-on-surface-variant pt-2">
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-[16px] text-primary">meeting_room</span>
                                        Auditorio Magna</span>
                                    <span class="font-data-mono text-outline">Pres: Lic. Zeballos</span>
                                </div>
                            </div>
                            <div
                                class="p-3 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all flex flex-col gap-2 relative overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-secondary"></div>
                                <div class="flex items-start justify-between">
                                    <span class="font-data-mono-bold text-headline-sm text-primary">10:30 -
                                        11:45</span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container text-label-md font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">group</span> Jurado
                                        Completo
                                    </span>
                                </div>
                                <div>
                                    <span class="font-data-mono text-label-md text-outline">PRY-2024-06 •
                                        GASTRONOMÍA</span>
                                    <h3
                                        class="font-label-lg text-body-md font-semibold text-on-surface leading-tight mt-0.5">
                                        Industrialización y Repostería Saludable a Base de Harina de Tarwi</h3>
                                </div>
                                <div class="flex items-center justify-between text-body-sm text-on-surface-variant pt-2">
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-[16px] text-primary">meeting_room</span>
                                        Taller Nutricional 2</span>
                                    <span class="font-data-mono text-outline">Pres: Dra. Soliz</span>
                                </div>
                            </div>
                            <div
                                class="p-3 rounded-lg bg-surface-container-low hover:bg-surface-container transition-all flex flex-col gap-2 relative overflow-hidden">
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-tertiary-container"></div>
                                <div class="flex items-start justify-between">
                                    <span class="font-data-mono-bold text-headline-sm text-tertiary">14:30 -
                                        15:45</span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-tertiary-fixed text-on-tertiary-fixed text-label-md font-semibold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[12px]">person_alert</span> 1
                                        Suplente Req.
                                    </span>
                                </div>
                                <div>
                                    <span class="font-data-mono text-label-md text-outline">PRY-2024-22 •
                                        SISTEMAS</span>
                                    <h3
                                        class="font-label-lg text-body-md font-semibold text-on-surface leading-tight mt-0.5">
                                        Sistema de Registro y Certificación BTH en Red Local</h3>
                                </div>
                                <div class="flex items-center justify-between text-body-sm text-on-surface-variant pt-2">
                                    <span class="flex items-center gap-1"><span
                                            class="material-symbols-outlined text-[16px] text-primary">meeting_room</span>
                                        Laboratorio 01</span>
                                    <span class="font-data-mono text-outline">Pres: Lic. Quispe</span>
                                </div>
                            </div> --}}
                        </div>
                        <button
                            class="mt-4 w-full py-2 rounded bg-surface-container-high hover:bg-surface-container-highest text-primary font-label-lg text-label-lg flex items-center justify-center gap-1 transition-colors">
                            <span>Ver Rol Mensual de Defensas</span>
                            <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                        </button>
                    </div>
                    {{-- <div class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col gap-3">
                        <div class="flex items-center justify-between">
                            <h2 class="font-headline-sm text-headline-sm text-on-surface">Carga Docente en
                                Tribunales</h2>
                            <span class="font-data-mono text-body-sm text-outline">Top 3 Asesores</span>
                        </div>
                        <div class="flex flex-col gap-3">
                            <div class="flex items-center justify-between p-2 rounded bg-surface-container-low">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded bg-primary text-on-primary font-data-mono-bold text-body-md flex items-center justify-center">
                                        CM</div>
                                    <div class="flex flex-col">
                                        <span class="font-label-lg text-body-sm font-semibold text-on-surface">Ing.
                                            Carlos Mamani</span>
                                        <span class="font-label-md text-outline">8 Proyectos Dictaminados</span>
                                    </div>
                                </div>
                                <span class="font-data-mono text-body-sm text-secondary font-semibold">100% al
                                    día</span>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded bg-surface-container-low">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded bg-primary text-on-primary font-data-mono-bold text-body-md flex items-center justify-center">
                                        MG</div>
                                    <div class="flex flex-col">
                                        <span class="font-label-lg text-body-sm font-semibold text-on-surface">Lic.
                                            Martha Gutiérrez</span>
                                        <span class="font-label-md text-outline">6 Proyectos Asignados</span>
                                    </div>
                                </div>
                                <span class="font-data-mono text-body-sm text-tertiary font-semibold">1
                                    Pendiente</span>
                            </div>
                            <div class="flex items-center justify-between p-2 rounded bg-surface-container-low">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded bg-primary text-on-primary font-data-mono-bold text-body-md flex items-center justify-center">
                                        WB</div>
                                    <div class="flex flex-col">
                                        <span class="font-label-lg text-body-sm font-semibold text-on-surface">Ing.
                                            Walter Blanco</span>
                                        <span class="font-label-md text-outline">5 Proyectos Asignados</span>
                                    </div>
                                </div>
                                <span class="font-data-mono text-body-sm text-error font-semibold">2 En
                                    Atraso</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </main>
    {{-- Modal de registro de evaluacion --}}
@endsection
<div class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6 md:p-8 bg-slate-900/60 backdrop-blur-sm overflow-y-auto"
    id="modal-registro-proyecto">
    <form method="POST" action="{{ route('proyectoGrado.store') }}"
        class="bg-surface-container-lowest w-full max-w-4xl rounded-xl shadow-2xl border border-outline-variant/30 flex flex-col overflow-hidden my-auto max-h-[92vh]">
        @csrf
        <input type="hidden" name="idCurso" value="">
        <input type="hidden" name="idGestion" value="{{ session('gestion_activa') }}">
        <input type="hidden" name="lineaInvestigacion" value="">
        <input type="hidden" name="fechaInicio" value="">
        <input type="hidden" name="fechaDefensa" value="">
        <input type="hidden" name="observacion" value="">
        <div
            class="px-6 py-4 bg-surface-container-low border-b border-outline-variant/20 flex items-start justify-between">
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-1"><span
                        class="px-2 py-0.5 rounded bg-primary text-on-primary font-data-mono text-label-md uppercase tracking-wider">Registro
                        Ministerial</span><span class="font-data-mono text-label-md text-primary font-semibold">CICLO
                        BTH 2026</span><span class="text-outline-variant">•</span><span
                        class="text-body-sm text-secondary font-medium flex items-center gap-1"><span
                            class="w-1.5 h-1.5 rounded-full bg-secondary"></span> Expediente en Línea</span></div>
                <h2 class="font-headline-md text-headline-md text-on-surface tracking-tight">Registro Oficial de
                    Nuevo Proyecto de Grado</h2>
                <p class="font-body-sm text-on-surface-variant mt-0.5">Convocatoria Bachillerato Técnico Humanístico
                    (BTH) · Gestión 2026 · Validación Institucional</p>
            </div><button id="cerrar-modal-registro-proyecto" aria-label="Cerrar" type="button"
                class="p-1.5 rounded-lg text-outline hover:text-on-surface hover:bg-surface-container-high transition-colors"><span
                    class="material-symbols-outlined text-[24px]">close</span></button>
        </div>
        <div class="px-6 py-5 overflow-y-auto space-y-6 text-on-surface">
            <div class="p-4 rounded-lg bg-surface-container-low/50 border border-outline-variant/20 space-y-4">
                <div class="flex items-center justify-between border-b border-outline-variant/20 pb-2">
                    <div class="flex items-center gap-2"><span
                            class="material-symbols-outlined text-primary text-[20px]">badge</span>
                        <h3 class="font-label-lg font-semibold text-primary uppercase tracking-wide">1.
                            Identificación y Modalidad</h3>
                    </div><span class="font-data-mono text-body-sm text-outline font-medium">Paso 1 de 3</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="md:col-span-1"><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Código
                            de Expediente</label>
                        <div class="flex items-center gap-2 bg-primary/5 border border-primary/20 rounded px-3 py-2">
                            <span class="material-symbols-outlined text-primary text-[18px]">tag</span><span
                                class="font-data-mono-bold text-data-mono-bold text-primary">PRY-2024-47</span><span
                                class="ml-auto text-[10px] uppercase font-bold bg-primary-fixed text-on-primary-fixed px-1.5 py-0.2 rounded">Auto</span>
                        </div>
                    </div>
                    <div class="md:col-span-2"><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Especialidad
                            / Mención Técnica <span class="text-error">*</span></label>
                        <div class="relative"><select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option selected="" value="sistemas">Sistemas Informáticos</option>
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div class="md:col-span-3"><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Título
                            Oficial del Proyecto <span class="text-error">*</span></label><input name="titulo"
                            class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 border border-outline-variant/30 focus:outline-none focus:border-primary"
                            placeholder="Ej: Implementación de Sistema Hidropónico Automatizado con Control Térmico y Monitoreo Remoto IoT"
                            type="text" value="" />
                        <p class="text-[11px] text-outline mt-1">Debe reflejar claramente el problema
                            socio-productivo abordado y la solución técnica implementada.</p>
                    </div>
                    <div class="md:col-span-3"><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Modalidad
                            de Titulación BTH <span class="text-error">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label
                                class="flex items-start gap-2 p-2.5 rounded border border-outline-variant/30 bg-surface-container-low cursor-pointer hover:bg-surface-container"><input
                                    class="mt-1 text-primary focus:ring-primary" value="PEP" name="modalidad"
                                    type="radio" />
                                <div class="flex flex-col"><span
                                        class="font-label-lg text-body-sm font-semibold text-on-surface leading-tight">Proyecto
                                        de Emprendimiento Productivo - PEP</span><span
                                        class="text-[11px] text-outline mt-0.5"></span>
                                </div>
                            </label>
                            <label
                                class="flex items-start gap-2 p-2.5 rounded border border-primary/40 bg-primary/5 cursor-pointer"><input
                                    class="mt-1 text-primary focus:ring-primary" value="PI" name="modalidad"
                                    checked="" type="radio" />
                                <div class="flex flex-col"><span
                                        class="font-label-lg text-body-sm font-semibold text-primary leading-tight">Proyecto
                                        de Innovacion - PI</span><span class="text-[11px] text-outline mt-0.5"></span>
                                </div>
                            </label>
                            <label
                                class="flex items-start gap-2 p-2.5 rounded border border-outline-variant/30 bg-surface-container-low cursor-pointer hover:bg-surface-container"><input
                                    class="mt-1 text-primary focus:ring-primary" value="PLC" name="modalidad"
                                    type="radio" />
                                <div class="flex flex-col"><span
                                        class="font-label-lg text-body-sm font-semibold text-on-surface leading-tight">Practica
                                        Laboral Comunitaria - PLC</span><span
                                        class="text-[11px] text-outline mt-0.5"></span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 rounded-lg bg-surface-container-low/50 border border-outline-variant/20 space-y-4">
                <div class="flex items-center justify-between border-b border-outline-variant/20 pb-2">
                    <div class="flex items-center gap-2"><span
                            class="material-symbols-outlined text-primary text-[20px]">groups</span>
                        <h3 class="font-label-lg font-semibold text-primary uppercase tracking-wide">2. Postulantes
                            y Asesoría Docente</h3>
                    </div><span class="font-data-mono text-body-sm text-outline font-medium">Paso 2 de 3</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Postulante
                            1 (Titular) <span class="text-error">*</span></label>
                        <div class="relative"><select name="idEstudiante"
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option disabled selected value="">Seleccionar estudiante...
                                </option>
                                @foreach ($estudiantesDisponibles as $estudiante)
                                    <option value="{{ $estudiante->id_estudiante }}">{{ $estudiante->id_estudiante }}
                                        -
                                        {{ $estudiante->nombres }}
                                        (6to Sec. '{{ $estudiante->paralelo }}')
                                    </option>
                                @endforeach
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1"><label
                                class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Postulante
                                2 (Pareja / Opcional)</label><span
                                class="text-[11px] text-secondary font-medium">Habilitado</span></div>
                        <div class="relative"><select name="idEstudiantes[]"
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option selected value="none">-- Sin segundo postulante (Individual) --
                                </option>
                                @foreach ($estudiantesDisponibles as $estudiante)
                                    <option value="{{ $estudiante->id_estudiante }}">
                                        {{ $estudiante->id_estudiante }} -
                                        {{ $estudiante->nombres }}
                                        (6to Sec. '{{ $estudiante->paralelo }}')
                                    </option>
                                @endforeach
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1"><label
                                class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Postulante
                                3 (Pareja / Opcional)</label><span
                                class="text-[11px] text-secondary font-medium">Habilitado</span></div>
                        <div class="relative"><select name="idEstudiantes[]"
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option selected="" value="none">-- Sin tercer postulante (Individual) --
                                </option>
                                @foreach ($estudiantesDisponibles as $estudiante)
                                    <option value="{{ $estudiante->id_estudiante }}">
                                        {{ $estudiante->id_estudiante }} -
                                        {{ $estudiante->nombres }}
                                        (6to Sec. '{{ $estudiante->paralelo }}')
                                    </option>
                                @endforeach
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Docente
                            Tutor / Revisor</label>
                        <div class="relative"><select name="idProfesorTutor"
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option selected="" value="21">Lic. Judith Flores Solar (Docente T.T.Gral.)
                                </option>
                                <option value="67">Lic. Roger Cori (Docente Informatico)</option>
                                <option value="66">Lic. Jose Luis Quisbert Quisbert (Docente Informatico)</option>
                                <option value="1">Lic. Javier Henry Quispe Pinto (Coordinador)</option>
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 rounded-lg bg-surface-container-low/50 border border-outline-variant/20 space-y-4">
                <div class="flex items-center justify-between border-b border-outline-variant/20 pb-2">
                    <div class="flex items-center gap-2"><span
                            class="material-symbols-outlined text-primary text-[20px]">description</span>
                        <h3 class="font-label-lg font-semibold text-primary uppercase tracking-wide">3. Alcance y
                            Documentación Preliminar</h3>
                    </div><span class="font-data-mono text-body-sm text-outline font-medium">Paso 3 de 3</span>
                </div>
                <div class="space-y-3">
                    <div>
                        <div class="flex items-center justify-between mb-1"><label
                                class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Resumen
                                / Justificación Comunitaria <span class="text-error">*</span></label><span
                                class="font-data-mono text-[11px] text-outline">142 / 300 caracteres</span></div>
                        <textarea name="descripcion"
                            class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 border border-outline-variant/30 focus:outline-none focus:border-primary resize-none"
                            placeholder="Sintetice el objetivo y el impacto para la unidad educativa o entorno sociocomunitario..."
                            rows="2">{{-- El proyecto busca optimizar el uso de agua potable en áreas de cultivo urbano escolar mediante actuadores automatizados con sensores de humedad y temperatura controlados por microcontrolador ESP32. --}}</textarea>
                    </div>
                    {{-- <div><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Carga
                            de Perfil de Grado Preliminar (PDF Oficial)</label>
                        <div
                            class="border-2 border-dashed border-outline-variant/40 rounded-lg p-4 bg-surface-container-low/40 hover:bg-surface-container transition-colors flex items-center justify-between cursor-pointer">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded bg-error-container text-on-error-container flex items-center justify-center">
                                    <span class="material-symbols-outlined text-[24px]">picture_as_pdf</span>
                                </div>
                                <div class="flex flex-col"><span
                                        class="font-body-md font-medium text-on-surface leading-snug">Perfil_BTH_Sistemas_PRY-2024-47_v1.pdf</span><span
                                        class="text-[11px] text-outline">2.4 MB · Documento validado en formato APA
                                        7ma</span></div>
                            </div>
                            <div class="flex items-center gap-2"><span
                                    class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container text-[11px] font-semibold flex items-center gap-1"><span
                                        class="material-symbols-outlined text-[14px]">check_circle</span> Listo para
                                    subida</span><button class="p-1 text-outline hover:text-error"
                                    type="button"><span
                                        class="material-symbols-outlined text-[18px]">delete</span></button></div>
                        </div>
                    </div> --}}
                    <div class="pt-1"><label class="flex items-start gap-2.5 cursor-pointer"><input checked=""
                                class="mt-0.5 h-4 w-4 rounded text-secondary focus:ring-secondary"
                                type="checkbox" /><span
                                class="font-body-sm text-body-sm text-on-surface-variant leading-tight">Declaro el
                                cumplimiento de la reglamentación BTH y la validación de tema ante la Dirección
                                Académica y Consejo de Titulación.</span></label></div>
                </div>
            </div>
        </div>
        <div
            class="px-6 py-4 bg-surface-container-low border-t border-outline-variant/20 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center gap-1 text-outline text-body-sm"><span
                    class="material-symbols-outlined text-[18px] text-primary">info</span><span>Todos los campos
                    marcados con (*) son obligatorios para el RUDE.</span></div>
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end"><button
                    id="cancelar-modal-registro-proyecto"
                    class="px-4 py-2 rounded border border-outline-variant text-on-surface hover:bg-surface-container font-label-lg text-label-lg transition-colors"
                    type="button">Cancelar</button>{{-- <button
                    class="flex items-center gap-1.5 px-4 py-2 rounded bg-surface-container-high hover:bg-surface-container-highest text-primary font-label-lg text-label-lg transition-colors"
                    type="button"><span class="material-symbols-outlined text-[18px]">save</span><span>Guardar
                        Borrador</span></button> --}}<button
                    class="flex items-center gap-2 px-5 py-2 rounded bg-secondary hover:bg-secondary/90 text-on-secondary font-label-lg text-label-lg shadow-sm transition-all active:scale-95"
                    type="submit"><span
                        class="material-symbols-outlined text-[18px]">check_circle</span><span>Registrar Proyecto y
                        Crear Expediente</span></button></div>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal-registro-proyecto');
        const abrirModal = document.getElementById('abrir-modal-registro-proyecto');
        const cerrarModal = document.getElementById('cerrar-modal-registro-proyecto');
        const cancelarModal = document.getElementById('cancelar-modal-registro-proyecto');

        const ocultarModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            modal.classList.remove('flex');
        };

        const mostrarModal = () => {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        abrirModal.addEventListener('click', mostrarModal);
        cerrarModal.addEventListener('click', ocultarModal);
        cancelarModal.addEventListener('click', ocultarModal);

        modal.addEventListener('click', (event) => {
            if (event.target === modal) {
                ocultarModal();
            }
        });

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape') {
                ocultarModal();
            }
        });
    });
</script>
{{-- Modal del registro de dictamen del tutor --}}
<div id="modal-dictamen"
    class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-inverse-surface/65 backdrop-blur-sm overflow-y-auto"
    aria-labelledby="titulo-modal-dictamen" role="dialog" aria-modal="true">
    <!-- MODAL DIALOG CONTAINER (Max Width ~740px) -->
    <form id="form-dictamen" method="POST"
        action="{{ route('proyectoGrado.dictamen.store', ['idProyecto' => 'PROJECT_ID']) }}"
        class="relative w-full max-w-[730px] my-6 bg-surface-container-lowest rounded-2xl shadow-2xl overflow-hidden flex flex-col animate-in fade-in zoom-in-95 duration-200">
        @csrf
        <input id="dictamen-project-id" name="idProyecto" type="hidden" />
        <!-- Top Decorative Institutional Accent Strip -->
        <div class="w-full h-1.5 bg-gradient-to-r from-primary via-primary-container to-secondary">
        </div>
        <!-- 1. MODAL HEADER -->
        <div class="px-7 pt-6 pb-4 bg-surface-container-lowest flex items-start justify-between gap-4">
            <div class="flex flex-col gap-1.5">
                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-primary-container text-on-primary font-data-mono-bold text-data-mono-bold tracking-tight">
                        <span class="material-symbols-outlined text-[15px]"
                            style="font-variation-settings: 'FILL' 1;">gavel</span>
                        DICTAMEN OFICIAL TRIBUNAL
                    </span>
                    <span
                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded bg-surface-container text-on-surface-variant font-label-md text-label-md">
                        <span class="material-symbols-outlined text-[15px]">event_repeat</span>
                        Fase 03 · Revisión de Conformidad
                    </span>
                </div>
                <h2 id="titulo-modal-dictamen"
                    class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight mt-1">
                    Registro de Dictamen y Visto Bueno del Tribunal
                </h2>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Actualización del estado metodológico y aprobación reglamentaria para pase a defensa
                    pública de grado.
                </p>
            </div>
            <button id="cerrar-modal-dictamen" aria-label="Cerrar ventana"
                class="p-1.5 text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high rounded-lg transition-colors flex-shrink-0"
                type="button">
                <span class="material-symbols-outlined text-[24px]">close</span>
            </button>
        </div>
        <!-- SCROLLABLE BODY -->
        <div class="px-7 py-4 space-y-6 overflow-y-auto max-h-[calc(88vh-140px)]">
            <!-- 2. SELECTED PROJECT REFERENCE CARD (Resumen del Proyecto Seleccionado) -->
            @if ($errors->any())
                <div class="mx-7 mt-4 rounded-lg bg-error-container p-3 text-on-error-container" role="alert">
                    <p class="font-label-lg font-semibold">No se pudo guardar el dictamen:</p>
                    <ul class="mt-1 list-inside list-disc font-body-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-surface-container-low p-4 rounded-xl flex flex-col gap-3">
                <div class="flex items-center justify-between gap-2 pb-2">
                    <div class="flex items-center gap-2">
                        <span id="dictamen-project-code"
                            class="font-data-mono-bold text-data-mono-bold px-2 py-0.5 rounded bg-surface-container-highest text-primary">
                        </span>
                        <span id="dictamen-project-course"
                            class="px-2 py-0.5 rounded bg-surface-container text-on-surface-variant font-label-md text-label-md font-medium">
                        </span>
                        <span id="dictamen-project-modality"
                            class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-medium">
                        </span>
                    </div>
                    <span class="font-data-mono text-data-mono text-on-surface-variant text-right">RUDE:
                        <span id="dictamen-project-rude"></span></span>
                </div>
                <div>
                    <h3 id="dictamen-project-title"
                        class="font-headline-sm text-headline-sm text-on-surface font-semibold leading-snug">
                    </h3>
                </div>
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-on-surface-variant font-body-sm text-body-sm bg-surface-container-lowest/80 p-3 rounded-lg">
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">person</span>
                        <div class="flex flex-col">
                            <span
                                class="font-label-md text-label-md text-on-surface-variant uppercase font-medium">Postulante
                                Titular</span>
                            <div id="dictamen-project-students"
                                class="font-label-lg text-label-lg font-bold text-on-surface"></div>
                            <span class="font-data-mono text-data-mono text-on-surface-variant">CI:
                                <span id="dictamen-project-ci"></span></span>
                        </div>
                    </div>
                    <div class="flex items-start gap-2">
                        <span class="material-symbols-outlined text-secondary text-[18px] mt-0.5">school</span>
                        <div class="flex flex-col">
                            <span
                                class="font-label-md text-label-md text-on-surface-variant uppercase font-medium">Tutor
                                Asignado</span>
                            <span id="dictamen-project-tutor"
                                class="font-label-lg text-label-lg font-semibold text-on-surface"></span>
                            <span id="dictamen-project-speciality"
                                class="font-label-md text-label-md text-on-surface-variant"></span>
                        </div>
                    </div>
                    <div class="sm:col-span-2 flex items-start gap-2 pt-1">
                        <span class="material-symbols-outlined text-primary text-[18px] mt-0.5">groups</span>
                        <div class="flex flex-col">
                            <span
                                class="font-label-md text-label-md text-on-surface-variant uppercase font-medium">Tribunal
                                Evaluador Asignado</span>
                            <div id="dictamen-project-tribunals" class="font-body-md text-body-md text-on-surface">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 3. SELECTOR OBLIGATORIO DE ESTADOS NORMATIVOS -->
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <label class="font-label-lg text-label-lg font-bold text-on-surface flex items-center gap-2">
                        <span>Resolución Normativa del Tribunal</span>
                        <span class="text-error font-bold">*</span>
                    </label>
                    <span class="font-label-md text-label-md text-on-surface-variant">Seleccione un
                        único estado vinculante</span>
                </div>
                <!-- Radio cards group -->
                <div class="grid grid-cols-1 gap-2.5" id="dictamen-options">
                    <!-- Option 1: Sin visto bueno -->
                    <label
                        class="relative flex items-start gap-3.5 p-3.5 rounded-xl cursor-pointer transition-all bg-surface-container-lowest hover:bg-surface-container-low shadow-sm">
                        <input class="mt-1 h-4 w-4 text-error focus:ring-0 cursor-pointer" name="dictamen_estado"
                            type="radio" value="sin_visto_bueno" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span
                                    class="px-2 py-0.5 rounded bg-error-container text-on-error-container font-label-md text-label-md font-bold uppercase inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">cancel</span>
                                    Sin visto bueno
                                </span>
                                <span class="font-label-md text-label-md text-error font-medium">Subsanación
                                    Requerida</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 leading-relaxed">
                                Observaciones pendientes de subsanación técnica o metodológica. Requiere
                                corregir y reingresar informe en un plazo de 72 horas.
                            </p>
                        </div>
                    </label>
                    <!-- Option 2: En lectura metodológica -->
                    <label
                        class="relative flex items-start gap-3.5 p-3.5 rounded-xl cursor-pointer transition-all bg-surface-container-lowest hover:bg-surface-container-low shadow-sm">
                        <input class="mt-1 h-4 w-4 text-primary focus:ring-0 cursor-pointer" name="dictamen_estado"
                            type="radio" value="en_lectura" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span
                                    class="px-2 py-0.5 rounded bg-surface-container-highest text-primary font-label-md text-label-md font-bold uppercase inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">menu_book</span>
                                    En lectura metodológica
                                </span>
                                <span class="font-label-md text-label-md text-on-surface-variant">Terna
                                    en Sesión</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 leading-relaxed">
                                En proceso activo de revisión por la terna examinadora. Plazo normativo
                                de 5 días hábiles vigente según cronograma institucional.
                            </p>
                        </div>
                    </label>
                    <!-- Option 3: Informe favorable -->
                    <label
                        class="relative flex items-start gap-3.5 p-3.5 rounded-xl cursor-pointer transition-all bg-surface-container-lowest hover:bg-surface-container-low shadow-sm">
                        <input class="mt-1 h-4 w-4 text-secondary focus:ring-0 cursor-pointer" name="dictamen_estado"
                            type="radio" value="informe_favorable" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span
                                    class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-bold uppercase inline-flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">task_alt</span>
                                    Informe favorable
                                </span>
                                <span class="font-label-md text-label-md text-secondary font-medium">Vo.Bo.
                                    Técnico Otorgado</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1 leading-relaxed">
                                Cumple con los requisitos de fondo, sistematización y marco aplicativo.
                                Visto bueno emitido a la espera de programar fecha definitiva.
                            </p>
                        </div>
                    </label>
                    <!-- Option 4: Habilitado para la defensa (SELECTED BY DEFAULT) -->
                    <label
                        class="relative flex items-start gap-3.5 p-3.5 rounded-xl cursor-pointer transition-all bg-secondary-container/25 shadow-sm">
                        <input class="mt-1 h-4 w-4 text-secondary focus:ring-0 cursor-pointer" name="dictamen_estado"
                            type="radio" value="habilitado_defensa" />
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span
                                        class="px-2.5 py-0.5 rounded bg-secondary text-on-secondary font-label-md text-label-md font-bold uppercase inline-flex items-center gap-1.5 shadow-sm">
                                        <span class="material-symbols-outlined text-[15px]"
                                            style="font-variation-settings: 'FILL' 1;">verified</span>
                                        Habilitado para la defensa
                                    </span>
                                    <span class="font-label-md text-label-md text-secondary font-bold">Estado
                                        Pleno</span>
                                </div>
                                <span
                                    class="font-data-mono-bold text-data-mono-bold text-secondary text-xs uppercase">Recomendado</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface mt-1 leading-relaxed">
                                Aprobación unánime o mayoritaria. Proyecto apto para programación de
                                fecha, hora y aula de sustentación oral formal ante el ministerio.
                            </p>
                        </div>
                    </label>
                </div>
            </div>
            <!-- 4. DETALLE DEL DICTAMEN Y OBSERVACIONES -->
            <div class="space-y-4 pt-1">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Date input -->
                    <div class="space-y-1.5">
                        <label
                            class="font-label-md text-label-md font-semibold text-on-surface flex items-center gap-1.5"
                            for="fecha-dictamen">
                            <span class="material-symbols-outlined text-primary text-[16px]">calendar_today</span>
                            <span>Fecha de Emisión del Dictamen</span>
                            <span class="text-error">*</span>
                        </label>
                        <div class="relative">
                            <input
                                class="w-full bg-surface-container-lowest text-on-surface font-data-mono text-data-mono px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:bg-surface-container-low transition-all"
                                id="fecha-dictamen" name="fecha_dictamen" type="date" required />
                        </div>
                    </div>
                    <!-- Resolution Type -->
                    <div class="space-y-1.5">
                        <label
                            class="font-label-md text-label-md font-semibold text-on-surface flex items-center gap-1.5"
                            for="tipo-resolucion">
                            <span class="material-symbols-outlined text-primary text-[16px]">how_to_reg</span>
                            <span>Tipo de Resolución de Terna</span>
                            <span class="text-error">*</span>
                        </label>
                        <select
                            class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:bg-surface-container-low transition-all"
                            id="tipo-resolucion" name="tipo_resolucion" required>
                            <option value="unanimidad">Aprobado por Unanimidad (2/2)
                            </option>
                            <option value="mayoria">Aprobado por Mayoría con Respaldo Técnico</option>
                            <option value="menores">Con Observaciones Menores no Impeditivas</option>
                            <option value="reestructuracion">Rechazado para Reestructuración Profunda
                            </option>
                        </select>
                    </div>
                </div>
                <!-- Textarea for Observations -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label
                            class="font-label-md text-label-md font-semibold text-on-surface flex items-center gap-1.5"
                            for="observaciones-tribunal">
                            <span class="material-symbols-outlined text-primary text-[16px]">rate_review</span>
                            <span>Observaciones y Conclusiones Metodológicas</span>
                        </label>
                        <span class="font-label-md text-label-md text-on-surface-variant">Carátula,
                            marco lógico y anexos</span>
                    </div>
                    <textarea
                        class="w-full bg-surface-container-lowest text-on-surface font-body-md text-body-md p-3 rounded-lg shadow-sm focus:outline-none focus:bg-surface-container-low transition-all"
                        id="observaciones-tribunal" name="observaciones"
                        placeholder="Describa las conclusiones del tribunal evaluador, observaciones de forma/fondo o recomendaciones prioritarias para la defensa oral..."
                        rows="3"></textarea>
                </div>
            </div>
            <!-- 5. CLÁUSULA DE VALIDEZ Y CREDENCIAL DEL EVALUADOR -->
            <div class="bg-surface-container p-4 rounded-xl space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-on-primary">
                            <span class="material-symbols-outlined text-[20px]">badge</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-label-md text-label-md text-on-surface-variant font-medium">Evaluador
                                Responsable</span>
                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Lic.
                                Javier Henry Quispe Pinto</span>
                            <span class="font-data-mono text-data-mono text-primary font-bold">RDA:
                                492014-LP</span>
                        </div>
                    </div>
                    <div
                        class="flex items-center gap-1.5 px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-bold">
                        <span class="material-symbols-outlined text-[16px]"
                            style="font-variation-settings: 'FILL' 1;">security</span>
                        <span>Firma Digital RDA Homologada</span>
                    </div>
                </div>
                <!-- Declaración jurada checkbox -->
                <div class="pt-2">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input class="mt-0.5 h-4 w-4 rounded text-primary focus:ring-0 cursor-pointer"
                            id="declaracion-jurada" name="declaracion_jurada" type="checkbox" value="1"
                            required />
                        <span class="font-body-sm text-body-sm text-on-surface leading-tight">
                            Declaro bajo juramento reglamentario haber revisado minuciosamente el
                            documento del proyecto conforme a las directrices vigentes del Subsistema de
                            Educación Regular y el Reglamento BTH.
                        </span>
                    </label>
                </div>
            </div>
        </div>
        <!-- 6. MODAL ACTIONS FOOTER -->
        <div
            class="px-7 py-4 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-3">
            <button id="cancelar-modal-dictamen"
                class="px-4 py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg hover:bg-surface-container-high transition-colors font-medium text-center"
                type="button">
                Cancelar
            </button>
            <div class="flex items-center gap-2.5">
                <button
                    class="px-5 py-2.5 rounded-lg bg-secondary text-on-secondary font-label-lg text-label-lg hover:bg-secondary/90 transition-all shadow-md font-bold flex items-center justify-center gap-2"
                    type="submit">
                    <span class="material-symbols-outlined text-[20px]"
                        style="font-variation-settings: 'FILL' 1;">task_alt</span>
                    <span>Registrar Dictamen Oficial</span>
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('modal-dictamen');
        const form = document.getElementById('form-dictamen');
        const fecha = document.getElementById('fecha-dictamen');
        const resolucion = document.getElementById('tipo-resolucion');
        const observaciones = document.getElementById('observaciones-tribunal');
        const projectIdInput = document.getElementById('dictamen-project-id');
        const actionTemplate = form.action;
        const opciones = document.querySelectorAll('input[name="dictamen_estado"]');

        const ocultarModal = () => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        };

        const actualizarOpcion = (radio) => {
            document.querySelectorAll('#dictamen-options label').forEach(label => {
                label.classList.remove('bg-secondary-container/25', 'bg-error-container/20',
                    'bg-surface-container-highest/40');
                label.classList.add('bg-surface-container-lowest');
            });
            const parentLabel = radio.closest('label');
            if (radio.value === 'habilitado_defensa') {
                parentLabel.classList.remove('bg-surface-container-lowest');
                parentLabel.classList.add('bg-secondary-container/25');
            } else if (radio.value === 'sin_visto_bueno') {
                parentLabel.classList.remove('bg-surface-container-lowest');
                parentLabel.classList.add('bg-error-container/20');
            } else {
                parentLabel.classList.remove('bg-surface-container-lowest');
                parentLabel.classList.add('bg-surface-container-highest/40');
            }
        };

        const abrirModal = (button, oldValues = null) => {
            const projectId = button.dataset.projectId;
            const students = JSON.parse(button.dataset.projectStudents || '[]');
            const tribunals = JSON.parse(button.dataset.projectTribunals || '[]');
            form.action = actionTemplate.replace('PROJECT_ID', projectId);
            projectIdInput.value = projectId;
            document.getElementById('dictamen-project-code').textContent = button.dataset.projectCode;
            document.getElementById('dictamen-project-title').textContent = button.dataset.projectTitle;
            document.getElementById('dictamen-project-course').textContent = button.dataset.projectCourse;
            document.getElementById('dictamen-project-modality').textContent = button.dataset
                .projectModality;
            document.getElementById('dictamen-project-rude').textContent = button.dataset.projectRude;
            document.getElementById('dictamen-project-students').replaceChildren(
                ...students.map((student, index) => {
                    const name = document.createElement('div');
                    name.textContent = student.nombre;
                    if (index > 0) name.classList.add('mt-1');
                    return name;
                })
            );
            document.getElementById('dictamen-project-ci').textContent =
                students.map(student => student.ci).join(' · ') || 'No registrado';
            document.getElementById('dictamen-project-tutor').textContent = button.dataset.projectTutor;
            document.getElementById('dictamen-project-speciality').textContent = button.dataset
                .projectCourse;

            const tribunalsContainer = document.getElementById('dictamen-project-tribunals');
            tribunalsContainer.replaceChildren();
            if (tribunals.length === 0) {
                tribunalsContainer.textContent = 'Sin tribunal asignado';
            } else {
                tribunals.forEach((tribunal, index) => {
                    const entry = document.createElement('span');
                    const name = document.createElement('strong');
                    name.className = index === 0 ? 'font-semibold text-primary' :
                        'font-semibold text-on-surface';
                    name.textContent = tribunal.nombre;
                    entry.append(name, document.createTextNode(
                        ` (${tribunal.cargo || 'Sin cargo'})`));
                    if (index < tribunals.length - 1) {
                        entry.append(document.createTextNode(' · '));
                    }
                    tribunalsContainer.append(entry);
                });
            }
            opciones.forEach(radio => {
                radio.checked = radio.value === (oldValues?.state || button.dataset.dictamenState);
            });
            fecha.value = oldValues?.date || button.dataset.dictamenDate || button.dataset.defaultDate;
            resolucion.value = oldValues?.resolution || button.dataset.dictamenResolution || 'unanimidad';
            observaciones.value = oldValues?.observations ?? button.dataset.dictamenObservations ?? '';
            document.getElementById('declaracion-jurada').checked = oldValues?.declaration === '1';
            document.getElementById('titulo-modal-dictamen').textContent = button.dataset.dictamenDate ?
                'Editar Dictamen y Visto Bueno del Tribunal' :
                'Registro de Dictamen y Visto Bueno del Tribunal';
            opciones.forEach(radio => radio.checked && actualizarOpcion(radio));
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        };

        document.querySelectorAll('.abrir-modal-dictamen').forEach(button => {
            button.addEventListener('click', () => abrirModal(button));
        });
        document.getElementById('cerrar-modal-dictamen').addEventListener('click', ocultarModal);
        document.getElementById('cancelar-modal-dictamen').addEventListener('click', ocultarModal);
        modal.addEventListener('click', event => {
            if (event.target === modal) ocultarModal();
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) ocultarModal();
        });
        opciones.forEach(radio => radio.addEventListener('change', () => actualizarOpcion(radio)));

        const oldProjectId = @json(old('idProyecto'));
        if (oldProjectId) {
            const button = [...document.querySelectorAll('.abrir-modal-dictamen')]
                .find(item => item.dataset.projectId === String(oldProjectId));
            if (button) {
                abrirModal(button, {
                    state: @json(old('dictamen_estado')),
                    date: @json(old('fecha_dictamen')),
                    resolution: @json(old('tipo_resolucion')),
                    observations: @json(old('observaciones')),
                    declaration: @json(old('declaracion_jurada')),
                });
            }
        }
    });
</script>

{{-- Modal de sorteo aleatorio --}}
@php($mesasMinimas = max(1, (int) ceil($proyectosSorteo->count() / 18)))
@php($mesasIniciales = min(max(1, min(20, $proyectosSorteo->count())), max($mesasMinimas, min(5, $proyectosSorteo->count()))))
<div id="modal-sorteo"
    class="fixed inset-0 z-50 hidden items-center justify-center p-3 sm:p-6 bg-inverse-surface/40 backdrop-blur-sm overflow-y-auto"
    aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="titulo-modal-sorteo">
    <input id="sorteo-csrf-token" type="hidden" value="{{ csrf_token() }}">
    <!-- Institutional Modal Enclosure -->
    <div
        class="w-full max-w-5xl bg-surface-container-lowest rounded shadow-xl flex flex-col max-h-[942px] overflow-hidden my-auto animate-in fade-in zoom-in-95 duration-200">
        <!-- Modal Top Bar / Institutional Masthead -->
        <div class="px-gutter-lg py-gutter-md bg-surface-container-low flex items-start justify-between">
            <div class="flex items-start gap-3">
                <div
                    class="w-10 h-10 rounded bg-primary flex items-center justify-center text-on-primary shrink-0 shadow-sm mt-0.5">
                    <span class="material-symbols-outlined text-[24px]">casino</span>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-2.5 flex-wrap">
                        <span id="titulo-modal-sorteo"
                            class="font-headline-md text-headline-md text-on-surface font-semibold tracking-tight">Sorteo
                            y Asignación Aleatoria de Mesas de Tribunal Evaluador</span>
                        <span
                            class="inline-flex items-center px-2 py-0.5 rounded bg-primary-fixed text-on-primary-fixed font-data-mono text-data-mono font-semibold">
                            REV. NORMATIVA 0184
                        </span>
                    </div>
                    <div class="flex items-center gap-2 mt-0.5"><span
                            class="font-label-md text-label-md tracking-wider uppercase text-on-surface-variant font-semibold">DISTRIBUCIÓN
                            SORTEO POR CONFIGURAR • {{ $proyectosSorteo->count() }} PROYECTOS REGISTRADOS</span><span
                            class="inline-block w-1.5 h-1.5 rounded-full bg-secondary"></span><span
                            class="font-data-mono text-data-mono text-secondary font-semibold">SIN SORTEO
                            GUARDADO</span></div>
                </div>
            </div>
            <button id="cerrar-modal-sorteo"
                class="p-1.5 rounded text-on-surface-variant hover:text-on-surface hover:bg-surface-container-high transition-colors"
                title="Cerrar modal" type="button">
                <span class="material-symbols-outlined text-[22px]">close</span>
            </button>
        </div>
        <!-- Scrollable Main Content -->
        <div class="overflow-y-auto px-gutter-lg py-gutter-lg flex flex-col gap-6 bg-surface-container-lowest">
            <!-- METRICAS CLAVE / RESUMEN SUPERIOR -->
            <div>
                <div class="flex items-center justify-between mb-2.5">
                    <span
                        class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant font-semibold flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[16px] text-primary">analytics</span>
                        Parámetros Operativos del Sorteo de Proyectos
                    </span>
                    <span class="font-data-mono text-data-mono text-secondary font-semibold flex items-center gap-1">
                        <span class="material-symbols-outlined text-[15px]">verified</span> Padrón
                        Total: {{ $proyectosSorteo->count() }} Proyectos Registrados
                    </span>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2.5">
                    <div class="p-3 rounded bg-surface-container-low flex flex-col justify-between">
                        <span class="font-label-md text-label-md text-on-surface-variant">Total
                            Proyectos</span>
                        <div class="mt-1 flex items-baseline gap-1.5">
                            <span
                                class="font-display text-display text-on-surface font-bold leading-none">{{ $proyectosSorteo->count() }}</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">proyectos</span>
                        </div>
                        <span
                            class="font-data-mono text-data-mono text-secondary mt-1 text-[12px]">{{ $proyectosSorteo->count() }}
                            incluidos en el sorteo</span>
                    </div>
                    <div
                        class="p-3 rounded bg-surface-container-low flex flex-col justify-between border-l-2 border-primary">
                        <span class="font-label-md text-label-md text-on-surface-variant">Duración de
                            referencia</span>
                        <div class="mt-1 flex items-baseline gap-1.5">
                            <span class="font-display text-display text-primary font-bold leading-none">30</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">minutos</span>
                        </div>
                        <span class="font-data-mono text-data-mono text-on-surface-variant mt-1 text-[12px]">Parámetro
                            del sorteo</span>
                    </div>
                    <div
                        class="p-3 rounded bg-surface-container-low flex flex-col justify-between border-l-2 border-secondary">
                        <span class="font-label-md text-label-md text-on-surface-variant">Mesas
                            seleccionadas</span>
                        <div class="mt-1 flex items-baseline gap-1.5">
                            <span id="sorteo-resumen-mesas"
                                class="font-display text-display text-on-surface font-bold leading-none">{{ $mesasIniciales }}</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">mesas</span>
                        </div>
                        <span class="font-data-mono text-data-mono text-secondary font-semibold mt-1 text-[12px]">No
                            persistidas</span>
                    </div>
                    <div class="p-3 rounded bg-surface-container-low flex flex-col justify-between">
                        <span class="font-label-md text-label-md text-on-surface-variant">Carga por
                            Mesa</span>
                        <div class="mt-1 flex items-baseline gap-1">
                            <span id="sorteo-resumen-carga"
                                class="font-headline-lg text-headline-lg text-on-surface font-bold leading-none">{{ intdiv($proyectosSorteo->count(), $mesasIniciales) }}
                                - {{ (int) ceil($proyectosSorteo->count() / $mesasIniciales) }}</span>
                            <span class="font-label-md text-label-md text-on-surface-variant">proy./mesa</span>
                        </div>
                        <span id="sorteo-resumen-distribucion"
                            class="font-data-mono text-data-mono text-secondary font-semibold mt-1 text-[12px]">{{ $mesasIniciales - ($proyectosSorteo->count() % $mesasIniciales) }}
                            × {{ intdiv($proyectosSorteo->count(), $mesasIniciales) }} +
                            {{ $proyectosSorteo->count() % $mesasIniciales }}
                            × {{ intdiv($proyectosSorteo->count(), $mesasIniciales) + 1 }} =
                            {{ $proyectosSorteo->count() }}</span>
                    </div>
                    <div class="p-3 rounded bg-surface-container-low flex flex-col justify-between">
                        <span class="font-label-md text-label-md text-on-surface-variant">Hora de
                            Inicio</span>
                        <div class="mt-1 flex items-baseline gap-1.5">
                            <span id="sorteo-hora-inicio"
                                class="font-headline-lg text-headline-lg text-on-surface font-bold">—</span>
                            <span id="sorteo-periodo-inicio"
                                class="font-label-md text-label-md text-on-surface-variant">sin horario</span>
                        </div>
                        <span class="font-data-mono text-data-mono text-on-surface-variant mt-1 text-[12px]">No
                            registrado</span>
                    </div>
                    <div
                        class="p-3 rounded bg-surface-container-low flex flex-col justify-between bg-primary-fixed/20">
                        <span class="font-label-md text-label-md text-on-primary-fixed font-semibold">Hora
                            Conclusión Est.</span>
                        <div class="mt-1 flex items-baseline gap-1.5">
                            <span id="sorteo-hora-fin"
                                class="font-headline-lg text-headline-lg text-primary font-bold">—</span>
                            <span id="sorteo-periodo-fin"
                                class="font-label-md text-label-md text-on-surface-variant">sin horario</span>
                        </div>
                        <span class="font-data-mono text-data-mono text-primary mt-1 text-[12px]">Cronograma
                            no registrado</span>
                    </div>
                </div>
            </div>
            <!-- PANEL DE CONFIGURACIÓN DINÁMICA DE MESAS Y HORARIOS -->
            <div
                class="bg-surface-container-low p-gutter-md rounded border border-outline-variant/30 flex flex-col gap-3.5">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px] text-primary">tune</span>
                        <span class="font-label-lg text-label-lg font-semibold text-on-surface">Configuración
                            de Distribución y Cantidad de Mesas de Tribunal</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="font-body-sm text-body-sm text-on-surface-variant">Hora de Inicio
                            General:</span>
                        <div
                            class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-surface-container-lowest border border-outline-variant/40 font-data-mono text-data-mono font-bold text-on-surface shadow-sm">
                            <span class="material-symbols-outlined text-[15px] text-primary">alarm</span>
                            <span class="">08:00 AM</span>
                        </div>
                        <span class="font-body-sm text-body-sm text-on-surface-variant ml-1">Duración
                            fija:</span>
                        <span
                            class="px-2 py-0.5 rounded bg-primary-fixed text-on-primary-fixed font-data-mono text-data-mono font-bold text-[12px]">30
                            min</span>
                        <label for="sorteo-fecha-defensa"
                            class="ml-auto flex items-center gap-2 text-body-sm text-on-surface-variant">
                            Fecha del cronograma:
                            <input id="sorteo-fecha-defensa" type="date" min="{{ now()->toDateString() }}"
                                value="{{ now()->toDateString() }}"
                                class="rounded border border-outline-variant/40 bg-surface-container-lowest px-2 py-1 font-data-mono text-data-mono text-on-surface">
                        </label>
                    </div>
                </div>
                <!-- Selector Interactivo de Cantidad de Mesas -->
                <div class="flex flex-col gap-2">
                    <div class="flex items-center justify-between text-body-sm text-on-surface-variant">
                        <span class="">Seleccione la cantidad de mesas evaluadoras para prorratear
                            automáticamente los {{ $proyectosSorteo->count() }} proyectos:</span>
                        <span class="font-data-mono text-data-mono text-primary font-semibold">Fórmula:
                            {{ $proyectosSorteo->count() }} ÷ N Mesas × 30 min</span>
                    </div>
                    <label for="sorteo-numero-mesas"
                        class="flex items-center gap-2 text-body-sm font-semibold text-on-surface">
                        Cantidad de mesas:
                        <input id="sorteo-numero-mesas" type="number" min="{{ $mesasMinimas }}"
                            max="{{ max(1, min(20, $proyectosSorteo->count())) }}" value="{{ $mesasIniciales }}"
                            class="w-20 rounded border border-outline-variant/40 bg-surface-container-lowest px-2 py-1 font-data-mono text-data-mono">
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-5 gap-2"><!-- Preset 3 Mesas -->
                        <button data-mesas="3" aria-pressed="false"
                            class="flex flex-col p-2.5 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface text-left border border-outline-variant/30 transition-all"
                            {{ $mesasMinimas > 3 || $proyectosSorteo->count() < 3 ? 'disabled' : '' }} type="button">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-label-lg text-label-lg font-semibold">3 Mesas</span>
                                <span data-check hidden
                                    class="material-symbols-outlined text-[16px] hidden">check_circle</span>
                                <span
                                    class="font-data-mono text-data-mono text-[11px] text-on-surface-variant">{{ intdiv($proyectosSorteo->count(), 3) }}-{{ (int) ceil($proyectosSorteo->count() / 3) }}
                                    c/u</span>
                            </div>
                            <span
                                class="font-data-mono text-data-mono text-[11px] text-on-surface-variant mt-1">{{ $proyectosSorteo->count() }}
                                proyectos para 3 mesas</span>
                            <span class="font-data-mono text-data-mono text-[11px] text-on-surface-variant">Turnos de
                                30 min</span>
                        </button>
                        <!-- Preset 4 Mesas -->
                        <button data-mesas="4" aria-pressed="false"
                            class="flex flex-col p-2.5 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface text-left border border-outline-variant/30 transition-all"
                            {{ $mesasMinimas > 4 || $proyectosSorteo->count() < 4 ? 'disabled' : '' }} type="button">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-label-lg text-label-lg font-semibold">4 Mesas</span>
                                <span data-check hidden
                                    class="material-symbols-outlined text-[16px] hidden">check_circle</span>
                                <span
                                    class="font-data-mono text-data-mono text-[11px] text-on-surface-variant">{{ intdiv($proyectosSorteo->count(), 4) }}-{{ (int) ceil($proyectosSorteo->count() / 4) }}
                                    c/u</span>
                            </div>
                            <span
                                class="font-data-mono text-data-mono text-[11px] text-on-surface-variant mt-1">{{ $proyectosSorteo->count() }}
                                proyectos para 4 mesas</span>
                            <span class="font-data-mono text-data-mono text-[11px] text-secondary font-medium">Turnos
                                de 30 min</span>
                        </button>
                        <!-- Preset 5 Mesas (Activo) -->
                        <button data-mesas="5" aria-pressed="true"
                            class="flex flex-col p-2.5 rounded bg-primary text-on-primary text-left shadow-sm border border-primary transition-all"
                            {{ $mesasMinimas > 5 || $proyectosSorteo->count() < 5 ? 'disabled' : '' }} type="button">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-label-lg text-label-lg font-bold">5 Mesas</span>
                                <span data-check class="material-symbols-outlined text-[16px]">check_circle</span>
                            </div>
                            <span
                                class="font-data-mono text-data-mono text-[11px] opacity-90 mt-1">{{ intdiv($proyectosSorteo->count(), 5) }}
                                -
                                {{ (int) ceil($proyectosSorteo->count() / 5) }} proy./mesa</span>
                            <span
                                class="font-data-mono text-data-mono text-[11px] text-secondary-fixed font-semibold">Turnos
                                de 30 min</span>
                        </button>
                        <!-- Preset 6 Mesas -->
                        <button data-mesas="6" aria-pressed="false"
                            class="flex flex-col p-2.5 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface text-left border border-outline-variant/30 transition-all"
                            {{ $mesasMinimas > 6 || $proyectosSorteo->count() < 6 ? 'disabled' : '' }} type="button">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-label-lg text-label-lg font-semibold">6 Mesas</span>
                                <span data-check hidden
                                    class="material-symbols-outlined text-[16px] hidden">check_circle</span>
                                <span
                                    class="font-data-mono text-data-mono text-[11px] text-on-surface-variant">{{ intdiv($proyectosSorteo->count(), 6) }}-{{ (int) ceil($proyectosSorteo->count() / 6) }}
                                    c/u</span>
                            </div>
                            <span
                                class="font-data-mono text-data-mono text-[11px] text-on-surface-variant mt-1">{{ $proyectosSorteo->count() }}
                                proyectos para 6 mesas</span>
                            <span class="font-data-mono text-data-mono text-[11px] text-secondary font-medium">Turnos
                                de 30 min</span>
                        </button>
                        <!-- Preset 9 Mesas -->
                        <button data-mesas="9" aria-pressed="false"
                            class="flex flex-col p-2.5 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface text-left border border-outline-variant/30 transition-all"
                            {{ $mesasMinimas > 9 || $proyectosSorteo->count() < 9 ? 'disabled' : '' }}
                            type="button">
                            <div class="flex items-center justify-between w-full">
                                <span class="font-label-lg text-label-lg font-semibold">9 Mesas</span>
                                <span data-check hidden
                                    class="material-symbols-outlined text-[16px] hidden">check_circle</span>
                                <span
                                    class="font-data-mono text-data-mono text-[11px] text-secondary font-semibold">{{ intdiv($proyectosSorteo->count(), 9) }}-{{ (int) ceil($proyectosSorteo->count() / 9) }}
                                    c/u</span>
                            </div>
                            <span
                                class="font-data-mono text-data-mono text-[11px] text-on-surface-variant mt-1">{{ $proyectosSorteo->count() }}
                                proyectos para 9 mesas</span>
                            <span class="font-data-mono text-data-mono text-[11px] text-secondary font-semibold">Turnos
                                de 30 min</span>
                        </button>
                    </div>
                </div>
            </div>
            <div id="sorteo-mensaje" class="hidden rounded bg-error-container px-4 py-3 text-on-error-container"
                role="alert"></div>
            <div id="sorteo-vista-previa" aria-live="polite">
                <div class="rounded border border-dashed border-outline-variant/40 p-4 text-on-surface-variant">
                    Presione “Reordenar Sorteo Aleatorio” para generar y visualizar la distribución de los proyectos.
                </div>
            </div>
            <!-- AUDITORÍA DE GARANTÍAS Y METADATA DEL SORTEO -->
            <div
                class="flex flex-wrap items-center justify-between text-on-surface-variant bg-surface-container-low/60 px-3.5 py-2.5 rounded border border-outline-variant/20 text-body-sm">
                <div class="flex items-center gap-3 flex-wrap">
                    <span class="font-data-mono text-data-mono flex items-center gap-1 text-secondary font-semibold">
                        <span class="material-symbols-outlined text-[16px]">database</span> Fuente:
                        proyectos y dictámenes oficiales
                    </span>
                    <span class="text-outline-variant">•</span>
                    <span class="font-data-mono text-data-mono flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px] text-primary">timer</span>
                        <span
                            id="sorteo-auditoria">{{ $ultimoSorteo ? 'Último cronograma confirmado #' . $ultimoSorteo->idSorteo : 'No hay mesas ni horarios de sorteo guardados' }}</span>
                    </span>
                </div>
                <span class="font-data-mono text-data-mono text-on-surface-variant text-[12px]">
                    <span
                        id="sorteo-estado">{{ $ultimoSorteo ? 'Último sorteo confirmado #' . $ultimoSorteo->idSorteo : 'Sorteo: no ejecutado' }}</span>
                </span>
            </div>
        </div>
        <!-- Modal Footer & Decision Actions -->
        <div
            class="px-gutter-lg py-gutter-md bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-on-surface-variant max-w-md">
                <span class="material-symbols-outlined text-[20px] text-primary shrink-0">info</span>
                <p id="sorteo-footer-message" class="font-body-sm text-body-sm leading-tight">
                    Se consideran los {{ $proyectosSorteo->count() }} proyectos registrados.
                    {{ $ultimoSorteo ? 'Puede exportar el último cronograma confirmado o generar uno nuevo.' : 'El PDF estará disponible al confirmar un cronograma.' }}
                </p>
            </div>
            <div class="flex items-center gap-2.5 w-full sm:w-auto justify-end flex-wrap">
                <!-- Button: Exportar Cronograma de Mesas (PDF) -->
                <a id="exportar-sorteo-pdf" href="{{ $ultimoSorteo ? route('proyectoGrado.sorteo.pdf') : '#' }}"
                    target="_blank" @if (!$ultimoSorteo) aria-disabled="true" @endif
                    class="flex items-center gap-1.5 px-3 py-2 rounded bg-surface-container-lowest hover:bg-surface-container text-on-surface font-label-md text-label-md transition-colors shadow-sm border border-outline-variant/30"
                    @if (!$ultimoSorteo) style="opacity:.5;pointer-events:none" @endif>
                    <span class="material-symbols-outlined text-[18px] text-error">picture_as_pdf</span>
                    <span class="">Exportar Cronograma (PDF)</span>
                </a>
                <!-- Button: Ejecutar / Reordenar Sorteo Aleatorio -->
                <button id="generar-sorteo"
                    class="flex items-center gap-1.5 px-3.5 py-2 rounded bg-surface-container-high hover:bg-surface-container-highest text-primary font-label-md text-label-md font-semibold transition-colors shadow-sm border border-outline-variant/40 active:scale-[0.99]"
                    type="button">
                    <span class="material-symbols-outlined text-[18px]">casino</span>
                    <span class="">Reordenar Sorteo Aleatorio</span>
                </button>
                <!-- Button: Guardar y Confirmar Cronograma Oficial -->
                <button id="confirmar-sorteo"
                    class="flex items-center gap-2 px-5 py-2 rounded bg-primary hover:bg-primary-container text-on-primary font-label-lg text-label-lg font-semibold transition-all shadow-md hover:shadow-lg active:scale-[0.99]"
                    type="button" disabled>
                    <span class="material-symbols-outlined text-[18px]">verified</span>
                    <span class="">Guardar y Confirmar Cronograma Oficial</span>
                    <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                </button>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modal = document.getElementById('modal-sorteo');
                const abrir = document.getElementById('abrir-modal-sorteo');
                const cerrar = document.getElementById('cerrar-modal-sorteo');

                if (!modal || !abrir || !cerrar) return;

                const csrfToken = document.getElementById('sorteo-csrf-token').value;
                const generar = document.getElementById('generar-sorteo');
                const confirmar = document.getElementById('confirmar-sorteo');
                const exportarPdf = document.getElementById('exportar-sorteo-pdf');
                const fechaDefensa = document.getElementById('sorteo-fecha-defensa');
                const mensaje = document.getElementById('sorteo-mensaje');
                const vistaPrevia = document.getElementById('sorteo-vista-previa');
                const selectorMesas = [...modal.querySelectorAll('[data-mesas]')];
                const selectorNumeroMesas = document.getElementById('sorteo-numero-mesas');
                let numeroMesas = Number(selectorNumeroMesas.value);
                let sorteoGenerado = false;
                const totalProyectos = {{ $proyectosSorteo->count() }};

                const limpiarHorarioResumen = () => {
                    document.getElementById('sorteo-hora-inicio').textContent = '—';
                    document.getElementById('sorteo-periodo-inicio').textContent = 'sin horario';
                    document.getElementById('sorteo-hora-fin').textContent = '—';
                    document.getElementById('sorteo-periodo-fin').textContent = 'sin horario';
                };
                const actualizarHorarioResumen = () => {
                    const formatear = minutos => {
                        const hora = Math.floor(minutos / 60) % 24;
                        const periodo = hora >= 12 ? 'PM' : 'AM';
                        return {
                            hora: `${hora % 12 || 12}:${String(minutos % 60).padStart(2, '0')}`,
                            periodo,
                        };
                    };
                    const inicio = formatear(8 * 60);
                    const horariosFin = [
                        '09:00', '09:30', '10:00', '10:30', '11:00',
                        '11:30', '12:00', '12:30', '13:30', '14:00', '14:30',
                        '15:00', '15:30', '16:00', '16:30', '17:00', '17:30', '18:00',
                    ];
                    const fin = formatear(
                        horariosFin[Math.ceil(totalProyectos / numeroMesas) - 1]
                        .split(':').reduce((total, parte) => total * 60 + Number(parte), 0)
                    );
                    document.getElementById('sorteo-hora-inicio').textContent = inicio.hora;
                    document.getElementById('sorteo-periodo-inicio').textContent = inicio.periodo;
                    document.getElementById('sorteo-hora-fin').textContent = fin.hora;
                    document.getElementById('sorteo-periodo-fin').textContent = fin.periodo;
                };

                const mostrarError = texto => {
                    mensaje.textContent = texto;
                    mensaje.classList.remove('hidden');
                };
                const ocultarError = () => {
                    mensaje.textContent = '';
                    mensaje.classList.add('hidden');
                };
                selectorMesas.forEach(boton => boton.addEventListener('click', () => {
                    numeroMesas = Number(boton.dataset.mesas);
                    selectorMesas.forEach(opcion => {
                        const seleccionado = opcion === boton;
                        opcion.setAttribute('aria-pressed', String(seleccionado));
                        opcion.classList.toggle('bg-primary', seleccionado);
                        opcion.classList.toggle('text-on-primary', seleccionado);
                        opcion.classList.toggle('shadow-sm', seleccionado);
                        opcion.classList.toggle('border-primary', seleccionado);
                        opcion.classList.toggle('bg-surface-container-lowest', !seleccionado);
                        opcion.classList.toggle('text-on-surface', !seleccionado);
                        opcion.classList.toggle('border-outline-variant/30', !seleccionado);
                        const indicador = opcion.querySelector('[data-check]');
                        if (indicador) {
                            indicador.hidden = !seleccionado;
                            indicador.classList.toggle('hidden', !seleccionado);
                        }
                    });
                    selectorNumeroMesas.value = numeroMesas;
                    actualizarResumenMesas();
                }));
                const actualizarResumenMesas = () => {
                    document.getElementById('sorteo-resumen-mesas').textContent = numeroMesas;
                    const total = totalProyectos;
                    const base = Math.floor(total / numeroMesas);
                    const excedente = total % numeroMesas;
                    document.getElementById('sorteo-resumen-carga').textContent =
                        `${base} - ${Math.ceil(total / numeroMesas)}`;
                    document.getElementById('sorteo-resumen-distribucion').textContent =
                        `${numeroMesas - excedente} × ${base} + ${excedente} × ${base + 1} = ${total}`;
                    if (sorteoGenerado) {
                        confirmar.disabled = true;
                        limpiarHorarioResumen();
                        mostrarError('La configuración cambió. Vuelva a reordenar el sorteo antes de confirmar.');
                    }
                };
                selectorNumeroMesas.addEventListener('change', () => {
                    if (!selectorNumeroMesas.reportValidity()) return;
                    numeroMesas = Number(selectorNumeroMesas.value);
                    selectorMesas.forEach(opcion => {
                        const seleccionado = Number(opcion.dataset.mesas) === numeroMesas;
                        opcion.setAttribute('aria-pressed', String(seleccionado));
                        opcion.classList.toggle('bg-primary', seleccionado);
                        opcion.classList.toggle('text-on-primary', seleccionado);
                        opcion.classList.toggle('shadow-sm', seleccionado);
                        opcion.classList.toggle('border-primary', seleccionado);
                        opcion.classList.toggle('bg-surface-container-lowest', !seleccionado);
                        opcion.classList.toggle('text-on-surface', !seleccionado);
                        opcion.classList.toggle('border-outline-variant/30', !seleccionado);
                        const indicador = opcion.querySelector('[data-check]');
                        if (indicador) {
                            indicador.hidden = !seleccionado;
                            indicador.classList.toggle('hidden', !seleccionado);
                        }
                    });
                    actualizarResumenMesas();
                });
                selectorNumeroMesas.dispatchEvent(new Event('change'));
                fechaDefensa.addEventListener('change', () => {
                    if (sorteoGenerado) {
                        confirmar.disabled = true;
                        limpiarHorarioResumen();
                        mostrarError('La fecha cambió. Vuelva a reordenar el sorteo antes de confirmar.');
                    }
                });

                const ocultarModal = () => {
                    modal.classList.add('hidden');
                    modal.setAttribute('aria-hidden', 'true');
                    document.body.classList.remove('overflow-hidden');
                    abrir.focus();
                };

                abrir.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    modal.setAttribute('aria-hidden', 'false');
                    document.body.classList.add('overflow-hidden');
                    cerrar.focus();
                });

                cerrar.addEventListener('click', ocultarModal);
                modal.addEventListener('click', event => {
                    if (event.target === modal) ocultarModal();
                });
                document.addEventListener('keydown', event => {
                    if (event.key === 'Escape' && !modal.classList.contains('hidden')) ocultarModal();
                });

                generar.addEventListener('click', async () => {
                    ocultarError();
                    if (!fechaDefensa.value) {
                        mostrarError('Seleccione la fecha del cronograma.');
                        return;
                    }

                    generar.disabled = true;
                    confirmar.disabled = true;
                    try {
                        if (!selectorNumeroMesas.reportValidity()) {
                            throw new Error('Seleccione una cantidad de mesas válida.');
                        }
                        const respuesta = await fetch(@json(route('proyectoGrado.sorteo.generar')), {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify({
                                numeroMesas,
                                fechaDefensa: fechaDefensa.value,
                            }),
                        });
                        const resultado = await respuesta.json();
                        if (!respuesta.ok) {
                            throw new Error(resultado.message || Object.values(resultado.errors || {})
                            .flat()[0]);
                        }
                        vistaPrevia.innerHTML = resultado.html;
                        sorteoGenerado = true;
                        actualizarHorarioResumen();
                        document.getElementById('sorteo-estado').textContent =
                            'Sorteo: borrador no confirmado';
                        document.getElementById('sorteo-auditoria').textContent =
                            'Borrador temporal; todavía no está registrado';
                        document.getElementById('sorteo-footer-message').textContent =
                            'Distribución generada. Puede reordenarla; solo se registrará al confirmar el cronograma.';
                        confirmar.disabled = false;
                    } catch (error) {
                        mostrarError(error.message || 'No se pudo generar el sorteo.');
                    } finally {
                        generar.disabled = false;
                    }
                });

                confirmar.addEventListener('click', async () => {
                    ocultarError();
                    confirmar.disabled = true;
                    try {
                        const respuesta = await fetch(@json(route('proyectoGrado.sorteo.confirmar')), {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                        });
                        const resultado = await respuesta.json();
                        if (!respuesta.ok) {
                            throw new Error(resultado.message || Object.values(resultado.errors || {})
                            .flat()[0]);
                        }
                        mostrarError(resultado.message);
                        mensaje.classList.remove('bg-error-container', 'text-on-error-container');
                        mensaje.classList.add('bg-secondary-container', 'text-on-secondary-container');
                        document.getElementById('sorteo-estado').textContent =
                            `Sorteo confirmado #${resultado.idSorteo}`;
                        document.getElementById('sorteo-auditoria').textContent =
                            'Cronograma confirmado y registrado';
                        document.getElementById('sorteo-footer-message').textContent = resultado.message;
                        exportarPdf.href = @json(route('proyectoGrado.sorteo.pdf'));
                        exportarPdf.removeAttribute('aria-disabled');
                        exportarPdf.style.removeProperty('opacity');
                        exportarPdf.style.removeProperty('pointer-events');
                        generar.disabled = true;
                    } catch (error) {
                        mostrarError(error.message || 'No se pudo confirmar el cronograma.');
                        confirmar.disabled = false;
                    }
                });
            });
        </script>
    </div>
</div>

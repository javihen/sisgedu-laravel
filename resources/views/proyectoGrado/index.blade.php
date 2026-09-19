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
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "error-container": "#ffdad6",
                        "inverse-on-surface": "#eef0ff",
                        "surface-dim": "#d2d9f4",
                        "on-tertiary-container": "#ffd0ad",
                        "on-secondary-container": "#00714b",
                        "primary-fixed": "#dae2ff",
                        "surface-container-low": "#f2f3ff",
                        "surface-container-highest": "#dae2fd",
                        "surface-container-high": "#e2e7ff",
                        "secondary-fixed": "#8df7c1",
                        "secondary-container": "#8af5be",
                        "surface": "#faf8ff",
                        "on-error-container": "#93000a",
                        "inverse-surface": "#283044",
                        "tertiary-container": "#914d00",
                        "surface-container": "#eaedff",
                        "on-tertiary": "#ffffff",
                        "primary": "#0040a1",
                        "on-surface-variant": "#424654",
                        "on-tertiary-fixed": "#2f1500",
                        "on-background": "#131b2e",
                        "background": "#faf8ff",
                        "surface-container-lowest": "#ffffff",
                        "primary-container": "#0056d2",
                        "on-primary-container": "#ccd8ff",
                        "secondary": "#006c47",
                        "surface-tint": "#0056d2",
                        "outline-variant": "#c3c6d6",
                        "on-secondary-fixed": "#002113",
                        "tertiary-fixed-dim": "#ffb77d",
                        "on-secondary": "#ffffff",
                        "tertiary": "#6e3900",
                        "on-tertiary-fixed-variant": "#6e3900",
                        "surface-bright": "#faf8ff",
                        "outline": "#737785",
                        "primary-fixed-dim": "#b2c5ff",
                        "inverse-primary": "#b2c5ff",
                        "on-primary-fixed": "#001847",
                        "on-secondary-fixed-variant": "#005235",
                        "secondary-fixed-dim": "#71dba6",
                        "on-surface": "#131b2e",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#ffdcc3",
                        "on-primary-fixed-variant": "#0040a1",
                        "error": "#ba1a1a",
                        "on-primary": "#ffffff",
                        "surface-variant": "#dae2fd"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "margin-page": "1.5rem",
                        "gutter-md": "1rem",
                        "table-row-standard": "0.5rem",
                        "inset-card": "1.25rem",
                        "gutter-lg": "1.5rem",
                        "gutter-sm": "0.75rem",
                        "table-row-compact": "0.25rem"
                    },
                    fontFamily: {
                        "label-lg": ["Public Sans"],
                        "headline-md": ["Public Sans"],
                        "headline-lg": ["Public Sans"],
                        "label-md": ["Public Sans"],
                        "display": ["Public Sans"],
                        "body-lg": ["Public Sans"],
                        "body-md": ["Public Sans"],
                        "body-sm": ["Public Sans"],
                        "data-mono": ["JetBrains Mono"],
                        "headline-sm": ["Public Sans"],
                        "headline-lg-mobile": ["Public Sans"],
                        "data-mono-bold": ["JetBrains Mono"]
                    },
                    fontSize: {
                        "label-lg": ["0.875rem", {
                            "lineHeight": "1.25rem",
                            "fontWeight": "500"
                        }],
                        "headline-md": ["1.25rem", {
                            "lineHeight": "1.75rem",
                            "fontWeight": "600"
                        }],
                        "headline-lg": ["1.5rem", {
                            "lineHeight": "2rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "label-md": ["0.75rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }],
                        "display": ["2rem", {
                            "lineHeight": "2.5rem",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "body-lg": ["1rem", {
                            "lineHeight": "1.5rem",
                            "fontWeight": "400"
                        }],
                        "body-md": ["0.875rem", {
                            "lineHeight": "1.25rem",
                            "fontWeight": "400"
                        }],
                        "body-sm": ["0.75rem", {
                            "lineHeight": "1rem",
                            "fontWeight": "400"
                        }],
                        "data-mono": ["0.8125rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "500"
                        }],
                        "headline-sm": ["1.125rem", {
                            "lineHeight": "1.5rem",
                            "fontWeight": "600"
                        }],
                        "headline-lg-mobile": ["1.25rem", {
                            "lineHeight": "1.75rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "data-mono-bold": ["0.8125rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }]
                    }
                }
            }
        }
    </script>
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
                    {{-- <button
                        class="flex items-center gap-2 px-4 py-2 bg-surface-container-high hover:bg-surface-container-highest text-on-surface rounded shadow-sm transition-all font-label-lg text-label-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px] text-on-surface-variant">file_download</span>
                        <span>Exportar Cuadro XLS</span>
                    </button> --}}
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-secondary hover:bg-secondary/90 text-on-secondary rounded shadow-sm transition-all font-label-lg text-label-lg active:scale-95">
                        <span class="material-symbols-outlined text-[18px]">add_circle</span>
                        <span>Nuevo Registro de Proyecto</span>
                    </button>
                </div>
            </div>
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
                                <span class="font-display text-display text-primary">81</span>
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
                        <span class="text-on-surface-variant">81 BTH Técnica</span>
                        {{-- <span class="text-outline-variant">•</span>
                        <span class="text-on-surface-variant">8 Excelencia / Monog.</span> --}}
                    </div>
                </div>
                {{-- <div
                    class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 rounded-full bg-secondary/5 pointer-events-none">
                    </div>
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Avance
                                Global del Ciclo</span>
                            <div class="flex items-baseline gap-2 mt-2">
                                <span class="font-display text-display text-secondary">78.4%</span>
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
                            <span>Meta: 85% Nov</span>
                            <span>Diferencial: -6.6%</span>
                        </div>
                    </div>
                </div> --}}
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
                                <span class="font-display text-display text-error">05</span>
                                <span
                                    class="font-label-md text-label-md text-error bg-error-container px-1.5 py-0.5 rounded font-semibold">Acción
                                    Urgente</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-error-container flex items-center justify-center text-on-error-container">
                            <span class="material-symbols-outlined text-[22px]">warning</span>
                        </div>
                    </div>
                    <div
                        class="mt-4 pt-3 bg-surface-container-low/50 -mx-inset-card -mb-inset-card px-inset-card py-2 flex items-center justify-between text-body-sm">
                        <span class="text-error font-medium">3 Tribunal pendiente</span>
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
                                <span class="font-display text-display text-on-surface">31</span>
                                <span class="font-data-mono text-body-sm text-tertiary font-semibold">OCTUBRE</span>
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
            <div
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
                                <option value="todos">Todas las Modalidades (46)</option>
                                <option value="socio">Proyecto Socio-Comunitario Productivo (24)</option>
                                <option value="emprendimiento">Proyecto de Emprendimiento (14)</option>
                                <option value="tesis">Tesis / Monografía de Excelencia (8)</option>
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
                                <option value="manana">Mañana (Sistemas &amp; Mecánica)</option>
                                <option value="tarde">Tarde (Agropecuaria &amp; Gastronomía)</option>
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
                                <option value="mamani">Ing. Carlos Mamani Choque</option>
                                <option value="gutierrez">Lic. Martha Gutiérrez Rios</option>
                                <option value="valdez">Ing. Fernando Valdez Tapia</option>
                                <option value="quispe">Lic. Elena Morales Quisbert</option>
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
            </div>
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-gutter-lg items-start">
                <div class="xl:col-span-8 flex flex-col gap-gutter-md">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
                        <div class="px-inset-card py-4 bg-surface-container-low/60 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary text-[22px]">table_chart</span>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface">Listado Central de
                                    Proyectos de Grado</h2>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-primary/10 text-primary font-data-mono text-body-sm font-semibold">6
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
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </button>
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                    title="Registrar Observación">
                                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
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
                                                <span class="font-label-md text-outline mt-1">Especialidad: Sistemas
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
                                                <span class="font-label-md text-tertiary flex items-center gap-0.5 mt-0.5">
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
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </button>
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                    title="Registrar Observación">
                                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
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
                                                <span class="font-label-md text-outline mt-1">Especialidad: Mecánica
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
                                                <span class="font-label-md text-error flex items-center gap-0.5 mt-0.5">
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
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
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
                                            <div class="font-body-sm text-outline mt-1">Tutor: Lic. E. Morales</div>
                                        </td>

                                        <td class="py-3.5 px-4 align-top">
                                            <div class="flex flex-col">
                                                <span class="font-body-md text-on-surface font-medium">Dra. Beatriz
                                                    Soliz</span>
                                                <span
                                                    class="font-label-md text-secondary flex items-center gap-0.5 mt-0.5">
                                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                    Informe Favorable 100/100
                                                </span>
                                            </div>
                                        </td>

                                        <td class="py-3.5 px-4 align-middle text-center">
                                            <div class="flex items-center justify-center gap-1">
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-primary hover:text-primary-container"
                                                    title="Ver Expediente Completo">
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </button>
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                    title="Registrar Observación">
                                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
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
                                                <span class="font-label-md text-primary flex items-center gap-0.5 mt-0.5">
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
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </button>
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                    title="Registrar Observación">
                                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
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
                                                <span class="font-label-md text-outline mt-1">Especialidad: Sistemas
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
                                                    <span class="material-symbols-outlined text-[18px]">folder_open</span>
                                                </button>
                                                <button
                                                    class="p-1.5 hover:bg-surface-container rounded text-on-surface-variant hover:text-error"
                                                    title="Registrar Observación">
                                                    <span class="material-symbols-outlined text-[18px]">edit_note</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="px-inset-card py-3 bg-surface-container-low/40 flex flex-col sm:flex-row items-center justify-between gap-2">
                            <span class="font-body-sm text-outline">Mostrando registros 1 al 6 de un total de 46
                                postulaciones registradas</span>
                            <div class="flex items-center gap-1">
                                <button
                                    class="px-2.5 py-1 rounded bg-surface-container text-on-surface-variant text-body-sm font-data-mono opacity-50 cursor-not-allowed">«
                                    Anterior</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-primary text-on-primary text-body-sm font-data-mono">1</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface-container text-on-surface text-body-sm font-data-mono hover:bg-surface-container-high">2</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface-container text-on-surface text-body-sm font-data-mono hover:bg-surface-container-high">3</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface-container text-on-surface text-body-sm font-data-mono hover:bg-surface-container-high">Siguiente
                                    »</button>
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
                                class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-data-mono-bold text-label-md">JUE
                                14 NOV</span>
                        </div>
                        <p class="font-body-sm text-on-surface-variant mb-4">Cronograma de defensas públicas orales
                            y constitución de tribunales evaluadores.</p>
                        <div class="flex flex-col gap-3">
                            <div
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
                            </div>
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
<div class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-8 bg-slate-900/60 backdrop-blur-sm overflow-y-auto"
    id="modal-registro-proyecto">
    <div
        class="bg-surface-container-lowest w-full max-w-4xl rounded-xl shadow-2xl border border-outline-variant/30 flex flex-col overflow-hidden my-auto max-h-[92vh]">
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
            </div><button aria-label="Cerrar"
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
                            Oficial del Proyecto <span class="text-error">*</span></label><input
                            class="w-full bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 border border-outline-variant/30 focus:outline-none focus:border-primary"
                            placeholder="Ej: Implementación de Sistema Hidropónico Automatizado con Control Térmico y Monitoreo Remoto IoT"
                            type="text" value="" />
                        <p class="text-[11px] text-outline mt-1">Debe reflejar claramente el problema
                            socio-productivo abordado y la solución técnica implementada.</p>
                    </div>
                    <div class="md:col-span-3"><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Modalidad
                            de Titulación BTH <span class="text-error">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3"><label
                                class="flex items-start gap-2 p-2.5 rounded border border-primary/40 bg-primary/5 cursor-pointer"><input
                                    checked="" class="mt-1 text-primary focus:ring-primary" name="modalidad"
                                    type="radio" />
                                <div class="flex flex-col"><span
                                        class="font-label-lg text-body-sm font-semibold text-primary leading-tight">Proyecto
                                        Socio-Comunitario</span><span class="text-[11px] text-outline mt-0.5">Impacto
                                        comunitario directo</span>
                                </div>
                            </label><label
                                class="flex items-start gap-2 p-2.5 rounded border border-outline-variant/30 bg-surface-container-low cursor-pointer hover:bg-surface-container"><input
                                    class="mt-1 text-primary focus:ring-primary" name="modalidad" type="radio" />
                                <div class="flex flex-col"><span
                                        class="font-label-lg text-body-sm font-semibold text-on-surface leading-tight">Emprendimiento
                                        Productivo</span><span class="text-[11px] text-outline mt-0.5">Viabilidad
                                        económica</span></div>
                            </label><label
                                class="flex items-start gap-2 p-2.5 rounded border border-outline-variant/30 bg-surface-container-low cursor-pointer hover:bg-surface-container"><input
                                    class="mt-1 text-primary focus:ring-primary" name="modalidad" type="radio" />
                                <div class="flex flex-col"><span
                                        class="font-label-lg text-body-sm font-semibold text-on-surface leading-tight">Tesis
                                        / Excelencia</span><span class="text-[11px] text-outline mt-0.5">Promedio
                                        sobresaliente</span></div>
                            </label></div>
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
                        <div class="relative"><select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option disabled="" value="">Seleccionar estudiante...</option>
                                <option selected="" value="54891024">54891024 - APAZA TICONA Marco Antonio (6to
                                    Sec.
                                    'A')</option>
                                <option value="63920194">63920194 - CONDORI MAMANI Rodrigo (6to Sec. 'B')</option>
                                <option value="78201943">78201943 - MAMANI COARITE Elena (6to Sec. 'A')</option>
                                <option value="89102485">89102485 - QUISPE HUANCA Alex (6to Sec. 'C')</option>
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1"><label
                                class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Postulante
                                2 (Pareja / Opcional)</label><span
                                class="text-[11px] text-secondary font-medium">Habilitado</span></div>
                        <div class="relative"><select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option value="none">-- Sin segundo postulante (Individual) --</option>
                                <option selected="" value="78201943">78201943 - MAMANI COARITE Elena (6to Sec. 'A')
                                </option>
                                <option value="63920194">63920194 - CONDORI MAMANI Rodrigo (6to Sec. 'B')</option>
                                <option value="89102485">89102485 - QUISPE HUANCA Alex (6to Sec. 'C')</option>
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1"><label
                                class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Postulante
                                3 (Pareja / Opcional)</label><span
                                class="text-[11px] text-secondary font-medium">Habilitado</span></div>
                        <div class="relative"><select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option selected="" value="none">-- Sin tercer postulante (Individual) --
                                </option>
                                <option value="78201943">78201943 - MAMANI COARITE Elena (6to Sec. 'A')
                                </option>
                                <option value="63920194">63920194 - CONDORI MAMANI Rodrigo (6to Sec. 'B')</option>
                                <option value="89102485">89102485 - QUISPE HUANCA Alex (6to Sec. 'C')</option>
                            </select><span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-on-surface-variant text-[18px]">expand_more</span>
                        </div>
                    </div>
                    <div><label
                            class="block font-label-md text-label-md text-on-surface-variant uppercase tracking-wider mb-1">Docente
                            Tutor / Revisor</label>
                        <div class="relative"><select
                                class="w-full appearance-none bg-surface-container-low text-on-surface font-body-md text-body-md rounded px-3 py-2 pr-8 border border-outline-variant/30 focus:outline-none focus:border-primary">
                                <option selected="" value="san">Prof. Víctor Hugo Sánchez (Tribunal Evaluador)
                                </option>
                                <option value="sol">Dra. Beatriz Soliz (Comisión Técnica)</option>
                                <option value="ram">Ing. Walter Blanco (Metodología)</option>
                                <option value="qui">Lic. Javier Henry Quispe Pinto (Coordinador)</option>
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
                        <textarea
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
                    class="px-4 py-2 rounded border border-outline-variant text-on-surface hover:bg-surface-container font-label-lg text-label-lg transition-colors"
                    type="button">Cancelar</button>{{-- <button
                    class="flex items-center gap-1.5 px-4 py-2 rounded bg-surface-container-high hover:bg-surface-container-highest text-primary font-label-lg text-label-lg transition-colors"
                    type="button"><span class="material-symbols-outlined text-[18px]">save</span><span>Guardar
                        Borrador</span></button> --}}<button
                    class="flex items-center gap-2 px-5 py-2 rounded bg-secondary hover:bg-secondary/90 text-on-secondary font-label-lg text-label-lg shadow-sm transition-all active:scale-95"
                    type="button"><span
                        class="material-symbols-outlined text-[18px]">check_circle</span><span>Registrar Proyecto y
                        Crear Expediente</span></button></div>
        </div>
    </div>
</div>

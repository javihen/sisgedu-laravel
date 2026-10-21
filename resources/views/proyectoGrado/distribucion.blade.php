@extends('layouts.navhorizontal')

@section('content')
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_dashboard" name="shell-type" />
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
                    "colors": {
                        "on-tertiary-container": "#ffd0ad",
                        "surface-container": "#eaedff",
                        "primary-fixed": "#dae2ff",
                        "surface-variant": "#dae2fd",
                        "surface-bright": "#faf8ff",
                        "inverse-on-surface": "#eef0ff",
                        "on-primary-container": "#ccd8ff",
                        "surface-container-high": "#e2e7ff",
                        "background": "#faf8ff",
                        "on-tertiary-fixed": "#2f1500",
                        "outline": "#737785",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#0056d2",
                        "primary": "#0040a1",
                        "outline-variant": "#c3c6d6",
                        "primary-container": "#0056d2",
                        "tertiary-fixed": "#ffdcc3",
                        "on-secondary-fixed-variant": "#005235",
                        "on-tertiary-fixed-variant": "#6e3900",
                        "on-secondary-container": "#00714b",
                        "on-primary-fixed": "#001847",
                        "inverse-primary": "#b2c5ff",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#424654",
                        "secondary-fixed": "#8df7c1",
                        "surface-container-low": "#f2f3ff",
                        "tertiary-container": "#914d00",
                        "secondary-container": "#8af5be",
                        "tertiary-fixed-dim": "#ffb77d",
                        "error-container": "#ffdad6",
                        "secondary": "#006c47",
                        "tertiary": "#6e3900",
                        "surface-container-highest": "#dae2fd",
                        "on-primary-fixed-variant": "#0040a1",
                        "on-primary": "#ffffff",
                        "on-background": "#131b2e",
                        "primary-fixed-dim": "#b2c5ff",
                        "inverse-surface": "#283044",
                        "surface-dim": "#d2d9f4",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#71dba6",
                        "surface": "#faf8ff",
                        "on-error": "#ffffff",
                        "on-surface": "#131b2e",
                        "on-secondary-fixed": "#002113"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-page": "1.5rem",
                        "gutter-lg": "1.5rem",
                        "table-row-standard": "0.5rem",
                        "table-row-compact": "0.25rem",
                        "gutter-md": "1rem",
                        "inset-card": "1.25rem",
                        "gutter-sm": "0.75rem"
                    },
                    "fontFamily": {
                        "data-mono": ["JetBrains Mono"],
                        "data-mono-bold": ["JetBrains Mono"],
                        "label-lg": ["Public Sans"],
                        "headline-lg": ["Public Sans"],
                        "headline-md": ["Public Sans"],
                        "display": ["Public Sans"],
                        "body-lg": ["Public Sans"],
                        "headline-lg-mobile": ["Public Sans"],
                        "body-sm": ["Public Sans"],
                        "label-md": ["Public Sans"],
                        "body-md": ["Public Sans"],
                        "headline-sm": ["Public Sans"]
                    },
                    "fontSize": {
                        "data-mono": ["0.8125rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "500"
                        }],
                        "data-mono-bold": ["0.8125rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "label-lg": ["0.875rem", {
                            "lineHeight": "1.25rem",
                            "fontWeight": "500"
                        }],
                        "headline-lg": ["1.5rem", {
                            "lineHeight": "2rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["1.25rem", {
                            "lineHeight": "1.75rem",
                            "fontWeight": "600"
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
                        "headline-lg-mobile": ["1.25rem", {
                            "lineHeight": "1.75rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "body-sm": ["0.75rem", {
                            "lineHeight": "1rem",
                            "fontWeight": "400"
                        }],
                        "label-md": ["0.75rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }],
                        "body-md": ["0.875rem", {
                            "lineHeight": "1.25rem",
                            "fontWeight": "400"
                        }],
                        "headline-sm": ["1.125rem", {
                            "lineHeight": "1.5rem",
                            "fontWeight": "600"
                        }]
                    }
                }
            }
        };
    </script>
    <main class="relative pt-4 min-h-screen px-gutter-lg pb-margin-page">
        <div class="flex flex-col w-full">
            <!-- Page Context & Section Hierarchy -->
            <div class="flex flex-col gap-6 w-full">
                <!-- Top Action & Navigation Banner -->
                <div
                    class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-surface-container-lowest p-gutter-lg rounded-xl shadow-sm">
                    <div class="flex flex-col max-w-2xl">
                        <div class="flex items-center gap-2 mb-1">
                            <span
                                class="font-data-mono text-data-mono text-primary font-bold uppercase tracking-wider">Asignación
                                de Tribunales · BTH Vida Nueva</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-outline-variant"></span>
                            <span class="font-label-md text-label-md text-secondary font-semibold flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">verified</span> Gestión
                                Titulación 2024
                            </span>
                        </div>
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight leading-snug">
                            Distribución y Carga de Proyectos por Mesa de Tribunal
                        </h1>
                        <p class="font-body-md text-body-md text-on-surface-variant mt-1 leading-relaxed">
                            Monitoreo comparativo de mesas examinadoras, ternas completas asignadas por proyecto,
                            compatibilidad horaria y asignación de salas de deliberación.
                        </p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        <!-- View Mode Switcher -->
                        <div class="inline-flex p-1 bg-surface-container rounded-lg shadow-inner">
                            <button
                                class="flex items-center gap-2 px-3.5 py-1.5 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg shadow-sm transition-all"
                                type="button">
                                <span class="material-symbols-outlined text-[18px]">table_restaurant</span>
                                <span>Por Mesa</span>
                            </button>
                            <a class="flex items-center gap-2 px-3.5 py-1.5 rounded-lg text-on-surface-variant hover:text-on-surface font-label-lg text-label-lg transition-colors"
                                href="#">
                                <span class="material-symbols-outlined text-[18px]">badge</span>
                                <span>Por Jurado</span>
                            </a>
                        </div>
                        <!-- Quick Institutional Exports -->
                        <div class="flex items-center gap-2">
                            <button
                                class="flex items-center gap-2 px-3 py-2 bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg rounded-lg transition-all"
                                title="Exportar nómina ministerial" type="button">
                                <span class="material-symbols-outlined text-[18px] text-error">picture_as_pdf</span>
                                <span class="hidden xl:inline">Nómina PDF</span>
                            </button>
                            <button
                                class="flex items-center gap-2 px-3 py-2 bg-surface-container hover:bg-surface-container-high text-on-surface font-label-lg text-label-lg rounded-lg transition-all"
                                title="Descargar matriz en formato Excel" type="button">
                                <span class="material-symbols-outlined text-[18px] text-secondary">table_view</span>
                                <span class="hidden xl:inline">Matriz XLS</span>
                            </button>
                            <button
                                class="flex items-center gap-2 px-3.5 py-2 bg-primary text-on-primary hover:bg-primary-container font-label-lg text-label-lg rounded-lg shadow-sm transition-all"
                                type="button">
                                <span class="material-symbols-outlined text-[18px]">group_add</span>
                                <span>Nueva Mesa</span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- KPI Summary Row with Rich SVG Gauges -->
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-gutter-md">
                    <!-- Card 1 -->
                    <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[20px] text-primary">groups_3</span>
                                <span class="font-label-md text-label-md uppercase font-semibold tracking-wider">Mesas
                                    Constituidas</span>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded text-[11px] font-data-mono font-bold bg-secondary-container text-on-secondary-container">100%
                                TERNAS</span>
                        </div>
                        <div class="mt-4 flex items-baseline justify-between">
                            <div>
                                <span class="font-display text-display text-on-surface tracking-tight">24</span>
                                <span class="font-body-md text-body-md text-on-surface-variant ml-1.5">/ 24
                                    asignadas</span>
                            </div>
                            <div class="text-right">
                                <span class="font-data-mono-bold text-data-mono-bold text-secondary">72 Roles</span>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">Docentes acreditados
                                </p>
                            </div>
                        </div>
                        <div class="w-full bg-surface-container h-1.5 rounded-full overflow-hidden mt-3">
                            <div class="bg-primary h-full rounded-full" style="width: 100%;"></div>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[20px] text-secondary">meeting_room</span>
                                <span class="font-label-md text-label-md uppercase font-semibold tracking-wider">Salas
                                    Habilitadas</span>
                            </div>
                            <span class="w-2 h-2 rounded-full bg-secondary"></span>
                        </div>
                        <div class="mt-4 flex items-baseline justify-between">
                            <div>
                                <span class="font-display text-display text-on-surface tracking-tight">4</span>
                                <span class="font-body-md text-body-md text-on-surface-variant ml-1.5">ambientes
                                    activos</span>
                            </div>
                            <div class="flex items-center gap-1 text-on-surface-variant">
                                <span class="font-data-mono text-data-mono">Capacidad: 100%</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 mt-3 text-on-surface-variant font-body-sm text-body-sm">
                            <span class="px-1.5 py-0.5 bg-surface-container rounded font-data-mono text-[11px]">Lab
                                1</span>
                            <span class="px-1.5 py-0.5 bg-surface-container rounded font-data-mono text-[11px]">Lab
                                2</span>
                            <span
                                class="px-1.5 py-0.5 bg-surface-container rounded font-data-mono text-[11px]">Mecánica</span>
                            <span
                                class="px-1.5 py-0.5 bg-surface-container rounded font-data-mono text-[11px]">Auditorio</span>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[20px] text-secondary">verified_user</span>
                                <span class="font-label-md text-label-md uppercase font-semibold tracking-wider">Conflictos
                                    Horarios</span>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded text-[11px] font-data-mono font-bold bg-secondary-container text-on-secondary-container">0
                                CRUCES</span>
                        </div>
                        <div class="mt-4 flex items-baseline justify-between">
                            <div>
                                <span class="font-display text-display text-secondary tracking-tight">0</span>
                                <span class="font-body-md text-body-md text-on-surface-variant ml-1.5">traslapes en
                                    terna</span>
                            </div>
                            <div class="flex items-center gap-1 text-secondary font-label-md text-label-md">
                                <span class="material-symbols-outlined text-[16px]">check_circle</span>
                                <span>Algoritmo OK</span>
                            </div>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant mt-3 truncate">
                            Régimen de compatibilidad horaria ministerial validado
                        </p>
                    </div>
                    <!-- Card 4 -->
                    <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span class="material-symbols-outlined text-[20px] text-tertiary">fact_check</span>
                                <span class="font-label-md text-label-md uppercase font-semibold tracking-wider">Estado
                                    de Actas</span>
                            </div>
                            <span class="font-data-mono text-data-mono font-semibold text-primary">66.6%</span>
                        </div>
                        <div class="mt-4 flex items-baseline justify-between">
                            <div>
                                <span class="font-display text-display text-on-surface tracking-tight">16</span>
                                <span
                                    class="font-body-md text-body-md text-secondary ml-1 font-semibold">Oficializadas</span>
                            </div>
                            <div class="text-right">
                                <span class="font-data-mono-bold text-data-mono-bold text-tertiary">8</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant ml-0.5">Pendientes</span>
                            </div>
                        </div>
                        <div class="w-full bg-surface-container h-1.5 rounded-full overflow-hidden mt-3 flex">
                            <div class="bg-secondary h-full" style="width: 66.6%;"></div>
                            <div class="bg-surface-variant h-full" style="width: 33.4%;"></div>
                        </div>
                    </div>
                </div>
                <!-- Filter & Query Control Panel -->
                {{-- <div
                    class="bg-surface-container-lowest p-4 rounded-xl shadow-sm flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
                    <div class="flex flex-1 flex-col sm:flex-row items-center gap-3">
                        <!-- Search Input -->
                        <div class="relative w-full sm:w-80">
                            <span
                                class="material-symbols-outlined absolute left-3 top-2.5 text-[18px] text-outline">search</span>
                            <input
                                class="w-full h-10 pl-9 pr-3 text-body-md font-body-md bg-surface-container-low rounded-lg focus:outline-none focus:bg-surface-container text-on-surface placeholder:text-outline transition-all"
                                placeholder="Buscar código, estudiante o docente..." type="text" />
                        </div>
                        <!-- Specialty Selector -->
                        <div class="relative w-full sm:w-56">
                            <select
                                class="w-full h-10 px-3 pr-8 text-body-md font-body-md bg-surface-container-low rounded-lg focus:outline-none text-on-surface appearance-none cursor-pointer">
                                <option value="">Todas las Especialidades</option>
                                <option value="si">Sistemas Informáticos</option>
                                <option value="ag">Agroecología</option>
                                <option value="ga">Gastronomía</option>
                                <option value="mc">Mecánica Industrial</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-[18px] text-outline">expand_more</span>
                        </div>
                        <!-- Day / Shift Selector -->
                        <div class="relative w-full sm:w-48">
                            <select
                                class="w-full h-10 px-3 pr-8 text-body-md font-body-md bg-surface-container-low rounded-lg focus:outline-none text-on-surface appearance-none cursor-pointer">
                                <option value="">Todos los Días</option>
                                <option value="l18">Lunes 18 / Nov</option>
                                <option value="m19">Martes 19 / Nov</option>
                                <option value="x20">Miércoles 20 / Nov</option>
                                <option value="j21">Jueves 21 / Nov</option>
                            </select>
                            <span
                                class="material-symbols-outlined absolute right-2.5 top-2.5 pointer-events-none text-[18px] text-outline">calendar_today</span>
                        </div>
                    </div>
                    <!-- State Filter Pills -->
                    <div class="flex items-center gap-1.5 overflow-x-auto pb-1 lg:pb-0">
                        <button
                            class="px-3 py-1.5 rounded-lg bg-primary-container text-on-primary font-label-md text-label-md whitespace-nowrap shadow-sm">
                            Todas (24)
                        </button>
                        <button
                            class="px-3 py-1.5 rounded-lg bg-surface-container text-on-surface-variant hover:text-on-surface font-label-md text-label-md whitespace-nowrap transition-colors">
                            Terna Completa (20)
                        </button>
                        <button
                            class="px-3 py-1.5 rounded-lg bg-surface-container text-on-surface-variant hover:text-on-surface font-label-md text-label-md whitespace-nowrap transition-colors">
                            En Observación (4)
                        </button>
                        <button
                            class="px-3 py-1.5 rounded-lg bg-surface-container text-on-surface-variant hover:text-on-surface font-label-md text-label-md whitespace-nowrap transition-colors">
                            En Deliberación
                        </button>
                    </div>
                </div> --}}
                <!-- Main Dynamic Layout: 2 Columns (Content Left 8 cols, Control Dock Right 4 cols) -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-lg items-start">
                    <!-- Primary Feed: Cards of Evaluator Tables (8 Cols) -->
                    <div class="lg:col-span-8 flex flex-col gap-5">
                        <!-- CARD MESA 1 -->
                        <div
                            class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden transition-all hover:shadow-md">
                            <!-- Card Header / Meta Bar -->
                            <div
                                class="p-4 sm:p-5 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="px-2.5 py-1 rounded bg-primary text-on-primary font-data-mono-bold text-data-mono-bold tracking-tight">
                                        MESA 01 · BTH-2024-SI-004
                                    </span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-surface-variant text-primary font-label-md text-label-md font-semibold">
                                        Sistemas Informáticos
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        Terna Validada
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-on-surface-variant font-label-md text-label-md">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                        Lun 18/Nov · 09:00 AM
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                        Lab 1 Informática
                                    </span>
                                </div>
                            </div>
                            <!-- Project & Postulants Details -->
                            <div class="p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold tracking-wider">Proyecto
                                        de Grado Técnico Medio</span>
                                    <h3
                                        class="font-headline-md text-headline-md text-on-surface font-semibold leading-snug">
                                        "Sistema Web de Control Hidropónico Automatizado con Telemetría IoT"
                                    </h3>
                                    <div
                                        class="flex items-center gap-2 mt-1 text-on-surface-variant font-body-sm text-body-sm">
                                        <span class="material-symbols-outlined text-[16px] text-outline">school</span>
                                        <span>Postulantes: <strong class="text-on-surface font-semibold">Joel
                                                Condori Condori</strong> &amp; <strong
                                                class="text-on-surface font-semibold">Ruth Mamani Perez</strong>
                                            (5to Secundaria BTH)</span>
                                    </div>
                                </div>
                                <!-- Terna Table Structure -->
                                <div class="bg-surface-container-low rounded-lg p-3">
                                    <div class="flex items-center justify-between pb-2 mb-2">
                                        <span
                                            class="font-label-md text-label-md font-semibold text-on-surface uppercase tracking-wider flex items-center gap-1.5">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-primary">how_to_reg</span>
                                            Terna Evaluadora Oficial (3 Jurados Titulares)
                                        </span>
                                        <span class="font-data-mono text-data-mono text-secondary font-medium">Quórum
                                            Acreditado (3/3)</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2.5">
                                        <!-- Jurado 1: Presidente -->
                                        <div
                                            class="p-3 bg-surface-container-lowest rounded-lg shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[11px] font-semibold bg-primary text-on-primary">PRESIDENTE</span>
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">
                                                    Lic. Javier Henry Quispe Pinto
                                                </span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                                                    RDA: 492014-LP
                                                </span>
                                            </div>
                                            <span
                                                class="mt-2.5 pt-2 text-[11px] font-label-md text-on-surface-variant font-medium block">
                                                Área: Titulación y Redes
                                            </span>
                                        </div>
                                        <!-- Jurado 2: Vocal Especialista -->
                                        <div
                                            class="p-3 bg-surface-container-lowest rounded-lg shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[11px] font-semibold bg-secondary text-on-secondary">VOCAL
                                                        TÉCNICO</span>
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">
                                                    Ing. Carlos Mendoza Rojas
                                                </span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                                                    RDA: 519022-LP
                                                </span>
                                            </div>
                                            <span
                                                class="mt-2.5 pt-2 text-[11px] font-label-md text-on-surface-variant font-medium block">
                                                Área: Telemática y Hardware
                                            </span>
                                        </div>
                                        <!-- Jurado 3: Vocal Secretario -->
                                        <div
                                            class="p-3 bg-surface-container-lowest rounded-lg shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[11px] font-semibold bg-surface-container-highest text-on-surface-variant">VOCAL
                                                        SECRETARIO</span>
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">
                                                    Prof. Gladys Choque Mamani
                                                </span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                                                    RDA: 381190-LP
                                                </span>
                                            </div>
                                            <span
                                                class="mt-2.5 pt-2 text-[11px] font-label-md text-on-surface-variant font-medium block">
                                                Área: Metodología BTH
                                            </span>
                                        </div>
                                    </div>
                                    <!-- Tutor Guidance Notice -->
                                    <div
                                        class="mt-2.5 flex items-center justify-between px-2 text-[11px] text-on-surface-variant font-body-sm">
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px] text-outline">info</span>
                                            Tutor Acompañante: <span class="font-medium text-on-surface">Ing.
                                                Marcelo Flores</span> (Inhabilitado de emitir calificación por norma
                                            ministerial)
                                        </span>
                                        <span class="font-data-mono text-[10px] text-outline">Acta #
                                            ACT-8891-24</span>
                                    </div>
                                </div>
                                <!-- Footer Action Row -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="px-2.5 py-1 rounded bg-surface-variant text-primary font-label-md text-label-md font-semibold flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px]">pending_actions</span>
                                            Defensa Programada · En Espera de Apertura
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="px-3 py-1.5 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center gap-1"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            Expediente
                                        </button>
                                        <button
                                            class="px-3 py-1.5 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center gap-1"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">swap_horiz</span>
                                            Reasignar
                                        </button>
                                        <button
                                            class="px-4 py-1.5 bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-lg text-label-lg shadow-sm transition-all flex items-center gap-1.5"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">lock_open</span>
                                            Aperturar Acta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CARD MESA 2 -->
                        <div
                            class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden transition-all hover:shadow-md">
                            <div
                                class="p-4 sm:p-5 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="px-2.5 py-1 rounded bg-secondary text-on-secondary font-data-mono-bold text-data-mono-bold tracking-tight">
                                        MESA 02 · BTH-2024-AG-012
                                    </span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-surface-variant text-primary font-label-md text-label-md font-semibold">
                                        Agroecología
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        Terna Validada
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-on-surface-variant font-label-md text-label-md">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                        Mié 20/Nov · 08:30 AM
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                        Invernadero Exp. / Lab 2
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold tracking-wider">Proyecto
                                        Socio-Productivo</span>
                                    <h3
                                        class="font-headline-md text-headline-md text-on-surface font-semibold leading-snug">
                                        "Biofertilizante Orgánico Líquido a Base de Residuos Orgánicos de Camélidos
                                        para Suelos Altiplánicos"
                                    </h3>
                                    <div
                                        class="flex items-center gap-2 mt-1 text-on-surface-variant font-body-sm text-body-sm">
                                        <span class="material-symbols-outlined text-[16px] text-outline">school</span>
                                        <span>Postulantes: <strong class="text-on-surface font-semibold">Alan Huanca
                                                Gutierrez</strong> &amp; <strong
                                                class="text-on-surface font-semibold">Elena Guachalla
                                                Flores</strong></span>
                                    </div>
                                </div>
                                <!-- Terna Table -->
                                <div class="bg-surface-container-low rounded-lg p-3">
                                    <div class="flex items-center justify-between pb-2 mb-2">
                                        <span
                                            class="font-label-md text-label-md font-semibold text-on-surface uppercase tracking-wider flex items-center gap-1.5">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-primary">how_to_reg</span>
                                            Terna Evaluadora Oficial (3 Jurados Titulares)
                                        </span>
                                        <span class="font-data-mono text-data-mono text-secondary font-medium">Quórum
                                            Acreditado (3/3)</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2.5">
                                        <div
                                            class="p-3 bg-surface-container-lowest rounded-lg shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[11px] font-semibold bg-primary text-on-primary">PRESIDENTE</span>
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">
                                                    Prof. Victor Hugo Sánchez
                                                </span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                                                    RDA: 290145-LP
                                                </span>
                                            </div>
                                            <span
                                                class="mt-2.5 pt-2 text-[11px] font-label-md text-on-surface-variant font-medium block">
                                                Área: Metodología e Investigación
                                            </span>
                                        </div>
                                        <div
                                            class="p-3 bg-surface-container-lowest rounded-lg shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[11px] font-semibold bg-secondary text-on-secondary">VOCAL
                                                        TÉCNICO</span>
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">
                                                    Ing. Roberto Carlos Ali
                                                </span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                                                    RDA: 412998-LP
                                                </span>
                                            </div>
                                            <span
                                                class="mt-2.5 pt-2 text-[11px] font-label-md text-on-surface-variant font-medium block">
                                                Área: Agronomía y Suelos
                                            </span>
                                        </div>
                                        <div
                                            class="p-3 bg-surface-container-lowest rounded-lg shadow-sm flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center justify-between mb-2">
                                                    <span
                                                        class="px-2 py-0.5 rounded text-[11px] font-semibold bg-surface-container-highest text-on-surface-variant">VOCAL
                                                        SECRETARIO</span>
                                                    <span
                                                        class="material-symbols-outlined text-[16px] text-secondary">check_circle</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">
                                                    Lic. Martha Beltrán Cruz
                                                </span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant block mt-0.5">
                                                    RDA: 602114-LP
                                                </span>
                                            </div>
                                            <span
                                                class="mt-2.5 pt-2 text-[11px] font-label-md text-on-surface-variant font-medium block">
                                                Área: Comunicación y Redacción
                                            </span>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-2.5 flex items-center justify-between px-2 text-[11px] text-on-surface-variant font-body-sm">
                                        <span>Tutor Asesor: <strong class="text-on-surface">Ing. Roxana
                                                Quisbert</strong> (Excluida de evaluación)</span>
                                        <span class="font-data-mono text-[10px] text-outline">Acta #
                                            ACT-8892-24</span>
                                    </div>
                                </div>
                                <!-- Footer Action Row -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="px-2.5 py-1 rounded bg-surface-container-high text-on-surface-variant font-label-md text-label-md font-semibold flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px] text-secondary">rule</span>
                                            Borrador Validado · Listo para Fecha
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="px-3 py-1.5 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center gap-1"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            Expediente
                                        </button>
                                        <button
                                            class="px-4 py-1.5 bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-lg text-label-lg shadow-sm transition-all flex items-center gap-1.5"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">tune</span>
                                            Gestionar Mesa
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CARD MESA 3 (Concluida / Alta Calificación) -->
                        <div
                            class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden transition-all hover:shadow-md">
                            <div
                                class="p-4 sm:p-5 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="px-2.5 py-1 rounded bg-tertiary text-on-tertiary font-data-mono-bold text-data-mono-bold tracking-tight">
                                        MESA 03 · BTH-2024-GA-007
                                    </span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-surface-variant text-primary font-label-md text-label-md font-semibold">
                                        Gastronomía
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-medium">
                                        <span class="material-symbols-outlined text-[14px]">done_all</span>
                                        Concluida &amp; Firmada
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-on-surface-variant font-label-md text-label-md">
                                    <span class="flex items-center gap-1">
                                        <span
                                            class="material-symbols-outlined text-[16px] text-secondary">event_available</span>
                                        Jue 21/Nov · 14:00 PM
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                        Taller de Gastronomía
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold tracking-wider">Proyecto
                                        de Emprendimiento Productivo</span>
                                    <h3
                                        class="font-headline-md text-headline-md text-on-surface font-semibold leading-snug">
                                        "Elaboración y Comercialización de Harina Integral de Cañahua para
                                        Panificación Escolar Andina"
                                    </h3>
                                    <div
                                        class="flex items-center gap-2 mt-1 text-on-surface-variant font-body-sm text-body-sm">
                                        <span class="material-symbols-outlined text-[16px] text-outline">school</span>
                                        <span>Postulantes: <strong class="text-on-surface font-semibold">Silvia
                                                Quisbert Morales</strong> &amp; <strong
                                                class="text-on-surface font-semibold">Pedro Calle
                                                Quispe</strong></span>
                                    </div>
                                </div>
                                <!-- Terna Members Compact -->
                                <div class="bg-surface-container-low rounded-lg p-3">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2.5">
                                        <div class="p-2.5 bg-surface-container-lowest rounded-lg shadow-sm">
                                            <span
                                                class="text-[10px] font-bold text-primary block uppercase">Presidente</span>
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface truncate block">Lic.
                                                Javier Henry Quispe</span>
                                            <span class="text-[11px] text-secondary font-data-mono block">Firma
                                                Digital OK</span>
                                        </div>
                                        <div class="p-2.5 bg-surface-container-lowest rounded-lg shadow-sm">
                                            <span class="text-[10px] font-bold text-secondary block uppercase">Vocal
                                                Especialista</span>
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface truncate block">Chef
                                                Walter Romero</span>
                                            <span class="text-[11px] text-secondary font-data-mono block">Firma
                                                Digital OK</span>
                                        </div>
                                        <div class="p-2.5 bg-surface-container-lowest rounded-lg shadow-sm">
                                            <span
                                                class="text-[10px] font-bold text-on-surface-variant block uppercase">Vocal
                                                Secretario</span>
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface truncate block">Prof.
                                                Victor Hugo Sánchez</span>
                                            <span class="text-[11px] text-secondary font-data-mono block">Firma
                                                Digital OK</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Score Summary & Badges -->
                                <div
                                    class="p-3 bg-secondary-container/30 rounded-lg flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-secondary text-on-secondary flex items-center justify-center font-data-mono-bold text-data-mono-bold text-lg shadow-sm">
                                            94
                                        </div>
                                        <div>
                                            <span
                                                class="font-label-lg text-label-lg font-bold text-secondary block leading-tight">Defensa
                                                Exitosa · Aprobado con Felicitación</span>
                                            <span class="font-body-sm text-body-sm text-on-surface-variant">Promedio
                                                ponderado final: 94 / 100 puntos ministeriales</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="px-3 py-1.5 bg-surface-container-lowest hover:bg-surface-container text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center gap-1 shadow-sm"
                                            type="button">
                                            <span
                                                class="material-symbols-outlined text-[16px] text-secondary">verified</span>
                                            Ver Acta Oficial
                                        </button>
                                        <button
                                            class="px-3.5 py-1.5 bg-secondary text-on-secondary hover:bg-on-secondary-container rounded-lg font-label-lg text-label-lg shadow-sm transition-all flex items-center gap-1.5"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">file_download</span>
                                            Certificado
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CARD MESA 4 -->
                        <div
                            class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden transition-all hover:shadow-md">
                            <div
                                class="p-4 sm:p-5 bg-surface-container-low flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span
                                        class="px-2.5 py-1 rounded bg-primary-container text-on-primary font-data-mono-bold text-data-mono-bold tracking-tight">
                                        MESA 04 · BTH-2024-MC-003
                                    </span>
                                    <span
                                        class="px-2 py-0.5 rounded bg-surface-variant text-primary font-label-md text-label-md font-semibold">
                                        Mecánica Industrial
                                    </span>
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-medium">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        Terna Validada
                                    </span>
                                </div>
                                <div class="flex items-center gap-3 text-on-surface-variant font-label-md text-label-md">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">schedule</span>
                                        Mar 19/Nov · 10:30 AM
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[16px] text-primary">location_on</span>
                                        Taller de Mecánica
                                    </span>
                                </div>
                            </div>
                            <div class="p-5 flex flex-col gap-4">
                                <div class="flex flex-col gap-1">
                                    <span
                                        class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold tracking-wider">Proyecto
                                        de Innovación Tecnológica</span>
                                    <h3
                                        class="font-headline-md text-headline-md text-on-surface font-semibold leading-snug">
                                        "Prototipo de Prensadora Hidráulica Semi-Automática para Chatarra y
                                        Reciclaje Metálico"
                                    </h3>
                                    <div
                                        class="flex items-center gap-2 mt-1 text-on-surface-variant font-body-sm text-body-sm">
                                        <span class="material-symbols-outlined text-[16px] text-outline">school</span>
                                        <span>Postulante Único: <strong class="text-on-surface font-semibold">David
                                                Nina Apaza</strong> (5to Secundaria BTH)</span>
                                    </div>
                                </div>
                                <!-- Terna Members Compact -->
                                <div class="bg-surface-container-low rounded-lg p-3">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2.5">
                                        <div class="p-3 bg-surface-container-lowest rounded-lg shadow-sm">
                                            <div class="flex items-center justify-between mb-1.5">
                                                <span
                                                    class="px-2 py-0.5 rounded text-[10px] font-semibold bg-primary text-on-primary">PRESIDENTE</span>
                                            </div>
                                            <span
                                                class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">Ing.
                                                Félix Copa Ramos</span>
                                            <span class="text-[11px] text-on-surface-variant">RDA: 541098-LP</span>
                                        </div>
                                        <div class="p-3 bg-surface-container-lowest rounded-lg shadow-sm">
                                            <div class="flex items-center justify-between mb-1.5">
                                                <span
                                                    class="px-2 py-0.5 rounded text-[10px] font-semibold bg-secondary text-on-secondary">VOCAL
                                                    TÉCNICO</span>
                                            </div>
                                            <span
                                                class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">Ing.
                                                Carlos Mendoza Rojas</span>
                                            <span class="text-[11px] text-on-surface-variant">RDA: 519022-LP</span>
                                        </div>
                                        <div class="p-3 bg-surface-container-lowest rounded-lg shadow-sm">
                                            <div class="flex items-center justify-between mb-1.5">
                                                <span
                                                    class="px-2 py-0.5 rounded text-[10px] font-semibold bg-surface-container-highest text-on-surface-variant">VOCAL
                                                    SECRETARIO</span>
                                            </div>
                                            <span
                                                class="font-label-lg text-label-lg text-on-surface font-semibold block leading-tight">Lic.
                                                Martha Beltrán Cruz</span>
                                            <span class="text-[11px] text-on-surface-variant">RDA: 602114-LP</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Footer Action Row -->
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pt-2">
                                    <div class="flex items-center gap-2">
                                        <span
                                            class="px-2.5 py-1 rounded bg-surface-variant text-primary font-label-md text-label-md font-semibold flex items-center gap-1.5">
                                            <span class="material-symbols-outlined text-[16px]">schedule</span>
                                            Defensa Programada · En Espera
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button
                                            class="px-3 py-1.5 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center gap-1"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">visibility</span>
                                            Expediente
                                        </button>
                                        <button
                                            class="px-4 py-1.5 bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-lg text-label-lg shadow-sm transition-all flex items-center gap-1.5"
                                            type="button">
                                            <span class="material-symbols-outlined text-[16px]">lock_open</span>
                                            Aperturar Acta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Right Column: Institutional Control Dock & Analytics (4 Cols) -->
                    <div class="lg:col-span-4 flex flex-col gap-5">
                        <!-- Cronograma Semanal de Salas Card -->
                        {{-- <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm">
                            <div class="flex items-center justify-between pb-3 mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px] text-primary">calendar_month</span>
                                    <h2 class="font-headline-sm text-headline-sm text-on-surface">Carga Semanal de
                                        Salas</h2>
                                </div>
                                <span class="font-data-mono text-data-mono text-on-surface-variant">4 Salas
                                    Activas</span>
                            </div>
                            <div class="flex flex-col gap-3">
                                <!-- Lab 1 -->
                                <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-1.5">
                                    <div class="flex items-center justify-between">
                                        <span class="font-label-lg text-label-lg text-on-surface font-semibold">Laboratorio
                                            1 Informática</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-primary">6
                                            defensas</span>
                                    </div>
                                    <div class="w-full bg-surface-container h-2 rounded-full overflow-hidden">
                                        <div class="bg-primary h-full rounded-full" style="width: 75%;"></div>
                                    </div>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant flex justify-between">
                                        <span>Lunes a Jueves · 08:30 - 12:30</span>
                                        <span class="text-secondary font-medium">Capacidad 75%</span>
                                    </span>
                                </div>
                                <!-- Lab 2 -->
                                <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-1.5">
                                    <div class="flex items-center justify-between">
                                        <span class="font-label-lg text-label-lg text-on-surface font-semibold">Invernadero
                                            / Lab 2 Agro</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-secondary">6
                                            defensas</span>
                                    </div>
                                    <div class="w-full bg-surface-container h-2 rounded-full overflow-hidden">
                                        <div class="bg-secondary h-full rounded-full" style="width: 75%;"></div>
                                    </div>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant flex justify-between">
                                        <span>Miércoles y Viernes · Mañanas</span>
                                        <span class="text-secondary font-medium">Capacidad 75%</span>
                                    </span>
                                </div>
                                <!-- Taller Mecánica -->
                                <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-1.5">
                                    <div class="flex items-center justify-between">
                                        <span class="font-label-lg text-label-lg text-on-surface font-semibold">Taller
                                            Mecánica Industrial</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-tertiary">8
                                            defensas</span>
                                    </div>
                                    <div class="w-full bg-surface-container h-2 rounded-full overflow-hidden">
                                        <div class="bg-tertiary h-full rounded-full" style="width: 100%;"></div>
                                    </div>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant flex justify-between">
                                        <span>Turno Completo Mañana y Tarde</span>
                                        <span class="text-tertiary font-bold">Lleno (100%)</span>
                                    </span>
                                </div>
                                <!-- Auditorio Central -->
                                <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-1.5">
                                    <div class="flex items-center justify-between">
                                        <span class="font-label-lg text-label-lg text-on-surface font-semibold">Auditorio
                                            Central BTH</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-primary">4
                                            defensas</span>
                                    </div>
                                    <div class="w-full bg-surface-container h-2 rounded-full overflow-hidden">
                                        <div class="bg-primary h-full rounded-full" style="width: 50%;"></div>
                                    </div>
                                    <span class="font-body-sm text-body-sm text-on-surface-variant flex justify-between">
                                        <span>Proyectos Interdisciplinarios</span>
                                        <span class="text-secondary font-medium">Disponible 50%</span>
                                    </span>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Protocolo de Quórum Reglamentario Card -->
                        <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm">
                            <div class="flex items-center gap-2 pb-3 mb-3">
                                <span class="material-symbols-outlined text-[20px] text-secondary">gavel</span>
                                <h2 class="font-headline-sm text-headline-sm text-on-surface">Protocolo de
                                    Instalación</h2>
                            </div>
                            <ul class="flex flex-col gap-3 font-body-sm text-body-sm text-on-surface-variant">
                                <li class="flex items-start gap-2.5">
                                    <span
                                        class="material-symbols-outlined text-[18px] text-secondary flex-shrink-0 mt-0.5">check_circle</span>
                                    <span><strong>Presencia Obligatoria:</strong> Los 3 miembros de la terna
                                        examinadora deben autenticarse con su firma digital PIN antes de la
                                        sustentación.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span
                                        class="material-symbols-outlined text-[18px] text-secondary flex-shrink-0 mt-0.5">timer</span>
                                    <span><strong>Tolerancia Máxima:</strong> 15 minutos exactos desde la hora
                                        programada para reemplazo por suplente ministerial.</span>
                                </li>
                                <li class="flex items-start gap-2.5">
                                    <span
                                        class="material-symbols-outlined text-[18px] text-secondary flex-shrink-0 mt-0.5">lock</span>
                                    <span><strong>Cierre de Acta Inalterable:</strong> Una vez firmada por el
                                        Presidente, el acta genera hash SHA-256 no editable.</span>
                                </li>
                            </ul>
                            <div class="mt-4 p-3 bg-surface-container-low rounded-lg">
                                <span
                                    class="font-label-md text-label-md font-semibold text-on-surface block mb-1">Normativa
                                    Vigente BTH:</span>
                                <p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
                                    Resolución Ministerial 0184/2024 · Reglamento General de Graduación Técnica
                                    Tecnológica del Estado Plurinacional.
                                </p>
                            </div>
                        </div>
                        <!-- Direct Actions Dock -->
                        <div class="bg-surface-container-lowest p-5 rounded-xl shadow-sm flex flex-col gap-3">
                            <span
                                class="font-label-md text-label-md uppercase font-semibold tracking-wider text-on-surface-variant">Operaciones
                                Rápidas</span>
                            <button
                                class="w-full py-2.5 px-4 bg-primary text-on-primary hover:bg-primary-container rounded-lg font-label-lg text-label-lg shadow-sm transition-all flex items-center justify-center gap-2"
                                type="button">
                                <span class="material-symbols-outlined text-[18px]">bolt</span>
                                <span>Simular Cruces de Horario</span>
                            </button>
                            <button
                                class="w-full py-2.5 px-4 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center justify-center gap-2"
                                type="button">
                                <span class="material-symbols-outlined text-[18px]">print</span>
                                <span>Exportar Sábana de Mesas (A3 / PDF)</span>
                            </button>
                            <button
                                class="w-full py-2.5 px-4 bg-surface-container hover:bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg transition-colors flex items-center justify-center gap-2"
                                type="button">
                                <span class="material-symbols-outlined text-[18px]">verified</span>
                                <span>Validar Carga con RDA Ministerial</span>
                            </button>
                        </div>
                        <!-- Ambient Mini Visual / Security Hash -->
                        <div
                            class="p-4 bg-surface-container-low rounded-xl flex items-center gap-3 text-on-surface-variant">
                            <div
                                class="w-8 h-8 rounded bg-surface-container flex items-center justify-center text-primary flex-shrink-0">
                                <span class="material-symbols-outlined text-[18px]">fingerprint</span>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="font-data-mono text-[11px] font-bold text-on-surface truncate">SISTEMA
                                    AUDITADO · MINEDU</span>
                                <span class="font-data-mono text-[10px] text-outline truncate">Hash: 8f9b...a12c |
                                    Nodo BTH Central</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Simple interactive tab styling toggle demonstration
            document.addEventListener('DOMContentLoaded', () => {
                const filterButtons = document.querySelectorAll('button[class*="whitespace-nowrap"]');
                filterButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        filterButtons.forEach(b => {
                            b.classList.remove('bg-primary-container', 'text-on-primary',
                                'shadow-sm');
                            b.classList.add('bg-surface-container', 'text-on-surface-variant');
                        });
                        btn.classList.remove('bg-surface-container', 'text-on-surface-variant');
                        btn.classList.add('bg-primary-container', 'text-on-primary', 'shadow-sm');
                    });
                });
            });
        </script>
    </main>
@endsection

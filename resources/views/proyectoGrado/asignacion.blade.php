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
    <main class="relative pt-4 min-h-screen  px-gutter-lg pb-margin-page">
        <div class="flex flex-col w-full">
            <!-- Sub-header Breadcrumb & Operational Context Bar -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
                <div class="flex flex-col gap-1">
                    <nav class="flex items-center gap-2 text-on-surface-variant font-label-md text-label-md">
                        <span class="hover:text-primary cursor-pointer transition-colors">BTH Vida Nueva</span>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="hover:text-primary cursor-pointer transition-colors">Asignación de
                            Tribunales</span>
                        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                        <span class="text-primary font-semibold">Sorteo y Balanceo de Jurados</span>
                    </nav>
                    <div class="flex items-center gap-3">
                        <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Designación de
                            Tribunales y Distribución de Jurados BTH</h1>
                        <span
                            class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-data-mono text-body-sm font-semibold">
                            <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                            Gestión 2024 · Fase III
                        </span>
                    </div>
                </div>
                <!-- Action Toolbar -->
                <div class="flex items-center flex-wrap gap-2.5">
                    <button
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-surface-container-high hover:bg-surface-variant text-primary font-label-lg text-label-lg shadow-sm transition-all"
                        onclick="document.getElementById('modal-registro-jurado').classList.remove('hidden')">
                        <span class="material-symbols-outlined text-[18px]">person_add</span>
                        <span> Registrar Nuevo Jurado</span>
                    </button>
                    {{-- <button
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-surface-container-high hover:bg-surface-variant text-on-surface font-label-lg text-label-lg shadow-sm transition-all"
                        onclick="document.getElementById('modal-criterios').classList.remove('hidden')">
                        <span class="material-symbols-outlined text-[18px]">tune</span>
                        <span>Criterios de Asignación</span>
                    </button>
                    <button
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-container text-on-primary font-label-lg text-label-lg shadow-md hover:bg-primary transition-all"
                        onclick="ejecutarSorteoAlgoritmo()">
                        <span class="material-symbols-outlined text-[20px]">shuffle</span>
                        <span>Ejecutar Sorteo Aleatorio Inteligente</span>
                    </button> --}}
                    <button
                        class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg bg-secondary text-on-secondary font-label-lg text-label-lg shadow-sm hover:opacity-95 transition-all"
                        onclick="exportarNominaPDF()">
                        <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                        <span>Exportar Nómina Oficial PDF</span>
                    </button>
                </div>
            </div>
            <!-- Operational Health & Metric Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- Card 1: Cobertura Proyectos -->
                <div
                    class="relative bg-surface-container-lowest p-inset-card rounded-xl shadow-sm flex flex-col justify-between overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Proyectos
                                por Asignar</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-display text-display text-primary font-bold">24</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">totales</span>
                            </div>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-primary-fixed flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[22px]">assignment_turned_in</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 flex flex-col gap-1.5 bg-surface-container-low p-2 rounded-lg">
                        <div class="flex justify-between items-center text-body-sm font-label-md">
                            <span class="text-secondary font-medium">18 Completos (75%)</span>
                            <span class="text-tertiary-container font-medium">6 Pendientes/Parciales</span>
                        </div>
                        <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden flex">
                            <div class="bg-secondary h-full" style="width: 75%"></div>
                            <div class="bg-tertiary-container h-full" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
                <!-- Card 2: Docentes Jurados -->
                <div
                    class="relative bg-surface-container-lowest p-inset-card rounded-xl shadow-sm flex flex-col justify-between overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Jurados
                                Habilitados</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-display text-display text-on-surface font-bold">16</span>
                                <span class="font-body-sm text-body-sm text-secondary font-medium">100%
                                    validados</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-secondary-container flex items-center justify-center text-on-secondary-container">
                            <span class="material-symbols-outlined text-[22px]">groups</span>
                        </div>
                    </div>
                    <div
                        class="mt-4 pt-3 flex items-center justify-between bg-surface-container-low p-2 rounded-lg text-body-sm">
                        <span class="text-on-surface-variant">Carga promedio:</span>
                        <span class="font-data-mono-bold text-data-mono-bold text-primary">4.5 actas /
                            docente</span>
                    </div>
                </div>
                <!-- Card 3: Especialidades -->
                {{-- <div
                    class="relative bg-surface-container-lowest p-inset-card rounded-xl shadow-sm flex flex-col justify-between overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div>
                            <span
                                class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant">Pertinencia
                                Técnica</span>
                            <div class="flex items-baseline gap-2 mt-1">
                                <span class="font-display text-display text-secondary font-bold">100%</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">compatibilidad</span>
                            </div>
                        </div>
                        <div
                            class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-[22px]">verified_user</span>
                        </div>
                    </div>
                    <div class="mt-4 pt-2 flex flex-wrap gap-1">
                        <span
                            class="px-1.5 py-0.5 rounded text-[10px] font-data-mono bg-surface-container text-primary">Sistemas</span>
                        <span
                            class="px-1.5 py-0.5 rounded text-[10px] font-data-mono bg-surface-container text-primary">Agroecol.</span>
                        <span
                            class="px-1.5 py-0.5 rounded text-[10px] font-data-mono bg-surface-container text-primary">Gastron.</span>
                        <span
                            class="px-1.5 py-0.5 rounded text-[10px] font-data-mono bg-surface-container text-primary">Mecánica</span>
                    </div>
                </div> --}}
                <!-- Card 4: Algoritmo Normativo -->
                {{-- <div
                    class="relative bg-surface-container-lowest p-inset-card rounded-xl shadow-sm flex flex-col justify-between overflow-hidden">
                    <div class="flex items-start justify-between">
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[16px] text-tertiary-container">gavel</span>
                                <span
                                    class="font-label-md text-label-md uppercase tracking-wider text-tertiary-container font-semibold">Restricción
                                    Activa</span>
                            </div>
                            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1.5 leading-snug">
                                Impedimento de conflicto de interés: Tutor vetado como tribunal de su postulante.
                            </p>
                        </div>
                    </div>
                    <div
                        class="mt-3 flex items-center justify-between text-body-sm font-data-mono bg-surface-container-low px-2 py-1 rounded">
                        <span class="text-on-surface-variant">Tope institucional:</span>
                        <span class="font-bold text-on-surface">Máx. 6 proy. / jurado</span>
                    </div>
                </div> --}}
            </div>
            <!-- Sorteo Configuration, Rule Control & Live Filters -->
            {{-- <div class="bg-surface-container-lowest rounded-xl p-inset-card shadow-sm mb-6 flex flex-col gap-4">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4 pb-3">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-primary-fixed rounded-lg text-primary flex items-center justify-center">
                            <span class="material-symbols-outlined text-[20px]">smart_toy</span>
                        </div>
                        <div>
                            <h2 class="font-headline-sm text-headline-sm text-on-surface">Motor de Asignación y
                                Reglas del Sorteo</h2>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">Configuración paramétrica
                                para la ejecución y asignación automatizada sin conflictos de interés</p>
                        </div>
                    </div>
                    <!-- Live Execution Trigger -->
                    <div class="flex items-center gap-3 self-stretch lg:self-auto">
                        <button
                            class="w-full lg:w-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm hover:bg-surface-tint transition-all"
                            id="btn-auto-assign" onclick="simularAsignacion()">
                            <span class="material-symbols-outlined text-[20px]">autorenew</span>
                            <span>Sortear y Asignar a 6 Pendientes</span>
                        </button>
                    </div>
                </div>
                <!-- Rule Checkboxes & Parameters -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 p-3 bg-surface-container-low rounded-lg">
                    <label class="flex items-start gap-2.5 cursor-pointer">
                        <input checked="" class="mt-0.5 rounded text-primary focus:ring-primary w-4 h-4"
                            type="checkbox" />
                        <div class="flex flex-col">
                            <span class="font-label-lg text-label-lg text-on-surface font-semibold">Impedimento
                                Tutor-Tribunal</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Inhabilita al docente
                                asesor como jurado de sus propios estudiantes.</span>
                        </div>
                    </label>
                    <label class="flex items-start gap-2.5 cursor-pointer">
                        <input checked="" class="mt-0.5 rounded text-primary focus:ring-primary w-4 h-4"
                            type="checkbox" />
                        <div class="flex flex-col">
                            <span class="font-label-lg text-label-lg text-on-surface font-semibold">Equidad en Carga
                                Horaria</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">Balancea aleatoriamente
                                priorizando docentes con menos de 4 defensas.</span>
                        </div>
                    </label>
                    <label class="flex items-start gap-2.5 cursor-pointer">
                        <input checked="" class="mt-0.5 rounded text-primary focus:ring-primary w-4 h-4"
                            type="checkbox" />
                        <div class="flex flex-col">
                            <span class="font-label-lg text-label-lg text-on-surface font-semibold">Terna
                                Obligatoria Estructurada</span>
                            <span class="font-body-sm text-body-sm text-on-surface-variant">1 Presidente
                                (Metodológico/Directivo) + 1 Especialista + 1 Secretario.</span>
                        </div>
                    </label>
                </div>
                <!-- Filter & Query Workspace -->
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Buscar
                            Proyecto o Postulante</label>
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-[18px]">search</span>
                            <input
                                class="w-full pl-9 pr-3 py-2 bg-surface rounded-lg text-body-md text-on-surface shadow-inner focus:outline-none focus:ring-1 focus:ring-primary"
                                id="filtro-texto" placeholder="Buscar por código, título o RUDE..." type="text" />
                        </div>
                    </div>
                    <div class="w-full sm:w-48">
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Cohorte /
                            Curso</label>
                        <select
                            class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="todos">Todos los paralelos</option>
                            <option value="6A">6to Secundaria - Paralelo A</option>
                            <option value="6B">6to Secundaria - Paralelo B</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-52">
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Especialidad
                            BTH</label>
                        <select
                            class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="todas">Todas las Especialidades</option>
                            <option value="sistemas">Sistemas Computacionales</option>
                            <option value="agro">Agroecología y Riego</option>
                            <option value="gastro">Gastronomía y Nutrición</option>
                            <option value="mecanica">Mecánica Industrial</option>
                            <option value="alimentos">Transformación de Alimentos</option>
                        </select>
                    </div>
                    <div class="w-full sm:w-48">
                        <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Estado
                            Tribunal</label>
                        <select
                            class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                            id="filtro-estado" onchange="filtrarTabla()">
                            <option value="todos">Todos los Estados</option>
                            <option value="completo">Tribunal Completo (3/3)</option>
                            <option value="parcial">Incompleto / Parcial</option>
                            <option value="sin_asignar">Sin Asignar (0/3)</option>
                        </select>
                    </div>
                    <div class="flex items-end self-end">
                        <button
                            class="px-3 py-2 rounded-lg bg-surface-container hover:bg-surface-variant text-on-surface-variant flex items-center gap-1.5 text-label-md">
                            <span class="material-symbols-outlined text-[18px]">filter_list_off</span>
                            <span>Limpiar</span>
                        </button>
                    </div>
                </div>
            </div> --}}
            <!-- Main Content Layout: Table (Primary) & Juror Roster (Secondary Sidebar) -->
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
                <!-- Projects and Designated Tribunals Ledger (xl:col-span-8) -->
                <div class="xl:col-span-8 flex flex-col gap-4">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
                        <!-- Table Topbar -->
                        <div class="p-4 bg-surface-container-low flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">fact_check</span>
                                <span class="font-headline-sm text-headline-sm text-on-surface">Nómina de Proyectos
                                    y Plazas de Tribunal</span>
                                <span
                                    class="ml-2 px-2 py-0.5 rounded text-data-mono text-body-sm bg-surface-container text-on-surface font-bold">24
                                    registros</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span
                                    class="hidden px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container text-label-md font-semibold animate-pulse"
                                    id="toast-preview">
                                    Previsualización de Sorteo Aplicada
                                </span>
                                <button
                                    class="p-1.5 rounded-lg bg-surface hover:bg-surface-container text-on-surface-variant">
                                    <span class="material-symbols-outlined text-[18px]">view_column</span>
                                </button>
                            </div>
                        </div>
                        <!-- Scrollable High Density Data Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse" id="tabla-proyectos">
                                <thead>
                                    <tr class="bg-surface-container text-on-surface font-label-md text-label-md">
                                        <th class="py-3 px-4 font-semibold uppercase tracking-wider">Proyecto /
                                            Postulantes</th>
                                        <th class="py-3 px-3 font-semibold uppercase tracking-wider">Tutor Guía</th>
                                        <th class="py-3 px-3 font-semibold uppercase tracking-wider">Terna Designada
                                            (Pres. / Voc. 1 / Voc. 2)</th>
                                        <th class="py-3 px-3 font-semibold uppercase tracking-wider text-center">
                                            Estado</th>
                                        <th class="py-3 px-4 font-semibold uppercase tracking-wider text-right">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-surface-container-high text-body-md">
                                    <!-- Row 1: Completo -->
                                    <tr class="hover:bg-surface-container-low transition-colors" data-estado="completo">
                                        <td class="py-3 px-4 align-top">
                                            <div class="flex flex-col gap-1 max-w-[260px]">
                                                <div class="flex items-center gap-1.5">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">BTH-2024-SI-004</span>
                                                    <span
                                                        class="px-1.5 py-0.2 rounded text-[10px] bg-primary-fixed text-on-primary-fixed font-semibold">Sistemas</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Sistema
                                                    Web de Control Hidropónico Automatizado con IoT</span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant truncate">Post:
                                                    Joel Condori · Ruth Mamani</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1 max-w-[170px]">
                                                <span
                                                    class="font-label-md text-label-md font-semibold text-on-surface">Ing.
                                                    Marcelo Flores</span>
                                                <span
                                                    class="inline-flex items-center gap-1 text-[11px] text-tertiary-container bg-surface-container px-1.5 py-0.5 rounded">
                                                    <span class="material-symbols-outlined text-[12px]">block</span>
                                                    Tutor (Inhabilitado)
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1.5 min-w-[280px]">
                                                <!-- Presidente -->
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-[10px] font-bold">P</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lic.
                                                            Henry Quispe Pinto</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-on-surface-variant font-data-mono">Presidencia</span>
                                                </div>
                                                <!-- Vocal Especialista -->
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-[10px] font-bold">V1</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Ing.
                                                            Carlos Mendoza R.</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-secondary font-data-mono font-medium">Esp.
                                                        Redes</span>
                                                </div>
                                                <!-- Vocal Secretario -->
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-surface-variant text-on-surface flex items-center justify-center text-[10px] font-bold">V2</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Prof.
                                                            Gladys Choque M.</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-on-surface-variant font-data-mono">Secretaría</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top text-center">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-secondary-container text-on-secondary-container font-data-mono text-[11px] font-semibold">
                                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                Completo (3/3)
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 align-top text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button class="p-1.5 rounded-lg text-primary hover:bg-surface-container"
                                                    onclick="generarMemo('BTH-2024-SI-004')"
                                                    title="Generar Memorándum de Designación">
                                                    <span class="material-symbols-outlined text-[18px]">history_edu</span>
                                                </button>
                                                <button
                                                    class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container"
                                                    onclick="abrirReasignarModal('BTH-2024-SI-004')"
                                                    title="Re-sortear o Cambiar">
                                                    <span
                                                        class="material-symbols-outlined text-[18px]">edit_calendar</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 2: Incompleto / Parcial -->
                                    <tr class="hover:bg-surface-container-low transition-colors" data-estado="parcial"
                                        id="fila-bth-agro-012">
                                        <td class="py-3 px-4 align-top">
                                            <div class="flex flex-col gap-1 max-w-[260px]">
                                                <div class="flex items-center gap-1.5">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">BTH-2024-AG-012</span>
                                                    <span
                                                        class="px-1.5 py-0.2 rounded text-[10px] bg-secondary-container text-on-secondary-container font-semibold">Agroecología</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Biofertilizante
                                                    Orgánico Líquido a Base de Residuos de Camélidos</span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant truncate">Post:
                                                    Alan Huanca Gutierrez</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1 max-w-[170px]">
                                                <span
                                                    class="font-label-md text-label-md font-semibold text-on-surface">Ing.
                                                    Roxana Quisbert</span>
                                                <span
                                                    class="inline-flex items-center gap-1 text-[11px] text-tertiary-container bg-surface-container px-1.5 py-0.5 rounded">
                                                    <span class="material-symbols-outlined text-[12px]">block</span>
                                                    Tutor (Inhabilitado)
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1.5 min-w-[280px]">
                                                <!-- Presidente -->
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-[10px] font-bold">P</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Prof.
                                                            Victor H. Sánchez</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-on-surface-variant font-data-mono">Presidencia</span>
                                                </div>
                                                <!-- Vocal Especialista -->
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-[10px] font-bold">V1</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Ing.
                                                            Roberto Carlos Ali</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-secondary font-data-mono font-medium">Agronomía</span>
                                                </div>
                                                <!-- Vocal Secretario Pendiente -->
                                                <div class="flex items-center justify-between bg-error-container/30 px-2 py-1 rounded border border-dashed border-error/40"
                                                    id="slot-vocal-secretario">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-error text-on-error flex items-center justify-center text-[10px] font-bold">?</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-error font-medium italic">Vacante:
                                                            Vocal Secretario</span>
                                                    </div>
                                                    <button
                                                        class="text-[11px] text-primary hover:underline font-semibold font-data-mono"
                                                        onclick="asignarRapido('BTH-2024-AG-012', 3)">
                                                        + Asignar
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top text-center">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-data-mono text-[11px] font-semibold"
                                                id="badge-estado-agro">
                                                <span class="material-symbols-outlined text-[14px]">warning</span>
                                                Incompleto (2/3)
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 align-top text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button class="p-1.5 rounded-lg text-primary hover:bg-surface-container"
                                                    onclick="sortearUno('BTH-2024-AG-012')"
                                                    title="Completar con Sorteo Automático">
                                                    <span class="material-symbols-outlined text-[18px]">casino</span>
                                                </button>
                                                <button
                                                    class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container"
                                                    onclick="abrirReasignarModal('BTH-2024-AG-012')"
                                                    title="Reasignar Plazas">
                                                    <span
                                                        class="material-symbols-outlined text-[18px]">edit_calendar</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 3: Sin Asignar -->
                                    <tr class="hover:bg-surface-container-low transition-colors" data-estado="sin_asignar"
                                        id="fila-bth-ga-007">
                                        <td class="py-3 px-4 align-top">
                                            <div class="flex flex-col gap-1 max-w-[260px]">
                                                <div class="flex items-center gap-1.5">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">BTH-2024-GA-007</span>
                                                    <span
                                                        class="px-1.5 py-0.2 rounded text-[10px] bg-tertiary-fixed text-on-tertiary-fixed-variant font-semibold">Gastronomía</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Harina
                                                    Integral de Cañahua para Panificación Escolar Andina</span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant truncate">Post:
                                                    Erika Ticona C. · Pedro Calle</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1 max-w-[170px]">
                                                <span
                                                    class="font-label-md text-label-md font-semibold text-on-surface">Chef
                                                    Walter Romero</span>
                                                <span
                                                    class="inline-flex items-center gap-1 text-[11px] text-tertiary-container bg-surface-container px-1.5 py-0.5 rounded">
                                                    <span class="material-symbols-outlined text-[12px]">block</span>
                                                    Tutor (Inhabilitado)
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top" id="slot-tribunal-ga">
                                            <div
                                                class="p-3 rounded-lg bg-surface-container-low text-center flex flex-col items-center justify-center gap-1.5">
                                                <span
                                                    class="material-symbols-outlined text-outline text-[22px]">shuffle</span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant font-medium">Plazas
                                                    vacantes (0 de 3 asignados)</span>
                                                <button class="text-label-md text-primary font-semibold hover:underline"
                                                    onclick="sortearUno('BTH-2024-GA-007')">
                                                    Ejecutar Sorteo Aleatorio de Terna
                                                </button>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top text-center" id="badge-ga-wrapper">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-error-container text-on-error-container font-data-mono text-[11px] font-semibold">
                                                <span class="material-symbols-outlined text-[14px]">cancel</span>
                                                Sin Asignar (0/3)
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 align-top text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button class="p-1.5 rounded-lg text-primary hover:bg-surface-container"
                                                    onclick="sortearUno('BTH-2024-GA-007')" title="Sortear Jurado">
                                                    <span class="material-symbols-outlined text-[18px]">casino</span>
                                                </button>
                                                <button
                                                    class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container"
                                                    onclick="abrirReasignarModal('BTH-2024-GA-007')"
                                                    title="Asignación Manual">
                                                    <span class="material-symbols-outlined text-[18px]">person_add</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Row 4: Completo -->
                                    <tr class="hover:bg-surface-container-low transition-colors" data-estado="completo">
                                        <td class="py-3 px-4 align-top">
                                            <div class="flex flex-col gap-1 max-w-[260px]">
                                                <div class="flex items-center gap-1.5">
                                                    <span
                                                        class="font-data-mono-bold text-data-mono-bold text-primary">BTH-2024-MC-003</span>
                                                    <span
                                                        class="px-1.5 py-0.2 rounded text-[10px] bg-surface-container text-on-surface font-semibold">Mecánica</span>
                                                </div>
                                                <span
                                                    class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Prototipo
                                                    de Prensadora Hidráulica Semi-Automática para Chatarra</span>
                                                <span
                                                    class="font-body-sm text-body-sm text-on-surface-variant truncate">Post:
                                                    David Nina Apaza</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1 max-w-[170px]">
                                                <span
                                                    class="font-label-md text-label-md font-semibold text-on-surface">Ing.
                                                    Gustavo Canaviri</span>
                                                <span
                                                    class="inline-flex items-center gap-1 text-[11px] text-tertiary-container bg-surface-container px-1.5 py-0.5 rounded">
                                                    <span class="material-symbols-outlined text-[12px]">block</span>
                                                    Tutor (Inhabilitado)
                                                </span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top">
                                            <div class="flex flex-col gap-1.5 min-w-[280px]">
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-[10px] font-bold">P</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lic.
                                                            Javier Henry Quispe</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-on-surface-variant font-data-mono">Presidencia</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-[10px] font-bold">V1</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Ing.
                                                            Felix Copa Ramos</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-secondary font-data-mono font-medium">Metalmecánica</span>
                                                </div>
                                                <div
                                                    class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
                                                    <div class="flex items-center gap-1.5">
                                                        <span
                                                            class="w-5 h-5 rounded-full bg-surface-variant text-on-surface flex items-center justify-center text-[10px] font-bold">V2</span>
                                                        <span
                                                            class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lic.
                                                            Martha Beltrán C.</span>
                                                    </div>
                                                    <span
                                                        class="text-[10px] text-on-surface-variant font-data-mono">Metodología</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 align-top text-center">
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-secondary-container text-on-secondary-container font-data-mono text-[11px] font-semibold">
                                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                Completo (3/3)
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 align-top text-right">
                                            <div class="flex items-center justify-end gap-1">
                                                <button class="p-1.5 rounded-lg text-primary hover:bg-surface-container"
                                                    onclick="generarMemo('BTH-2024-MC-003')"
                                                    title="Generar Memorándum de Designación">
                                                    <span class="material-symbols-outlined text-[18px]">history_edu</span>
                                                </button>
                                                <button
                                                    class="p-1.5 rounded-lg text-on-surface-variant hover:bg-surface-container"
                                                    onclick="abrirReasignarModal('BTH-2024-MC-003')" title="Re-sortear">
                                                    <span
                                                        class="material-symbols-outlined text-[18px]">edit_calendar</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Table Pagination & Bulk Status Summary -->
                        <div
                            class="p-3 bg-surface-container-low flex flex-col sm:flex-row items-center justify-between gap-3 text-body-sm">
                            <div class="flex items-center gap-2 text-on-surface-variant">
                                <span>Mostrando 4 de 24 proyectos</span>
                                <span>·</span>
                                <span class="text-secondary font-semibold">18 tribunales oficializados</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <button
                                    class="px-2.5 py-1 rounded bg-surface hover:bg-surface-container disabled:opacity-40 text-on-surface font-label-md">Anterior</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-primary text-on-primary font-label-md font-bold">1</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface hover:bg-surface-container text-on-surface font-label-md">2</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface hover:bg-surface-container text-on-surface font-label-md">3</button>
                                <button
                                    class="px-2.5 py-1 rounded bg-surface hover:bg-surface-container text-on-surface font-label-md">Siguiente</button>
                            </div>
                        </div>
                    </div>
                    <!-- Institutional Notice / Audit Ledger Footer -->
                    <div class="bg-surface-container-low p-4 rounded-xl flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-secondary text-[24px]">verified</span>
                            <div>
                                <h4 class="font-label-lg text-label-lg font-semibold text-on-surface">Validación de
                                    Acta de Sorteo Ministerial</h4>
                                <p class="font-body-sm text-body-sm text-on-surface-variant">
                                    Toda designación generada emite un código Hash criptográfico vinculado al RUDE y
                                    registro RDA docente conforme a la Resolución Ministerial 001/2024 BTH.
                                </p>
                            </div>
                        </div>
                        <button
                            class="flex-shrink-0 px-3 py-1.5 rounded-lg bg-surface-container-high hover:bg-surface-variant text-on-surface font-label-md text-label-md">
                            Auditoría de Cambios
                        </button>
                    </div>
                </div>
                <!-- Banco de Jurados Habilitados (Right Column xl:col-span-4) -->
                <div class="xl:col-span-4 flex flex-col gap-4">
                    <div class="bg-surface-container-lowest rounded-xl shadow-sm p-inset-card flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[20px]">badge</span>
                                <div>
                                    <h3 class="font-headline-sm text-headline-sm text-on-surface">Banco de Jurados
                                    </h3>
                                    <span class="font-label-md text-label-md text-on-surface-variant">16 docentes
                                        habilitados</span>
                                </div>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded-full bg-secondary-container text-on-secondary-container font-data-mono text-[11px] font-semibold">
                                Activos
                            </span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Balance de cargas académicas en tiempo real. Los docentes con carga máxima quedan
                            excluidos automáticamente del bombo aleatorio.
                        </p>
                        <!-- Search in Jury Pool -->
                        <div class="relative">
                            <span
                                class="material-symbols-outlined absolute left-2.5 top-2 text-outline text-[16px]">search</span>
                            <input
                                class="w-full pl-8 pr-3 py-1.5 bg-surface rounded-lg text-body-sm text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                                placeholder="Filtrar por nombre o área..." type="text" />
                        </div>
                        <!-- Jurors List -->
                        <div class="flex flex-col gap-3 max-h-[580px] overflow-y-auto pr-1">
                            <!-- Juror 1 -->
                            <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-2">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary-fixed text-primary flex items-center justify-center font-bold text-body-sm">
                                            VS
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Prof.
                                                Victor Hugo Sánchez</span>
                                            <span class="font-body-sm text-body-sm text-on-surface-variant">Metodología
                                                / Sociales</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-data-mono font-semibold bg-secondary-container text-on-secondary-container">
                                        Disponible
                                    </span>
                                </div>
                                <!-- Workload bar -->
                                <div class="flex flex-col gap-1">
                                    <div class="flex justify-between text-body-sm">
                                        <span class="text-on-surface-variant font-label-md">Carga Asignada:</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-primary">4 / 5
                                            proyectos</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="bg-primary h-full" style="width: 80%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-1">
                                    <div class="flex gap-1">
                                        <span
                                            class="px-1.5 py-0.5 rounded text-[9px] bg-surface-container text-on-surface-variant font-data-mono">Presidente
                                            (3)</span>
                                        <span
                                            class="px-1.5 py-0.5 rounded text-[9px] bg-surface-container text-on-surface-variant font-data-mono">Vocal
                                            (1)</span>
                                    </div>
                                    <button class="text-label-md text-primary hover:underline"
                                        onclick="editarDisponibilidad('Prof. Victor Hugo Sánchez')">
                                        Editar Disponibilidad
                                    </button>
                                </div>
                            </div>
                            <!-- Juror 2 -->
                            <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-2">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-body-sm">
                                            MB
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Lic.
                                                Martha Beltrán Cruz</span>
                                            <span class="font-body-sm text-body-sm text-on-surface-variant">Lenguaje
                                                / Comunicación</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-data-mono font-semibold bg-secondary-container text-on-secondary-container">
                                        Disponible
                                    </span>
                                </div>
                                <!-- Workload bar -->
                                <div class="flex flex-col gap-1">
                                    <div class="flex justify-between text-body-sm">
                                        <span class="text-on-surface-variant font-label-md">Carga Asignada:</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-secondary">3 / 5
                                            proyectos</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="bg-secondary h-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-1">
                                    <div class="flex gap-1">
                                        <span
                                            class="px-1.5 py-0.5 rounded text-[9px] bg-surface-container text-on-surface-variant font-data-mono">Secretaría
                                            (3)</span>
                                    </div>
                                    <button class="text-label-md text-primary hover:underline"
                                        onclick="editarDisponibilidad('Lic. Martha Beltrán Cruz')">
                                        Editar Disponibilidad
                                    </button>
                                </div>
                            </div>
                            <!-- Juror 3 (Tope Máximo) -->
                            <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-2">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant flex items-center justify-center font-bold text-body-sm">
                                            CM
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Ing.
                                                Carlos Mendoza Rojas</span>
                                            <span class="font-body-sm text-body-sm text-on-surface-variant">Sistemas
                                                / Telemática</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-data-mono font-semibold bg-tertiary-fixed text-on-tertiary-fixed-variant">
                                        Carga Máxima
                                    </span>
                                </div>
                                <!-- Workload bar -->
                                <div class="flex flex-col gap-1">
                                    <div class="flex justify-between text-body-sm">
                                        <span class="text-on-surface-variant font-label-md">Carga Asignada:</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-tertiary">5 / 5
                                            proyectos</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="bg-tertiary h-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-[11px] text-on-surface-variant italic">Bloqueado para nuevos
                                        sorteos</span>
                                    <button class="text-label-md text-primary hover:underline"
                                        onclick="editarDisponibilidad('Ing. Carlos Mendoza Rojas')">
                                        Ver Detalles
                                    </button>
                                </div>
                            </div>
                            <!-- Juror 4 -->
                            <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-2">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-surface-variant text-on-surface flex items-center justify-center font-bold text-body-sm">
                                            GC
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-label-lg text-label-lg font-semibold text-on-surface leading-tight">Prof.
                                                Gladys Choque Mamani</span>
                                            <span class="font-body-sm text-body-sm text-on-surface-variant">Matemática
                                                / Bioestadística</span>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-0.5 rounded text-[10px] font-data-mono font-semibold bg-secondary-container text-on-secondary-container">
                                        Disponible
                                    </span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <div class="flex justify-between text-body-sm">
                                        <span class="text-on-surface-variant font-label-md">Carga Asignada:</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-primary">2 / 5
                                            proyectos</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                        <div class="bg-primary h-full" style="width: 40%"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-1">
                                    <span class="text-[11px] text-secondary font-medium">Prioridad en próximo
                                        bombo</span>
                                    <button class="text-label-md text-primary hover:underline"
                                        onclick="editarDisponibilidad('Prof. Gladys Choque Mamani')">
                                        Editar Disponibilidad
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button
                            class="w-full py-2.5 rounded-lg bg-surface-container hover:bg-surface-variant text-primary font-label-lg text-label-lg flex items-center justify-center gap-2 transition-all"
                            onclick="document.getElementById('modal-registro-jurado').classList.remove('hidden')">
                            <span class="material-symbols-outlined text-[18px]">add_circle</span>
                            <span>Añadir Evaluador al Banco</span>
                        </button>
                    </div>
                    <!-- Live Statistics Widget: Juror Distribution by Specialty -->
                    {{-- <div class="bg-surface-container-lowest rounded-xl shadow-sm p-inset-card flex flex-col gap-3">
                        <h4 class="font-headline-sm text-headline-sm text-on-surface">Distribución por Especialidad
                            BTH</h4>
                        <div class="space-y-2.5 pt-1">
                            <div>
                                <div class="flex justify-between text-body-sm mb-1">
                                    <span class="text-on-surface">Sistemas Computacionales</span>
                                    <span class="font-data-mono font-bold text-on-surface">4 Jurados</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="bg-primary h-full" style="width: 25%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-body-sm mb-1">
                                    <span class="text-on-surface">Agroecología y Medio Ambiente</span>
                                    <span class="font-data-mono font-bold text-on-surface">4 Jurados</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="bg-secondary h-full" style="width: 25%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-body-sm mb-1">
                                    <span class="text-on-surface">Gastronomía y Alimentación</span>
                                    <span class="font-data-mono font-bold text-on-surface">3 Jurados</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="bg-tertiary h-full" style="width: 19%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-body-sm mb-1">
                                    <span class="text-on-surface">Mecánica y Electricidad</span>
                                    <span class="font-data-mono font-bold text-on-surface">3 Jurados</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="bg-primary-container h-full" style="width: 19%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-body-sm mb-1">
                                    <span class="text-on-surface">Metodología y Regencia General</span>
                                    <span class="font-data-mono font-bold text-on-surface">2 Jurados</span>
                                </div>
                                <div class="w-full h-1.5 bg-surface-container rounded-full overflow-hidden">
                                    <div class="bg-surface-tint h-full" style="width: 12%"></div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- MODAL: Registrar Nuevo Jurado -->
            <div class="hidden fixed inset-0 z-50 flex items-center justify-center bg-inverse-surface/40 backdrop-blur-sm p-4"
                id="modal-registro-jurado">
                <div
                    class="bg-surface-container-lowest rounded-xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col">
                    <div class="p-4 bg-surface-container-low flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[22px]">person_add</span>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">Registrar Evaluador para
                                Banco de Tribunales</h3>
                        </div>
                        <button class="p-1 rounded-lg text-on-surface-variant hover:bg-surface-container"
                            onclick="document.getElementById('modal-registro-jurado').classList.add('hidden')">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>
                    <div class="p-6 flex flex-col gap-4">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Nombre
                                Completo del Docente (según RDA)</label>
                            <input
                                class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                                placeholder="Ej. Lic. Edwin Mamani Gutierrez" type="text" />
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Cédula
                                    de Identidad</label>
                                <input
                                    class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                                    placeholder="Ej. 4839201 LP" type="text" />
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Código
                                    RDA</label>
                                <input
                                    class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                                    placeholder="Ej. RDA-90421" type="text" />
                            </div>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Especialidad
                                BTH Habilitada</label>
                            <select
                                class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary">
                                <option>Sistemas Computacionales</option>
                                <option>Agroecología y Riego</option>
                                <option>Gastronomía y Nutrición</option>
                                <option>Mecánica Industrial</option>
                                <option>Metodología y Formación General</option>
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Carga
                                    Máxima de Actas</label>
                                <input
                                    class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                                    max="8" min="1" type="number" value="5" />
                            </div>
                            <div>
                                <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Rol
                                    Predilecto en Terna</label>
                                <select
                                    class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary">
                                    <option>Cualquier Rol</option>
                                    <option>Presidente Tribunal</option>
                                    <option>Vocal Especialista</option>
                                    <option>Vocal Secretario</option>
                                </select>
                            </div>
                        </div>
                        <div
                            class="p-3 bg-surface-container-low rounded-lg text-body-sm text-on-surface-variant flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary text-[18px]">verified</span>
                            <span>El docente quedará inmediatamente habilitado para el algoritmo de sorteo sin
                                conflictos de interés.</span>
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-low flex items-center justify-end gap-3">
                        <button
                            class="px-4 py-2 rounded-lg bg-surface text-on-surface hover:bg-surface-container font-label-lg text-label-lg"
                            onclick="document.getElementById('modal-registro-jurado').classList.add('hidden')">
                            Cancelar
                        </button>
                        <button
                            class="px-4 py-2 rounded-lg bg-primary text-on-primary hover:bg-surface-tint font-label-lg text-label-lg shadow-sm"
                            onclick="document.getElementById('modal-registro-jurado').classList.add('hidden'); alert('Docente jurado incorporado exitosamente al banco.');">
                            Registrar y Habilitar
                        </button>
                    </div>
                </div>
            </div>
            <!-- MODAL: Configurar Criterios de Asignación -->
            <div class="hidden fixed inset-0 z-50 flex items-center justify-center bg-inverse-surface/40 backdrop-blur-sm p-4"
                id="modal-criterios">
                <div
                    class="bg-surface-container-lowest rounded-xl shadow-xl w-full max-w-lg overflow-hidden flex flex-col">
                    <div class="p-4 bg-surface-container-low flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[22px]">tune</span>
                            <h3 class="font-headline-sm text-headline-sm text-on-surface">Criterios del Algoritmo de
                                Sorteo</h3>
                        </div>
                        <button class="p-1 rounded-lg text-on-surface-variant hover:bg-surface-container"
                            onclick="document.getElementById('modal-criterios').classList.add('hidden')">
                            <span class="material-symbols-outlined text-[20px]">close</span>
                        </button>
                    </div>
                    <div class="p-6 flex flex-col gap-4 text-body-md">
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Tope
                                Máximo de Proyectos por Jurado</label>
                            <input
                                class="w-full px-3 py-2 bg-surface rounded-lg text-body-md text-on-surface focus:outline-none focus:ring-1 focus:ring-primary"
                                type="number" value="6" />
                            <span class="text-[11px] text-on-surface-variant">Límite normativo para garantizar
                                calidad evaluativa y dedicación.</span>
                        </div>
                        <div>
                            <label class="block font-label-md text-label-md text-on-surface-variant mb-1">Modo de
                                Selección Aleatoria</label>
                            <div class="flex flex-col gap-2">
                                <label class="flex items-center gap-2">
                                    <input checked="" class="text-primary focus:ring-primary" name="modo_sorteo"
                                        type="radio" />
                                    <span>Balanceado Inteligente (Compensación de menor carga)</span>
                                </label>
                                <label class="flex items-center gap-2">
                                    <input class="text-primary focus:ring-primary" name="modo_sorteo" type="radio" />
                                    <span>Aleatorio Puro con Restricciones Fijas</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-1.5">
                            <span class="font-label-md text-label-md font-semibold text-on-surface">Restricciones de
                                Parentesco o Asesoría</span>
                            <p class="font-body-sm text-body-sm text-on-surface-variant">
                                Se excluye automáticamente todo docente tutor. En caso de reclamo de parte
                                interesada, se puede ingresar una lista negra temporal en el sistema de actas.
                            </p>
                        </div>
                    </div>
                    <div class="p-4 bg-surface-container-low flex items-center justify-end gap-3">
                        <button
                            class="px-4 py-2 rounded-lg bg-surface text-on-surface hover:bg-surface-container font-label-lg text-label-lg"
                            onclick="document.getElementById('modal-criterios').classList.add('hidden')">
                            Cerrar
                        </button>
                        <button
                            class="px-4 py-2 rounded-lg bg-primary text-on-primary hover:bg-surface-tint font-label-lg text-label-lg"
                            onclick="document.getElementById('modal-criterios').classList.add('hidden')">
                            Guardar Parámetros
                        </button>
                    </div>
                </div>
            </div>
            <!-- Interactive JavaScript Engine -->
            <script>
                function ejecutarSorteoAlgoritmo() {
                    const toast = document.getElementById('toast-preview');
                    toast.classList.remove('hidden');
                    toast.innerText = 'Ejecutando algoritmo inteligente...';

                    setTimeout(() => {
                        simularAsignacion();
                        toast.innerText = '¡Sorteo concluido con éxito! 6 proyectos balanceados.';
                    }, 700);
                }

                function simularAsignacion() {
                    // Resolve project Agro-012 slot
                    const slotSecretario = document.getElementById('slot-vocal-secretario');
                    if (slotSecretario) {
                        slotSecretario.outerHTML = `
          <div class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded transition-all">
            <div class="flex items-center gap-1.5">
              <span class="w-5 h-5 rounded-full bg-surface-variant text-on-surface flex items-center justify-center text-[10px] font-bold">V2</span>
              <span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lic. Martha Beltrán C.</span>
            </div>
            <span class="text-[10px] text-secondary font-data-mono font-medium">Asignado por Sorteo</span>
          </div>
        `;
                    }

                    const badgeAgro = document.getElementById('badge-estado-agro');
                    if (badgeAgro) {
                        badgeAgro.className =
                            'inline-flex items-center gap-1 px-2 py-1 rounded-full bg-secondary-container text-on-secondary-container font-data-mono text-[11px] font-semibold';
                        badgeAgro.innerHTML =
                            '<span class="material-symbols-outlined text-[14px]">check_circle</span> Completo (3/3)';
                    }

                    const filaAgro = document.getElementById('fila-bth-agro-012');
                    if (filaAgro) filaAgro.setAttribute('data-estado', 'completo');

                    // Resolve project GA-007 slot
                    const slotGa = document.getElementById('slot-tribunal-ga');
                    if (slotGa) {
                        slotGa.innerHTML = `
          <div class="flex flex-col gap-1.5 min-w-[280px]">
            <div class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
              <div class="flex items-center gap-1.5">
                <span class="w-5 h-5 rounded-full bg-primary-container text-on-primary flex items-center justify-center text-[10px] font-bold">P</span>
                <span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Prof. Victor H. Sánchez</span>
              </div>
              <span class="text-[10px] text-on-surface-variant font-data-mono">Presidencia</span>
            </div>
            <div class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
              <div class="flex items-center gap-1.5">
                <span class="w-5 h-5 rounded-full bg-secondary text-on-secondary flex items-center justify-center text-[10px] font-bold">V1</span>
                <span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lic. Patricia Loayza</span>
              </div>
              <span class="text-[10px] text-secondary font-data-mono font-medium">Bromatología</span>
            </div>
            <div class="flex items-center justify-between bg-surface-container-low px-2 py-1 rounded">
              <div class="flex items-center gap-1.5">
                <span class="w-5 h-5 rounded-full bg-surface-variant text-on-surface flex items-center justify-center text-[10px] font-bold">V2</span>
                <span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Prof. Gladys Choque M.</span>
              </div>
              <span class="text-[10px] text-on-surface-variant font-data-mono">Secretaría</span>
            </div>
          </div>
        `;
                    }

                    const badgeGaWrapper = document.getElementById('badge-ga-wrapper');
                    if (badgeGaWrapper) {
                        badgeGaWrapper.innerHTML = `
          <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-secondary-container text-on-secondary-container font-data-mono text-[11px] font-semibold">
            <span class="material-symbols-outlined text-[14px]">check_circle</span>
            Completo (3/3)
          </span>
        `;
                    }

                    const filaGa = document.getElementById('fila-bth-ga-007');
                    if (filaGa) filaGa.setAttribute('data-estado', 'completo');

                    const toast = document.getElementById('toast-preview');
                    toast.classList.remove('hidden');
                    toast.innerText = 'Previsualización de Sorteo Aplicada';
                }

                function sortearUno(codigo) {
                    alert('Ejecutando sorteo aleatorio individual para el proyecto: ' + codigo +
                        ' respetando incompatibilidad de tutores.');
                    simularAsignacion();
                }

                function asignarRapido(codigo, plazaIndex) {
                    alert('Asignación rápida manual de plaza ' + plazaIndex + ' para el proyecto ' + codigo);
                }

                function generarMemo(codigo) {
                    alert('Generando Memorándum Oficial en formato Ministerial BTH para el proyecto: ' + codigo);
                }

                function abrirReasignarModal(codigo) {
                    alert('Abriendo editor interactivo de ternas y re-sorteo para ' + codigo);
                }

                function exportarNominaPDF() {
                    alert('Exportando acta centralizadora de tribunales oficiales BTH Gestión 2024 (PDF firmado digitalmente)...');
                }

                function editarDisponibilidad(nombre) {
                    alert('Ajustando carga máxima y licencias para: ' + nombre);
                }

                function filtrarTabla() {
                    const select = document.getElementById('filtro-estado');
                    const val = select.value;
                    const rows = document.querySelectorAll('#tabla-proyectos tbody tr');

                    rows.forEach(r => {
                        const est = r.getAttribute('data-estado');
                        if (val === 'todos' || val === est) {
                            r.style.display = '';
                        } else {
                            r.style.display = 'none';
                        }
                    });
                }
            </script>
        </div>
    </main>
@endsection

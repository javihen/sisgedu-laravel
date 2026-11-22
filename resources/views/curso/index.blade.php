@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@400;500;700&amp;display=swap"
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
                        "inverse-on-surface": "#eef0ff",
                        "primary-container": "#0056d2",
                        "on-secondary-fixed": "#002113",
                        "tertiary": "#6e3900",
                        "on-surface": "#131b2e",
                        "inverse-surface": "#283044",
                        "tertiary-fixed-dim": "#ffb77d",
                        "on-primary-fixed-variant": "#0040a1",
                        "primary-fixed": "#dae2ff",
                        "on-tertiary-fixed-variant": "#6e3900",
                        "inverse-primary": "#b2c5ff",
                        "secondary": "#006c47",
                        "on-error-container": "#93000a",
                        "secondary-container": "#8af5be",
                        "on-primary": "#ffffff",
                        "outline": "#737785",
                        "surface-dim": "#d2d9f4",
                        "background": "#faf8ff",
                        "surface-variant": "#dae2fd",
                        "on-secondary-container": "#00714b",
                        "surface-container-highest": "#dae2fd",
                        "secondary-fixed-dim": "#71dba6",
                        "primary": "#0040a1",
                        "error": "#ba1a1a",
                        "on-secondary-fixed-variant": "#005235",
                        "tertiary-container": "#914d00",
                        "on-tertiary-container": "#ffd0ad",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed": "#8df7c1",
                        "on-surface-variant": "#424654",
                        "on-background": "#131b2e",
                        "tertiary-fixed": "#ffdcc3",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed": "#2f1500",
                        "surface-tint": "#0056d2",
                        "primary-fixed-dim": "#b2c5ff",
                        "on-secondary": "#ffffff",
                        "surface-container": "#eaedff",
                        "on-error": "#ffffff",
                        "surface-bright": "#faf8ff",
                        "surface": "#faf8ff",
                        "on-primary-container": "#ccd8ff",
                        "surface-container-high": "#e2e7ff",
                        "outline-variant": "#c3c6d6",
                        "on-tertiary": "#ffffff",
                        "surface-container-low": "#f2f3ff",
                        "on-primary-fixed": "#001847"
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "table-row-compact": "0.25rem",
                        "table-row-standard": "0.5rem",
                        "gutter-lg": "1.5rem",
                        "gutter-md": "1rem",
                        "inset-card": "1.25rem",
                        "margin-page": "1.5rem",
                        "gutter-sm": "0.75rem"
                    },
                    fontFamily: {
                        "label-md": ["Public Sans"],
                        "body-md": ["Public Sans"],
                        "headline-lg": ["Public Sans"],
                        "display": ["Public Sans"],
                        "data-mono-bold": ["JetBrains Mono"],
                        "body-sm": ["Public Sans"],
                        "label-lg": ["Public Sans"],
                        "headline-lg-mobile": ["Public Sans"],
                        "headline-sm": ["Public Sans"],
                        "headline-md": ["Public Sans"],
                        "body-lg": ["Public Sans"],
                        "data-mono": ["JetBrains Mono"]
                    },
                    fontSize: {
                        "label-md": ["0.75rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "0.02em",
                            "fontWeight": "500"
                        }],
                        "body-md": ["0.875rem", {
                            "lineHeight": "1.25rem",
                            "fontWeight": "400"
                        }],
                        "headline-lg": ["1.5rem", {
                            "lineHeight": "2rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "display": ["2rem", {
                            "lineHeight": "2.5rem",
                            "letterSpacing": "-0.02em",
                            "fontWeight": "700"
                        }],
                        "data-mono-bold": ["0.8125rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "700"
                        }],
                        "body-sm": ["0.75rem", {
                            "lineHeight": "1rem",
                            "fontWeight": "400"
                        }],
                        "label-lg": ["0.875rem", {
                            "lineHeight": "1.25rem",
                            "fontWeight": "500"
                        }],
                        "headline-lg-mobile": ["1.25rem", {
                            "lineHeight": "1.75rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "600"
                        }],
                        "headline-sm": ["1.125rem", {
                            "lineHeight": "1.5rem",
                            "fontWeight": "600"
                        }],
                        "headline-md": ["1.25rem", {
                            "lineHeight": "1.75rem",
                            "fontWeight": "600"
                        }],
                        "body-lg": ["1rem", {
                            "lineHeight": "1.5rem",
                            "fontWeight": "400"
                        }],
                        "data-mono": ["0.8125rem", {
                            "lineHeight": "1rem",
                            "letterSpacing": "-0.01em",
                            "fontWeight": "500"
                        }]
                    }
                }
            }
        }
    </script>
    <div class=" w-[calc(100%)] absolute" style="font-family: 'poppins'">
        <main class="w-full  min-h-screen">
            <div class="flex flex-col w-full">
                <div class="p-margin-page space-y-gutter-lg max-w-[1720px] mx-auto w-full">
                    <!-- Header Section with Search and Fast Actions -->
                    <div
                        class="flex flex-col xl:flex-row xl:items-center justify-between gap-gutter-md bg-surface-container-lowest p-gutter-lg rounded-xl shadow-sm">
                        <div class="flex flex-col gap-1">
                            <h1 class="font-headline-lg text-headline-lg text-on-surface font-bold tracking-tight">
                                Panel de Gestión y Navegación de Cursos
                            </h1>
                            <p class="font-body-md text-body-md text-on-surface-variant">
                                Unidad Educativa Cristiano "Vida Nueva" • Gestión Académica 2026
                            </p>
                        </div>
                        <div class="flex flex-wrap items-center gap-gutter-sm">
                            <!-- Turn Filter Selector -->
                            <div class="flex items-center bg-surface-container-low p-1 rounded-lg">
                                <button
                                    class="px-3 py-1.5 rounded-lg bg-surface-container-lowest font-label-md text-label-md font-semibold text-primary shadow-sm transition-all flex items-center gap-1.5"
                                    id="btnTurnoManana">
                                    <span class="material-symbols-outlined text-[16px]">light_mode</span>
                                    Mañana
                                </button>
                                <button
                                    class="px-3 py-1.5 rounded-lg text-on-surface-variant font-label-md text-label-md font-medium hover:text-on-surface transition-all flex items-center gap-1.5"
                                    id="btnTurnoTarde">
                                    <span class="material-symbols-outlined text-[16px]">wb_twilight</span>
                                    Tarde
                                </button>
                            </div>
                            <!-- Export General Report Button -->
                            <button
                                class="h-10 px-4 bg-secondary text-on-secondary font-label-lg text-label-lg rounded-lg shadow-sm hover:opacity-95 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">download_for_offline</span>
                                <span>Reporte General de Matrícula</span>
                            </button>
                        </div>
                    </div>

                    <!-- Multi-level Navigation Tabs -->
                    <div
                        class="flex flex-col md:flex-row md:items-center justify-between gap-3 bg-surface-container-lowest p-2 rounded-xl shadow-sm">
                        <div class="flex flex-wrap items-center gap-2" id="levelTabsContainer">
                            <!-- Tab Todos -->
                            <button
                                class="level-tab px-4 py-2 rounded-lg font-label-lg text-label-lg transition-all text-on-surface-variant hover:bg-surface-container-high font-medium"
                                data-filter="todos">
                                <span>Todos los Niveles</span>
                                <span
                                    class="ml-1.5 px-2 py-0.5 rounded-full bg-surface-container text-outline font-data-mono text-data-mono">1,240</span>
                            </button>
                            <!-- Tab Inicial -->
                            <button
                                class="level-tab px-4 py-2 rounded-lg font-label-lg text-label-lg transition-all text-on-surface-variant hover:bg-surface-container-high font-medium flex items-center gap-2"
                                data-filter="inicial">
                                <span>Educación Inicial en Familia Comunitaria</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container text-outline font-data-mono text-data-mono">124</span>
                            </button>
                            <!-- Tab Primaria -->
                            <button
                                class="level-tab px-4 py-2 rounded-lg font-label-lg text-label-lg transition-all text-on-surface-variant hover:bg-surface-container-high font-medium flex items-center gap-2"
                                data-filter="primaria">
                                <span>Primaria Comunitaria Vocacional</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-surface-container text-outline font-data-mono text-data-mono">512</span>
                            </button>
                            <!-- Tab Secundaria (Active Default) -->
                            <button
                                class="level-tab active px-4 py-2 rounded-lg font-label-lg text-label-lg transition-all bg-primary-container text-on-primary font-semibold shadow-sm flex items-center gap-2"
                                data-filter="secundaria">
                                <span class="material-symbols-outlined text-[18px]">verified</span>
                                <span>Secundaria Comunitaria Productiva</span>
                                <span
                                    class="px-2 py-0.5 rounded-full bg-on-primary/20 text-on-primary font-data-mono-bold text-data-mono-bold">604</span>
                            </button>
                        </div>
                    </div>
                    <!-- Interactive Course Card Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 2xl:grid-cols-3 gap-gutter-md" id="courseCardsGrid">
                        <!-- CARD 1: 1ro de Secundaria -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="secundaria" data-name="1ro de secundaria" data-tutor="Prof. Marcela Condori Ramos">
                            <div class="flex flex-col gap-3">
                                <!-- Card Header & Badge -->
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Secundaria
                                            Regular</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">1ro de
                                            Secundaria</h2>
                                    </div>
                                    {{-- <span
                                        class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        98 Estudiantes
                                    </span> --}}
                                </div>
                                <!-- Tutor / Advisor Row -->
                                {{--  <div class="flex items-center gap-2.5 p-2 bg-surface-container-low rounded-lg">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                                        <span class="material-symbols-outlined text-[18px]">school</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-sm text-body-sm text-outline font-medium">Asesor General
                                            de Grado</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-semibold truncate">Prof.
                                            Marcela Condori Ramos</span>
                                    </div>
                                </div> --}}
                                <!-- Parallel Class Quick Switcher Chips -->
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">34
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">32
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">32
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Key Performance Mini Bar -->
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">71.8
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">97.4%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Alerta Académica</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold">
                                            0 en Riesgo
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!-- Action Quick-Launch Bar -->
                            {{-- <div class="pt-table-row-standard mt-3 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all"
                                    title="Listado Oficial de Estudiantes">
                                    <span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
                                    Lista
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all"
                                    title="Boletines Centralizados">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    Boletines
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all"
                                    title="Ficha de Refuerzo y Riesgo">
                                    <span class="material-symbols-outlined text-[16px]">monitoring</span>
                                    Riesgo
                                </button>
                                <button
                                    class="h-8 px-2 bg-primary text-on-primary hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 shadow-sm transition-all"
                                    title="Centralizador Formato A3">
                                    <span class="material-symbols-outlined text-[16px]">grid_on</span>
                                    A3
                                </button>
                            </div> --}}
                        </div>
                        <!-- CARD 2: 2do de Secundaria -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="secundaria" data-name="2do de secundaria" data-tutor="Lic. Carlos Mendoza Vargas">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Secundaria
                                            Regular</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">2do de
                                            Secundaria</h2>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">35
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">35
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">35
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">66.2
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">95.1%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Alerta Académica</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-md text-label-md font-semibold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">info</span>
                                            2 Observados
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CARD 3: 3ro de Secundaria -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="secundaria" data-name="3ro de secundaria"
                            data-tutor="Prof. Roxana Mamani Torrico">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Secundaria
                                            Regular</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">3ro de
                                            Secundaria</h2>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">34
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">34
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">34
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">69.5
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">96.8%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Alerta Académica</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-error-container text-on-error-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">warning</span>
                                            1 en Riesgo
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CARD 4: 4to de Secundaria -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="secundaria" data-name="4to de secundaria" data-tutor="Lic. Fernando Zalles Arze">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Secundaria
                                            Regular • Pre-BTH</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">4to de
                                            Secundaria</h2>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        99 Estudiantes
                                    </span>
                                </div>
                                <div class="flex items-center gap-2.5 p-2 bg-surface-container-low rounded-lg">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                                        <span class="material-symbols-outlined text-[18px]">school</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-sm text-body-sm text-outline font-medium">Asesor General
                                            de Grado</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-semibold truncate">Lic.
                                            Fernando Zalles Arze</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">33
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">33
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">33
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">67.1
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">94.8%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Alerta Académica</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-error-container text-on-error-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">warning</span>
                                            2 en Riesgo
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-table-row-standard mt-3 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
                                    Lista
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    Boletines
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">monitoring</span>
                                    Riesgo
                                </button>
                                <button
                                    class="h-8 px-2 bg-primary text-on-primary hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-[16px]">grid_on</span>
                                    A3
                                </button>
                            </div>
                        </div>
                        <!-- CARD 5: 5to de Secundaria (High Alert Card) -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="secundaria" data-name="5to de secundaria" data-tutor="Ing. Roberto Benítez Paz">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Secundaria
                                            • BTH Sistemas</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">5to de
                                            Secundaria</h2>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        100 Estudiantes
                                    </span>
                                </div>
                                <div class="flex items-center gap-2.5 p-2 bg-surface-container-low rounded-lg">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                                        <span class="material-symbols-outlined text-[18px]">school</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-sm text-body-sm text-outline font-medium">Asesor General
                                            de Grado</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-semibold truncate">Ing.
                                            Roberto Benítez Paz</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="relative flex flex-col items-center justify-center p-2 rounded-lg bg-error-container/40 text-on-surface hover:bg-primary hover:text-on-primary transition-all group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-error group-hover:text-on-primary">35
                                                est. (3 alerta)</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">35
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">30
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">64.8
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">93.2%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Alerta Académica</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-error text-on-error font-label-md text-label-md font-semibold flex items-center gap-1 shadow-sm">
                                            <span class="material-symbols-outlined text-[14px]">error</span>
                                            4 en Riesgo Total
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-table-row-standard mt-3 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
                                    Lista
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    Boletines
                                </button>
                                <button
                                    class="h-8 px-2 bg-error text-on-error hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 transition-all shadow-sm">
                                    <span class="material-symbols-outlined text-[16px]">warning</span>
                                    Riesgo
                                </button>
                                <button
                                    class="h-8 px-2 bg-primary text-on-primary hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-[16px]">grid_on</span>
                                    A3
                                </button>
                            </div>
                        </div>
                        <!-- CARD 6: 6to de Secundaria (Graduación y BTH) -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="secundaria" data-name="6to de secundaria"
                            data-tutor="Lic. Miriam Solares Morales">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Promoción
                                            2024 • BTH Técnico Medio</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">6to de
                                            Secundaria</h2>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded bg-primary-fixed text-on-primary-fixed font-label-md text-label-md font-bold flex items-center gap-1">
                                        <span class="material-symbols-outlined text-[14px]">school</span>
                                        100 Estudiantes
                                    </span>
                                </div>
                                <div class="flex items-center gap-2.5 p-2 bg-surface-container-low rounded-lg">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                                        <span class="material-symbols-outlined text-[18px]">verified_user</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-sm text-body-sm text-outline font-medium">Asesor de
                                            Promoción</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-semibold truncate">Lic.
                                            Miriam Solares Morales</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">34
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">33
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">33
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">74.2
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">98.2%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Habilitación BTH</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                            <span class="material-symbols-outlined text-[14px]">workspace_premium</span>
                                            97 Aptos
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-table-row-standard mt-3 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
                                    Lista
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    Boletines
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">monitoring</span>
                                    Riesgo
                                </button>
                                <button
                                    class="h-8 px-2 bg-primary text-on-primary hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-[16px]">grid_on</span>
                                    A3
                                </button>
                            </div>
                        </div>
                        <!-- CARD 7: Inicial - Kínder (Initially shown when filtered or on 'todos') -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="inicial" data-name="kínder inicial" data-tutor="Prof. Beatriz Callisaya">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Inicial
                                            Comunitaria</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">Segunda
                                            Sección (Kínder)</h2>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        64 Estudiantes
                                    </span>
                                </div>
                                <div class="flex items-center gap-2.5 p-2 bg-surface-container-low rounded-lg">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                                        <span class="material-symbols-outlined text-[18px]">child_care</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-sm text-body-sm text-outline font-medium">Docente
                                            Titular</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-semibold truncate">Prof.
                                            Beatriz Callisaya</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-2 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">32
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">32
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Evaluación
                                            Cualitativa</span>
                                        <span class="font-data-mono-bold text-data-mono-bold text-secondary text-base">En
                                            Desarrollo</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">96.0%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Estado</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold">
                                            Regular
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-table-row-standard mt-3 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
                                    Lista
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    Boletines
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">monitoring</span>
                                    Riesgo
                                </button>
                                <button
                                    class="h-8 px-2 bg-primary text-on-primary hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-[16px]">grid_on</span>
                                    A3
                                </button>
                            </div>
                        </div>
                        <!-- CARD 8: Primaria - 1ro de Primaria (Shown when filtered) -->
                        <div class="course-card bg-surface-container-lowest rounded-xl p-inset-card shadow-sm hover:shadow-md transition-all flex flex-col justify-between"
                            data-level="primaria" data-name="1ro de primaria" data-tutor="Prof. Sonia Gutierrez">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-start justify-between gap-2">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-label-md text-label-md text-primary font-semibold uppercase tracking-wider">Primaria
                                            Comunitaria</span>
                                        <h2 class="font-headline-md text-headline-md text-on-surface font-bold">1ro de
                                            Primaria</h2>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
                                        92 Estudiantes
                                    </span>
                                </div>
                                <div class="flex items-center gap-2.5 p-2 bg-surface-container-low rounded-lg">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-variant flex items-center justify-center text-primary font-bold">
                                        <span class="material-symbols-outlined text-[18px]">school</span>
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span class="font-body-sm text-body-sm text-outline font-medium">Maestra de
                                            Aula</span>
                                        <span
                                            class="font-label-md text-label-md text-on-surface font-semibold truncate">Prof.
                                            Sonia Gutierrez</span>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1.5">
                                    <span class="font-label-md text-label-md text-outline font-semibold">Paralelos
                                        Disponibles:</span>
                                    <div class="grid grid-cols-3 gap-2">
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo A</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">31
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo B</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">31
                                                est.</span>
                                        </button>
                                        <button
                                            class="flex flex-col items-center justify-center p-2 rounded-lg bg-surface-container-high hover:bg-primary hover:text-on-primary transition-all text-on-surface group">
                                            <span class="font-headline-sm text-headline-sm font-bold">Paralelo C</span>
                                            <span
                                                class="font-data-mono text-data-mono text-outline group-hover:text-on-primary">30
                                                est.</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="p-3 bg-surface-container-low rounded-lg flex items-center justify-between">
                                    <div class="flex flex-col">
                                        <span class="font-body-sm text-body-sm text-outline">Promedio Trimestral</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-on-surface text-base">78.4
                                            pts</span>
                                    </div>
                                    <div class="flex flex-col items-center">
                                        <span class="font-body-sm text-body-sm text-outline">Asistencia</span>
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-secondary text-base">97.9%</span>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="font-body-sm text-body-sm text-outline">Alerta Académica</span>
                                        <span
                                            class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold">
                                            0 en Riesgo
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-table-row-standard mt-3 grid grid-cols-2 sm:grid-cols-4 gap-1.5">
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">format_list_bulleted</span>
                                    Lista
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">description</span>
                                    Boletines
                                </button>
                                <button
                                    class="h-8 px-2 bg-surface-container text-on-surface hover:bg-surface-container-high rounded font-label-md text-label-md flex items-center justify-center gap-1 transition-all">
                                    <span class="material-symbols-outlined text-[16px]">monitoring</span>
                                    Riesgo
                                </button>
                                <button
                                    class="h-8 px-2 bg-primary text-on-primary hover:opacity-90 rounded font-label-md text-label-md font-semibold flex items-center justify-center gap-1 shadow-sm transition-all">
                                    <span class="material-symbols-outlined text-[16px]">grid_on</span>
                                    A3
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Quick Navigation Bottom Ledger Notice -->
                    <div
                        class="bg-surface-container-lowest p-gutter-md rounded-xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined text-[22px]">policy</span>
                            </div>
                            <div class="flex flex-col">
                                <span class="font-label-lg text-label-lg font-semibold text-on-surface">Cierre del 3er
                                    Trimestre y Generación de Libretas Electrónicas</span>
                                <span class="font-body-sm text-body-sm text-on-surface-variant">
                                    Plazo ministerial de sincronización con servidor departamental SIE vence el 30 de
                                    Noviembre.
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 w-full md:w-auto justify-end">
                            <button
                                class="px-4 py-2 bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg font-semibold hover:bg-surface-variant transition-all">
                                Historial de Actas
                            </button>
                            <button
                                class="px-4 py-2 bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold hover:opacity-90 shadow-sm transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">verified</span>
                                <span>Validar Consistencia RUDE</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // Course Card Filter & Tab Switcher Micro-Interactions
                document.addEventListener('DOMContentLoaded', () => {
                    const tabs = document.querySelectorAll('.level-tab');
                    const cards = document.querySelectorAll('.course-card');
                    const searchInput = document.getElementById('courseSearchInput');
                    const btnManana = document.getElementById('btnTurnoManana');
                    const btnTarde = document.getElementById('btnTurnoTarde');

                    let currentFilter = 'secundaria'; // Default to secundaria as requested

                    function updateCardVisibility() {
                        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';

                        cards.forEach(card => {
                            const cardLevel = card.getAttribute('data-level');
                            const cardName = (card.getAttribute('data-name') || '').toLowerCase();
                            const cardTutor = (card.getAttribute('data-tutor') || '').toLowerCase();

                            const matchesLevel = (currentFilter === 'todos') || (cardLevel === currentFilter);
                            const matchesSearch = !searchTerm || cardName.includes(searchTerm) || cardTutor
                                .includes(searchTerm);

                            if (matchesLevel && matchesSearch) {
                                card.style.display = 'flex';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    }

                    tabs.forEach(tab => {
                        tab.addEventListener('click', () => {
                            tabs.forEach(t => {
                                t.classList.remove('bg-primary-container', 'text-on-primary',
                                    'font-semibold', 'shadow-sm', 'active');
                                t.classList.add('text-on-surface-variant', 'font-medium');
                            });

                            tab.classList.remove('text-on-surface-variant', 'font-medium');
                            tab.classList.add('bg-primary-container', 'text-on-primary', 'font-semibold',
                                'shadow-sm', 'active');

                            currentFilter = tab.getAttribute('data-filter');
                            updateCardVisibility();
                        });
                    });

                    if (searchInput) {
                        searchInput.addEventListener('input', updateCardVisibility);
                    }

                    // Turn toggle styling
                    if (btnManana && btnTarde) {
                        btnManana.addEventListener('click', () => {
                            btnManana.className =
                                'px-3 py-1.5 rounded-lg bg-surface-container-lowest font-label-md text-label-md font-semibold text-primary shadow-sm transition-all flex items-center gap-1.5';
                            btnTarde.className =
                                'px-3 py-1.5 rounded-lg text-on-surface-variant font-label-md text-label-md font-medium hover:text-on-surface transition-all flex items-center gap-1.5';
                        });

                        btnTarde.addEventListener('click', () => {
                            btnTarde.className =
                                'px-3 py-1.5 rounded-lg bg-surface-container-lowest font-label-md text-label-md font-semibold text-primary shadow-sm transition-all flex items-center gap-1.5';
                            btnManana.className =
                                'px-3 py-1.5 rounded-lg text-on-surface-variant font-label-md text-label-md font-medium hover:text-on-surface transition-all flex items-center gap-1.5';
                        });
                    }

                    // Initial render execution
                    updateCardVisibility();
                });
            </script>
        </main>



        {{-- Antiguo contenedor de cursos como base para el nuevo --}}



        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">LISTADO DE CURSOS</p>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full  my-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false"
                        class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif

        {{-- Contenedores por nivel de cursos --}}
        <div class=" mx-3 mt-2 flex flex-row gap-1 w-full">
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col items-center justify-center p-4 border-slate-300 border shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">INICIAL EN FAMILIA COMUNITARIA</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                {{-- <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Estudiantes</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Retirados</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Efectivo</p>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO MAÑANA
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Minicial as $MI)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $MI->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $MI->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $MI->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('curso.reprobaciones', $MI->id) }}" title="Estudiantes reprobados"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                            <i class='bx bx-error-circle'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $MI->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO TARDE
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Tinicial as $TI)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $TI->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $TI->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $TI->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('curso.reprobaciones', $TI->id) }}" title="Estudiantes reprobados"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                            <i class='bx bx-error-circle'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $TI->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col flex-auto items-center justify-center p-4 border border-slate-300 shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">PRIMARIA COMUNITARIA VOCACIONAL</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                {{-- <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Estudiantes</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Retirados</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Efectivo</p>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO MAÑANA
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-[550px] group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Mprimaria as $MP)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $MP->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $MP->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $MP->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('curso.reprobaciones', $MP->id) }}" title="Estudiantes reprobados"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                            <i class='bx bx-error-circle'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $MP->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO TARDE
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Tprimaria as $TP)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $TP->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $TP->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $TP->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('curso.reprobaciones', $TP->id) }}" title="Estudiantes reprobados"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                            <i class='bx bx-error-circle'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $TP->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col flex-auto items-center justify-center p-4 border border-slate-300 shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">SECUNDARIA COMUNITARIA PRODUCTIVA</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                {{-- <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Estudiantes</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Retirados</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Efectivo</p>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO MAÑANA
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-[550px] group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Msecundaria as $MS)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $MS->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $MS->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $MS->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('curso.reprobaciones', $MS->id) }}" title="Estudiantes reprobados"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                            <i class='bx bx-error-circle'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $MS->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO TARDE
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Tsecundaria as $TS)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $TS->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $TS->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $TS->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('curso.reprobaciones', $TS->id) }}" title="Estudiantes reprobados"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                            <i class='bx bx-error-circle'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $TS->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed bottom-16 right-5 animate-bounce ">
            <a href="#" id="openModal"
                class="px-5 py-2 text-blue-600 border border-blue-600 bg-white rounded-lg hover:text-white hover:bg-blue-700 text-md transition-all">
                Nuevo
                curso </a>
        </div>
        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="translate-y-[-20px] opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition transform ease-in duration-300"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-[-20px] opacity-0" class="fixed top-20 right-5 w-full max-w-sm z-50">
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 text-red-700 hover:text-red-900 font-bold">&times;</button>
                </div>
            </div>
        @endif

        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mb-2 text-left">Nuevo curso</h2>
                <hr class="border border-slate-200">
                <!-- Formulario -->
                <form class="space-y-4" action="{{ route('curso.store') }}" method="post">
                    @csrf
                    <div class="flex flex-row mt-4">
                        <div class="basis-1/2">
                            <img src="./images/estudents.png" alt="">
                        </div>
                        <div class="basis-1/2">
                            <div>
                                <label for="" class="text-xs block">Turno</label>
                                <select name="turno" id="turno"
                                    class="text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="M">MANANA</option>
                                    <option value="T">TARDE</option>
                                </select>
                                <label for="" class="text-xs block mt-2">Nivel</label>
                                <select name="nivel" id="nivel"
                                    class=" text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="0">INICIAL EN FAMILIA COMUNITARIA</option>
                                    <option value="1">PRIMARIA COMUNITARIA VOCACIONAL</option>
                                    <option value="2">SECUNDARIA COMUNITARIA PRODUCTIVA</option>
                                </select>
                                <label for="" class="text-xs block mt-2">Grado</label>
                                <select name="grado" id="grado"
                                    class="text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="1">PRIMERO</option>
                                    <option value="2">SEGUNDO</option>
                                    <option value="3">TERCERO</option>
                                    <option value="4">CUARTO</option>
                                    <option value="5">QUINTO</option>
                                    <option value="6">SEXTO</option>
                                </select>
                                <label for="" class="text-xs block mt-2">Paralelo</label>
                                <select name="paralelo" id="paralelo"
                                    class="text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <hr class="border-slate-200 border">
                    <!-- Botones -->
                    <div class="flex justify-end space-x-2  ">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white w-1/2 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const openBtn = document.getElementById('openModal');
            const closeBtn = document.getElementById('closeModal');
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');

            // Abrir modal
            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('opacity-0', 'scale-95');
                    modalContent.classList.add('opacity-100', 'scale-100');
                }, 10);
            });

            // Cerrar modal
            closeBtn.addEventListener('click', () => {
                modalContent.classList.remove('opacity-100', 'scale-100');
                modalContent.classList.add('opacity-0', 'scale-95');
                setTimeout(() => modal.classList.add('hidden'), 200);
            });
        </script>
        <script>
            console.log(@json(session()->all()));
        </script>
    </div>
@endsection

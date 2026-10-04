@extends('layouts.navhorizontal')

@section('content')
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&amp;family=Public+Sans:wght@400;500;600;700&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet">
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
    <main class="w-full pt-1 flex-1 px-gutter-lg pb-gutter-lg">
        <div class="flex flex-col w-full gap-gutter-md">
            <!-- Miga de Pan y Contexto Administrativo -->
            <nav aria-label="Breadcrumb"
                class="flex flex-wrap items-center justify-between gap-gutter-sm bg-surface-container-lowest px-gutter-md py-table-row-standard rounded shadow-sm">
                <ol class="flex items-center gap-gutter-sm font-label-md text-label-md text-on-surface-variant">
                    <li class="flex items-center gap-1 hover:text-primary transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-[16px]">school</span>
                        <a class="" href="{{ route('proyectoGrado.index') }}">Proyectos de Grado</a>
                    </li>
                    <li class="text-outline-variant select-none">/</li>
                    <li class="hover:text-primary transition-colors cursor-pointer">
                        <span class="">Banco de Proyectos</span>
                    </li>
                    <li class="text-outline-variant select-none">/</li>
                    <li class="flex items-center gap-1 font-data-mono-bold text-data-mono-bold text-primary">
                        <span
                            class="px-1.5 py-0.5 rounded bg-surface-container-high text-primary font-data-mono text-data-mono">EXP-PG-2026-{{ $proyecto->idProyecto }}</span>
                        <span class="">Expediente de Proyecto</span>
                    </li>
                </ol>
                <div class="flex items-center gap-gutter-sm">
                    <span
                        class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-surface-container text-on-surface-variant font-data-mono text-data-mono">
                        <span class="h-2 w-2 rounded-full bg-primary animate-pulse"></span>
                        FASE IV: REVISIÓN TRIBUNAL LECTOR
                    </span>
                    <span class="font-data-mono text-data-mono text-outline">ACTUALIZACIÓN: HOY 10:42 AM</span>
                </div>
            </nav>
            <!-- Barra de Herramientas y Acciones Críticas -->
            <div
                class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-gutter-md bg-surface-container-lowest p-inset-card rounded shadow-sm">
                <div class="flex items-center gap-gutter-md">
                    <div
                        class="w-12 h-12 rounded bg-primary-fixed flex items-center justify-center text-on-primary-fixed shadow-sm">
                        <span class="material-symbols-outlined text-[28px]">assignment_turned_in</span>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-2">
                            <h1 class="font-headline-md text-headline-md text-on-surface tracking-tight">Expediente
                                Oficial de Titulación BTH</h1>
                            <span
                                class="px-2 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed-variant font-label-md text-label-md font-medium">BTH
                                Vigente</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">Convocatoria Técnico Medio y
                            Bachillerato Técnico Humanístico Gestión 2026</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-gutter-sm w-full lg:w-auto justify-end">
                    <button
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded bg-surface-container-low hover:bg-surface-container text-on-surface font-label-lg text-label-lg transition-colors shadow-sm"
                        type="button">
                        <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                        <span class="">Descargar Ficha Técnica PDF</span>
                    </button>
                    {{-- <button
                        class="inline-flex items-center gap-1.5 px-3 py-2 rounded bg-tertiary-container hover:bg-tertiary text-on-tertiary font-label-lg text-label-lg transition-colors shadow-sm"
                        type="button">
                        <span class="material-symbols-outlined text-[18px]">rule_folder</span>
                        <span class="">Emitir Acta de Observaciones</span>
                    </button> --}}
                    <button
                        class="inline-flex items-center gap-1.5 px-4 py-2 rounded bg-secondary hover:bg-secondary/90 text-on-secondary font-label-lg text-label-lg font-medium transition-colors shadow-sm"
                        type="button">
                        <span class="material-symbols-outlined text-[20px]">verified</span>
                        <span class="">Aprobar Fase y Pasar a Defensa</span>
                    </button>
                </div>
            </div>
            <!-- Layout Principal de 2 Columnas -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter-md items-start">
                <!-- COLUMNA IZQUIERDA (Aprox 65% - 8 cols en 12-col) -->
                <div class="lg:col-span-8 flex flex-col gap-gutter-md">
                    <!-- 1. FICHA DEL PROYECTO -->
                    <section class="bg-surface-container-lowest rounded p-inset-card shadow-sm flex flex-col gap-gutter-md">
                        <!-- Encabezado de la Ficha -->
                        <div class="flex flex-col gap-1 pb-gutter-sm bg-surface-container-lowest">
                            <div class="flex items-center justify-between">
                                <span
                                    class="font-data-mono-bold text-data-mono-bold uppercase tracking-wider text-primary">EXPEDIENTE
                                    N° PG-2026-{{ $proyecto->idProyecto }}</span>
                                <span
                                    class="font-label-md text-label-md px-2 py-0.5 rounded bg-surface-container-high text-primary font-medium">Línea:
                                    TM. Sistemas Informaticos</span>
                            </div>
                            <h2 class="font-headline-lg text-headline-lg text-on-surface leading-tight mt-1">
                                {{ $proyecto->titulo }}
                            </h2>
                            <div
                                class="flex flex-wrap items-center gap-x-4 gap-y-1 font-body-sm text-body-sm text-on-surface-variant mt-1">
                                <span class="flex items-center gap-1 font-medium text-secondary">
                                    <span class="material-symbols-outlined text-[16px]"></span>
                                    Modalidad: @if ($proyecto->lineaInvestigacion == 'PI')
                                        Proyecto de Innovacion
                                    @else
                                    @endif
                                </span>
                                {{-- <span class="text-outline-variant">•</span>
                                <span class="">Innovación Tecnológica Comunitaria y Soberanía Alimentaria</span> --}}
                            </div>
                        </div>
                        <!-- Metadatos de Estudiantes y Asesor (Grid de 3 bloques) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-gutter-md pt-1">
                            @php
                                $participantes = collect([$proyecto->estudiante])
                                    ->merge($proyecto->proyectoEstudiantes->pluck('estudiante'))
                                    ->filter()
                                    ->unique('id_estudiante');
                            @endphp
                            @forelse ($participantes as $estudiante)
                                <div class="p-gutter-sm rounded bg-surface-container-low flex items-start gap-gutter-sm">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-on-primary-fixed shrink-0 font-headline-sm text-headline-sm">
                                        Q
                                    </div>
                                    <div class="flex flex-col min-w-0">
                                        <span
                                            class="font-label-md text-label-md text-outline uppercase tracking-wider">Postulante
                                        </span>
                                        <span
                                            class="font-label-lg text-label-lg font-semibold text-on-surface truncate">{{ $estudiante->nombreCapitalizado(
                                                $estudiante->nombres . ' ' . $estudiante->appaterno . ' ' . $estudiante->apmaterno,
                                            ) }}</span>
                                        <div
                                            class="flex items-center gap-2 mt-1 font-data-mono text-data-mono text-on-surface-variant">
                                            <span class="">RUDE: 807300482014</span>
                                            <span class="text-outline-variant">|</span>
                                            <span
                                                class="px-1.5 py-0.2 rounded bg-surface-container-highest text-primary text-[11px]">{{ $proyecto->curso?->display_name ?? $proyecto->idCurso }}</span>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                @endif
                            @empty
                                Sin estudiantes asociados
                            @endforelse

                        </div>
                        <!-- Asesor Metodológico / Tutor -->
                        <div
                            class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-gutter-sm rounded bg-surface-container-high gap-gutter-sm">
                            <div class="flex items-center gap-gutter-sm">
                                <div
                                    class="w-9 h-9 rounded bg-surface-container-lowest flex items-center justify-center text-tertiary">
                                    <span class="material-symbols-outlined text-[22px]">person_apron</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-md text-label-md text-outline uppercase tracking-wider">Docente
                                        Tutor / Asesor Metodológico</span>
                                    @if ($proyecto->tutor)
                                        <span class="font-label-lg text-label-lg text-on-surface font-semibold">Prof. Lic.
                                            {{ $proyecto->tutor->nombreCapitalizado($proyecto->tutor->nombres . ' ' . $proyecto->tutor->appaterno . ' ' . $proyecto->tutor->apmaterno) }}</span>
                                    @else
                                        Sin tutor asignado
                                    @endif

                                </div>
                            </div>
                            <div class="flex items-center gap-2 text-right"><button type="button"
                                    onclick="document.getElementById('tutorModalContainer').style.display='flex'"
                                    aria-controls="tutorModalContainer" aria-haspopup="dialog"
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded bg-surface-container-lowest text-primary hover:bg-primary hover:text-on-primary transition-colors text-label-md font-label-md font-medium shadow-sm cursor-pointer border border-outline-variant/50 mr-1"><span
                                        class="material-symbols-outlined text-[16px]">event_available</span><span
                                        class="">Registrar Asistencia y Entregas</span></button>
                                {{--  <span
                                    class="px-2 py-0.5 rounded bg-surface-container-lowest text-on-surface-variant font-label-md text-label-md">
                                    Especialidad Técnica y Redacción Científica
                                </span> --}}
                                <span class="material-symbols-outlined text-secondary text-[20px]">check_circle</span>
                            </div>
                        </div>
                        <!-- Resumen Ejecutivo del Proyecto con Imagen de Contexto -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter-md mt-2">
                            <div class="md:col-span-2 flex flex-col justify-between">
                                <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                                    {{ $proyecto->descripcion ?: 'Sin descripción registrada.' }}
                                </p>
                                {{-- <div class="flex flex-wrap gap-2 mt-3 font-data-mono text-data-mono">
                                    <span class="px-2 py-1 rounded bg-surface-container-low text-primary">#ESP32_IoT</span>
                                    <span
                                        class="px-2 py-1 rounded bg-surface-container-low text-primary">#AgroecologíaBTH</span>
                                    <span
                                        class="px-2 py-1 rounded bg-surface-container-low text-secondary">#ComunidadSostenible</span>
                                </div> --}}
                            </div>
                            <div class="relative h-32 md:h-auto rounded overflow-hidden bg-surface-container shadow-inner">
                                <img class="w-full h-full object-cover"
                                    data-alt="Close up photograph of a student-built automated drip irrigation system in an educational school greenhouse, soil moisture sensor probes wired to a compact microcontroller enclosure, fresh vegetable sprouts bathed in gentle morning sunlight, clear sharp institutional documentary style"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDfQXmOc1p8tV1SeYb4u-jyVx6HANa0xlzD2924FKP3Vndw8G60TrcO5WW8MkQiv1FnLWkhTeD-zHrrNxFW3jDvFOwTvPJ8L4F1H_lyukiFpaJOd3KJdyvVCwE2oIrdedpHinh4GfxfTBgf7eU-kfxwyu1GVxp99g0d8i2lmYr-lBQkaFnMGr9TTeqR-F2GXlTT5wQzznQkupRg6W_q--7f4KpGO1lQJeTicftv0xcZQz0P0BC99bJN">
                                <div
                                    class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-inverse-surface/80 to-transparent p-2">
                                    <span
                                        class="font-label-md text-label-md text-inverse-on-surface font-medium block">Proyecto
                                        de grado.</span>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- 2. WORKFLOW STEPPER: LÍNEA DE TIEMPO INTERACTIVA DE ENTREGAS -->
                    <section class="bg-surface-container-lowest rounded p-inset-card shadow-sm flex flex-col gap-gutter-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-gutter-sm">
                                <span class="material-symbols-outlined text-primary text-[22px]">alt_route</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Ruta Cronológica y
                                    Fases de Acreditación</h3>
                            </div>
                            <button type="button"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded bg-primary text-on-primary hover:bg-primary-container text-label-md font-label-md transition-colors shadow-sm cursor-pointer mr-2"><span
                                    class="material-symbols-outlined text-[16px]">add</span><span class="">Adicionar
                                    Hito</span></button>{{-- <span
                                class="font-label-md text-label-md text-on-surface-variant bg-surface-container-low px-2 py-1 rounded font-medium">Reglamento
                                RAC-2024</span> --}}
                        </div>
                        <!-- Stepper Horizontal / Vertical Adaptativo -->
                        <div class="flex flex-col gap-3 relative">
                            <!-- Hito 1: Aprobado -->
                            <div
                                class="flex items-start gap-gutter-md p-gutter-sm rounded bg-surface-container-lowest hover:bg-surface-container-low/60 transition-colors">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-on-secondary shadow-sm">
                                        <span class="material-symbols-outlined text-[18px]">check</span>
                                    </div>
                                    <div class="w-0.5 h-10 bg-secondary/30 my-1"></div>
                                </div>
                                <div class="flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Hito
                                                1: Perfil de Grado Formal</span>
                                            <span
                                                class="px-2 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">Convalidado</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Definición de
                                            problemática comunitaria, objetivos y delimitación de recursos técnicos.
                                        </p>
                                    </div>
                                    <div class="flex sm:flex-col items-baseline sm:items-end gap-2 sm:gap-0 shrink-0">
                                        <span class="font-data-mono-bold text-data-mono-bold text-secondary text-[14px]">85
                                            / 100 pts</span>
                                        <span class="font-data-mono text-data-mono text-outline">15 de Marzo,
                                            2024</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Hito 2: Aprobado -->
                            <div
                                class="flex items-start gap-gutter-md p-gutter-sm rounded bg-surface-container-lowest hover:bg-surface-container-low/60 transition-colors -mt-2">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-on-secondary shadow-sm">
                                        <span class="material-symbols-outlined text-[18px]">check</span>
                                    </div>
                                    <div class="w-0.5 h-10 bg-secondary/30 my-1"></div>
                                </div>
                                <div class="flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Hito
                                                2: Capítulos I, II y III (Marco Teórico y Metodológico)</span>
                                            <span
                                                class="px-2 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">Revisión
                                                Concluida</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Desarrollo
                                            bibliográfico, normas APA 7ma ed., encuestas de campo y dimensionamiento
                                            físico.</p>
                                    </div>
                                    <div class="flex sm:flex-col items-baseline sm:items-end gap-2 sm:gap-0 shrink-0">
                                        <span class="font-data-mono-bold text-data-mono-bold text-secondary text-[14px]">80
                                            / 100 pts</span>
                                        <span class="font-data-mono text-data-mono text-outline">20 de Junio,
                                            2024</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Hito 3: Aprobado -->
                            <div
                                class="flex items-start gap-gutter-md p-gutter-sm rounded bg-surface-container-lowest hover:bg-surface-container-low/60 transition-colors -mt-2">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-secondary flex items-center justify-center text-on-secondary shadow-sm">
                                        <span class="material-symbols-outlined text-[18px]">check</span>
                                    </div>
                                    <div class="w-0.5 h-10 bg-primary/30 my-1"></div>
                                </div>
                                <div class="flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Hito
                                                3: Prototipo Físico y Trabajo de Campo</span>
                                            <span
                                                class="px-2 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed font-label-md text-label-md">Inspeccionado
                                                en Huerto</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant">Instalación del
                                            módulo solar fotovoltaico de 50W, cableado de bombas sumergibles de 12V
                                            y pruebas de caudal.</p>
                                    </div>
                                    <div class="flex sm:flex-col items-baseline sm:items-end gap-2 sm:gap-0 shrink-0">
                                        <span
                                            class="font-data-mono-bold text-data-mono-bold text-primary text-[14px]">Constatado
                                            100%</span>
                                        <span class="font-data-mono text-data-mono text-outline">15 de Agosto,
                                            2024</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Hito 4: ESTADO ACTUAL -->
                            <div
                                class="flex items-start gap-gutter-md p-gutter-sm rounded bg-primary-fixed/20 shadow-sm -mt-2">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-primary flex items-center justify-center text-on-primary shadow-md ring-4 ring-primary-fixed">
                                        <span class="material-symbols-outlined text-[18px]">pending_actions</span>
                                    </div>
                                    <div class="w-0.5 h-10 bg-outline-variant/50 my-1"></div>
                                </div>
                                <div class="flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-label-lg text-label-lg font-bold text-primary">Hito 4:
                                                Borrador Final Completo para Tribunal Lector</span>
                                            <span
                                                class="px-2 py-0.5 rounded bg-primary text-on-primary font-label-md text-label-md font-semibold animate-pulse">ESTADO
                                                VIGENTE</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-on-surface mt-0.5">
                                            Fase de dictamen individual por 3 docentes calificadores. Estatus:
                                            <strong class="text-primary font-semibold">2 de 3 votos
                                                emitidos</strong> favorables para habilitación.
                                        </p>
                                    </div>
                                    <div class="flex sm:flex-col items-baseline sm:items-end gap-2 sm:gap-0 shrink-0">
                                        <span class="font-data-mono-bold text-data-mono-bold text-tertiary text-[14px]">En
                                            Deliberación</span>
                                        <span class="font-data-mono text-data-mono text-on-surface-variant">Límite:
                                            28 de Oct.</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Hito 5: Pendiente -->
                            <div
                                class="flex items-start gap-gutter-md p-gutter-sm rounded bg-surface-container-lowest opacity-60 -mt-2">
                                <div class="flex flex-col items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-surface-container-highest flex items-center justify-center text-outline shadow-none">
                                        <span class="material-symbols-outlined text-[18px]">lock</span>
                                    </div>
                                </div>
                                <div class="flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-label-lg text-label-lg font-semibold text-outline">Hito
                                                5: Habilitación y Defensa Pública de Grado</span>
                                            <span
                                                class="px-2 py-0.5 rounded bg-surface-container-highest text-outline font-label-md text-label-md">Bloqueado</span>
                                        </div>
                                        <p class="font-body-sm text-body-sm text-outline">Emisión de Acta Formal de
                                            Suficiencia Académica y programación de auditorio.</p>
                                    </div>
                                    <div class="shrink-0 text-right">
                                        <span class="font-data-mono text-data-mono text-outline">Pendiente de
                                            Acta</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- 3. HISTORIAL DE ARCHIVOS Y VERSIONES SUBIDAS -->
                    {{-- <section
                        class="bg-surface-container-lowest rounded p-inset-card shadow-sm flex flex-col gap-gutter-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-gutter-sm">
                                <span class="material-symbols-outlined text-primary text-[22px]">folder_copy</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Historial de Versiones
                                    Documentales</h3>
                            </div>
                            <button
                                class="inline-flex items-center gap-1 font-label-md text-label-md text-primary hover:underline">
                                <span class="material-symbols-outlined text-[16px]">upload_file</span>
                                <span class="">Cargar Nueva Adenda</span>
                            </button>
                        </div>
                        <!-- Tabla / Lista de Entregables -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-surface-container-low text-on-surface font-label-md text-label-md uppercase tracking-wider">
                                        <th class="p-gutter-sm rounded-l">Documento / Entregable</th>
                                        <th class="p-gutter-sm">Versión</th>
                                        <th class="p-gutter-sm">Tamaño</th>
                                        <th class="p-gutter-sm">Fecha Subida</th>
                                        <th class="p-gutter-sm">Rúbrica Vinculada</th>
                                        <th class="p-gutter-sm text-right rounded-r">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="font-body-md text-body-md divide-y-0">
                                    <!-- Fila v3.0 Actual -->
                                    <tr
                                        class="hover:bg-surface-container-high/40 transition-colors bg-surface-container-lowest">
                                        <td class="p-gutter-sm flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-error text-[24px]">picture_as_pdf</span>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg font-medium text-on-surface">Borrador_Final_Proyecto_Grado_v3.pdf</span>
                                                <span class="font-data-mono text-data-mono text-outline">SHA-256:
                                                    8f2a...bc41 (Firma Digital Estudiantil)</span>
                                            </div>
                                        </td>
                                        <td class="p-gutter-sm">
                                            <span
                                                class="font-data-mono-bold text-data-mono-bold px-2 py-0.5 rounded bg-primary-fixed text-on-primary-fixed">v3.0
                                                Final</span>
                                        </td>
                                        <td class="p-gutter-sm font-data-mono text-data-mono text-on-surface-variant">
                                            14.8 MB</td>
                                        <td class="p-gutter-sm font-data-mono text-data-mono text-on-surface-variant">
                                            12 Oct 2024, 18:20</td>
                                        <td class="p-gutter-sm">
                                            <span
                                                class="inline-flex items-center gap-1 font-label-md text-label-md text-tertiary">
                                                <span class="material-symbols-outlined text-[14px]">hourglass_top</span>
                                                En Revisión
                                            </span>
                                        </td>
                                        <td class="p-gutter-sm text-right">
                                            <button
                                                class="p-1 rounded hover:bg-surface-container-highest text-primary transition-colors"
                                                title="Descargar documento">
                                                <span class="material-symbols-outlined text-[20px]">download</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Fila v2.1 Corregida -->
                                    <tr
                                        class="hover:bg-surface-container-high/40 transition-colors bg-surface-container-low/40">
                                        <td class="p-gutter-sm flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-primary text-[24px]">description</span>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface">Memoria_Tecnica_Capitulo_Metodologico_v2.1.docx</span>
                                                <span class="font-data-mono text-data-mono text-outline">Subsanación
                                                    observaciones Prof. Mercado</span>
                                            </div>
                                        </td>
                                        <td class="p-gutter-sm">
                                            <span
                                                class="font-data-mono text-data-mono px-2 py-0.5 rounded bg-surface-container-highest text-on-surface-variant">v2.1
                                                Corregida</span>
                                        </td>
                                        <td class="p-gutter-sm font-data-mono text-data-mono text-on-surface-variant">
                                            6.2 MB</td>
                                        <td class="p-gutter-sm font-data-mono text-data-mono text-on-surface-variant">
                                            28 Sep 2024, 09:15</td>
                                        <td class="p-gutter-sm">
                                            <span
                                                class="inline-flex items-center gap-1 font-label-md text-label-md text-secondary">
                                                <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                                Aprobado (80/100)
                                            </span>
                                        </td>
                                        <td class="p-gutter-sm text-right">
                                            <button
                                                class="p-1 rounded hover:bg-surface-container-highest text-on-surface-variant transition-colors"
                                                title="Descargar documento">
                                                <span class="material-symbols-outlined text-[20px]">download</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Fila v1.0 Inicial -->
                                    <tr
                                        class="hover:bg-surface-container-high/40 transition-colors bg-surface-container-lowest">
                                        <td class="p-gutter-sm flex items-center gap-2">
                                            <span
                                                class="material-symbols-outlined text-error text-[24px]">picture_as_pdf</span>
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-label-lg text-label-lg text-on-surface">Perfil_Aprobado_Ministerio_v1.0.pdf</span>
                                                <span class="font-data-mono text-data-mono text-outline">Sello de
                                                    Dirección Académica</span>
                                            </div>
                                        </td>
                                        <td class="p-gutter-sm">
                                            <span
                                                class="font-data-mono text-data-mono px-2 py-0.5 rounded bg-surface-container-highest text-on-surface-variant">v1.0
                                                Inicial</span>
                                        </td>
                                        <td class="p-gutter-sm font-data-mono text-data-mono text-on-surface-variant">
                                            2.4 MB</td>
                                        <td class="p-gutter-sm font-data-mono text-data-mono text-on-surface-variant">
                                            15 Mar 2024, 11:30</td>
                                        <td class="p-gutter-sm">
                                            <span
                                                class="inline-flex items-center gap-1 font-label-md text-label-md text-secondary">
                                                <span class="material-symbols-outlined text-[14px]">verified</span>
                                                Oficializado (85/100)
                                            </span>
                                        </td>
                                        <td class="p-gutter-sm text-right">
                                            <button
                                                class="p-1 rounded hover:bg-surface-container-highest text-on-surface-variant transition-colors"
                                                title="Descargar documento">
                                                <span class="material-symbols-outlined text-[20px]">download</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section> --}}
                </div>
                <!-- COLUMNA DERECHA (Aprox 35% - 4 cols en 12-col) -->
                <div class="lg:col-span-4 flex flex-col gap-gutter-md">
                    <!-- 1. PANEL DE TRIBUNAL EVALUADOR / JURADOS CALIFICADORES -->
                    <section
                        class="bg-surface-container-lowest rounded p-inset-card shadow-sm flex flex-col gap-gutter-md">
                        <div class="flex items-center justify-between pb-gutter-sm">
                            <div class="flex items-center gap-gutter-sm">
                                <span class="material-symbols-outlined text-primary text-[22px]">gavel</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Tribunal Evaluador
                                </h3>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded bg-surface-container text-primary font-data-mono-bold text-data-mono-bold">
                                2 / 3 VOTOS
                            </span>
                        </div>
                        <!-- Barra de progreso de votación ministerial -->
                        {{-- <div class="flex flex-col gap-1">
                            <div class="flex justify-between font-label-md text-label-md text-on-surface-variant">
                                <span class="">Quórum Evaluativo</span>
                                <span class="font-semibold text-secondary">66.7% (Falta 1 Dictamen)</span>
                            </div>
                            <div class="w-full h-2 rounded bg-surface-container-highest overflow-hidden">
                                <div class="bg-secondary h-full rounded" style="width: 66.7%"></div>
                            </div>
                        </div> --}}
                        <!-- Tarjetas de Jurados -->
                        <div class="flex flex-col gap-gutter-sm">
                            <!-- Jurado 1: Presidente -->
                            <div class="p-gutter-sm rounded bg-surface-container-low flex flex-col gap-1.5">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-primary text-on-primary flex items-center justify-center font-label-md text-label-md">
                                            JQ
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Lic.
                                                Pendiente</span>
                                            <span class="font-label-md text-label-md text-outline">Presidente del
                                                Tribunal (Usted)</span>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-tertiary text-[20px]"
                                        title="Aprobado con observaciones">edit_note</span>
                                </div>
                                <div class="mt-1 flex items-center justify-between pt-1 font-label-md text-label-md">
                                    <span class="text-tertiary font-medium bg-tertiary-container/15 px-2 py-0.5 rounded">
                                        {{-- APROBADO CON OBSERVACIONES MENORES --}}
                                    </span>
                                    <span class="font-data-mono text-data-mono text-outline">18 Oct</span>
                                </div>
                            </div>
                            <!-- Jurado 2: Secretario -->
                            <div class="p-gutter-sm rounded bg-surface-container-low flex flex-col gap-1.5">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-secondary text-on-secondary flex items-center justify-center font-label-md text-label-md">
                                            VS
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Prof.
                                                Pendiente</span>
                                            <span class="font-label-md text-label-md text-outline">Secretario /
                                                Vocal 1</span>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-secondary text-[20px]"
                                        title="Aprobado sin observaciones">task_alt</span>
                                </div>
                                <div class="mt-1 flex items-center justify-between pt-1 font-label-md text-label-md">
                                    <span class="text-secondary font-medium bg-secondary-fixed/50 px-2 py-0.5 rounded">
                                        {{-- APROBADO SIN OBSERVACIONES --}}
                                    </span>
                                    <span class="font-data-mono text-data-mono text-outline">19 Oct</span>
                                </div>
                            </div>
                            <!-- Jurado 3: Pendiente -->
                            <div class="p-gutter-sm rounded bg-surface-container-high/60 flex flex-col gap-1.5">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-8 h-8 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-label-md text-label-md">
                                            GC
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="font-label-lg text-label-lg font-bold text-on-surface">Prof.
                                                Pendiente</span>
                                            <span class="font-label-md text-label-md text-outline">Vocal Técnico
                                                2</span>
                                        </div>
                                    </div>
                                    <span class="material-symbols-outlined text-tertiary text-[20px] animate-spin"
                                        style="animation-duration: 4s;">sync</span>
                                </div>
                                <div class="mt-1 flex items-center justify-between pt-1 font-label-md text-label-md">
                                    <span
                                        class="text-on-surface-variant font-medium bg-surface-container-highest px-2 py-0.5 rounded">
                                        {{-- PENDIENTE DE EMISIÓN DE CRITERIO --}}
                                    </span>
                                    <button class="font-label-md text-label-md text-primary underline">Recordar</button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- 2. RÚBRICA DE CRITERIOS MINISTERIALES (100 pts) -->
                    {{-- <section
                        class="bg-surface-container-lowest rounded p-inset-card shadow-sm flex flex-col gap-gutter-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-gutter-sm">
                                <span class="material-symbols-outlined text-primary text-[22px]">score</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Rúbrica Ministerial
                                </h3>
                            </div>
                            <span class="font-data-mono-bold text-data-mono-bold text-headline-sm text-secondary">
                                86 <span class="text-outline text-label-md font-body-sm">/ 100 pts</span>
                            </span>
                        </div>
                        <!-- Desglose de Criterios Oficiales BTH -->
                        <div class="flex flex-col gap-3 font-body-sm text-body-sm">
                            <!-- Criterio 1: Justificación e Impacto -->
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-center">
                                    <span class="text-on-surface font-medium">Justificación e Impacto Social</span>
                                    <span class="font-data-mono-bold text-data-mono-bold text-on-surface">18 <span
                                            class="text-outline font-normal">/ 20</span></span>
                                </div>
                                <div class="w-full h-1.5 rounded bg-surface-container overflow-hidden">
                                    <div class="bg-primary h-full rounded" style="width: 90%"></div>
                                </div>
                            </div>
                            <!-- Criterio 2: Fundamentación Técnica -->
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-center">
                                    <span class="text-on-surface font-medium">Fundamentación Técnica y
                                        Prototipo</span>
                                    <span class="font-data-mono-bold text-data-mono-bold text-secondary">35 <span
                                            class="text-outline font-normal">/ 40</span></span>
                                </div>
                                <div class="w-full h-1.5 rounded bg-surface-container overflow-hidden">
                                    <div class="bg-secondary h-full rounded" style="width: 87.5%"></div>
                                </div>
                            </div>
                            <!-- Criterio 3: Estructura y Redacción -->
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-center">
                                    <span class="text-on-surface font-medium">Estructura y Redacción
                                        Académica</span>
                                    <span class="font-data-mono-bold text-data-mono-bold text-tertiary">16 <span
                                            class="text-outline font-normal">/ 20</span></span>
                                </div>
                                <div class="w-full h-1.5 rounded bg-surface-container overflow-hidden">
                                    <div class="bg-tertiary h-full rounded" style="width: 80%"></div>
                                </div>
                            </div>
                            <!-- Criterio 4: Aporte a la Comunidad -->
                            <div class="flex flex-col gap-1">
                                <div class="flex justify-between items-center">
                                    <span class="text-on-surface font-medium">Aporte a la Comunidad Educativa</span>
                                    <span class="font-data-mono-bold text-data-mono-bold text-on-surface">17 <span
                                            class="text-outline font-normal">/ 20</span></span>
                                </div>
                                <div class="w-full h-1.5 rounded bg-surface-container overflow-hidden">
                                    <div class="bg-primary h-full rounded" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="p-gutter-sm rounded bg-surface-container-low flex items-center justify-between">
                            <span class="font-label-md text-label-md text-on-surface-variant uppercase">Dictamen
                                Preliminar:</span>
                            <span
                                class="font-data-mono-bold text-data-mono-bold text-secondary px-2 py-0.5 rounded bg-secondary-container/40">
                                PROBABLE DEFENSA SATISFACTORIA
                            </span>
                        </div>
                    </section> --}}
                    <!-- 3. OBSERVACIONES OFICIALES DEL TRIBUNAL -->
                    {{-- <section
                        class="bg-surface-container-lowest rounded p-inset-card shadow-sm flex flex-col gap-gutter-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-gutter-sm">
                                <span class="material-symbols-outlined text-tertiary text-[22px]">announcement</span>
                                <h3 class="font-headline-sm text-headline-sm text-on-surface">Observaciones
                                    Oficiales</h3>
                            </div>
                            <span
                                class="px-2 py-0.5 rounded bg-error-container text-on-error-container font-label-md text-label-md font-semibold">
                                2 Subsanaciones Pendientes
                            </span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant">
                            Observaciones vinculantes registradas por los jurados que deben constar subsanadas antes
                            de autorizar la impresión del empastado formal.
                        </p>
                        <!-- Cuadro con Comentarios Formales -->
                        <div class="flex flex-col gap-gutter-sm">
                            <div class="p-gutter-sm rounded bg-surface-container-low flex flex-col gap-1">
                                <div class="flex items-center justify-between font-label-md text-label-md">
                                    <span class="font-bold text-primary">Obs. 01 - Lic. Quispe (Presidencia)</span>
                                    <span class="font-data-mono text-data-mono text-outline">Pág. 44 - Anexo
                                        C</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface">
                                    "Incorporar el esquema unifilar eléctrico del convertidor DC-DC y especificar el
                                    grado de protección IP65 de la caja estanca para intemperie."
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="inline-flex items-center gap-1 font-label-md text-label-md text-error">
                                        <span class="material-symbols-outlined text-[14px]">cancel</span> Sin
                                        Levantar
                                    </span>
                                </div>
                            </div>
                            <div class="p-gutter-sm rounded bg-surface-container-low flex flex-col gap-1">
                                <div class="flex items-center justify-between font-label-md text-label-md">
                                    <span class="font-bold text-primary">Obs. 02 - Prof. Sánchez (Vocal 1)</span>
                                    <span class="font-data-mono text-data-mono text-outline">Capítulo III</span>
                                </div>
                                <p class="font-body-sm text-body-sm text-on-surface">
                                    "Alinear la tabla de costos de reposición de insumos hídricos con el formato
                                    oficial del POA escolar comunal."
                                </p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span
                                        class="inline-flex items-center gap-1 font-label-md text-label-md text-secondary">
                                        <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                        Atendido en v3.0
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- Entrada Rápida de Comentario Institucional -->
                        <div class="pt-2 flex flex-col gap-2">
                            <label class="font-label-md text-label-md text-outline uppercase font-medium">Añadir
                                Adenda al Expediente</label>
                            <div class="flex gap-2">
                                <input
                                    class="flex-1 bg-surface-container-low px-3 py-1.5 rounded font-body-sm text-body-sm text-on-surface placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest shadow-inner"
                                    placeholder="Escriba requerimiento ministerial..." type="text">
                                <button
                                    class="px-3 py-1.5 rounded bg-primary text-on-primary font-label-md text-label-md hover:bg-primary-container transition-colors shadow-sm">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </section> --}}
                </div>
            </div>
        </div>
    </main>
@endsection
<div class="fixed inset-0 z-50 flex items-center justify-center p-3 md:p-6 overflow-y-auto bg-inverse-surface/60 backdrop-blur-sm transition-opacity duration-200"
    id="tutorModalContainer" style="display: none;" role="dialog" aria-modal="true"
    aria-labelledby="tutorModalTitle">
    <!-- MODAL CARD WINDOW -->
    <div
        class="relative w-full max-w-6xl my-auto bg-surface-container-lowest text-on-surface rounded-xl shadow-2xl flex flex-col max-h-[942px] overflow-hidden transform transition-all animate-[fadeIn_0.15s_ease-out]">
        <!-- 1. ENCABEZADO DE LA VENTANA MODAL -->
        <div
            class="px-gutter-lg py-4 bg-surface-container-lowest flex items-start justify-between shadow-sm relative z-20">
            <div class="flex flex-col gap-1.5 pr-6">
                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="font-data-mono-bold text-data-mono-bold text-primary bg-primary-fixed/80 px-2 py-0.5 rounded text-xs tracking-tight">EXP-PG-2026-{{ $proyecto->idProyecto }}</span>
                    <span
                        class="font-data-mono text-data-mono text-on-surface-variant bg-surface-container-high px-2 py-0.5 rounded text-xs uppercase tracking-wide">GESTIÓN
                        2026</span>
                    <span class="text-outline-variant text-xs">•</span>
                    <div
                        class="flex items-center gap-1 text-on-secondary-container bg-secondary-container/60 px-2 py-0.5 rounded font-label-md text-label-md">
                        <span class="material-symbols-outlined text-[15px]">verified</span>
                        <span>Módulo de Seguimiento Docente BTH · U.E. Vida Nueva</span>
                    </div>
                </div>
                <h2 id="tutorModalTitle"
                    class="font-headline-md text-headline-md text-on-surface tracking-tight mt-0.5">
                    Control de Tutorías: Registro de Asistencia
                </h2>
            </div>
            <button aria-label="Cerrar ventana"
                class="w-8 h-8 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface-variant hover:text-on-surface flex items-center justify-center transition-colors focus:outline-none"
                onclick="document.getElementById('tutorModalContainer').style.display='none'">
                <span class="material-symbols-outlined text-[20px]">close</span>
            </button>
        </div>
        <!-- SCROLLABLE INTERIOR BODY -->
        <div class="overflow-y-auto flex-1 p-gutter-lg space-y-gutter-lg bg-surface-bright">
            <!-- 2. RESUMEN SUPERIOR DEL PROYECTO Y MÉTRICAS -->
            <div class="bg-surface-container-lowest p-inset-card rounded-xl shadow-sm flex flex-col gap-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between pb-3 gap-2">
                    <div class="flex flex-col">
                        <span class="font-label-md text-label-md uppercase tracking-wider text-outline">Proyecto
                            de Grado Modalidad BTH</span>
                        <span class="font-headline-sm text-headline-sm text-primary">{{ $proyecto->titulo }}</span>
                    </div>
                    <div
                        class="flex items-center gap-2.5 bg-surface-container-low px-3 py-1.5 rounded-lg self-start md:self-auto">
                        <span class="material-symbols-outlined text-primary text-[20px]">account_box</span>
                        <div class="flex flex-col">
                            <span class="font-label-md text-label-md text-outline">Tutor Metodológico
                                &amp; Asignado</span>
                            <span class="font-label-lg text-label-lg font-semibold text-on-surface">Prof.
                                {{ $proyecto->tutor->nombreCapitalizado($proyecto->tutor->nombres . ' ' . $proyecto->tutor->appaterno . ' ' . $proyecto->tutor->apmaterno) }}</span>
                        </div>
                    </div>
                </div>
                <!-- Metricas KPI Cards -->
                {{-- <div class="grid grid-cols-2 md:grid-cols-4 gap-gutter-sm pt-1">
                    <div class="bg-surface-container-low/70 p-3 rounded-lg flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-primary-container text-on-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">event_repeat</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-headline-sm text-headline-sm font-bold text-on-surface">09
                                Sesiones</span>
                            <span class="font-label-md text-label-md text-on-surface-variant truncate">Programadas
                                / Ejecutadas</span>
                        </div>
                    </div>
                    <div class="bg-surface-container-low/70 p-3 rounded-lg flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-secondary text-on-secondary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">task_alt</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <div class="flex items-center gap-1.5">
                                <span class="font-headline-sm text-headline-sm font-bold text-secondary">92%</span>
                                <span
                                    class="font-label-md text-label-md bg-secondary-fixed text-on-secondary-fixed px-1 rounded text-[10px] font-bold">Excelente</span>
                            </div>
                            <span class="font-label-md text-label-md text-on-surface-variant truncate">Asistencia
                                Global Equipo</span>
                        </div>
                    </div>
                    <div class="bg-surface-container-low/70 p-3 rounded-lg flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-surface-container-high text-primary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-headline-sm text-headline-sm font-bold text-on-surface">07
                                Aprobadas</span>
                            <span class="font-label-md text-label-md text-on-surface-variant truncate">Entregas
                                Periódicas</span>
                        </div>
                    </div>
                    <div class="bg-surface-container-low/70 p-3 rounded-lg flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-lg bg-tertiary-fixed text-tertiary flex items-center justify-center shrink-0">
                            <span class="material-symbols-outlined text-[20px]">pending_actions</span>
                        </div>
                        <div class="flex flex-col min-w-0">
                            <span class="font-headline-sm text-headline-sm font-bold text-tertiary">01
                                Justificada</span>
                            <span class="font-label-md text-label-md text-on-surface-variant truncate">Faltas
                                / Licencias</span>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- 3. FORMULARIO ACTIVO: NUEVA SESIÓN DE TUTORÍA -->
            <div class="bg-surface-container-lowest p-inset-card rounded-xl shadow-md relative overflow-hidden">
                <div class="h-1.5 bg-primary absolute top-0 left-0 right-0"></div>
                <div class="flex flex-col md:flex-row md:items-center justify-between pb-4 gap-2">
                    <div class="flex items-center gap-2">
                        <span
                            class="w-7 h-7 rounded-full bg-primary text-on-primary font-headline-sm text-headline-sm flex items-center justify-center text-xs font-bold">10</span>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold tracking-tight">
                            Nueva Sesión de Tutoría y Registro Activo de Asistencia
                        </h3>
                    </div>
                    <span
                        class="font-label-md text-label-md text-primary font-semibold bg-primary-fixed/50 px-3 py-1 rounded-full">
                        Libreta de Campo Pedagógica • Registro en Proceso
                    </span>
                </div>
                <!-- Parámetros de la Sesión -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3.5 p-3.5 bg-surface-container-low/50 rounded-lg">
                    <div class="md:col-span-3 flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold">N°
                            de Sesión</label>
                        <div class="h-9 px-3 bg-surface-container-lowest rounded flex items-center shadow-xs">
                            <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión N°
                                10</span>
                            <span class="font-label-md text-label-md text-outline ml-1.5">(Ordinaria)</span>
                        </div>
                    </div>
                    <div class="md:col-span-3 flex flex-col gap-1">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold">Fecha
                            Programada</label>
                        <div
                            class="h-9 px-3 bg-surface-container-lowest rounded flex items-center justify-between shadow-xs">
                            <span class="font-data-mono text-data-mono text-on-surface">24/10/2024</span>
                            <span class="material-symbols-outlined text-outline text-[18px]">calendar_today</span>
                        </div>
                    </div>
                    <div class="md:col-span-2 flex flex-col gap-1">
                        <label
                            class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold">Horario</label>
                        <div
                            class="h-9 px-3 bg-surface-container-lowest rounded flex items-center justify-between shadow-xs">
                            <span class="font-data-mono text-data-mono text-on-surface">14:30 -
                                16:00</span>
                            <span class="material-symbols-outlined text-outline text-[18px]">schedule</span>
                        </div>
                    </div>
                    <div class="md:col-span-4 flex flex-col gap-1">
                        <label class="font-label-md text-label-md text-on-surface-variant uppercase font-semibold">Tema
                            / Hito de Sesión</label>
                        <input
                            class="h-9 px-3 bg-surface-container-lowest rounded font-body-sm text-body-sm text-on-surface shadow-xs focus:outline-none focus:ring-2 focus:ring-primary/40 truncate"
                            type="text" value="Revisión de Calibración de Sensores de Humedad y Código ESP32" />
                    </div>
                </div>
                <!-- Control de Asistencia y Hora por Cada Integrante -->
                <div class="flex flex-col gap-4 mt-4">
                    <span class="font-label-md text-label-md uppercase tracking-wider text-outline font-semibold">
                        Evaluación Individualizada de Integrantes
                    </span>
                    <!-- Integrante 01 -->
                    <div class="bg-surface-container-low/30 rounded-lg p-3.5 space-y-3">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-2 pb-2">
                            <div class="flex items-center gap-2.5">
                                <div
                                    class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center font-headline-sm text-headline-sm text-primary font-bold">
                                    QD
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-lg text-label-lg font-semibold text-on-surface">Quisberth
                                        Marca Domingo Fernando</span>
                                    <span class="font-body-sm text-body-sm text-outline">C.I. 9845120
                                        L.P. • 6to Sec. 'A' • Esp: Sistemas Informáticos</span>
                                </div>
                            </div>
                            <!-- Status Pills -->
                            <div class="inline-flex rounded-lg bg-surface-container p-0.5 self-start lg:self-auto"
                                id="pillGroup1">
                                <button
                                    class="px-3 py-1 text-xs font-label-md font-semibold rounded bg-secondary text-on-secondary shadow-sm flex items-center gap-1"
                                    type="button">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span>
                                    <span>Presente</span>
                                </button>
                                <button
                                    class="px-2.5 py-1 text-xs font-label-md font-medium text-on-surface-variant hover:text-on-surface"
                                    type="button">
                                    Retraso
                                </button>
                                <button
                                    class="px-2.5 py-1 text-xs font-label-md font-medium text-on-surface-variant hover:text-on-surface"
                                    type="button">
                                    Falta Justificada
                                </button>
                                <button
                                    class="px-2.5 py-1 text-xs font-label-md font-medium text-on-surface-variant hover:text-on-surface"
                                    type="button">
                                    Falta Injustificada
                                </button>
                            </div>
                        </div>
                        <!-- Input Fields Row -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 pt-1">
                            <div class="md:col-span-2 flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant font-medium">Hora
                                    Llegada</label>
                                <div
                                    class="flex items-center h-8 bg-surface-container-lowest rounded px-2.5 shadow-xs">
                                    <input
                                        class="font-data-mono-bold text-data-mono-bold text-secondary w-full bg-transparent focus:outline-none"
                                        type="text" value="14:28" />
                                    <span
                                        class="font-label-md text-[10px] uppercase font-bold text-secondary bg-secondary-fixed/50 px-1 py-0.2 rounded shrink-0">Puntual</span>
                                </div>
                            </div>
                            <div class="md:col-span-5 flex flex-col gap-1">
                                <label
                                    class="font-label-md text-label-md text-on-surface-variant font-medium">Entregable
                                    Presentado en Sesión</label>
                                <input
                                    class="h-8 px-2.5 bg-surface-container-lowest rounded font-body-sm text-body-sm text-on-surface shadow-xs focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="text" value="Diagrama de conexiones y código fuente v2.1" />
                            </div>
                            <div class="md:col-span-5 flex flex-col gap-1">
                                <label
                                    class="font-label-md text-label-md text-on-surface-variant font-medium">Observaciones
                                    de Puntualidad &amp; Avance</label>
                                <input
                                    class="h-8 px-2.5 bg-surface-container-lowest rounded font-body-sm text-body-sm text-on-surface shadow-xs focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="text" value="Trajo el circuito funcional y mediciones preliminares." />
                            </div>
                        </div>
                    </div>
                    <!-- Integrante 02 -->
                    <div class="bg-surface-container-low/30 rounded-lg p-3.5 space-y-3">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-2 pb-2">
                            <div class="flex items-center gap-2.5">
                                <div
                                    class="w-8 h-8 rounded-full bg-secondary-fixed flex items-center justify-center font-headline-sm text-headline-sm text-secondary font-bold">
                                    ML
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-label-lg text-label-lg font-semibold text-on-surface">Mamani
                                        Flores Laura Beatriz</span>
                                    <span class="font-body-sm text-body-sm text-outline">C.I. 8329104
                                        L.P. • 6to Sec. 'A' • Esp: Agroecología</span>
                                </div>
                            </div>
                            <!-- Status Pills -->
                            <div class="inline-flex rounded-lg bg-surface-container p-0.5 self-start lg:self-auto"
                                id="pillGroup2">
                                <button
                                    class="px-2.5 py-1 text-xs font-label-md font-medium text-on-surface-variant hover:text-on-surface"
                                    type="button">
                                    Presente
                                </button>
                                <button
                                    class="px-3 py-1 text-xs font-label-md font-semibold rounded bg-tertiary-fixed text-tertiary shadow-sm flex items-center gap-1"
                                    type="button">
                                    <span class="material-symbols-outlined text-[14px]">warning</span>
                                    <span>Retraso (5 min)</span>
                                </button>
                                <button
                                    class="px-2.5 py-1 text-xs font-label-md font-medium text-on-surface-variant hover:text-on-surface"
                                    type="button">
                                    Falta Justificada
                                </button>
                                <button
                                    class="px-2.5 py-1 text-xs font-label-md font-medium text-on-surface-variant hover:text-on-surface"
                                    type="button">
                                    Falta Injustificada
                                </button>
                            </div>
                        </div>
                        <!-- Input Fields Row -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-3 pt-1">
                            <div class="md:col-span-2 flex flex-col gap-1">
                                <label class="font-label-md text-label-md text-on-surface-variant font-medium">Hora
                                    Llegada</label>
                                <div
                                    class="flex items-center h-8 bg-surface-container-lowest rounded px-2.5 shadow-xs">
                                    <input
                                        class="font-data-mono-bold text-data-mono-bold text-tertiary w-full bg-transparent focus:outline-none"
                                        type="text" value="14:35" />
                                    <span
                                        class="font-label-md text-[10px] uppercase font-bold text-tertiary bg-tertiary-fixed-dim/50 px-1 py-0.2 rounded shrink-0">+5m
                                        Justif.</span>
                                </div>
                            </div>
                            <div class="md:col-span-5 flex flex-col gap-1">
                                <label
                                    class="font-label-md text-label-md text-on-surface-variant font-medium">Entregable
                                    Presentado en Sesión</label>
                                <input
                                    class="h-8 px-2.5 bg-surface-container-lowest rounded font-body-sm text-body-sm text-on-surface shadow-xs focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="text" value="Muestras de sustrato y tabla de ph/humedad" />
                            </div>
                            <div class="md:col-span-5 flex flex-col gap-1">
                                <label
                                    class="font-label-md text-label-md text-on-surface-variant font-medium">Observaciones
                                    de Puntualidad &amp; Avance</label>
                                <input
                                    class="h-8 px-2.5 bg-surface-container-lowest rounded font-body-sm text-body-sm text-on-surface shadow-xs focus:outline-none focus:ring-1 focus:ring-primary"
                                    type="text" value="Ingresó 5 minutos después con autorización de dirección." />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 4. HISTORIAL DETALLADO Y CRONOLÓGICO -->
            <div class="bg-surface-container-lowest p-inset-card rounded-xl shadow-sm flex flex-col gap-4">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[22px]">history_edu</span>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface font-semibold tracking-tight">
                            Historial Cronológico de Asistencias y Entregas Previas
                        </h3>
                    </div>
                    <!-- Filtros rápidos tipo pestaña -->
                    <div class="flex items-center p-1 bg-surface-container-low rounded-lg gap-1">
                        <button
                            class="px-3 py-1 font-label-md text-label-md rounded font-semibold bg-surface-container-lowest text-primary shadow-xs">
                            Todos los Registros (9)
                        </button>
                        <button
                            class="px-3 py-1 font-label-md text-label-md rounded font-medium text-on-surface-variant hover:text-on-surface">
                            Quisberth Marca D. (9)
                        </button>
                        <button
                            class="px-3 py-1 font-label-md text-label-md rounded font-medium text-on-surface-variant hover:text-on-surface">
                            Mamani Flores L. (9)
                        </button>
                    </div>
                </div>
                <!-- Academic Centralizer Ledger Table -->
                <div class="overflow-x-auto rounded-lg shadow-xs">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container text-on-surface">
                                <th class="py-2.5 px-3 font-label-md text-label-md uppercase font-bold text-outline">
                                    N° &amp; Fecha</th>
                                <th class="py-2.5 px-3 font-label-md text-label-md uppercase font-bold text-outline">
                                    Estudiante / Postulante</th>
                                <th class="py-2.5 px-3 font-label-md text-label-md uppercase font-bold text-outline">
                                    Horario Prog. / Llegada</th>
                                <th class="py-2.5 px-3 font-label-md text-label-md uppercase font-bold text-outline">
                                    Estado Asistencia</th>
                                <th class="py-2.5 px-3 font-label-md text-label-md uppercase font-bold text-outline">
                                    Entregable Asociado / Revisión</th>
                                <th
                                    class="py-2.5 px-3 font-label-md text-label-md uppercase font-bold text-outline text-right">
                                    Dictamen Tutor</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-high font-body-sm text-body-sm">
                            <!-- Fila 1: Sesión 09 - Quisberth -->
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-2.5 px-3">
                                    <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión
                                        09</span>
                                    <span class="block font-data-mono text-xs text-outline">17/10/2024</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-label-md text-label-md font-medium text-on-surface">Quisberth
                                        Marca Domingo</span>
                                    <span class="block font-body-sm text-xs text-outline">Sistemas
                                        Informáticos</span>
                                </td>
                                <td class="py-2.5 px-3 font-data-mono text-data-mono">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-outline">14:30</span>
                                        <span class="text-outline-variant font-bold">→</span>
                                        <span
                                            class="text-secondary font-bold bg-secondary-fixed/30 px-1 py-0.2 rounded">14:25</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span
                                        class="inline-flex items-center gap-1 bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[13px]">check</span>
                                        Presente
                                    </span>
                                </td>
                                <td class="py-2.5 px-3 font-body-sm text-on-surface">
                                    Avance Cap. III (Metodología y Sensores) aprobado
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <span
                                        class="inline-flex items-center gap-1 text-primary font-data-mono-bold text-xs bg-primary-fixed/40 px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[14px]">draw</span>
                                        Firmado
                                    </span>
                                </td>
                            </tr>
                            <!-- Fila 2: Sesión 09 - Laura -->
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-2.5 px-3">
                                    <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión
                                        09</span>
                                    <span class="block font-data-mono text-xs text-outline">17/10/2024</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-label-md text-label-md font-medium text-on-surface">Mamani
                                        Flores Laura Beatriz</span>
                                    <span class="block font-body-sm text-xs text-outline">Agroecología</span>
                                </td>
                                <td class="py-2.5 px-3 font-data-mono text-data-mono">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-outline">14:30</span>
                                        <span class="text-outline-variant font-bold">→</span>
                                        <span
                                            class="text-secondary font-bold bg-secondary-fixed/30 px-1 py-0.2 rounded">14:28</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span
                                        class="inline-flex items-center gap-1 bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[13px]">check</span>
                                        Presente
                                    </span>
                                </td>
                                <td class="py-2.5 px-3 font-body-sm text-on-surface">
                                    Avance Cap. III (Requerimientos Hídricos) aprobado
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <span
                                        class="inline-flex items-center gap-1 text-primary font-data-mono-bold text-xs bg-primary-fixed/40 px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[14px]">draw</span>
                                        Firmado
                                    </span>
                                </td>
                            </tr>
                            <!-- Fila 3: Sesión 08 - Quisberth -->
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-2.5 px-3">
                                    <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión
                                        08</span>
                                    <span class="block font-data-mono text-xs text-outline">10/10/2024</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-label-md text-label-md font-medium text-on-surface">Quisberth
                                        Marca Domingo</span>
                                    <span class="block font-body-sm text-xs text-outline">Sistemas
                                        Informáticos</span>
                                </td>
                                <td class="py-2.5 px-3 font-data-mono text-data-mono">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-outline">15:00</span>
                                        <span class="text-outline-variant font-bold">→</span>
                                        <span
                                            class="text-tertiary font-bold bg-tertiary-fixed/50 px-1 py-0.2 rounded">15:15</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span
                                        class="inline-flex items-center gap-1 bg-tertiary-fixed-dim/60 text-tertiary font-label-md text-label-md font-semibold px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[13px]">schedule</span>
                                        Retraso 15 min
                                    </span>
                                </td>
                                <td class="py-2.5 px-3 font-body-sm text-on-surface">
                                    Corrección de memoria técnica de arquitectura
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <span
                                        class="inline-flex items-center gap-1 text-primary font-data-mono-bold text-xs bg-primary-fixed/40 px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[14px]">draw</span>
                                        Firmado
                                    </span>
                                </td>
                            </tr>
                            <!-- Fila 4: Sesión 08 - Laura -->
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-2.5 px-3">
                                    <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión
                                        08</span>
                                    <span class="block font-data-mono text-xs text-outline">10/10/2024</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-label-md text-label-md font-medium text-on-surface">Mamani
                                        Flores Laura Beatriz</span>
                                    <span class="block font-body-sm text-xs text-outline">Agroecología</span>
                                </td>
                                <td class="py-2.5 px-3 font-data-mono text-data-mono">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-outline">15:00</span>
                                        <span class="text-outline-variant font-bold">→</span>
                                        <span
                                            class="text-secondary font-bold bg-secondary-fixed/30 px-1 py-0.2 rounded">14:55</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span
                                        class="inline-flex items-center gap-1 bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[13px]">check</span>
                                        Presente
                                    </span>
                                </td>
                                <td class="py-2.5 px-3 font-body-sm text-on-surface">
                                    Datos de ensayo agrícola en parcela experimental
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <span
                                        class="inline-flex items-center gap-1 text-primary font-data-mono-bold text-xs bg-primary-fixed/40 px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[14px]">draw</span>
                                        Firmado
                                    </span>
                                </td>
                            </tr>
                            <!-- Fila 5: Sesión 07 - Quisberth -->
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-2.5 px-3">
                                    <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión
                                        07</span>
                                    <span class="block font-data-mono text-xs text-outline">03/10/2024</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-label-md text-label-md font-medium text-on-surface">Quisberth
                                        Marca Domingo</span>
                                    <span class="block font-body-sm text-xs text-outline">Sistemas
                                        Informáticos</span>
                                </td>
                                <td class="py-2.5 px-3 font-data-mono text-data-mono">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-outline">14:30</span>
                                        <span class="text-outline-variant font-bold">→</span>
                                        <span
                                            class="text-secondary font-bold bg-secondary-fixed/30 px-1 py-0.2 rounded">14:30</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span
                                        class="inline-flex items-center gap-1 bg-secondary-container text-on-secondary-container font-label-md text-label-md font-semibold px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[13px]">check</span>
                                        Presente
                                    </span>
                                </td>
                                <td class="py-2.5 px-3 font-body-sm text-on-surface">
                                    Prototipo físico verificado en banco de prueba
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <span
                                        class="inline-flex items-center gap-1 text-primary font-data-mono-bold text-xs bg-primary-fixed/40 px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[14px]">draw</span>
                                        Firmado
                                    </span>
                                </td>
                            </tr>
                            <!-- Fila 6: Sesión 07 - Laura -->
                            <tr class="hover:bg-surface-container-low/40 transition-colors">
                                <td class="py-2.5 px-3">
                                    <span class="font-data-mono-bold text-data-mono-bold text-primary">Sesión
                                        07</span>
                                    <span class="block font-data-mono text-xs text-outline">03/10/2024</span>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span class="font-label-md text-label-md font-medium text-on-surface">Mamani
                                        Flores Laura Beatriz</span>
                                    <span class="block font-body-sm text-xs text-outline">Agroecología</span>
                                </td>
                                <td class="py-2.5 px-3 font-data-mono text-data-mono">
                                    <div class="flex items-center gap-1.5">
                                        <span class="text-outline">14:30</span>
                                        <span class="text-outline-variant font-bold">→</span>
                                        <span class="text-outline font-bold">--:--</span>
                                    </div>
                                </td>
                                <td class="py-2.5 px-3">
                                    <span
                                        class="inline-flex items-center gap-1 bg-surface-container-highest text-primary font-label-md text-label-md font-semibold px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[13px]">assignment_turned_in</span>
                                        Falta Justificada
                                    </span>
                                </td>
                                <td class="py-2.5 px-3 font-body-sm text-on-surface">
                                    Licencia médica escolar regularizada
                                </td>
                                <td class="py-2.5 px-3 text-right">
                                    <span
                                        class="inline-flex items-center gap-1 text-outline font-data-mono text-xs bg-surface-container px-2 py-0.5 rounded">
                                        <span class="material-symbols-outlined text-[14px]">attach_file</span>
                                        Archivo Adj.
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- 5. PIE DEL MODAL CON ACCIONES INSTITUCIONALES -->
        <div
            class="px-gutter-lg py-3.5 bg-surface-container-lowest shadow-[0_-2px_6px_rgba(0,0,0,0.03)] flex flex-col md:flex-row items-center justify-between gap-3 relative z-20">
            <div class="flex items-center gap-2 text-outline">
                <span class="material-symbols-outlined text-primary text-[18px]">verified_user</span>
                <span class="font-body-sm text-body-sm">
                    El registro de asistencia y horas queda vinculado a la carpeta pedagógica
                    ministerial del tutor.
                </span>
            </div>
            <div class="flex items-center gap-2.5 w-full md:w-auto justify-end">
                <button
                    class="h-9 px-4 rounded font-label-lg text-label-lg text-on-surface-variant hover:text-on-surface hover:bg-surface-container transition-colors"
                    onclick="document.getElementById('tutorModalContainer').style.display='none'" type="button">
                    Cancelar
                </button>
                <button
                    class="h-9 px-3.5 rounded bg-surface-container-low hover:bg-surface-container text-primary font-label-lg text-label-lg flex items-center gap-1.5 transition-colors"
                    type="button">
                    <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                    <span>Descargar Resumen PDF</span>
                </button>
                <button
                    class="h-9 px-5 rounded bg-secondary hover:bg-on-secondary-container text-on-secondary font-label-lg text-label-lg font-semibold flex items-center gap-1.5 shadow-sm transition-colors"
                    onclick="salvarAsistencia()" type="button">
                    <span class="material-symbols-outlined text-[18px]">done_all</span>
                    <span>Guardar y Validar Asistencia de Sesión</span>
                </button>
            </div>
        </div>
    </div>
</div>

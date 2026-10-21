<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="web_blank" name="shell-type" />
    <title>Portal de Autenticación Institucional - BTH Vida Nueva</title>
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
                        "tertiary-fixed-dim": "#ffb77d",
                        "primary": "#334155",
                        "primary-container": "#0056d2",
                        "primary-fixed-dim": "#b2c5ff",
                        "surface-container-highest": "#dae2fd",
                        "surface-container-low": "#f2f3ff",
                        "tertiary-container": "#914d00",
                        "on-secondary-container": "#00714b",
                        "on-background": "#131b2e",
                        "on-tertiary-container": "#ffd0ad",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed-variant": "#005235",
                        "inverse-primary": "#b2c5ff",
                        "background": "#faf8ff",
                        "on-secondary-fixed": "#002113",
                        "error-container": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed": "#dae2ff",
                        "tertiary": "#6e3900",
                        "on-primary-fixed-variant": "#0040a1",
                        "secondary": "#006c47",
                        "on-tertiary-fixed-variant": "#6e3900",
                        "surface-container": "#eaedff",
                        "on-primary-fixed": "#001847",
                        "surface-bright": "#faf8ff",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#0056d2",
                        "surface": "#faf8ff",
                        "on-surface-variant": "#424654",
                        "inverse-on-surface": "#eef0ff",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#ccd8ff",
                        "surface-container-high": "#e2e7ff",
                        "surface-dim": "#d2d9f4",
                        "tertiary-fixed": "#ffdcc3",
                        "on-surface": "#131b2e",
                        "inverse-surface": "#283044",
                        "secondary-fixed": "#8df7c1",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#8af5be",
                        "on-tertiary-fixed": "#2f1500",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "secondary-fixed-dim": "#71dba6",
                        "surface-variant": "#dae2fd",
                        "outline": "#737785",
                        "outline-variant": "#c3c6d6"
                    },
                    borderRadius: {
                        DEFAULT: "0.125rem",
                        lg: "0.25rem",
                        xl: "0.5rem",
                        full: "0.75rem"
                    },
                    spacing: {
                        "gutter-lg": "1.5rem",
                        "table-row-standard": "0.5rem",
                        "inset-card": "1.25rem",
                        "gutter-sm": "0.75rem",
                        "margin-page": "1.5rem",
                        "gutter-md": "1rem",
                        "table-row-compact": "0.25rem"
                    },
                    fontFamily: {
                        "label-md": ["Public Sans"],
                        "data-mono": ["JetBrains Mono"],
                        "body-lg": ["Public Sans"],
                        "label-lg": ["Public Sans"],
                        display: ["Public Sans"],
                        "headline-lg": ["Public Sans"],
                        "body-md": ["Public Sans"],
                        "headline-sm": ["Public Sans"],
                        "headline-lg-mobile": ["Public Sans"],
                        "data-mono-bold": ["JetBrains Mono"],
                        "body-sm": ["Public Sans"],
                        "headline-md": ["Public Sans"]
                    },
                    fontSize: {
                        "label-md": ["0.75rem", {
                            lineHeight: "1rem",
                            letterSpacing: "0.02em",
                            fontWeight: "500"
                        }],
                        "data-mono": ["0.8125rem", {
                            lineHeight: "1rem",
                            letterSpacing: "-0.01em",
                            fontWeight: "500"
                        }],
                        "body-lg": ["1rem", {
                            lineHeight: "1.5rem",
                            fontWeight: "400"
                        }],
                        "label-lg": ["0.875rem", {
                            lineHeight: "1.25rem",
                            fontWeight: "500"
                        }],
                        display: ["2rem", {
                            lineHeight: "2.5rem",
                            letterSpacing: "-0.02em",
                            fontWeight: "700"
                        }],
                        "headline-lg": ["1.5rem", {
                            lineHeight: "2rem",
                            letterSpacing: "-0.01em",
                            fontWeight: "600"
                        }],
                        "body-md": ["0.875rem", {
                            lineHeight: "1.25rem",
                            fontWeight: "400"
                        }],
                        "headline-sm": ["1.125rem", {
                            lineHeight: "1.5rem",
                            fontWeight: "600"
                        }],
                        "headline-lg-mobile": ["1.25rem", {
                            lineHeight: "1.75rem",
                            letterSpacing: "-0.01em",
                            fontWeight: "600"
                        }],
                        "data-mono-bold": ["0.8125rem", {
                            lineHeight: "1rem",
                            letterSpacing: "-0.01em",
                            fontWeight: "700"
                        }],
                        "body-sm": ["0.75rem", {
                            lineHeight: "1rem",
                            fontWeight: "400"
                        }],
                        "headline-md": ["1.25rem", {
                            lineHeight: "1.75rem",
                            fontWeight: "600"
                        }]
                    }
                }
            }
        };
    </script>
</head>

<body
    class="min-h-screen bg-background font-body-md text-body-md text-on-surface flex flex-col justify-between selection:bg-primary-fixed selection:text-on-primary-fixed">

    <main class="flex-1 w-full max-w-7xl mx-auto px-margin-page flex items-center justify-center py-margin-page">
        <div class="flex flex-col w-full">
            <div class="relative w-full overflow-hidden rounded-xl shadow-xl bg-surface-container-lowest">
                <div
                    class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-primary-fixed/30 blur-3xl pointer-events-none">
                </div>
                <div
                    class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-secondary-fixed/40 blur-3xl pointer-events-none">
                </div>
                <div class="relative grid grid-cols-1 lg:grid-cols-12 min-h-[640px]">
                    <!-- Panel Izquierdo: Branding & Contexto Oficial -->
                    <section
                        class="lg:col-span-5 bg-gradient-to-br from-primary via-primary-container to-primary text-on-primary p-gutter-lg flex flex-col justify-between relative overflow-hidden">
                        <div
                            class="absolute inset-0 opacity-10 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:16px_16px] pointer-events-none">
                        </div>
                        <div
                            class="absolute -right-20 top-1/3 w-64 h-64 rounded-full bg-secondary/20 blur-2xl pointer-events-none">
                        </div>
                        <div class="relative z-10 space-y-gutter-md">
                            {{-- <div
                                class="inline-flex items-center gap-gutter-sm px-gutter-sm py-1 rounded-full bg-surface-container-lowest/15 backdrop-blur-md text-on-primary">
                                <span class="material-symbols-outlined text-[16px] text-secondary-fixed">gavel</span>
                                <span class="font-data-mono text-data-mono tracking-tight">R.A. 0184/2024 • Min.
                                    Educación</span>
                            </div> --}}
                            <div class="space-y-1">
                                <div class="flex items-center gap-gutter-sm">
                                    <span
                                        class="material-symbols-outlined text-[32px] text-secondary-fixed">school</span>
                                    <span
                                        class="font-data-mono text-data-mono uppercase tracking-widest text-on-primary-container font-bold">BTH
                                        Cristiano "Vida Nueva"</span>
                                </div>
                                <h1 class="font-headline-lg text-headline-lg text-on-primary font-bold tracking-tight">
                                    Plataforma Oficial de Proyecto de Grado
                                </h1>
                                <p class="font-body-md text-body-md text-on-primary-container leading-relaxed">
                                    Sistema integral de evaluación técnica humanística, control de proyectos de grado y
                                    centralización de actas certificadas.
                                </p>
                            </div>
                            <!-- Puntos Clave Institucionales -->
                            <div class="space-y-gutter-sm pt-2">
                                <div
                                    class="flex items-start gap-gutter-sm bg-surface-container-lowest/10 backdrop-blur-sm p-gutter-sm rounded-lg">
                                    <span
                                        class="material-symbols-outlined text-[20px] text-secondary-fixed shrink-0 mt-0.5">assignment_turned_in</span>
                                    <div>
                                        <p class="font-label-lg text-label-lg font-semibold text-on-primary">Control de
                                            Proyectos de Grado</p>
                                        <p class="font-body-sm text-body-sm text-on-primary-container">Seguimiento de
                                            perfil, defensa pública y asignación de tribunales BTH.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-gutter-sm bg-surface-container-lowest/10 backdrop-blur-sm p-gutter-sm rounded-lg">
                                    <span
                                        class="material-symbols-outlined text-[20px] text-secondary-fixed shrink-0 mt-0.5">verified_user</span>
                                    <div>
                                        <p class="font-label-lg text-label-lg font-semibold text-on-primary">Actas
                                            Ministeriales Oficializadas</p>
                                        <p class="font-body-sm text-body-sm text-on-primary-container">Generación
                                            automatizada de centralizadores y notas finales homologadas.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex items-start gap-gutter-sm bg-surface-container-lowest/10 backdrop-blur-sm p-gutter-sm rounded-lg">
                                    <span
                                        class="material-symbols-outlined text-[20px] text-secondary-fixed shrink-0 mt-0.5">fingerprint</span>
                                    <div>
                                        <p class="font-label-lg text-label-lg font-semibold text-on-primary">Firma y
                                            Certificación Digital</p>
                                        <p class="font-body-sm text-body-sm text-on-primary-container">Protocolo con
                                            validez jurídica y verificación criptográfica docente RDA.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Tarjeta Flotante de Estado Activo -->
                        <div class="relative z-10 mt-gutter-lg pt-gutter-sm">
                            <div
                                class="bg-surface-container-lowest/15 backdrop-blur-md rounded-lg p-gutter-sm flex items-center justify-between">
                                <div class="flex items-center gap-gutter-sm">
                                    <span class="relative flex h-3 w-3">
                                        <span
                                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary-fixed opacity-75"></span>
                                        <span
                                            class="relative inline-flex rounded-full h-3 w-3 bg-secondary-fixed"></span>
                                    </span>
                                    <div>
                                        <p
                                            class="font-label-md text-label-md uppercase font-bold tracking-wider text-secondary-fixed">
                                            Gestión 2026 • Periodo Activo</p>
                                        <p class="font-body-sm text-body-sm text-on-primary-container">Defensas</p>
                                    </div>
                                </div>
                                <span
                                    class="font-data-mono text-data-mono bg-surface-container-lowest/20 px-2 py-0.5 rounded text-on-primary font-bold">v1.0.2</span>
                            </div>
                        </div>
                    </section>
                    <!-- Panel Derecho: Formulario de Autenticación -->
                    <section
                        class="lg:col-span-7 p-gutter-lg sm:p-10 flex flex-col justify-between bg-surface-container-lowest">
                        <div>
                            <!-- Cabecera del Formulario -->
                            <div
                                class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 pb-gutter-md">
                                <div>
                                    {{-- <span
                                        class="font-label-md text-label-md font-semibold text-primary uppercase tracking-wider">Acceso
                                        Oficial de Usuario</span> --}}
                                    <h2 class="font-headline-lg text-headline-lg font-bold text-on-surface">Iniciar
                                        Sesión</h2>
                                </div>
                                <div
                                    class="inline-flex items-center gap-1.5 px-gutter-sm py-1 bg-surface-container-low rounded text-on-surface-variant self-start sm:self-auto">
                                    <span class="material-symbols-outlined text-[16px] text-secondary">encrypted</span>
                                    <span class="font-data-mono text-data-mono">SISTEMAS INFORMATICOS</span>
                                </div>
                            </div>
                            <p class="font-body-md text-body-md text-on-surface-variant -mt-2 mb-gutter-md">
                                Ingrese sus credenciales de acreditación ministerial o cuenta institucional autorizada.
                            </p>
                            <!-- Selector de Rol Institucional -->
                            <div class="space-y-1.5 mb-gutter-md">
                                <label
                                    class="font-label-md text-label-md font-semibold text-on-surface-variant uppercase tracking-wider">
                                    Tipo de Perfil de Acceso
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-2" id="role-selector">
                                    <button
                                        class="role-btn text-left p-gutter-sm rounded-lg bg-surface-container-low transition-all duration-150 flex items-center gap-2 text-primary font-semibold shadow-sm"
                                        data-role="tribunal" type="button">
                                        <span class="material-symbols-outlined text-[20px] text-primary">badge</span>
                                        <span class="font-label-lg text-label-lg leading-tight">Docente / Tribunal
                                            BTH</span>
                                    </button>
                                    {{-- <button
                                        class="role-btn text-left p-gutter-sm rounded-lg bg-surface-container-lowest hover:bg-surface-container-low transition-all duration-150 flex items-center gap-2 text-on-surface-variant"
                                        data-role="direccion" type="button">
                                        <span class="material-symbols-outlined text-[20px]">admin_panel_settings</span>
                                        <span class="font-label-lg text-label-lg leading-tight">Dirección /
                                            Gestor</span>
                                    </button>
                                    <button
                                        class="role-btn text-left p-gutter-sm rounded-lg bg-surface-container-lowest hover:bg-surface-container-low transition-all duration-150 flex items-center gap-2 text-on-surface-variant"
                                        data-role="estudiante" type="button">
                                        <span class="material-symbols-outlined text-[20px]">person</span>
                                        <span class="font-label-lg text-label-lg leading-tight">Postulante /
                                            Alumno</span>
                                    </button> --}}
                                </div>
                            </div>
                            <!-- Formulario Principal -->
                            <form class="space-y-gutter-md" id="login-form" method="POST"
                                action="{{ route('login.post') }}" onsubmit="handleLogin();">
                                @csrf
                                <!-- Campo Usuario / RDA -->
                                <div class="space-y-1">
                                    <label
                                        class="font-label-md text-label-md font-semibold text-on-surface flex justify-between"
                                        for="user-identity">
                                        <span id="label-identity">Código RDA Docente o Correo Institucional</span>
                                        <span
                                            class="font-data-mono text-data-mono text-outline font-normal">Identificador
                                            Único</span>
                                    </label>
                                    <div class="relative flex items-center">
                                        <span
                                            class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">fingerprint</span>
                                        <input
                                            class="w-full pl-10 pr-4 py-2.5 bg-surface-container-lowest text-on-surface rounded-lg font-body-md text-body-md placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary shadow-sm"
                                            id="user-identity" name="username"
                                            placeholder="Ej. 492014-LP o usuario@vidanueva.edu.bo" required=""
                                            type="text" />
                                    </div>
                                </div>
                                <!-- Campo Contraseña -->
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between">
                                        <label class="font-label-md text-label-md font-semibold text-on-surface"
                                            for="password">Contraseña de Seguridad</label>
                                        {{-- <a class="font-label-md text-label-md text-primary font-semibold hover:underline"
                                            href="javascript:void(0)">
                                            ¿Olvidó su contraseña o RDA?
                                        </a> --}}
                                    </div>
                                    <div class="relative flex items-center">
                                        <span
                                            class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">lock</span>
                                        <input
                                            class="w-full pl-10 pr-11 py-2.5 bg-surface-container-lowest text-on-surface rounded-lg font-body-md text-body-md placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary shadow-sm"
                                            id="password" name="password" placeholder="••••••••••••" required=""
                                            type="password" />
                                        <button aria-label="Alternar visibilidad de contraseña"
                                            class="absolute right-2.5 p-1 rounded hover:bg-surface-container-high text-on-surface-variant focus:outline-none"
                                            id="toggle-password" type="button">
                                            <span class="material-symbols-outlined text-[20px]"
                                                id="eye-icon">visibility</span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Selector de Gestión y Periodo -->
                                {{-- <div class="space-y-1">
                                    <label class="font-label-md text-label-md font-semibold text-on-surface"
                                        for="academic-period">
                                        Gestión y Ciclo Operativo
                                    </label>
                                    <div class="relative flex items-center">
                                        <span
                                            class="material-symbols-outlined absolute left-3 text-on-surface-variant text-[20px]">event_note</span>
                                        <select
                                            class="w-full pl-10 pr-8 py-2.5 bg-surface-container-lowest text-on-surface rounded-lg font-body-md text-body-md focus:outline-none focus:ring-2 focus:ring-primary appearance-none cursor-pointer shadow-sm"
                                            id="academic-period" name="academic-period">
                                            <option selected="" value="2024-3T">Gestión 2024 • 3er Trimestre /
                                                Defensas de Grado BTH (Vigente)</option>
                                            <option value="2024-2T">Gestión 2024 • 2do Trimestre / Evaluaciones de
                                                Avance</option>
                                            <option value="2024-1T">Gestión 2024 • 1er Trimestre / Registro y Perfiles
                                            </option>
                                            <option value="2023-HIS">Gestión 2023 • Archivo Centralizador Histórico
                                                Final</option>
                                        </select>
                                        <span
                                            class="material-symbols-outlined absolute right-3 text-on-surface-variant pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div> --}}
                                <!-- Recordar y Políticas -->
                                {{-- <div class="flex items-center justify-between pt-1">
                                    <label class="flex items-center gap-2 cursor-pointer select-none">
                                        <input
                                            class="w-4 h-4 rounded text-primary focus:ring-primary accent-primary cursor-pointer"
                                            id="remember" type="checkbox" />
                                        <span class="font-body-sm text-body-sm text-on-surface-variant">Recordar mis
                                            datos en este equipo institucional</span>
                                    </label>
                                </div> --}}
                                <!-- Botones de Acción -->
                                <div class="space-y-gutter-sm pt-10">
                                    <button
                                        class="w-full py-3 px-gutter-md bg-primary hover:bg-primary-container active:bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-semibold flex items-center justify-center gap-2 shadow-md transition-all duration-150"
                                        id="btn-login" type="submit">
                                        <span>Ingresar al Panel de Control</span>
                                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                                    </button>
                                    {{-- <button
                                        class="w-full py-2.5 px-gutter-md bg-surface-container-low hover:bg-surface-container text-on-surface rounded-lg font-label-lg text-label-lg font-medium flex items-center justify-center gap-2 transition-all duration-150"
                                        onclick="handleTokenAuth()" type="button">
                                        <span class="material-symbols-outlined text-secondary text-[20px]">key</span>
                                        <span>Acceder con Credencial Digital Docente (RDA / Token)</span>
                                    </button> --}}
                                </div>
                            </form>
                        </div>
                        <!-- Indicadores de Cumplimiento Normativo / Pie del Card -->
                        <div
                            class="mt-gutter-lg pt-gutter-sm bg-surface-container-low/70 -mx-gutter-lg -mb-gutter-lg sm:-mx-10 sm:-mb-10 p-gutter-md rounded-b-xl flex flex-col sm:flex-row items-center justify-end gap-gutter-sm">
                            {{-- <div class="flex items-end gap-gutter-sm text-on-surface-variant">
                                <span class="material-symbols-outlined text-[18px] text-secondary">verified_user</span>
                                <span class="font-body-sm text-body-sm">Conexión cifrada SSL 256-bit • Auditoría
                                    permanente</span>
                            </div> --}}
                            <div class="flex items-center gap-gutter-md">
                                <a class="font-label-md text-label-md text-primary font-semibold hover:underline flex items-center gap-1"
                                    href="javascript:void(0)">
                                    <span class="material-symbols-outlined text-[16px]">contact_support</span>
                                    <span>Soporte Técnico BTH</span>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- Alerta Contextual Dinámica -->
            <div class="hidden mt-gutter-md mx-auto max-w-xl w-full p-gutter-sm bg-surface-container rounded-lg shadow-sm flex items-center justify-between animate-fade-in"
                id="status-toast">
                <div class="flex items-center gap-gutter-sm">
                    <span class="material-symbols-outlined text-primary text-[20px]" id="toast-icon">info</span>
                    <span class="font-body-sm text-body-sm text-on-surface font-medium" id="toast-text">Validando
                        credenciales...</span>
                </div>
                <button class="text-on-surface-variant p-1"
                    onclick="document.getElementById('status-toast').classList.add('hidden')" type="button">
                    <span class="material-symbols-outlined text-[18px]">close</span>
                </button>
            </div>
        </div>
        <script>
            // Control de cambio de roles
            const roleButtons = document.querySelectorAll('.role-btn');
            const labelIdentity = document.getElementById('label-identity');
            const userIdentity = document.getElementById('user-identity');

            const roleConfig = {
                tribunal: {
                    label: 'Código RDA Docente o Correo Institucional',
                    placeholder: 'Ej. 492014-LP o usuario@vidanueva.edu.bo'
                },
                direccion: {
                    label: 'Credencial Ministerial o Usuario Administrativo',
                    placeholder: 'Ej. DIR-ADMIN-VN o direccion@vidanueva.edu.bo'
                },
                estudiante: {
                    label: 'Código RUDE o Matrícula Institucional',
                    placeholder: 'Ej. 807300452020589 o estudiante@vidanueva.edu.bo'
                }
            };

            roleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    roleButtons.forEach(btn => {
                        btn.classList.remove('bg-surface-container-low', 'text-primary',
                            'font-semibold', 'shadow-sm');
                        btn.classList.add('bg-surface-container-lowest', 'text-on-surface-variant');
                    });

                    button.classList.remove('bg-surface-container-lowest', 'text-on-surface-variant');
                    button.classList.add('bg-surface-container-low', 'text-primary', 'font-semibold',
                        'shadow-sm');

                    const role = button.getAttribute('data-role');
                    if (roleConfig[role]) {
                        labelIdentity.textContent = roleConfig[role].label;
                        userIdentity.placeholder = roleConfig[role].placeholder;
                    }
                });
            });

            // Toggle de visibilidad de contraseña
            const togglePasswordBtn = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (togglePasswordBtn) {
                togglePasswordBtn.addEventListener('click', () => {
                    const isPassword = passwordInput.type === 'password';
                    passwordInput.type = isPassword ? 'text' : 'password';
                    eyeIcon.textContent = isPassword ? 'visibility_off' : 'visibility';
                });
            }

            // Microinteracción para login regular
            function handleLogin() {
                const toast = document.getElementById('status-toast');
                const toastText = document.getElementById('toast-text');
                const toastIcon = document.getElementById('toast-icon');
                const btnLogin = document.getElementById('btn-login');

                toast.classList.remove('hidden');
                toastIcon.textContent = 'hourglass_top';
                toastText.textContent = 'Comprobando credenciales con el servidor SIGED Vida Nueva...';

                btnLogin.disabled = true;
                btnLogin.classList.add('opacity-80', 'cursor-not-allowed');

                setTimeout(() => {
                    toastIcon.textContent = 'check_circle';
                    toastText.textContent = 'Sesión validada exitosamente. Redirigiendo a panel central...';
                    setTimeout(() => {
                        btnLogin.disabled = false;
                        btnLogin.classList.remove('opacity-80', 'cursor-not-allowed');
                    }, 1500);
                }, 1200);
            }

            // Microinteracción para login con token RDA
            function handleTokenAuth() {
                const toast = document.getElementById('status-toast');
                const toastText = document.getElementById('toast-text');
                const toastIcon = document.getElementById('toast-icon');

                toast.classList.remove('hidden');
                toastIcon.textContent = 'contactless';
                toastText.textContent = 'Detectando token criptográfico o lector biométrico RDA... Por favor, espere.';

                setTimeout(() => {
                    toastText.textContent =
                        'Dispositivo verificado. Solicite autorización en su aplicación ministerial.';
                }, 1800);
            }
        </script>
    </main>
    <footer
        class="w-full bg-surface-container-lowest/90 backdrop-blur-md shadow-[0_-1px_6px_rgba(0,0,0,0.03)] py-gutter-md">
        <div
            class="max-w-7xl mx-auto px-margin-page flex flex-col sm:flex-row items-center justify-between gap-gutter-sm text-center sm:text-left">
            <div class="flex items-center gap-gutter-sm"><span
                    class="material-symbols-outlined text-secondary text-[16px]">shield</span>

            </div>
            <div class="flex items-center gap-gutter-md"><span
                    class="font-body-sm text-body-sm text-on-surface-variant">© 2026 Bachillerato Técnico Humanístico
                    Vida Nueva</span></div>
        </div>
    </footer>
</body>

</html>

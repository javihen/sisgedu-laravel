<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Cargar solo los estilos de iconos que se usan y con caching CDN -->
    <!-- Si solo usas Font Awesome, considera eliminar Boxicons y usar la versión kits/minificada -->
    <link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" media="print"
        onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    </noscript>

    <script defer src="https://kit.fontawesome.com/21444380c6.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&family=Madimi+One&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Story+Script&display=swap"
        rel="stylesheet">
    <style>
        .fondo {
            background-image: url('/images/patron5.jpg');
            background-repeat: repeat;
            position: fixed;
            z-index: 0;
            width: 100%;
            height: 100vh;
            opacity: 0.2;
        }

        .flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white {
            display: flex;
            align-items: center;


        }

        .nav__icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
            width: 30px;
        }

        .nav__name {
            font-size: var(--small-font-size);
            font-weight: var(--font-medium);
            white-space: nowrap;

        }

        .nav__logout {
            margin-top: 5rem;
        }

        .nav__dropdown-collapse {
            display: none;
        }

        .nav__dropdown-collapse.show {
            display: block;
        }

        .nav__dropdown-content {
            background-color: white;
            padding: 0.5rem;
            border-radius: 0.375rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .nav__dropdown-item {
            display: block;
            padding: 0.5rem 1rem;
            color: #374151;
            text-decoration: none;
            border-radius: 0.375rem;
            transition: border 0.2s;
        }
    </style>
</head>

<body>


    {{-- Esta linea colocara un fondo repetido detras del contenido --}}
    <div class="fondo"></div>

    <header class="relative z-10 bg-white px-1.5 flex justify-between align-items-center h-15 border-b-slate-200">
        <div class=" ml-16 flex flex-row items-center h-full">
            <p style='font-family: "Playwrite GB S", cursive;'>Sistema de Gestion Educativa</p>
            <div class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm mx-2">Gestion
                {{ session('gestion') }}
            </div>
        </div>
        <div class=" mr-4 h-full flex items-center justify-center">
            <div class="bg-[#E3DFE7] m-auto py-2 px-3 rounded-md text-[14px]"
                style='font-family: "Poppins",
                cursive;'>
                PROF. {{ session('usuario_nombre') }}
            </div>
        </div>

    </header>

    <div class="nav fixed top-0 pl-2 pr-2 py-4 h-screen bg-[#334155] z-10 w-14 hover:w-[220px] transition-all duration-300"
        id="navbar">
        <nav class="nav__container h-screen flex-col justify-between pb-12 overflow-auto scroll-w ">
            <div>
                <a href="#"
                    class="flex items-center py-3 pl-2 rounded-md text-white nav__logo font-semibold mb-10 align-items-center">
                    <i class="fa-solid fa-brain nav__icon text-2xl mr-4"></i>
                    <span class="ml-2">Menu</span>
                </a>

                <div class="nav__list grid gap-y-10">
                    <div class="nav__items grid ">
                        @if (session()->has('usuario_permisos') && in_array('gestionar_roles', session('usuario_permisos')))
                            <a href="{{ route('panel') }}"
                                class="items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white flex align-items-center ">
                                <i class="fa-solid fa-school-flag text-[1.2rem] mr-2 nav__icon"></i>
                                <span class="nav__name font-medium whitespace-nowrap  ml-1.5">Inicio</span>
                            </a>
                        @endif
                        {{-- PERFIL - Solo si tiene permiso --}}
                        @if (session()->has('usuario_permisos') && in_array('ver_perfil', session('usuario_permisos')))
                            <a href="{{ route('profesor.perfil', session('profesor_id')) }}"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class="fa-solid fa-address-card nav__icon"></i>
                                <span class="nav__name ">Perfil</span>
                            </a>
                        @endif
                        @if (session()->has('usuario_permisos') && in_array('ver_estudiantes', session('usuario_permisos')))
                            <div class="nav__dropdown">
                                <a href="#"
                                    class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                    <div class="flex items-center">
                                        {{-- <i class="fa-solid fa-graduation-cap nav__icon"></i> --}}
                                        <i class="fa-solid fa-user-graduate nav__icon"></i>
                                        <span class="nav__name">Estudiantes</span>
                                    </div>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse mt-1">
                                    <div class="nav__dropdown-content">
                                        <a href="{{ route('estudiante.index') }}" class="nav__dropdown-item">Listado</a>
                                        <a href="#" class="nav__dropdown-item">Historial academico</a>
                                        <a href="#" class="nav__dropdown-item">Asistencia</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (session()->has('usuario_permisos') && in_array('ver_profesores', session('usuario_permisos')))
                            <div class="nav__dropdown">
                                <a href="#"
                                    class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                    <div class="flex items-center">
                                        {{-- <i class='bx bx-chalkboard nav__icon'></i> --}}
                                        <i class="fa-solid fa-person-chalkboard nav__icon"></i>
                                        <span class="nav__name">Docentes</span>
                                    </div>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse mt-1">
                                    <div class="nav__dropdown-content">
                                        <a href="{{ route('profesor.index') }}" class="nav__dropdown-item">Listado</a>
                                        <a href="#" class="nav__dropdown-item">Asignacion</a>
                                        <a href="#" class="nav__dropdown-item">Carga horaria</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- CURSOS - Solo si tiene permiso --}}
                        @if (session()->has('usuario_permisos') && in_array('ver_cursos', session('usuario_permisos')))
                            <div class="nav__dropdown">
                                <a href="#"
                                    class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                    <div class="flex items-center">
                                        {{-- <i class="fa-solid fa-chalkboard-user nav__icon"></i> --}}
                                        <i class="fa-solid fa-chalkboard nav__icon"></i>
                                        <span class="nav__name">Cursos/Materias</span>
                                    </div>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse mt-1">
                                    <div class="nav__dropdown-content">
                                        <a href="{{ route('curso.index') }}" class="nav__dropdown-item">Listado</a>
                                        <a href="{{ route('materia.index') }}" class="nav__dropdown-item">Materias</a>
                                        <a href="{{ route('materia.asignacion') }}"
                                            class="nav__dropdown-item">Asignacion</a>
                                        <a href="#" class="nav__dropdown-item">Carga horaria</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="nav__dropdown">
                            <a href="#"
                                class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <div class="flex items-center">
                                    <i class='bx bx-calendar nav__icon'></i>
                                    <span class="nav__name">Horarios</span>
                                </div>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse mt-1">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">Crear horarios</a>
                                    <a href="#" class="nav__dropdown-item">Listar</a>
                                    <a href="#" class="nav__dropdown-item">Asignar aulas</a>
                                </div>
                            </div>
                        </div>
                        <div class="nav__dropdown">
                            <a href="#"
                                class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <div class="flex items-center">
                                    {{-- <i class='bx bx-list-check nav__icon'></i> --}}
                                    <i class="fa-solid fa-list-check nav__icon"></i>
                                    <span class="nav__name">Asistencia</span>
                                </div>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse mt-1">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">Registrar asistencia</a>
                                    <a href="#" class="nav__dropdown-item">Ver asistencia</a>
                                </div>
                            </div>
                        </div>
                        <div class="nav__dropdown">
                            <a href="#"
                                class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <div class="flex items-center">
                                    <i class='bx bx-book-bookmark nav__icon'></i>
                                    <span class="nav__name">Calificaciones</span>
                                </div>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse mt-1">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">Registrar notas</a>
                                    <a href="#" class="nav__dropdown-item">Ver calificaciones</a>
                                    <a href="#" class="nav__dropdown-item">Promedios</a>
                                    <a href="#" class="nav__dropdown-item">Cuadro de honor</a>
                                    <a href="#" class="nav__dropdown-item">Reprobados x curso</a>
                                </div>
                            </div>
                        </div>
                        <div class="nav__dropdown">
                            <a href="#"
                                class="flex items-center justify-between py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <div class="flex items-center">
                                    <i class='bx bxs-report nav__icon'></i>
                                    <span class="nav__name">Reportes</span>
                                </div>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse mt-1">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">R. Estudiantes</a>
                                    <a href="#" class="nav__dropdown-item">R. Docentes</a>
                                    <a href="#" class="nav__dropdown-item">R. Asistencias</a>
                                    <a href="#" class="nav__dropdown-item">R. Notas</a>
                                    <a href="#" class="nav__dropdown-item">Exportar PDF/Excel</a>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="nav__dropdown">
                            <a href="#"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class='bx bx-book-alt nav__icon'></i>
                                <span class="nav__name">Administracion</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="estudiantes_vista.php" class="nav__dropdown-item">Estudiantes</a>
                                    <a href="profesor_vista.php" class="nav__dropdown-item">Profesores</a>
                                    <a href="#" class="nav__dropdown-item">Administrativos</a>
                                    <a href="#" class="nav__dropdown-item">Horarios</a>
                                    <a href="curso_vista.php" class="nav__dropdown-item">Cursos</a>
                                </div>
                            </div>
                        </div> --}}

                        {{-- CURSOS - Solo si tiene permiso --}}
                        {{-- @if (session()->has('usuario_permisos') && in_array('ver_cursos', session('usuario_permisos')))
                            <a href="{{ route('curso.index') }}"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class="fa-solid fa-chalkboard-user nav__icon"></i>
                                <span class="nav__name ">Cursos</span>
                            </a>
                        @endif --}}
                        {{-- CURSOS - Solo si tiene permiso --}}
                        @if (session()->has('usuario_permisos') && in_array('ver_cursos_asignados', session('usuario_permisos')))
                            <a href="{{ route('curso.asignados', session('profesor_id')) }}"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class="fa-solid fa-chalkboard-user nav__icon"></i>
                                <span class="nav__name ">Asignaturas</span>
                            </a>
                        @endif

                        {{-- PROFESORES - Solo si tiene permiso --}}
                        {{-- @if (session()->has('usuario_permisos') && in_array('ver_profesores', session('usuario_permisos')))
                            <a href="{{ route('profesor.index') }}"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class="fa-solid fa-user-tie nav__icon"></i>
                                <span class="nav__name ">Profesores</span>
                            </a>
                        @endif --}}

                        {{-- ESTUDIANTES - Solo si tiene permiso --}}
                        {{-- @if (session()->has('usuario_permisos') && in_array('ver_estudiantes', session('usuario_permisos')))
                            <a href="{{ route('estudiante.index') }}"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class="fa-solid fa-graduation-cap nav__icon"></i>
                                <span class="nav__name ">Estudiantes</span>
                            </a>
                        @endif --}}

                        {{-- MATERIAS - Solo si tiene permiso --}}
                        {{-- @if (session()->has('usuario_permisos') && in_array('ver_materias', session('usuario_permisos')))
                            <a href="{{ route('materia.index') }}"
                                class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                <i class="fa-solid fa-book-bookmark nav__icon"></i>
                                <span class="nav__name ">Materias</span>
                            </a>
                        @endif --}}

                        {{-- ADMINISTRACIÓN - Solo si es administrador --}}
                        @if (session()->has('usuario_permisos') && in_array('gestionar_roles', session('usuario_permisos')))
                            <div class="border-t border-slate-600 pt-4 mt-4">
                                <a href="{{ route('roles.index') }}"
                                    class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                    <i class="fa-solid fa-shield nav__icon"></i>
                                    <span class="nav__name ">Roles</span>
                                </a>
                                <a href="{{ route('permisos.index') }}"
                                    class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                                    <i class="fa-solid fa-lock nav__icon"></i>
                                    <span class="nav__name ">Permisos</span>
                                </a>
                            </div>
                        @endif


                        {{-- <a href="honor_vista.php" class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                            <i class='bx bx-trophy nav__icon'></i>
                            <span class="nav__name">Cuadro de honor</span>
                        </a>
                        <a href="reprobados_vista.php" class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                            <i class='bx bx-book-open nav__icon'></i>
                            <span class="nav__name">Reprobados</span>
                        </a>
                        <a href="importar_vista.php" class="flex items-center py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white">
                            <i class='bx bx-data nav__icon'></i>
                            <span class="nav__name">Importar datos</span>
                        </a> --}}
                    </div>
                </div>
            </div>
            <a href="{{ route('logout') }}"
                class="flex items-center w-[190px] py-3 pl-2 rounded-md text-white hover:text-slate-700 hover:bg-white fixed bottom-0 mb-4">
                <i class="fa-solid fa-right-from-bracket nav__icon ml-1"></i>
                <span class="nav__name">Salir</span>
            </a>
        </nav>
    </div>

    @yield('content')


    <div class="flex justify-center">
        <footer class="bg-white rounded-lg shadow-sm w-content fixed bottom-0 z-10">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="text-sm text-gray-500 sm:text-center mr-10 ">© 2023 <a href="#"
                        class="hover:underline">Sistema
                        de Gestion Educativa</a>. All Rights Reserved.
                </span>
                <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 sm:mt-0">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
        </footer>
    </div>

    @if (session('swal'))
        <script>
            Swal.fire(@json(session('swal')));
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.nav__dropdown');
            dropdowns.forEach(dropdown => {
                const link = dropdown.querySelector('a');
                const collapse = dropdown.querySelector('.nav__dropdown-collapse');
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    // Cerrar todos los submenús
                    const allCollapses = document.querySelectorAll('.nav__dropdown-collapse');
                    allCollapses.forEach(c => c.classList.remove('show'));
                    // Toggle el actual
                    collapse.classList.toggle('show');
                });
            });

            const navbar = document.getElementById('navbar');
            navbar.addEventListener('mouseleave', function() {
                const collapses = document.querySelectorAll('.nav__dropdown-collapse');
                collapses.forEach(collapse => {
                    collapse.classList.remove('show');
                });
            });
        });
    </script>
</body>

</html>

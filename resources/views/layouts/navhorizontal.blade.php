<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        .nav__link {
            display: flex;
            align-items: center;
            color: #fff;

        }

        .nav__link:hover {
            color: #dacfea;
        }

        .nav__link:hover::before {
            content: ".";
            display: block;
            position: relative;
            top: 0;
            left: -1px;
            border: 1px solid #fff;
            width: 1px;

        }

        .nav__icon {
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        .nav__name {
            font-size: var(--small-font-size);
            font-weight: var(--font-medium);
            white-space: nowrap;
            color: var(--text-color);
        }

        .nav__logout {
            margin-top: 5rem;
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
                2025
            </div>
        </div>
        <div class=" mr-4 h-full flex items-center justify-center">
            <div class="bg-[#E3DFE7] m-auto py-2 px-3 rounded-md text-[14px]"
                style='font-family: "Poppins",
                cursive;'>
                PROF. JAVIER HENRY QUISPE PINTO
            </div>
        </div>

    </header>

    <div class="nav fixed top-0 px-4 py-4 h-screen bg-[#334155] z-10 w-14 hover:w-52 transition-all duration-300"
        id="navbar">
        <nav class="nav__container h-screen flex-col justify-between pb-12 overflow-auto scroll-w ">
            <div>
                <a href="#" class="nav__link nav__logo font-semibold mb-10 flex align-items-center text-white">
                    <i class='bx bxs-school nav__icon text-2xl mr-2'></i>
                    <span class="nav__logo-name">Menu</span>
                </a>

                <div class="nav__list grid gap-y-10">
                    <div class="nav__items grid gap-y-6">


                        <a href="panel_vista.php"
                            class="nav__link flex align-items-center text-white hover:text-[#6923d0]">
                            <i class='bx bx-home nav__icon text-[1.2rem] mr-2'></i>
                            <span class="nav__name font-medium whitespace-nowrap text-white ml-1.5">Inicio</span>
                        </a>

                        {{-- <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">Perfil</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="#" class="nav__dropdown-item">Contrasena</a>
                                    <a href="#" class="nav__dropdown-item">Cuenta</a>
                                </div>
                            </div>
                        </div> --}}

                        <!-- <div class="nav__dropdown">
                            <a href="#" class="nav__link">
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
                        </div> -->

                        <a href="profesor_vista.php"
                            class="nav__link flex align-items-center text-white hover:text-[#6923d0]">
                            <i class='bx bx-group nav__icon text-[1.2rem] mr-2'></i>
                            <span class="nav__name">Profesores</span>
                        </a>
                        <a href="{{ route('estudiante.index') }}" class="nav__link">
                            <i class='bx bx-id-card nav__icon'></i>
                            <span class="nav__name">Estudiantes</span>
                        </a>
                        <a href="honor_vista.php" class="nav__link">
                            <i class='bx bx-trophy nav__icon'></i>
                            <span class="nav__name">Cuadro de honor</span>
                        </a>
                        <a href="{{ route('curso.index') }}" class="nav__link">
                            <i class='bx bx-book-open nav__icon'></i>
                            <span class="nav__name">Cursos</span>
                        </a>
                        <a href="reprobados_vista.php" class="nav__link">
                            <i class='bx bx-book-open nav__icon'></i>
                            <span class="nav__name">Reprobados</span>
                        </a>
                        <a href="importar_vista.php" class="nav__link">
                            <i class='bx bx-data nav__icon'></i>
                            <span class="nav__name">Importar datos</span>
                        </a>
                    </div>
                </div>
            </div>
            <a href="../controller/cerrar.php" class="nav__link nav__logout fixed bottom-0 mb-4">
                <i class=' bx bx-log-out nav__icon'></i>
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

</body>

</html>

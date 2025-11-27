@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 px-4 bg-[#38BC9B] rounded-md flex justify-end items-center ">
            <p class=" text-sm text-white px-2 py-1 rounded">Kardex del usuario</p>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-[18px] mr-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = true, 4000)" x-show="show" x-transition class="w-full ml-4 mr-4">
                <div
                    class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif

        {{-- Contenedores por nivel de cursos --}}

        <div class=" mx-3 mt-2 flex flex-row gap-1 w-full h-[calc(100vh-150px)]">
            <div class="w-1/3 h-[calc(100%-2rem)] border-8 shadow-[0_0_5px_rgba(0,0,0,0.25)]
            border-white rounded-xl p-2 bg-cover bg-center bg-no-repeat relative overflow-hidden"
                style="background-image: url('/images/perfil2.jpg');">

                <!-- Overlay degradado + blur (EFECTO NUEVO) -->
                <div
                    class="absolute inset-x-0 bottom-0 h-1/3
                bg-gradient-to-t from-black/80 via-black/40 to-transparent
                backdrop-blur-md pointer-events-none">
                </div>

                <!-- CONTENIDO (sin opacidad, sobre el efecto) -->
                <div class="absolute bottom-0 left-0 w-full  p-4 text-white">
                    <div class="flex flex-row ml-2 mt-2 w-full">
                        <div class="ml-2 w-full">
                            <div class="text-xl font-bold truncate w-[calc(100%-20px)]">PROF.
                                {{ $profesor->nombres }}
                                {{ $profesor->apmaterno }}
                                {{ $profesor->appaterno }}</div>
                            <div class="text-sm truncate w-[calc(100%-20px)]">{{ $profesor->nivelFormacion }}</div>
                        </div>
                    </div>

                    <p class="text-xs mt-3 mx-2 text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias quo beatae provident...
                    </p>

                    <a href="#" id="openModal"
                        class="py-[6px] px-4 bg-white/20 border border-white/40 rounded shadow ml-2 mt-3 inline-block
                  backdrop-blur-sm hover:bg-white/30 transition text-sm">
                        <i class='bx bx-edit'></i> Actualizar
                    </a>

                </div>
            </div>


            <div class="w-2/3 h-[calc(100%-2rem)] rounded  overflow-y-scroll scrollbar-thin">
                <div class="flex justify-between items-center ">
                    <p class="text-[16px] text-blue-600 font-bold ml-4">Cursos asignados</p>
                    <a href="#" id="openModalAsignacion"
                        class="bg-blue-600 text-white px-6 text-xs py-2  shadow-[0_0_3px_rgba(0,0,0,0.25)] rounded border-2 hover:border-blue-600 hover:bg-white hover:text-blue-600 hover:animate-pulse">Registrar
                        asignacion</a>
                </div>
                <div class="">
                    <table class="w-full mt-4 table-auto  rounded-xl bg-white text-center text-sm">
                        <tr class="bg-slate-500 text-white">
                            <td class="py-1">Nro</td>
                            <td>Curso</td>
                            <td>Turno</td>
                            <td>Estudiantes</td>
                            <td>Area</td>
                            <td>Opciones</td>
                        </tr>
                        <tr class="border-b border-slate-300 hover:bg-slate-200">
                            <td class="py-3">1</td>
                            <td>1ro Secundaria A</td>
                            <td>Manana</td>
                            <td>35</td>
                            <td class="">
                                <p class="border border-slate-400 py-1 px-2 w-fit rounded m-auto bg-white">Ciencias
                                    Naturales:Biologia
                                </p>
                            </td>
                            <td>
                                <a href=""
                                    class="border border-green-600 rounded shadow-[0_0_3px_rgba(0,0,0,0.25)] text-center px-2 py-1 bg-white text-green-600 hover:bg-green-600 hover:text-white"><i
                                        class='bx bx-download'></i></a>
                                <a href=""
                                    class="border border-blue-600 rounded shadow-[0_0_3px_rgba(0,0,0,0.25)] text-center px-2 py-1 bg-white text-blue-600 hover:bg-blue-600 hover:text-white"><i
                                        class='bx bxs-book-open'></i></a>
                            </td>
                        </tr>
                        <tr class="border-b border-slate-300">
                            <td class="py-3">1</td>
                            <td>1ro Secundaria A</td>
                            <td>Manana</td>
                            <td>35</td>
                            <td class="">
                                <p class="border border-slate-400 py-1 px-2 w-fit rounded m-auto">Ciencias
                                    Naturales:Biologia
                                </p>
                            </td>
                            <td>
                                <a href=""
                                    class="border border-green-600 rounded shadow-[0_0_3px_rgba(0,0,0,0.25)] text-center px-2 py-1 bg-white text-green-600 hover:bg-green-600 hover:text-white"><i
                                        class='bx bx-download'></i></a>
                                <a href=""
                                    class="border border-blue-600 rounded shadow-[0_0_3px_rgba(0,0,0,0.25)] text-center px-2 py-1 bg-white text-blue-600 hover:bg-blue-600 hover:text-white"><i
                                        class='bx bxs-book-open'></i></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{-- Modal formulario profesor --}}
        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">Registrar profesor</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formularioEstudiante" method="post" action="{{ route('profesor.store') }}">
                    @csrf
                    <div class="flex flex-row gap-1 mt-[-25px]">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">RDA </label>
                            <input type="text" name="rda" id="rda"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">CI </label>
                            <input type="text" name="ci" id="ci"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Apellido paterno
                            </label>
                            <input type="text" name="appaterno" id="appaterno"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Apellido materno
                            </label>
                            <input type="text" name="apmaterno" id="apmaterno"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Nombre (s) </label>
                        <input type="text" name="nombres" id="nombres"
                            class="w-full border border-slate-700 rounded-md p-2 uppercase">
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Genero
                            </label>
                            <select name="genero" id="genero"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="">seleccione</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Fecha de nacimiento
                            </label>
                            <input type="date" name="fechaNac" id="fechaNac"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="flex flex-row gap-1 mt-[-25px]">
                        <div class="basis-1/2 ">
                            <label for="codigo" class="text-xs relative top-3 left-3 bg-white px-2">Grado de estudio
                            </label>
                            <input type="text" name="nivelFormacion" id="nivelFormacion"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Fuente de
                                financiamiento
                            </label>
                            <select name="fuenteFinan" id="fuenteFinan"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="PPFF">PADRES DE FAMILIA</option>
                                <option value="TGE">TESORO GENERAL DEL ESTADO</option>
                                <option value="RP">RECURSOS PROPIOS</option>
                            </select>
                        </div>
                    </div>



                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Observaciones </label>
                        <textarea name="observacion" id="observacion" class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </textarea>
                    </div>
                    <hr class="border-slate-200 border">
                    <!-- Botones -->
                    <div class="flex justify-end space-x-2  ">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cancelar</button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-blue-600 text-white w-1/2 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal de asignacion --}}
        <div id="modalAsignacion"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContentAsignacion"
                class="bg-white rounded-md shadow-lg w-[622px] transform transition-all scale-95 opacity-0">
                <!-- Título -->
                <div class="bg-red-500 w-full h-14 pt-6 rounded-t-md flex items-center justify-center text-white">
                    <h2 class="text-md font-semibold  mb-6 text-left" id="modalTitle"><i class='bx bxs-book-alt'></i>
                        Asignacion de materia
                </div>
                </h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <div class="p-4">
                    <form class="space-y-4" id="formularioEstudiante" method="post"
                        action="{{ route('profesor.store') }}">
                        @csrf

                        <div class="mt-[-25px]">
                            <label for="rude" class="text-xs relative top-0 left-3 bg-white px-2">Profesor (a)
                            </label>
                            <input type="text" name="nombres" id="nombres"
                                class="w-full text-center bg-slate-200 border border-slate-700 rounded-md p-2 uppercase"
                                value="{{ $profesor->nombres }} {{ $profesor->apmaterno }} {{ $profesor->appaterno }}"
                                disabled>
                        </div>
                        <hr class="">
                        <div class="flex flex-row mt-[-25px] gap-1">
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Nivel
                                    educativo
                                </label>
                                <select name="genero" id="genero"
                                    class="border border-slate-600 bg-white p-2 rounded-md">
                                    <option value="">seleccione</option>
                                    <option value="0">INICIAL</option>
                                    <option value="1">PRIMARIA</option>
                                    <option value="2">SECUNDARIA</option>
                                </select>
                            </div>
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Curso
                                </label>
                                <select name="genero" id="genero"
                                    class="border border-slate-600 bg-white p-2 rounded-md">
                                    <option value="">seleccione</option>
                                    <option value="M">1ro Primaria A</option>
                                    <option value="F">2do Primaria A</option>
                                </select>
                            </div>

                        </div>
                        <div class="mt-[-25px]">
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Area
                                </label>
                                <select name="genero" id="genero"
                                    class="border border-slate-600 bg-white p-2 rounded-md">
                                    <option value="">seleccione</option>
                                    <option value="M">COMUNICACION Y LENGUAJES: LENGUA ORIGINARIA</option>
                                    <option value="F">FEMENINO</option>
                                </select>
                            </div>
                        </div>
                        <hr class="border-slate-200 border">
                        <!-- Botones -->
                        <div class="flex justify-end space-x-2  ">
                            <button type="button" id="closeModalAsignacion"
                                class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cancelar</button>
                            <button type="submit" id="submitBtn"
                                class="px-4 py-2 bg-green-600 text-white w-1/2 rounded-lg hover:bg-green-700 transition hover:cursor-pointer">Asignar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                /* Eventos del modal formulamrio profesor */
                const openBtn = document.getElementById('openModal');
                const closeBtn = document.getElementById('closeModal');

                openBtn.addEventListener('click', () => {
                    document.getElementById('modal').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('modalContent').classList.remove('scale-95',
                            'opacity-0');
                    }, 10);
                });
                closeBtn.addEventListener('click', () => {
                    document.getElementById('modalContent').classList.add('scale-95',
                        'opacity-0');
                    setTimeout(() => {
                        document.getElementById('modal').classList.add('hidden');
                    }, 200);
                });
                /* Eventos del modal de asignacion */
                const openBtnAsignacion = document.getElementById('openModalAsignacion');
                const closeBtnAsignacion = document.getElementById('closeModalAsignacion');

                openBtnAsignacion.addEventListener('click', () => {
                    document.getElementById('modalAsignacion').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('modalContentAsignacion').classList.remove('scale-95',
                            'opacity-0');
                    }, 10);
                });
                closeBtnAsignacion.addEventListener('click', () => {
                    document.getElementById('modalContentAsignacion').classList.add('scale-95',
                        'opacity-0');
                    setTimeout(() => {
                        document.getElementById('modalAsignacion').classList.add('hidden');
                    }, 200);
                });
            });
        </script>
    </div>
@endsection

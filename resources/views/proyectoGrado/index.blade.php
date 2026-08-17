@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 px-4 bg-slate-700 text-white rounded-md flex justify-between items-center ">
            <p class="text-white text-sm ">Listado de Proyecto de grado 2026</p>
            <div class="flex flex-row">
                <a href="#" id="openModal"
                    class=" mx-2 text-center flex items-center justify-center
                text-white bg-blue-600  border border-transparent shadow-xs
                font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    <i class='bx bx-plus mr-2'></i>Nuevo Proyecto
                </a>
                <a href="#" id="#"
                    class=" mx-2 text-center flex items-center justify-center
                text-white bg-blue-600  border border-transparent shadow-xs
                font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    Exportar PDF
                </a>
                <a href="#" id="#"
                    class=" mx-2 text-center flex items-center justify-center
                text-white bg-blue-600  border border-transparent shadow-xs
                font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    Buscar
                </a>
            </div>
        </div>
        <div class="">

        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-[18px] mr-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false"
                        class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
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
            <div class="w-1/5 h-fit p-2 bg-white rounded border border-gray-600">
                <p class="text-sm font-semibold mb-2">Cursos</p>
                <a href="{{ route('proyectoGrado.searchXCurso', 'C26A') }}"
                    class="grid items-center justify-center text-sm hover:bg-slate-600 hover:text-white cursor-pointer w-full h-10 border border-slate-700 rounded mb-2">6to
                    Secundaria A</a>
                <a href="{{ route('proyectoGrado.searchXCurso', 'C26B') }}"
                    class="grid items-center justify-center text-sm hover:bg-slate-600 hover:text-white cursor-pointer w-full h-10 border border-slate-700 rounded mb-2">6to
                    Secundaria B</a>
                <a href="{{ route('proyectoGrado.searchXCurso', 'C26C') }}"
                    class="grid items-center justify-center text-sm hover:bg-slate-600 hover:text-white cursor-pointer w-full h-10 border border-slate-700 rounded mb-2">6to
                    Secundaria C</a>
            </div>
            <div class="w-4/5 bg-white h-fit pb-4 rounded border border-gray-600 ">
                <table class="w-full ">
                    <thead class="bg-gray-600 text-white sticky top-0">
                        <tr class="text-center text-xs ">
                            <th class="py-2">Nro</th>
                            <th>CI</th>
                            <th>Estudiantes</th>
                            <th>Estado</th>
                            <th>Titulo del proyecto</th>
                            <th>Tutor</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($proyectos as $proyecto)
                            <tr class="text-xs text-center hover:bg-gray-100">
                                <td class="px-4 py-2 border-b border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $proyecto->ci ?? '-' }}</td>
                                <td class="px-4 py-2 border-b border-gray-300 text-left">{{ $proyecto->nombres ?? '-' }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $proyecto->estado }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    @if ($proyecto->proyectoGrado)
                                        - Proyecto: {{ $proyecto->proyectoGrado->nombre_proyecto }}
                                    @else
                                        - Sin proyecto de grado
                                    @endif
                                </td>



                                </td>
                                <td class="px-4 py-2 border-b border-gray-300 flex items-center justify-center gap-2">
                                    <a href="#"
                                        class="text-xs px-2 py-1 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">Ver
                                        Tutor</a>
                                    {{-- @if ($proyecto->tutor)

                                    @endif
                                    <a href="{{ route('proyectoGrado.show', $proyecto->idProyecto) }}"
                                        class="text-xs px-2 py-1 border border-slate-600 text-slate-600 rounded hover:bg-slate-600 hover:text-white transition">Ver
                                        Proyecto</a> --}}
                                </td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="px-4 py-4 text-center text-sm text-gray-500">No se encontraron
                                    proyectos para este curso.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modal"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
        <!-- Contenedor del modal -->
        <div id="modalContent"
            class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all opacity-0 scale-95 ">

            <!-- Título -->
            <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">Registrar proyecto de grado</h2>
            <hr class="border border-slate-200 mb-4">
            <!-- Formulario -->
            <form class="space-y-4" id="formularioProfesor" method="post" action="#">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id_gestion" value="{{ session('gestion_activa') }}">
                {{-- <div class="flex flex-row gap-1 mt-[-25px]">
                    <div class="basis-1/2 ">
                        <label for="rude"
                            class="text-xs relative top-3 left-3 bg-white px-2 border border-slate-700 rounded-md">RDA
                        </label>
                        <input type="text" name="rda" id="rda"
                            class="w-full border border-slate-700 rounded-md p-2 uppercase focus:border-slate-700 focus:outline-none focus:bg-slate-100">
                    </div>
                    <div class="basis-1/2">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">CI </label>
                        <input type="text" name="ci" id="ci"
                            class="w-full border border-slate-700 rounded-md p-2 uppercase">
                    </div>
                </div> --}}
                {{-- <div class="flex flex-row mt-[-25px] gap-1">
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
                </div> --}}
                <div class="mt-[-25px]">
                    <label for="rude"
                        class="text-xs relative top-3 left-3 bg-white px-2 border border-slate-700 rounded-md ">Titulo
                        del
                        proyecto de grado</label>
                    <input type="text" name="nombres" id="nombres"
                        class="w-full border border-slate-700 rounded-md p-2 focus:border-slate-700 focus:outline-none focus:bg-slate-100">
                </div>
                <div class="flex flex-row mt-[-25px] gap-1">
                    <div class="basis-1/2 flex flex-col mt-2 ">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Genero
                        </label>
                        <select name="genero" id="genero" class="border border-slate-600 bg-white p-2 rounded-md">
                            <option value="">seleccione</option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                    <div class="basis-1/2 flex flex-col mt-2 ">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Genero
                        </label>
                        <select name="genero" id="genero" class="border border-slate-600 bg-white p-2 rounded-md">
                            <option value="">seleccione</option>
                            <option value="M">MASCULINO</option>
                            <option value="F">FEMENINO</option>
                        </select>
                    </div>
                </div>
                {{-- <div class="flex flex-row gap-1 mt-[-25px]">
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
                            <option value="TGN">TESORO GENERAL DE LA NACION</option>
                            <option value="RP">RECURSOS PROPIOS</option>
                        </select>
                    </div>
                </div>
                <div class="mt-[-25px]">
                    <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Observaciones </label>
                    <textarea name="observacion" id="observacion" class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </textarea>
                </div> --}}
                <hr class="border-slate-200 border">
                <!-- Botones -->
                <div class="flex justify-end space-x-2  ">
                    <button type="button" id="closeModal"
                        class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition"><i
                            class="fa-regular fa-circle-xmark"></i>
                        Cancelar</button>
                    <button type="submit" id="submitBtn"
                        class="px-4 py-2 bg-blue-600 text-white w-1/2 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer"><i
                            class="fa-regular fa-floppy-disk"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Script para los eventos --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById('modal');
            const openBtn = document.getElementById('openModal');
            const closeBtn = document.getElementById('closeModal');
            const formularioProfesor = document.getElementById('formularioProfesor')
            const formMethod = document.getElementById('formMethod');
            const submitBtn = document.getElementById('submitBtn');
            openBtn.addEventListener('click', () => {

                modal.classList.remove('hidden');

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
        });
    </script>
@endsection

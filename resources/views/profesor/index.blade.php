@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 px-4 bg-[#38BC9B] rounded-md flex justify-between items-center ">
            <p class="text-white text-sm ">Listado de Docentes</p>
            <a href="#" id="openModal"
                class=" mx-2 text-center flex items-center justify-center
           text-white bg-blue-600  border border-transparent shadow-xs
           font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                <i class='bx bx-plus mr-2'></i>Nuevo Docente
            </a>
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
            <div
                class="w-full bg-white h-[calc(100%-2rem)] rounded border border-gray-400 overflow-y-scroll scrollbar-thin">
                <table class="w-full ">
                    <thead class="bg-gray-200 sticky top-0">
                        <tr class="text-center text-xs text-gray-700">
                            <th class="py-2">Nro</th>
                            <th>CI</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Nombres</th>
                            <th>Fuente de financiamiento</th>
                            <th>Rol</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-xs text-center hover:bg-gray-100">
                            <td class="px-4 py-2 border-b border-gray-300">1</td>
                            <td class="px-4 py-2 border-b border-gray-300">12345678</td>
                            <td class="px-4 py-2 border-b border-gray-300">PEREZ</td>
                            <td class="px-4 py-2 border-b border-gray-300">GOMEZ</td>
                            <td class="px-4 py-2 border-b border-gray-300">JUAN CARLOS</td>
                            <td class="px-4 py-2 border-b border-gray-300">PP.FF.</td>
                            <td class="px-4 py-2 border-b border-gray-300 ">
                                <p class="w-fit mx-auto py-1 px-2 border border-green-600 text-green-600 rounded bg-white">
                                    Profesor
                                </p>
                            </td>
                            <td class="px-4 py-2 border-b border-gray-300 flex justify-center items-center gap-2">
                                <a href="#"
                                    class="bg-slate-600 text-white py-2 px-3 border border-black rounded">Asignar cursos</a>
                                <a href="#"
                                    class="text-blue-600 hover:underline border border-blue-600 hover:bg-blue-600 hover:text-white rounded bg-white py-2 px-3"><i
                                        class='bx bx-edit-alt'></i></a>
                                <form action="#" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 border border-red-600 cursor-pointer hover:bg-red-600 hover:text-white rounded bg-white py-2 px-3 hover:underline"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar este docente?')"><i
                                            class='bx bx-trash'></i></button>
                                </form>
                            </td>
                        </tr>
                        {{-- @foreach ($profesores as $profesor)
                            <tr class="hover:bg-gray-100">
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->id }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->nombre }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->apellido }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->email }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    <a href="{{ route('profesor.edit', $profesor->id) }}"
                                        class="text-blue-600 hover:underline mr-2">Editar</a>
                                    <form action="{{ route('profesor.destroy', $profesor->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este docente?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

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
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                const tabButtons = document.querySelectorAll('.tab-btn');
                const tabPanels = document.querySelectorAll('.tab-panel');

                tabButtons.forEach(btn => {
                    btn.addEventListener('click', () => {

                        // Remover clases activas de todos
                        tabButtons.forEach(b => {
                            b.classList.remove(
                                'text-gray-600',
                                'border-b',
                                'border-slate-400'
                            );
                            b.classList.add(
                                'text-gray-600',
                                'bg-transparent',
                                'border-transparent'
                            );
                        });

                        // Agregar clases activas al botón presionado
                        btn.classList.remove(
                            'text-gray-600',
                            'bg-transparent',
                            'border-transparent'
                        );
                        btn.classList.add(
                            'text-gray-600',
                            'border-b',
                            'border-slate-400'
                        );

                        // Ocultar todos los paneles
                        tabPanels.forEach(panel => panel.classList.add('hidden'));

                        // Mostrar panel correspondiente
                        const target = btn.getAttribute('data-tabs-target');
                        document.querySelector(target).classList.remove('hidden');
                    });
                });

                // Activar el primer tab
                if (tabButtons.length > 0) {
                    tabButtons[0].click();
                }

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
            });
        </script>
    </div>
@endsection

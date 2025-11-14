@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#3B82F6] rounded-md flex justify-between items-center pl-4 pr-2 ">
            <p class="text-white text-sm ">LISTADO DE ESTUDIANTES</p>
            <div class=" h-full">
                <i class='bx  bx-search' class="relative "></i>
                <input class="bg-white my-2 py-2 rounded-md px-2 text-xs" type="text" name="" id=""
                    placeholder="Buscar estudiante ...">
            </div>
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
        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full  my-4">
                <div
                    class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif

        <div class=" ml-3 w-full mt-2  flex gap-1 ">
            <div class="bg-white w-2/3  border border-slate-300 rounded-md">
                <table class="w-full">
                    <tr class="bg-[#64748B] text-white text-sm text-center ">
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Ap. Paterno</td>
                        <td>Ap. Materno</td>
                        <td>Nombres</td>
                        <td>Curso</td>
                        <td>Estado</td>
                        <td>Opciones</td>
                    </tr>
                    @foreach ($estudiantes as $estudiante)
                        <tr class="border-b border-[#64748B] text-xs text-center ">
                            <td class="py-3">{{ $loop->iteration }}</td>
                            <td>{{ $estudiante->id_estudiante }}</td>
                            <td>{{ $estudiante->appaterno }}</td>
                            <td>{{ $estudiante->apmaterno }}</td>
                            <td>{{ $estudiante->nombres }}</td>
                            <td>SIN CURSO</td>{{-- aqui debemos de buscar en la tabla inscripcion si esta registrado en algun curso sino solo colocamos SIN CURSO --}}
                            <td>
                                @if ($estudiante->estado === 'E')
                                    <a href="#"
                                        class="px-2 border border-green-500 bg-white text-green-500 rounded-sm hover:text-white hover:bg-green-500">
                                        Efectivo
                                    </a>
                                @elseif ($estudiante->estado === 'R')
                                    <a href="#"
                                        class="px-2 border border-red-500 bg-white text-red-500 rounded-sm hover:text-white hover:bg-red-500">
                                        Retirado
                                    </a>
                                @elseif ($estudiante->estado === 'A')
                                    <a href="#"
                                        class="px-2 border border-slate-500 bg-white text-slate-500 rounded-sm hover:text-white hover:bg-slate-500">
                                        Abandono
                                    </a>
                                @else
                                    <span class="px-2 text-sm text-gray-500">—</span>
                                @endif
                            </td>
                            <td>
                                <a href="#"
                                    class="py-2 px-3 border border-red-500 bg-white my-2 rounded-sm text-red-500 hover:bg-red-500 hover:text-white"><i
                                        class='bx  bx-trash '></i></a>
                                <a href="#"
                                    class="ml-1 p-2 border border-[#3B82F6] bg-white text-[#3B82F6] hover:bg-[#3B82F6] hover:text-white rounded-sm"><i
                                        class='bx  bx-edit-alt '></i>
                                    Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class=" w-1/3  ">
                <div class=" flex gap-2">
                    <a href="#" id="openModal"
                        class="bg-[#3B82F6] px-4 py-2 text-white w-2/3 flex-auto text-center border-2 hover:border-blue-800 rounded-md text-sm transition-all"><i
                            class='bx  bx-plus'></i>
                        Nuevo
                        estudiante
                    </a>
                    <a href="#"
                        class="rounded-md w-1/3 flex-auto bg-slate-500 text-white text-center py-2 border-2 border-slate-500 hover:border-white text-sm"><i
                            class='bx bx-download'></i> Subir </a>
                </div>
                <div class="border border-slate-300 bg-white">
                    <p class="text-center p-2">Estadistica</p>
                    <table class="w-full text-center">
                        <tr class="bg-slate-500 text-white ">
                            <td>Curso</td>
                            <td>M</td>
                            <td>F</td>
                            <td>Total</td>
                        </tr>
                        <tr class="border-b border-slate-300 text-xs">
                            <td class="py-2">1o PRIMARIA "A"</td>
                            <td>32</td>
                            <td>8</td>
                            <td>40</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Nos crearemos el formulario modal con el que podamos nosotros registras a nuevos estudiantes --}}
        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left">REGISTRO DE NUEVO ESTUDIANTE</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" action="{{ route('estudiante.store') }}" method="post">
                    @csrf
                    <div class="flex flex-row gap-1 p-2 bg-slate-200">
                        <div class="basis-1/3 flex flex-col">
                            <label for="" class="text-xs">Turno</label>
                            <select name="turno" id="turno" class="border border-slate-600 bg-white p-2 rounded-sm">
                                <option value="">- seleccione -</option>
                                <option value="M">MANANA</option>
                                <option value="T">TARDE</option>
                            </select>
                        </div>
                        <div class="basis-1/3 flex flex-col">
                            <label for="" class="text-xs">Nivel</label>
                            <select name="nivel" id="nivel" class="border border-slate-600 bg-white p-2 rounded-sm">
                                <option value="">- seleccione -</option>
                                <option value="0">INICIAL</option>
                                <option value="1">PRIMARIA</option>
                                <option value="2">SECUNDARIA</option>
                            </select>
                        </div>
                        <div class="basis-1/3 flex flex-col">
                            <label for="" class="text-xs">Curso</label>
                            <select name="curso" id="curso" class="border border-slate-600 bg-white p-2 rounded-sm">
                                <option value=""> - seleccione - </option>

                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row mt-4 gap-1">
                        <div class="basis-1/2 ">
                            <label for="codigo" class="text-xs relative top-3 left-3 bg-white px-2">Codigo </label>
                            <input type="text" name="codigo" id="codigo"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Estado
                            </label>
                            <select name="estado" id="estado"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="E">EFECTIVO</option>
                                <option value="R">RETIRADO</option>
                                <option value="A">ABANDONO</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row mt-4 gap-1 mt-[-25px]">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">R.U.D.E. </label>
                            <input type="text" name="rude" id="rude"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">C.I. </label>
                            <input type="text" name="ci" id="ci"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Nombre (s) </label>
                        <input type="text" name="nombres" id="nombres"
                            class="w-full border border-slate-700 rounded-md p-2 uppercase">
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
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Genero
                            </label>
                            <select name="genero" id="genero"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="">seleccione</option>
                                <option value="M">MASCULINO</option>
                                <option value="M">FEMENINO</option>
                            </select>
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Fecha de nacimiento
                            </label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
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

            //codigo para obtener datos de un select
            document.getElementById("nivel").addEventListener('change', function() {
                const nivel = this.value;
                const turno = document.getElementById('turno').value;
                const cursoSelect = document.getElementById('curso');

                cursoSelect.innerHTML = '<option value="">seleccione</option>';
                cursoSelect.disabled = true;

                if (turno && nivel) {
                    // Cargar los cursos pasando ambos parámetros
                    fetch(`/curso/${turno}/${nivel}`)
                        .then(response => response.json())
                        .then(data => {
                            cursoSelect.innerHTML = data.map(item =>
                                `<option value="${item.idCurso}">${item.nombreCurso}</option>`
                            ).join('');
                            cursoSelect.disabled = false;
                        })
                        .catch(error => console.error('Error cargando de los cursos:', error));
                }


            });
        </script>


    </div>
@endsection

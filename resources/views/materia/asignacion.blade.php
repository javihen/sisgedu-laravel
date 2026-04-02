@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">Formulario de asignacion</p>
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
        @if ($errors->any())
            <div class="w-full ml-4 mr-4 mt-2">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        {{-- Contenedores por nivel de cursos --}}
        <div class="mx-3 mt-2 flex justify-center flex-row gap-1 w-full h-[calc(100vh-150px)]">
            <div class=" w-3/4 bg-white h-fit rounded border border-gray-400 p-4">
                <div>
                    <form class="space-y-4" id="formularioAsignacion" action="{{ route('asignacion.store') }}"
                        method="post" class="form-adicionar">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <div class="flex flex-row mt-4 gap-1">
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="id_profesor"
                                    class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Seleccione
                                    al docente
                                </label>
                                <select name="id_profesor" id="id_profesor"
                                    class="border border-slate-600 bg-white p-2 rounded-md">
                                    <option value="">-- Seleccione al docente --</option>
                                    @foreach ($profesores as $profesor)
                                        <option value="{{ $profesor->id_profesor }}">
                                            {{ $profesor->nombres }} {{ $profesor->appaterno }} {{ $profesor->apmaterno }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="nivel" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Nivel del
                                    curso
                                </label>
                                <select name="nivel" id="nivel"
                                    class="border border-slate-600 bg-white p-2 rounded-md" onchange="filterCursos()">
                                    <option value="">-- Seleccione un nivel --</option>
                                    @foreach ($niveles as $key => $valor)
                                        <option value="{{ $key }}"
                                            @if ($selectedNivel == (string) $key) selected @endif>{{ $valor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-row gap-1 mt-[-25px]">
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="id_materia" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Area /
                                    Materia
                                </label>
                                <select name="id_materia" id="id_materia"
                                    class="border border-slate-600 bg-white p-2 rounded-md" onchange="filterCursos()">
                                    <option value="">-- Seleccione una materia --</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id_materia }}"
                                            @if ($selectedMateria == $materia->id_materia) selected @endif>
                                            {{ $materia->area }} ({{ $materia->abreviatura }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="turno" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Turno
                                </label>
                                <select name="turno" id="turno"
                                    class="border border-slate-600 bg-white p-2 rounded-md" onchange="filterCursos()">
                                    <option value="">-- Seleccione un turno --</option>
                                    @foreach ($turnos as $key => $valor)
                                        <option value="{{ $key }}"
                                            @if ($selectedTurno == $key) selected @endif>{{ $valor }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2  ">
                            <button type="submit" id="submitBtn"
                                class="px-4 py-2 bg-blue-800 text-white w-1/3 rounded-md hover:bg-blue-700 transition hover:cursor-pointer text-sm">Registrar
                                asignacion</button>
                        </div>

                        <div
                            class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                            <table class="w-full text-xs text-left rtl:text-right text-body">
                                <thead
                                    class="text-xs text-body bg-neutral-secondary-medium border-b border-default-medium bg-slate-600 text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 font-medium w-1/4">Curso</th>
                                        <th scope="col" class="px-6 py-3 font-medium w-[20px]">Estado</th>
                                        <th scope="col" class="px-6 py-3 font-medium">Profesor asignado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($selectedTurno !== '' && $selectedNivel !== '')
                                        @if ($cursos->isEmpty())
                                            <tr class="bg-white">
                                                <td colspan="3" class="px-6 py-4 text-center text-gray-600">No hay cursos
                                                    para el turno y
                                                    nivel seleccionados.</td>
                                            </tr>
                                        @else
                                            @foreach ($cursos as $curso)
                                                <tr
                                                    class="bg-neutral-primary-soft border-default border-b hover:bg-neutral-secondary-medium">
                                                    <td class="px-6 py-2 font-medium text-heading whitespace-nowrap">
                                                        {{ $curso->display_name }}
                                                    </td>
                                                    <td
                                                        class="px-6 py-1 font-medium text-heading whitespace-nowrap text-center">
                                                        @if ($selectedMateria)
                                                            <input type="checkbox" name="idcurso[]"
                                                                value="{{ $curso->id }}"
                                                                class="w-4 h-4 border border-default-medium rounded-xs bg-neutral-secondary-medium">
                                                        @else
                                                            -
                                                        @endif
                                                    </td>
                                                    <td class="px-6 py-1 font-medium text-heading whitespace-nowrap">
                                                        @if ($selectedMateria)
                                                            @if ($curso->asignaciones->isNotEmpty())
                                                                PROF.
                                                                {{ $curso->asignaciones->first()->profesor->nombres }}
                                                                {{ $curso->asignaciones->first()->profesor->appaterno }}
                                                                {{ $curso->asignaciones->first()->profesor->apmaterno }}
                                                            @else
                                                                No asignado
                                                            @endif
                                                        @else
                                                            Seleccione una materia
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        @endif
                                    @else
                                        <tr class="bg-white">
                                            <td colspan="3" class="px-6 py-4 text-center text-gray-600">Elige turno y
                                                nivel
                                                para ver cursos.
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>



                </div>

            </div>
        </div>
        </form>

        {{-- overflow-y-scroll scrollbar-thin
         <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[422px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">Formulario materia</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formMateria" action="{{ route('materia.store') }}" method="post">
                    @csrf
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Codigo </label>
                        <input type="text" name="id_materia" id="id_materia"
                            class="w-full border border-slate-700 rounded-md px-2  pt-5 pb-2">
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="w-full flex flex-col mt-2 ">
                            <label for="rude"
                                class="text-xs relative top-5 left-1 bg-white px-2 w-fit text-slate-600">Nivel
                            </label>
                            <select name="nivel" id="nivel"
                                class="border border-slate-600 bg-white px-2  pt-5 pb-2">
                                <option value="">seleccione</option>
                                <option value="0">Inicial en Familia Comunitaria</option>
                                <option value="1">Primaria Comunitaria Vocacional</option>
                                <option value="2">Secundaria Comunitaria Productiva</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="w-full flex flex-col mt-2 ">
                            <label for="rude"
                                class="text-xs relative top-5 left-1 bg-white px-2 w-fit text-slate-600">Campo
                            </label>
                            <select name="campo" id="campo"
                                class="border border-slate-600 bg-white px-2  pt-5 pb-2">
                                <option value="">seleccione</option>
                                <option value="Comunidad y Sociedad">Comunidad y Sociedad</option>
                                <option value="Vida, Tierra y Territorio">Vida, Tierra y Territorio</option>
                                <option value="Ciencia, Tecnologia y produccion">Ciencia, Tecnologia y produccion</option>
                                <option value="Cosmos y Pensamiento">Cosmos y Pensamiento</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Area </label>
                        <input type="text" name="area" id="area"
                            class="w-full border border-slate-700 rounded-md px-2 pt-5 pb-2">
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Abreviatura </label>
                        <input type="text" name="abreviatura" id="abreviatura"
                            class="w-full border border-slate-700 rounded-md px-2 pt-5 pb-2">
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Orden </label>
                        <input type="number" name="orden" id="orden"
                            class="w-full border border-slate-700 rounded-md px-2 pt-5 pb-2">
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
        </div> --}}

    </div>

    <script>
        function filterCursos() {
            const turno = document.getElementById('turno').value;
            const nivel = document.getElementById('nivel').value;
            const materia = document.getElementById('id_materia').value;
            const params = new URLSearchParams(window.location.search);

            if (turno) {
                params.set('turno', turno);
            } else {
                params.delete('turno');
            }

            if (nivel) {
                params.set('nivel', nivel);
            } else {
                params.delete('nivel');
            }

            if (materia) {
                params.set('id_materia', materia);
            } else {
                params.delete('id_materia');
            }

            const target = '{{ route('materia.asignacion') }}';
            window.location.href = target + (params.toString().length ? '?' + params.toString() : '');
        }
    </script>
@endsection

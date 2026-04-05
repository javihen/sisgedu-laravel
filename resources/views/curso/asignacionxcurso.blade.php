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
            <div class="w-1/4 bg-white h-fit rounded border border-gray-400 p-4">
                <div class="tree text-sm">
                    <style>
                        .tree li::before {
                            bottom: -0.75rem;
                        }

                        .tree li:last-child::before {
                            bottom: 0;
                        }
                    </style>
                    <ul class="pl-5">
                        @foreach ($cursosTree as $turno => $nivelesTree)
                            <li
                                class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300 after:absolute after:left-0 after:top-2.5 after:w-2.5 after:h-px after:bg-gray-300">
                                <span
                                    class="toggle border-green-600 border px-2 py-1  text-green-600 rounded-md mb-2 cursor-pointer select-none before:content-['▶'] before:inline-block before:mr-1">
                                    {{ $turnos[$turno] ?? $turno }}
                                </span>
                                <ul class="nested hidden pl-5 mt-3">
                                    @foreach ($nivelesTree as $nivel => $gradosTree)
                                        <li
                                            class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300 after:absolute after:left-0 after:top-2.5 after:w-2.5 after:h-px after:bg-gray-300">
                                            <span
                                                class="toggle cursor-pointer border border-green-600 px-2 py-1 text-xs text-green-600 rounded-md select-none before:content-['▶'] before:inline-block before:mr-1">
                                                {{ $niveles[$nivel] ?? 'Nivel ' . $nivel }}
                                            </span>
                                            <ul class="nested hidden pl-5 mt-3">
                                                @foreach ($gradosTree as $grado => $paralelos)
                                                    <li
                                                        class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300 after:absolute after:left-0 after:top-2.5 after:w-2.5 after:h-px after:bg-gray-300">
                                                        <span
                                                            class="toggle border border-slate-600 px-2 py-1 text-xs text-slate-600 rounded-md cursor-pointer select-none before:content-['▶'] before:inline-block before:mr-1">
                                                            {{ is_numeric($grado) ? $grado . 'º' : $grado }}
                                                        </span>
                                                        <ul class="nested hidden pl-5 mt-3">
                                                            @foreach ($paralelos as $paralelo => $cursos)
                                                                <li
                                                                    class="relative pl-5  mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300 after:absolute after:left-0 after:top-2.5 after:w-2.5 after:h-px after:bg-gray-300">
                                                                    <span
                                                                        class="border text-xs border-gray-600 w-8 h-8 rounded-full flex items-center justify-center text-center">
                                                                        {{ $paralelo }}
                                                                    </span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <script>
                document.querySelectorAll('.toggle').forEach(el => {
                    el.addEventListener('click', () => {
                        const nested = el.nextElementSibling;
                        if (nested) {
                            nested.classList.toggle('hidden');
                            el.classList.toggle('expanded');

                            // Cambiar flecha
                            if (el.classList.contains('expanded')) {
                                el.classList.remove("before:content-['▶']");
                                el.classList.add("before:content-['▼']");
                            } else {
                                el.classList.remove("before:content-['▼']");
                                el.classList.add("before:content-['▶']");
                            }
                        }
                    });
                });
            </script>

            <div class=" w-3/4 bg-white h-fit rounded border border-gray-400 p-4">
                <div>
                    <form class="space-y-4" id="formularioAsignacion" action="{{ route('asignacion.store') }}"
                        method="post" class="form-adicionar">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <div class="flex flex-row mt-4 gap-1">

                            <div class="basis-1/2 flex flex-col mt-2 ">
                                <label for="nivel" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Nivel del
                                    curso
                                </label>

                            </div>

                            <div class="basis-1/2 flex flex-col " style="">
                                <label for="id_materia" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Area /
                                    Materia
                                </label>

                            </div>

                        </div>
                        <div class="flex flex-row gap-1 mt-[-20px] ">

                            <div class="basis-1/2 flex flex-col" style="">
                                <label for="turno" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Turno
                                </label>

                            </div>

                            <div class="basis-1/2 flex flex-col" style="">
                                <label for="id_profesor"
                                    class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Seleccione
                                    al docente
                                </label>
                                <select name="id_profesor" id="id_profesor"
                                    class="border border-slate-600 bg-white p-2 rounded-md w-full">
                                    <option value="">-- Seleccione al docente --</option>

                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-2  ">
                            <button type="submit" id="submitBtn"
                                class="px-4 py-2 bg-blue-800 text-white w-1/3 rounded-md hover:bg-blue-700 transition hover:cursor-pointer text-sm">Registrar
                                asignacion</button>
                        </div>

                        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default" ">
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

                                                                                                                                                                                                                                                                <tr class="bg-white">
                                                                                                                                                                                                                                                                    <td colspan="3" class="px-6 py-4 text-center text-gray-600">No hay cursos
                                                                                                                                                                                                                                                                        para el turno y
                                                                                                                                                                                                                                                                        nivel seleccionados.</td>
                                                                                                                                                                                                                                                                </tr>

                                                                                                                                                                                                                                                                </tbody>
                                                                                                                                                                                                                                                                </table>
                                                                                                                                                                                                                                                            </div>


                                                                                                                                                                                                                                                            <div class="mt-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                                                                                                                                                                                                                                                                Seleccione una materia para ver la tabla de cursos y asignar profesor.
                                                                                                                                                                                                                                                            </div>




                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                            </form>
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

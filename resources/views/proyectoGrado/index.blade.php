@extends('layouts.navhorizontal')

@section('content')
    @php
        $cursoActual =
            request()->route('idCurso') ?? (optional($proyectos->first()?->inscripciones?->first())->id_curso ?? null);
        $profesores = \App\Models\Profesor::orderBy('nombres')->get();
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 px-4 bg-slate-700 text-white rounded-md flex justify-between items-center ">
            <p class="text-white text-sm ">Listado de Proyecto de grado 2026</p>
            <div class="flex flex-row">
                {{-- <a href="#" id="openModal"
                    class=" mx-2 text-center flex items-center justify-center
                text-white bg-blue-600  border border-transparent shadow-xs
                font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    <i class='bx bx-plus mr-2'></i>Nuevo Proyecto
                </a> --}}
                {{-- <a href="#" id="#"
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
                </a> --}}
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
                            <tr class="text-xs text-center hover:bg-gray-200 border-b border-gray-300">
                                <td class="px-4 py-4 border-b border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $proyecto->ci ?? '-' }}</td>
                                <td class="px-4 py-2 border-b border-gray-300 text-left">{{ $proyecto->nombres ?? '-' }}
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    @if ($proyecto->estado == 'E')
                                        <p
                                            class="relative inline-flex items-center px-2 py-1 text-xs border text-green-700 border-green-600 rounded-lg transition-colors">
                                            Efectivo<span
                                                class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 border-2 border-white rounded-full">
                                            </span></p>
                                    @else
                                    @endif

                                </td>
                                <td class="px-4 py-2 border-b border-gray-300">
                                    @if ($proyecto->proyectoGrado)
                                        Proyecto: {{ $proyecto->proyectoGrado->titulo }}
                                    @else
                                        Sin proyecto de grado
                                    @endif
                                </td>



                                {{-- <td class="px-4 py-2 border-b border-gray-300 flex items-center justify-center gap-2">

                                    @if ($proyecto->tutor)

                                    @endif
                                    <a href="{{ route('proyectoGrado.show', $proyecto->idProyecto) }}"
                                        class="text-xs px-2 py-1 border border-slate-600 text-slate-600 rounded hover:bg-slate-600 hover:text-white transition">Ver
                                        Proyecto</a>
                                </td> --}}
                                <td>
                                    @if ($proyecto->proyectoGrado?->tutor == null)
                                        <p
                                            class="relative inline-flex items-center px-2 py-1 text-xs border text-red-700 border-red-600 rounded-lg transition-colors">
                                            Sin tutor</p>
                                    @else
                                        <p
                                            class="relative inline-flex items-center px-2 py-1 text-xs border text-mauve-700 border-mauve-600 rounded-lg transition-colors">
                                            {{ $proyecto->proyectoGrado?->tutor?->nombres . ' ' . $proyecto->proyectoGrado?->tutor?->appaterno }}
                                        </p>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" data-project-modal-open
                                        data-id-estudiante="{{ $proyecto->id_estudiante }}"
                                        data-estudiante="{{ trim(($proyecto->nombres ?? '') . ' ' . ($proyecto->appaterno ?? '') . ' ' . ($proyecto->apmaterno ?? '')) }}"
                                        data-id-curso="{{ optional($proyecto->inscripciones?->first())->id_curso ?? $cursoActual }}"
                                        class="inline-flex items-center gap-2 px-4 py-2 text-sm text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-600 hover:text-white hover:border-blue-600 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                                        <i class="fa-solid fa-box-archive"></i>
                                        Registrar
                                    </button>
                                </td>

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
    <div id="projectModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/60 backdrop-blur-sm p-4">
        <div class="absolute inset-0"></div>
        <div id="projectModalContent"
            class="relative w-full max-w-2xl transform scale-95 opacity-0 transition-all duration-300">
            <div class="bg-white rounded-2xl shadow-2xl border border-slate-200 overflow-hidden">
                <div
                    class="flex items-center justify-between bg-gradient-to-r from-sky-600 to-blue-700 px-6 py-4 text-white">
                    <div>
                        <p class="text-xs uppercase tracking-[0.2em] text-sky-100">Proyecto de grado</p>
                        <h2 class="text-xl font-semibold">Registrar proyecto</h2>
                    </div>
                    <button type="button" data-modal-close aria-label="Cerrar modal"
                        class="flex h-9 w-9 items-center justify-center rounded-full border border-white/30 bg-white/10 text-lg hover:bg-white/20 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <form method="POST" action="{{ route('proyectoGrado.store') }}" class="space-y-5 p-6">
                    @csrf
                    <input type="hidden" name="idEstudiante" id="idEstudiante">
                    <input type="hidden" name="idCurso" id="idCurso" value="{{ $cursoActual }}">
                    <input type="hidden" name="idGestion" value="{{ session('gestion_activa') }}">

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-3">
                        <label
                            class="block text-xs font-semibold uppercase tracking-[0.2em] text-slate-500 mb-1">Estudiante</label>
                        <input type="text" id="studentName" disabled
                            class="w-full border-0 bg-transparent p-0 text-sm text-slate-700 focus:outline-none">
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="titulo" class="block text-sm font-medium text-slate-700 mb-2">Título del
                                proyecto</label>
                            <input type="text" name="titulo" id="titulo" required maxlength="300"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                placeholder="Ej: Sistema de gestión educativa">
                        </div>

                        <div>
                            <label for="idProfesorTutor" class="block text-sm font-medium text-slate-700 mb-2">Tutor</label>
                            <select name="idProfesorTutor" id="idProfesorTutor" required
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100">
                                <option value="">Seleccione un tutor</option>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id_profesor }}">
                                        {{ trim(($profesor->nombres ?? '') . ' ' . ($profesor->appaterno ?? '') . ' ' . ($profesor->apmaterno ?? '')) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="lineaInvestigacion" class="block text-sm font-medium text-slate-700 mb-2">Línea de
                                investigación</label>
                            <input type="text" name="lineaInvestigacion" id="lineaInvestigacion" maxlength="150"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                placeholder="Ej: Tecnología educativa">
                        </div>

                        <div>
                            <label for="fechaInicio" class="block text-sm font-medium text-slate-700 mb-2">Fecha de
                                inicio</label>
                            <input type="date" name="fechaInicio" id="fechaInicio"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100">
                        </div>

                        <div>
                            <label for="fechaDefensa" class="block text-sm font-medium text-slate-700 mb-2">Fecha de
                                defensa</label>
                            <input type="date" name="fechaDefensa" id="fechaDefensa"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100">
                        </div>

                        <div class="md:col-span-2">
                            <label for="descripcion"
                                class="block text-sm font-medium text-slate-700 mb-2">Descripción</label>
                            <textarea name="descripcion" id="descripcion" rows="4"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                placeholder="Describa brevemente el objetivo del proyecto..."></textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label for="observacion"
                                class="block text-sm font-medium text-slate-700 mb-2">Observación</label>
                            <textarea name="observacion" id="observacion" rows="3"
                                class="w-full rounded-xl border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-4 focus:ring-sky-100"
                                placeholder="Detalles relevantes o comentarios del asesor..."></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-200 pt-5">
                        <button type="button" data-modal-close
                            class="px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-sm font-medium text-slate-700 hover:bg-slate-100 transition">
                            <i class="fa-regular fa-circle-xmark mr-2"></i>Cancelar
                        </button>
                        <button type="submit"
                            class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 text-sm font-medium text-white shadow-lg shadow-sky-200 hover:shadow-xl hover:scale-[1.01] transition-all">
                            <i class="fa-regular fa-floppy-disk mr-2"></i>Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('projectModal');
            const modalContent = document.getElementById('projectModalContent');
            const studentName = document.getElementById('studentName');
            const idEstudiante = document.getElementById('idEstudiante');
            const idCurso = document.getElementById('idCurso');

            const closeModal = () => {
                modal.classList.add('hidden');
                modalContent.classList.add('scale-95', 'opacity-0');
                modalContent.classList.remove('scale-100');
            };

            const openModal = (button) => {
                const estudiante = button.dataset.estudiante || 'Estudiante';
                const estudianteId = button.dataset.idEstudiante || '';
                const cursoId = button.dataset.idCurso || idCurso.value || '';

                studentName.value = estudiante;
                idEstudiante.value = estudianteId;
                idCurso.value = cursoId;

                modal.classList.remove('hidden');
                requestAnimationFrame(() => {
                    modalContent.classList.remove('scale-95', 'opacity-0');
                    modalContent.classList.add('scale-100', 'opacity-100');
                });
            };

            document.querySelectorAll('[data-project-modal-open]').forEach((button) => {
                button.addEventListener('click', () => openModal(button));
            });

            document.querySelectorAll('[data-modal-close]').forEach((button) => {
                button.addEventListener('click', closeModal);
            });

            modal.addEventListener('click', (event) => {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeModal();
                }
            });
        });
    </script>
@endsection

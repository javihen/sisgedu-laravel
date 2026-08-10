@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-1 sm:ml-1 w-[calc(100%-30px)] sm:w-[calc(100%-90px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-between items-center">
            <p class="text-white text-sm ml-4">
                <i class='bx bx-list-check mr-2'></i>Listado de Reuniones de Citación
            </p>
        </div>
        {{-- Notificaciones o mensajes de éxito o error --}}
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
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-4 mr-4">
                <div
                    class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif
        {{-- Contenido de la plantilla blade --}}
        <div class="flex justify-center p-4 w-full ">
            <div class="bg-white rounded shadow-lg w-2/3">
                <table class="table-auto border-collapse border border-slate-200 w-full text-xs">
                    <tr class="bg-gray-700 text-white text-center p-2">
                        <td class="py-2">Nro</td>
                        <td>Nombre</td>
                        <td>Cursos</td>

                    </tr>
                    <tbody>
                        @foreach ($profesores as $index => $profesor)
                            <tr>
                                <td class="border border-slate-300 text-center p-2">{{ $index + 1 }}</td>
                                <td class="border border-slate-300 px-2 w-1/2">PROF. {{ $profesor->profesor }}</td>
                                <td class="border border-slate-300 text-center p-2">
                                    @foreach ($profesor->cursos as $curso)
                                        <button type="button"
                                            data-asignacion="{{ $curso->idAsignacion }}"
                                            data-curso="{{ e($curso->nombre) }}"
                                            class="course-open-button border border-green-700 text-green-700 hover:text-white hover:bg-green-700 rounded px-2 py-1 m-1 text-xs cursor-pointer">
                                            {{ $curso->nombre }}
                                        </button>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="courseModal" style="display: none; pointer-events: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl overflow-hidden">
                <div class="flex items-center justify-between border-b px-4 py-3">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Estudiantes citados</h3>
                        <p id="courseModalTitle" class="text-sm text-slate-600"></p>
                    </div>
                    <button type="button" id="closeCourseModal"
                        class="text-slate-500 hover:text-slate-900 text-2xl leading-none">&times;</button>
                </div>
                <div class="px-4 py-4">
                    <div id="courseModalBody" class="space-y-2 text-sm text-slate-800">
                        <p class="text-slate-500">Elige un curso para ver los estudiantes citados.</p>
                    </div>
                </div>
                {{-- <div class="border-t px-4 py-3 flex justify-end">
                    <button type="button" id="closeCourseModalFooter"
                        class="bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded">Cerrar</button>
                </div> --}}
            </div>
        </div>

        <script>
            const courseModal = document.getElementById('courseModal');
            const courseModalTitle = document.getElementById('courseModalTitle');
            const courseModalBody = document.getElementById('courseModalBody');
            const closeCourseModalButton = document.getElementById('closeCourseModal');

            if (closeCourseModalButton) {
                closeCourseModalButton.addEventListener('click', hideCourseModal);
            }

            courseModal.addEventListener('click', (event) => {
                if (event.target === courseModal) {
                    hideCourseModal();
                }
            });

            function hideCourseModal() {
                courseModal.style.display = 'none';
                courseModal.style.pointerEvents = 'none';
            }

            function bindCourseButtons() {
                document.querySelectorAll('.course-open-button').forEach(button => {
                    button.addEventListener('click', () => {
                        const asignacionId = button.dataset.asignacion;
                        const cursoLabel = button.dataset.curso;
                        openCourseModal(asignacionId, cursoLabel);
                    });
                });
            }

            async function openCourseModal(asignacionId, cursoLabel) {
                courseModalTitle.textContent = cursoLabel;
                courseModalBody.innerHTML = '<p class="text-slate-500">Cargando estudiantes citados...</p>';
                courseModal.style.display = 'flex';
                courseModal.style.pointerEvents = 'auto';

                try {
                    const response = await fetch(`{{ route('citacion.profesores') }}?asignacion_id=${asignacionId}`, {
                        headers: {
                            'Accept': 'application/json'
                        },
                    });

                    if (!response.ok) {
                        throw new Error('No se pudo obtener el listado de estudiantes.');
                    }

                    const data = await response.json();
                    const estudiantes = Array.isArray(data.estudiantes) ? data.estudiantes : [];

                    if (estudiantes.length === 0) {
                        courseModalBody.innerHTML =
                            '<p class="text-slate-500">No hay estudiantes citados para este curso.</p>';
                        return;
                    }

                    courseModalBody.innerHTML = estudiantes.map(estudiante => `
                        <div class="rounded border border-slate-200 bg-slate-50 p-3">
                            <p class="font-medium text-slate-900">${estudiante.estudiante}</p>
                            <p class="text-xs text-slate-500">Estado: ${estudiante.estado}</p>
                        </div>
                    `).join('');
                } catch (error) {
                    courseModalBody.innerHTML = `<p class="text-red-500">${error.message}</p>`;
                }
            }
                document.addEventListener('DOMContentLoaded', bindCourseButtons);
                </script>
    </div>

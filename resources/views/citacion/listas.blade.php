@extends('layouts.navhorizontal')

@section('content')
    <div class="w-full px-2 pb-6 pt-2 sm:px-4 lg:pl-[72px] lg:pr-4" style="font-family: 'poppins'">
        <div
            class="mt-2 flex h-auto min-h-12 flex-col gap-2 rounded-md bg-[#38BC9B] px-3 py-2 sm:flex-row sm:items-center sm:justify-between sm:px-4">
            <p class="text-sm text-white">
                <i class='bx bx-list-check mr-2'></i>Listado de Cursos asignados
            </p>
            <div class="flex gap-2">
                {{-- <a href="{{ route('citacion.pdf.general') }}"
                    class="text-white bg-red-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 hover:text-red-600 hover:bg-white hover:border-red-600 transition">
                    <i class='bx bx-file-pdf mr-1'></i>PDF General
                </a>
                <a href="{{ route('citacion.import') }}"
                    class="text-white bg-blue-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    <i class='bx bx-cloud-upload mr-2'></i>Importar
                </a> --}}
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="mt-3 w-full">
                <div
                    class="flex items-center justify-between rounded border border-green-400 bg-green-100 px-4 py-3 text-green-700 shadow-md">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false"
                        class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="mt-3 w-full">
                <div
                    class="flex items-center justify-between rounded border border-red-400 bg-red-100 px-4 py-3 text-red-700 shadow-md">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif

        <div class="mt-4 flex w-full justify-center">
            <div class="w-full overflow-hidden rounded-md bg-white shadow-[0_8px_15px_rgba(0,0,0,0.15)] lg:w-2/3">
                <div class="overflow-x-auto">
                    <table class="w-full md:min-w-[560px] text-sm text-left text-body rtl:text-right">
                        <caption class="p-4 text-left text-lg font-medium text-heading sm:p-5 rtl:text-right">
                            Aula Abierta - 2do Trimestre 2026
                            <p class="mt-1.5 text-[10px] sm:text-sm font-normal text-body">El listado fue asignado desde
                                sistemas
                                si daria
                                el
                                caso de no estar registrado su curso apersonarse por favor con el administrador del sitio.
                            </p>
                        </caption>
                        <thead class="border-b border-t border-default-medium bg-slate-600 text-center text-xs text-white">
                            <tr>
                                <th scope="col" class="px-3 py-3 font-medium sm:px-6 hidden sm:block">
                                    No
                                </th>
                                <th scope="col" class="px-3 py-3 font-medium sm:px-6 w-1/5">
                                    Curso
                                </th>
                                <th scope="col" class="px-3 py-3 font-medium sm:px-6 hidden sm:block">
                                    Area
                                </th>
                                <th scope="col" class="px-3 py-3 font-medium sm:px-6 w-2/5">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($asignaciones as $index => $asignacion)
                                <tr
                                    class="border-b border-slate-200 bg-neutral-primary-soft hover:bg-neutral-primary-medium text-center sm:text-left">
                                    <td class="px-3 py-4 text-center sm:px-6 hidden sm:block">{{ $index + 1 }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 font-medium text-heading sm:px-6">
                                        {{ $asignacion->curso->display_name }}
                                        <p
                                            class="text-xs text-blue-500 border border-blue-500 rounded w-fit px-1 py-0.5 text-center sm:hidden">
                                            {{ $asignacion->materia->area }}</p>
                                    </td>
                                    <td class="px-3 py-4 sm:px-6 hidden md:block">
                                        <p
                                            class="rounded-md border border-green-700 bg-green-700 py-1 text-center text-[10px] font-bold text-white">
                                            {{ $asignacion->materia->area }}</p>
                                    </td>
                                    <td class="px-3 py-4 sm:px-6">
                                        <div class="flex flex-wrap items-center gap-2 justify-center sm:justify-start">
                                            <button type="button"
                                                class="btn-ver-estudiantes rounded border border-blue-600 px-3 py-1.5 text-xs font-medium text-blue-600 transition hover:bg-blue-600 hover:text-white"
                                                data-curso-id="{{ $asignacion->idcurso }}"
                                                data-curso-nombre="{{ $asignacion->curso->display_name }}"
                                                data-id-asignacion="{{ $asignacion->idAsignacion }}">
                                                <i class="fa-solid fa-list-ol"></i><br class="md:hidden"> Estudiantes
                                            </button>
                                            {{-- <a href="{{ route('citacion.pdf.asignacion', ['id' => $asignacion->id]) }}" --}}
                                            @if ($asignacion->citaciones->isNotEmpty() && $asignacion->citaciones->first()->estado === 'CERRADO')
                                                <a href="{{ route('citacion.imprimir-listado', ['idAsignacion' => $asignacion->idAsignacion]) }}"
                                                    target="_blank"
                                                    class="rounded border border-red-600 px-3 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-600 hover:text-red-100">
                                                    <i class="fa-regular fa-file-pdf"></i> Imprimir
                                                </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="modalEstudiantes" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/70 p-4">
        <div class="w-full max-w-3xl rounded-xl bg-white shadow-xl">
            <div class="flex items-center justify-between border-b border-slate-200 px-6 py-4">
                <div>
                    <h3 id="tituloModalEstudiantes" class="text-lg font-semibold text-slate-800">Estudiantes del curso</h3>
                    <p id="subtituloModalEstudiantes" class="text-sm text-slate-500">Cargando información...</p>
                </div>
                <button type="button" id="cerrarModalEstudiantes"
                    class="rounded-full border border-slate-300 px-3 py-1 text-slate-600 hover:bg-slate-100">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div id="contenidoModalEstudiantes" class="max-h-[70vh] overflow-y-auto p-6">
                <p class="text-sm text-slate-500">Seleccione un curso para ver sus estudiantes.</p>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = '{{ csrf_token() }}';
        const modalEstudiantes = document.getElementById('modalEstudiantes');
        const contenidoModalEstudiantes = document.getElementById('contenidoModalEstudiantes');
        const tituloModalEstudiantes = document.getElementById('tituloModalEstudiantes');
        const subtituloModalEstudiantes = document.getElementById('subtituloModalEstudiantes');

        const abrirModalEstudiantes = (cursoId, cursoNombre, asignacionId) => {
            tituloModalEstudiantes.textContent = 'Estudiantes del curso';
            subtituloModalEstudiantes.textContent = cursoNombre || 'Curso';
            contenidoModalEstudiantes.innerHTML = '<p class="text-sm text-slate-500">Cargando estudiantes...</p>';
            modalEstudiantes.classList.remove('hidden');
            modalEstudiantes.classList.add('flex');

            // Cambio: se abre el modal con la asignación concreta para no mezclar sesiones entre materias del mismo curso.
            const ruta = asignacionId ? `/citacion/asignacion/${asignacionId}/estudiantes` :
                `/citacion/curso/${cursoId}/estudiantes`;

            fetch(ruta)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('No se pudo cargar la información');
                    }
                    return response.text();
                })
                .then(html => {
                    contenidoModalEstudiantes.innerHTML = html;
                })
                .catch(() => {
                    contenidoModalEstudiantes.innerHTML =
                        '<p class="text-sm text-red-600">No se pudo cargar la lista de estudiantes.</p>';
                });
        };

        const cerrarModalEstudiantes = () => {
            modalEstudiantes.classList.add('hidden');
            modalEstudiantes.classList.remove('flex');
        };

        document.querySelectorAll('.btn-ver-estudiantes').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                abrirModalEstudiantes(this.dataset.cursoId, this.dataset.cursoNombre, this.dataset
                    .idAsignacion);
            });
        });

        document.getElementById('cerrarModalEstudiantes').addEventListener('click', cerrarModalEstudiantes);
        modalEstudiantes.addEventListener('click', function(event) {
            if (event.target === modalEstudiantes) {
                cerrarModalEstudiantes();
            }
        });

        document.addEventListener('click', function(event) {
            const citarButton = event.target.closest('.btn-citar-estudiante');
            if (citarButton) {
                const idEstudiante = citarButton.dataset.idEstudiante;
                const idProfesor = citarButton.dataset.idProfesor;
                const idAsignacion = citarButton.dataset.idAsignacion;

                if (!idEstudiante || !idProfesor || !idAsignacion) {
                    alert('Faltan datos para registrar la citación.');
                    return;
                }

                citarButton.disabled = true;
                citarButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Procesando...';
                citarButton.className =
                    'btn-citar-estudiante rounded-full border border-orange-300 bg-orange-100 px-3 py-1.5 text-xs font-semibold text-orange-700 transition';

                // Cambio: se usa la ruta de alternancia para registrar o quitar al estudiante de detalle_citaciones.
                fetch('/citacion/toggle-registro', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            idEstudiante,
                            idAsignacion,
                            _token: csrfToken
                        })
                    })
                    .then(async response => {
                        const text = await response.text();
                        let data = {};

                        try {
                            data = text ? JSON.parse(text) : {};
                        } catch (error) {
                            data = {
                                raw: text
                            };
                        }

                        if (!response.ok) {
                            throw new Error(data.message || 'Error al procesar la solicitud');
                        }

                        return data;
                    })
                    .then(data => {
                        if (data.success) {
                            const isRemoved = Boolean(data.removed);
                            citarButton.innerHTML =
                                `<i class="fa-solid ${isRemoved ? 'fa-user-plus' : 'fa-check'} mr-1"></i> ${isRemoved ? 'Disponible' : 'Citado'}`;
                            citarButton.className =
                                `btn-citar-estudiante rounded-full border px-3 py-1.5 text-xs font-semibold transition ${isRemoved ? 'border-slate-300 bg-slate-100 text-slate-600 hover:bg-slate-200' : 'border-emerald-400 bg-emerald-500 text-white'}`;
                        } else {
                            citarButton.innerHTML =
                                '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Error';
                            citarButton.className =
                                'btn-citar-estudiante rounded-full border border-red-300 bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition';
                        }
                    })
                    .catch((error) => {
                        console.error('Error toggle registro', error);
                        citarButton.innerHTML = '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Error';
                        citarButton.className =
                            'btn-citar-estudiante rounded-full border border-red-300 bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition';
                    })
                    .finally(() => {
                        citarButton.disabled = false;
                    });
            }

            const cerrarButton = event.target.closest('.btn-cerrar-sesion');
            if (cerrarButton) {
                const idAsignacion = cerrarButton.dataset.idAsignacion;

                if (!idAsignacion) {
                    alert('No hay asignación para cerrar la sesión.');
                    return;
                }

                cerrarButton.disabled = true;
                cerrarButton.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-1"></i> Cerrando...';

                fetch('/citacion/cerrar-sesion', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            idAsignacion,
                            _token: csrfToken
                        })
                    })
                    .then(async response => {
                        const text = await response.text();
                        let data = {};

                        try {
                            data = text ? JSON.parse(text) : {};
                        } catch (error) {
                            data = {
                                raw: text
                            };
                        }

                        if (!response.ok) {
                            throw new Error(data.message || 'Error al procesar la solicitud');
                        }

                        return data;
                    })
                    .then(data => {
                        if (data.success) {
                            // Cambio: al cerrar la sesión, se vuelve a cargar el modal para mostrar el botón de impresión y ocultar las acciones de citar.
                            cerrarButton.innerHTML = '<i class="fa-solid fa-lock mr-1"></i> Cerrado';
                            cerrarButton.className =
                                'btn-cerrar-sesion rounded-full border border-red-400 bg-red-500 px-3 py-1.5 text-xs font-semibold text-white transition';
                            const cursoId = cerrarButton.dataset.cursoId;
                            const cursoNombre = cerrarButton.dataset.cursoNombre;
                            if (cursoId) {
                                abrirModalEstudiantes(cursoId, cursoNombre || 'Curso');
                            }
                        } else {
                            cerrarButton.innerHTML =
                                '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Error';
                            cerrarButton.className =
                                'btn-cerrar-sesion rounded-full border border-red-300 bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition';
                        }
                    })
                    .catch((error) => {
                        console.error('Error cerrar', error);
                        cerrarButton.innerHTML = '<i class="fa-solid fa-triangle-exclamation mr-1"></i> Error';
                        cerrarButton.className =
                            'btn-cerrar-sesion rounded-full border border-red-300 bg-red-100 px-3 py-1.5 text-xs font-semibold text-red-700 transition';
                    })
                    .finally(() => {
                        cerrarButton.disabled = false;
                    });
            }
        });

        // Implementar SweetAlert para eliminar citaciones
        document.querySelectorAll('.form-eliminar').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Se eliminará la citación de forma permanente.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

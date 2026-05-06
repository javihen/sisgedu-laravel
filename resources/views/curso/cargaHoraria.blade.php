@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">Plan de estudio</p>
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
                                                                    @php
                                                                        // Construimos el nombre descriptivo para mostrar al usuario
                                                                        $nombreCompleto =
                                                                            (is_numeric($grado)
                                                                                ? $grado . 'º'
                                                                                : $grado) .
                                                                            ' ' .
                                                                            $paralelo .
                                                                            ' - ' .
                                                                            ($niveles[$nivel] ?? 'Nivel ' . $nivel) .
                                                                            ' (' .
                                                                            ($turnos[$turno] ?? $turno) .
                                                                            ')';
                                                                    @endphp
                                                                    <span
                                                                        class="border text-xs border-gray-600 w-8 h-8 rounded-full flex items-center justify-center text-center cursor-pointer hover:bg-slate-100 transition"
                                                                        onclick="selectParalelo('{{ $turno }}', '{{ $nivel }}', '{{ $grado }}', '{{ $paralelo }}', '{{ $nombreCompleto }}')">
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
                document.addEventListener('DOMContentLoaded', function() {
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
                });

                // Variables globales para mantener el estado del curso seleccionado
                let currentParams = {};

                function eliminarAsignacion(idCursoMateria) {
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "Se eliminará la asignación de forma permanente.",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Sí, eliminar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const formData = new FormData();
                            formData.append('_method', 'DELETE');
                            formData.append('_token', '{{ csrf_token() }}');

                            fetch(`/curso-materia/${idCursoMateria}`, {
                                    method: 'POST',
                                    body: formData
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: '¡Éxito!',
                                            text: 'Asignación eliminada correctamente.',
                                            icon: 'success',
                                            confirmButtonText: 'Entendido'
                                        }).then(() => {
                                            // Recargar asignaciones
                                            selectParalelo(currentParams.turno, currentParams.nivel,
                                                currentParams.grado, currentParams
                                                .paralelo, document.getElementById('cursoSeleccionado')
                                                .innerText.split(': ')[1]);
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error',
                                            text: data.message || 'No se pudo eliminar la asignación.',
                                            icon: 'error',
                                            confirmButtonText: 'Entendido'
                                        });
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Error al eliminar la asignación.',
                                        icon: 'error',
                                        confirmButtonText: 'Entendido'
                                    });
                                });
                        }
                    });
                }

                function registrarMateria() {
                    const idCurso = document.getElementById('idCurso').value;
                    const idMateria = document.getElementById('id_materia').value;
                    const horasMes = document.getElementById('horas_mes').value;

                    if (!idCurso) {
                        alert('Por favor, seleccione un paralelo desde el árbol de cursos.');
                        return;
                    }
                    if (!idMateria) {
                        alert('Por favor, seleccione una materia.');
                        return;
                    }
                    if (!horasMes) {
                        alert('Por favor, seleccione las horas.');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('idCurso', idCurso);
                    formData.append('id_materia', idMateria);
                    formData.append('horas_mes', horasMes);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('curso-materia.store') }}', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                // Recargar asignaciones
                                selectParalelo(currentParams.turno, currentParams.nivel, currentParams.grado, currentParams
                                    .paralelo, document.getElementById('cursoSeleccionado').innerText.split(': ')[1]);
                            } else {
                                alert('Error: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al registrar la materia.');
                        });
                }

                // Función para obtener color pastel basado en el campo
                function getColorByCampo(campo) {
                    const colores = [
                        'bg-red-100', // Rojo pastel
                        'bg-orange-100', // Naranja pastel
                        'bg-yellow-100', // Amarillo pastel
                        'bg-emerald-100', // Verde pastel
                        'bg-blue-100', // Azul pastel
                        'bg-violet-100' // Violeta pastel
                    ];

                    // Crear hash simple del campo
                    let hash = 0;
                    for (let i = 0; i < campo.length; i++) {
                        hash = ((hash << 5) - hash) + campo.charCodeAt(i);
                        hash = hash & hash; // Convertir a entero de 32 bits
                    }

                    return colores[Math.abs(hash) % colores.length];
                }

                function selectParalelo(turno, nivel, grado, paralelo, nombreCurso) {
                    currentParams = {
                        turno,
                        nivel,
                        grado,
                        paralelo
                    };
                    // Actualizar el texto del curso seleccionado
                    document.getElementById('cursoSeleccionado').innerText = 'Curso: ' + nombreCurso;
                    // Limpiar el id de curso oculto hasta que cargue
                    document.getElementById('idCurso').value = '';

                    const tbody = document.getElementById('asignaciones-tbody');
                    tbody.innerHTML =
                        '<tr class="bg-white"><td colspan="3" class="px-6 py-4 text-center text-gray-600">Cargando...</td></tr>';

                    const url = '{{ route('asignacion.getAsignacionesCurso') }}' +
                        '?turno=' + encodeURIComponent(turno) +
                        '&nivel=' + encodeURIComponent(nivel) +
                        '&grado=' + encodeURIComponent(grado) +
                        '&paralelo=' + encodeURIComponent(paralelo);

                    fetch(url)
                        .then(response => response.json().then(data => ({
                            status: response.status,
                            data
                        })))
                        .then(({
                            status,
                            data
                        }) => {
                            if (status !== 200 || data.error) {
                                tbody.innerHTML =
                                    '<tr class="bg-white"><td colspan="4" class="px-6 py-4 text-center text-red-600">No se encontró el curso o no hay asignaciones.</td></tr>';
                                return;
                            }
                            // Setear idCurso en el hidden
                            document.getElementById('idCurso').value = data.idCurso;
                            if (!Array.isArray(data.asignaciones) || data.asignaciones.length === 0) {
                                tbody.innerHTML =
                                    '<tr class="bg-white"><td colspan="4" class="px-6 py-4 text-center text-gray-600">No hay asignaciones para este curso.</td></tr>';
                                return;
                            }
                            const rows = data.asignaciones.map(item => {
                                const tieneProfesor = item.prof_nombres != null;
                                const profLabel = tieneProfesor ?
                                    `${item.prof_appaterno} ${item.prof_nombres}` :
                                    'Sin Profesor';
                                const btnColorClass = tieneProfesor ?
                                    'border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white' :
                                    'border-red-500 bg-red-500 text-red-500 hover:bg-white hover:text-red-500';

                                return `
                                <tr class="${getColorByCampo(item.campo)} border-b border-gray-400 hover:opacity-80 text-center transition">
                                    <td class="px-4">${item.campo}</td>
                                    <td class="px-4">
                                        <span class="border border-slate-400 px-2 py-1 bg-white rounded">${item.area} (${item.abreviatura})</span>
                                    </td>
                                    <td class="px-4 font-bold text-lg">${item.horas_mes} <i class="fa-regular fa-clock"></i></td>
                                    <td class="px-4 text-left">
                                        <button onclick="eliminarAsignacion(${item.idCursoMateria})" class="py-2 px-3 border border-red-500 bg-white my-2 rounded-sm text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                                            <i class="fa-regular fa-trash-can"></i> Eliminar
                                        </button>
                                        <button  onclick="abrirModalProfesor('${data.idCurso}', '${item.idMateria}', '${item.area}')"
                                                class="py-2 px-3 border bg-white w-50 text-left my-2 rounded-sm cursor-pointer transition ${btnColorClass}">
                                            <i class="fa-solid fa-chalkboard-user"></i> ${profLabel}
                                        </button>
                                    </td>
                                </tr>
                            `;
                            }).join('');

                            // Calcular suma total de horas
                            const totalHoras = data.asignaciones.reduce((sum, item) => sum + parseInt(item.horas_mes), 0);
                            const totalRow = `
                                <tr class="bg-slate-200 border-t-2 border-slate-600 font-bold text-center">
                                    <td colspan="2" class="px-4 py-3">TOTAL</td>
                                    <td class="px-4 py-3 font-bold text-lg">${totalHoras} <i class="fa-regular fa-clock"></i></td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                            `;
                            tbody.innerHTML = rows + totalRow;
                        })
                        .catch(error => {
                            console.error('Error al cargar asignaciones:', error);
                            tbody.innerHTML =
                                '<tr class="bg-white"><td colspan="4" class="px-6 py-4 text-center text-red-600">Error al cargar las asignaciones.</td></tr>';
                        });

                }

                function abrirModalProfesor(idCurso, idMateria, areaMateria) {
                    document.getElementById('modal_idCurso').value = idCurso;
                    document.getElementById('modal_idMateria').value = idMateria;
                    document.getElementById('modalTitle').innerText = 'Asignar Profesor: ' + areaMateria;
                    document.getElementById('modalProfesor').classList.remove('hidden');
                }

                function cerrarModal() {
                    document.getElementById('modalProfesor').classList.add('hidden');
                }

                function guardarAsignacion() {
                    const idCurso = document.getElementById('modal_idCurso').value;
                    const idMateria = document.getElementById('modal_idMateria').value;
                    const idProfesor = document.getElementById('modal_idProfesor').value;

                    if (!idProfesor) {
                        alert('Por favor, seleccione un profesor.');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('idcurso[]', idCurso);
                    formData.append('id_materia', idMateria);
                    formData.append('id_profesor', idProfesor);
                    formData.append('_token', '{{ csrf_token() }}');

                    fetch('{{ route('asignacion.store') }}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            cerrarModal();
                            selectParalelo(currentParams.turno, currentParams.nivel, currentParams.grado, currentParams
                                .paralelo, document.getElementById('cursoSeleccionado').innerText.split(': ')[1]);
                        })
                        .catch(error => console.error('Error:', error));
                }
            </script>

            <div class=" w-3/4 bg-white h-fit rounded border px-4 py-1">
                <div>
                    <form class="space-y-4" id="formularioAsignacion" action="{{ route('curso-materia.store') }}"
                        method="post" class="form-adicionar">
                        @csrf
                        <input type="hidden" name="idCurso" id="idCurso" value="">

                        <div class="flex flex-row gap-1 mb-2">
                            <div class="basis-1/3 flex flex-col ">
                                <label for="id_materia" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Area /
                                    Materia
                                </label>
                                <select name="id_materia" id="id_materia"
                                    class="border border-slate-600 bg-white p-2 rounded-md w-full"
                                    onchange="filterCursos()">
                                    <option value="">-- Seleccione una materia --</option>
                                    @foreach ($materias as $materia)
                                        <option value="{{ $materia->id_materia }}"
                                            @if ($selectedMateria == $materia->id_materia) selected @endif>
                                            {{ $materia->area }} ({{ $materia->abreviatura }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="basis-1/3 flex flex-col ">
                                <label for="id_materia" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Horas
                                </label>
                                <select name="horas_mes" id="horas_mes"
                                    class="border border-slate-600 bg-white p-2 rounded-md w-full">
                                    <option value="">-- Seleccione horas --</option>
                                    <option value="8">8 hrs</option>
                                    <option value="12">12 Hrs</option>
                                    <option value="16">16 Hrs</option>
                                    <option value="20">20 Hrs</option>
                                    <option value="24">24 Hrs</option>
                                    <option value="28">28 Hrs</option>
                                    <option value="32">32 Hrs</option>
                                    <option value="36">36 Hrs</option>
                                    <option value="40">40 Hrs</option>
                                    <option value="44">44 Hrs</option>
                                    <option value="48">48 Hrs</option>
                                </select>
                            </div>

                            <div class="basis-1/3 flex flex-col">
                                <input type="button" value="Registrar" onclick="registrarMateria()"
                                    class="border border-green-600 bg-white text-green-600 p-2 rounded-md w-full cursor-pointer hover:bg-green-700 hover:text-white transition top-4 relative">
                            </div>

                        </div>

                    </form>

                    <span id="cursoSeleccionado" class="font-bold text-lg">Curso: Ninguno</span>
                    <div
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default mb-12">
                        <table class="w-full text-xs text-left rtl:text-right text-body ">
                            <thead
                                class="text-xs text-body bg-neutral-secondary-medium border-b border-default-medium bg-slate-600 text-white">
                                <tr class="text-center">
                                    <th scope="col" class="px-6 py-3 font-medium w-1/8">Campo</th>
                                    <th scope="col" class="px-6 py-3 font-medium w-1/3">Materias</th>
                                    <th scope="col" class="px-6 py-3 font-medium w-1/8">Horas</th>
                                    <th scope="col" class="px-6 py-3 font-medium w-1/4">Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="asignaciones-tbody">
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-600">Seleccione un paralelo
                                        para ver las asignaciones.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    {{-- <div class="mt-4 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                            Seleccione una materia para ver la tabla de cursos y asignar profesor.
                        </div> --}}




                </div>

            </div>
        </div>

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

    <!-- Modal para Asignar Profesor -->
    <div id="modalProfesor" class="fixed inset-0 bg-gray-600/50 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg leading-6 font-bold text-gray-900 text-center" id="modalTitle">Asignar Profesor</h3>
                <div class="mt-4 px-2">
                    <input type="hidden" id="modal_idCurso">
                    <input type="hidden" id="modal_idMateria">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seleccione Docente</label>
                        <select id="modal_idProfesor"
                            class="block w-full border border-gray-300 rounded-md shadow-sm p-2 text-sm">
                            <option value="">-- Seleccione un profesor --</option>
                            @foreach ($profesores as $p)
                                <option value="{{ $p->id_profesor }}">{{ $p->appaterno }} {{ $p->apmaterno }}
                                    {{ $p->nombres }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex flex-col gap-2 mt-4">
                    <button onclick="guardarAsignacion()"
                        class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700">Asignar</button>
                    <button onclick="cerrarModal()"
                        class="px-4 py-2 bg-gray-100 text-gray-700 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-200">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

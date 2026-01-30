@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div
            class="sticky top-0 z-1 ml-3 w-full mt-2 h-12 bg-[#3B82F6] rounded-md flex justify-between items-center pl-2 pr-2 ">
            <div>
                <a href="" id="openListadoEstudiantes"
                    class="py-1 px-2 rounded text-slate-700 border text-md border-slate-700 bg-white"><i
                        class="fa-regular fa-address-book"></i></a>
                <a href="{{ route('estudiante.reportePDF', $curso->id) }}" id="reportePDF"
                    class="py-1 px-2 rounded text-slate-700 border text-md border-slate-700 bg-white" target="_blank"><i
                        class="fa-regular fa-file-pdf"></i></a>
                <a href="" class="py-1 px-2 rounded text-green-700 border border-green-700 bg-white"><i
                        class="fa-regular fa-file-excel"></i></a>
                <a href="" id="openasistenciaModal"
                    class="text-xs py-[7px] px-2 rounded text-slate-700 border border-slate-700 bg-white"><i
                        class="fa-solid fa-list-check"></i> Nueva asistencia </a>
            </div>
            {{-- <div class="bg-white w-fit px-4 text-center rounded-md">
                <p class="text-md italic uppercase">Comunicacion y Lenguajes: Lengua originaria</p>
                <p class="text-[10px]">Prof. Lourdes Mamani Chipana</p>

            </div> --}}
            <div class="bg-white w-72 text-center rounded-md">
                <p class="text-md ">{{ $curso->display_name }}</p>
                <p class="text-[10px]">Asistencia del curso</p>
            </div>
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

        <div class=" ml-3 w-full mt-2  flex flex-col gap-1 ">
            <div class="bg-white w-full  border border-slate-300 rounded-md">
                <table class="w-full ">
                    <tr class="bg-[#64748B] text-white text-sm text-center h-20 sticky top-12">
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Estudiante</td>
                        <td>Genero</td>
                        <td class="w-30">Estado</td>
                        <td class="p-0 w-0">
                            <div class="flex flex-col-reverse [writing-mode:vertical-rl] text-[10px]">
                                <span class="my-2">02/02/2026</span>
                                <span class="my-2">03/02/2026</span>
                                <span class="my-2">02/02/2026</span>
                                <span class="my-2">02/02/2026</span>
                                <span class="my-2">02/02/2026</span>
                                <span class="my-2">02/02/2026</span>
                            </div>
                        </td>
                        <td>Opciones</td>
                    </tr>
                    @foreach ($estudiantes as $estudiante)
                        <tr class="text-sm text-center border-t border-slate-400 hover:bg-slate-200">
                            <td class="h-8">{{ $loop->iteration }}</td>
                            <td>{{ $estudiante->id_estudiante }}</td>
                            <td class="text-left">{{ $estudiante->appaterno }} {{ $estudiante->apmaterno }}
                                {{ $estudiante->nombres }}</td>

                            <td>
                                @if ($estudiante->genero == 'M')
                                    <p class="border border-blue-500 bg-white text-blue-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle"
                                        data-id="{{ $estudiante->id_estudiante }}">
                                        <i class="fa-solid fa-person"></i>
                                    </p>
                                @else
                                    <p class="border border-pink-500 bg-white text-pink-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle"
                                        data-id="{{ $estudiante->id_estudiante }}">
                                        <i class="fa-solid fa-person-dress"></i>
                                    </p>
                                @endif
                            </td>
                            <td>
                                @if ($estudiante->estado === 'E')
                                    <a href="#"
                                        class="px-2 py-1 my-2 text-xs text-green-500 border border-green-500 rounded w-fit hover:bg-green-500 hover:text-white hover:cursor-pointer">
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
                            <td class="flex flex-row gap-1 pt-3">
                                <p
                                    class="border inline-block hover:bg-green-500 hover:text-white hover:cursor-pointer border-green-500 text-green-500 m-auto w-fit h-fit px-2 py-1 text-xs  rounded  ">
                                    P
                                </p>
                                <p
                                    class="border inline-block hover:bg-red-500 hover:text-white hover:cursor-pointer border-red-500 text-red-500 m-auto w-fit h-fit px-2 py-1 text-xs  rounded  ">
                                    F
                                </p>
                                <p
                                    class="border inline-block border-blue-500 text-blue-500 m-auto w-fit h-fit px-2 py-1 text-xs  rounded  ">
                                    L
                                </p>
                                <p
                                    class="border inline-block border-amber-500 text-amber-500 m-auto w-fit h-fit px-2 py-1 text-xs  rounded  ">
                                    A
                                </p>
                                <p
                                    class="border inline-block border-red-500 text-red-500 m-auto w-fit h-fit px-2 py-1 text-xs  rounded  ">
                                    F
                                </p>
                                <p
                                    class="border inline-block border-red-500 text-red-500 m-auto w-fit h-fit px-2 py-1 text-xs  rounded  ">
                                    F
                                </p>
                            </td>



                            <td class="h-12">
                                <a href="#"
                                    class="bg-slate-700 text-white px-2 py-2 rounded hover:text-slate-700 hover:bg-white border-2 border-slate-700 "><i
                                        class="fa-solid fa-list-check"></i></a>
                                <a href="#"
                                    class="bg-slate-900 text-white px-2 py-2 rounded hover:text-slate-900 hover:bg-white border-2 border-slate-bg-slate-900 "><i
                                        class="fa-solid fa-book"></i> Calificaciones</a>

                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
            <div class="flex justify-end bg-white w-full  border border-slate-300 rounded-md mb-16 h-30">
                <div class="flex my-auto flex-col mr-2">
                    <a href=""
                        class="py-1 px-2 rounded mb-2 text-center text-slate-700 border text-md border-slate-700 bg-white"><i
                            class="fa-regular fa-address-book"></i> Adicionar estudiante</a>

                    <a href=""
                        class="py-1 px-2 rounded text-center text-green-700 border border-green-700 bg-white"><i
                            class="fa-regular fa-file-excel"></i> Generar archivo</a>
                </div>
            </div>
        </div>

        {{-- Modal para registrar asistencia --}}
        <div id="modal"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50"
            style="display: none;">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[800px] p-4 transform transition-all scale-100 opacity-100">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">REGISTRO DE ASISTENCIA</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formularioAsistencia" method="post">
                    @csrf
                    <input type="hidden" name="idCurso" id="inputIdCurso" value="{{ $curso->id }}">
                    <input type="hidden" name="id_gestion" id="inputIdGestion" value="">

                    <div class="flex flex-row mt-4 gap-4">
                        <div class="basis-1/2">
                            <label for="fechaAsistencia" class="text-xs relative top-3 left-3 bg-white px-2">Fecha</label>
                            <input type="date" name="fecha" id="fechaAsistencia"
                                class="w-full border border-slate-700 rounded-md p-2" required>
                        </div>
                        <div class="basis-1/2 flex flex-col mt-2">
                            <label for="horaAsistencia"
                                class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Hora</label>
                            <input type="time" name="hora" id="horaAsistencia"
                                class="border border-slate-600 bg-white p-2 rounded-md" required>
                        </div>
                    </div>

                    <div class="flex flex-col hidden ">
                        <label for="descripcionAsistencia"
                            class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Descripción</label>
                        <textarea name="descripcion" id="descripcionAsistencia" class="border border-slate-600 bg-white p-2 rounded-md"
                            rows="2"></textarea>
                    </div>

                    <hr class="border border-slate-200 mb-4">
                    <p class="font-semibold">Listado de estudiantes inscritos</p>

                    <!-- Tabla de estudiantes para asistencia -->
                    <div class="overflow-auto max-h-96 border border-slate-300 rounded-md">
                        <table class="w-full">
                            <thead class="bg-[#64748B] text-white text-sm sticky top-0">
                                <tr>
                                    <td class="py-2 px-2 text-center">Nro</td>
                                    <td class="py-2 px-2">Código</td>
                                    <td class="py-2 px-2">RUDE</td>
                                    <td class="py-2 px-2">Estudiante</td>
                                    <td class="py-2 px-2 text-center">Estado</td>
                                    <td class="py-2 px-2">Observación</td>
                                </tr>
                            </thead>
                            <tbody id="tablaAsistenciaBody">
                                <!-- Se llenará con JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 border border-gray-300 rounded-md w-1/4 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cancelar</button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-blue-600 text-white w-1/4 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Registrar
                            asistencia</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modalListado" class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
            style="display: none;" data-curso-id="{{ $curso->id }}">
            <!-- Contenedor del modal -->
            <div id="modalListadoContent" class="bg-white rounded-md shadow-lg w-[800px] p-4 transform transition-all">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left">LISTADO DE ESTUDIANTES</h2>
                <hr class="border border-slate-200 mb-4">

                <!-- Input de búsqueda -->
                <div class="mb-4">
                    <input type="text" id="inputBusqueda" placeholder="Buscar por nombre, RUDE o código..."
                        class="w-full border border-slate-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tabla de estudiantes -->
                <div class="overflow-auto max-h-96 border border-slate-300 rounded-md">
                    <table class="w-full">
                        <thead class="bg-[#64748B] text-white text-sm sticky top-0">
                            <tr>
                                <th class="py-2 px-2 text-center w-10">
                                    {{-- <input type="checkbox" id="checkboxSelectAll" class="cursor-pointer"> --}}
                                </th>
                                <th class="py-2 px-2 text-left">Codigo</th>
                                <th class="py-2 px-2 text-left">Rude</th>
                                <th class="py-2 px-2 text-left">Nombre Completo</th>
                                <th class="py-2 px-2 text-center">Genero</th>
                                <th class="py-2 px-2 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEstudiantesBody">
                            <!-- Se llena dinamicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>

                <hr class="border-slate-200 border mt-4">

                <!-- Botones -->
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" id="closeModalListado"
                        class="px-4 py-2 border border-gray-300 rounded-md w-1/4 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cerrar</button>
                    <button type="button" id="btnSeleccionarEstudiantes"
                        class="px-4 py-2 bg-blue-600 text-white w-1/4 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Registrarlos</button>
                </div>
            </div>
        </div>




    </div>

    <script>
        document.getElementById('openasistenciaModal').addEventListener('click', function(e) {
            e.preventDefault();
            const modal = document.getElementById('modal');
            modal.style.display = 'flex';

            const modalContent = document.getElementById('modalContent');
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);

            // Establecer fecha y hora actual por defecto
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            document.getElementById('fechaAsistencia').value = `${year}-${month}-${day}`;
            document.getElementById('horaAsistencia').value = `${hours}:${minutes}`;

            // Cargar estudiantes inscritos en el curso
            cargarEstudiantesInscritosParaAsistencia();
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.style.display = 'none';
            }, 200);
        });

        // Cargar estudiantes inscritos para el formulario de asistencia
        function cargarEstudiantesInscritosParaAsistencia() {
            const idCurso = document.getElementById('inputIdCurso').value;

            fetch('{{ route('asistencia.inscritos', ['idCurso' => $curso->id]) }}')
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('tablaAsistenciaBody');
                    tbody.innerHTML = '';

                    data.forEach((inscripcion, index) => {
                        const estudiante = inscripcion.estudiante;
                        const row = document.createElement('tr');
                        row.className = 'border-t border-slate-400 hover:bg-slate-100';
                        row.innerHTML = `
                            <td class="py-2 px-2 text-center text-sm">${index + 1}</td>
                            <td class="py-2 px-2 text-sm">${estudiante.id_estudiante}</td>
                            <td class="py-2 px-2 text-sm">${estudiante.rude || '-'}</td>
                            <td class="py-2 px-2 text-sm">${estudiante.appaterno} ${estudiante.apmaterno} ${estudiante.nombres}</td>
                            <td class="py-2 px-2 text-center">
                                <button type="button" class="btn-asistencia w-8 h-8 rounded-full border border-green-500 bg-green-100 flex items-center justify-center mx-auto cursor-pointer transition-colors" data-id="${estudiante.id_estudiante}" data-state="P">
                                    <i class="fa-solid fa-p text-green-600"></i>
                                </button>
                            </td>
                            <td class="py-2 px-2">
                                <input type="text" name="observacion_${estudiante.id_estudiante}" placeholder="Obs."
                                    class="w-full border border-slate-300 rounded p-1 text-sm">
                            </td>
                        `;
                        tbody.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error cargando estudiantes:', error);
                    alert('Error al cargar los estudiantes inscritos');
                });
        }

        // Delegación de eventos para el botón de asistencia (Cambio de estado P -> F -> R -> P)
        document.getElementById('tablaAsistenciaBody').addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-asistencia');
            if (btn) {
                const currentState = btn.getAttribute('data-state');
                let newState, newClass, newIcon;

                if (currentState === 'P') {
                    newState = 'F';
                    newClass =
                        'btn-asistencia w-8 h-8 rounded-full border border-red-500 bg-red-100 flex items-center justify-center mx-auto cursor-pointer transition-colors';
                    newIcon = '<i class="fa-solid fa-f text-red-600"></i>';
                } else if (currentState === 'F') {
                    newState = 'R';
                    newClass =
                        'btn-asistencia w-8 h-8 rounded-full border border-yellow-500 bg-yellow-100 flex items-center justify-center mx-auto cursor-pointer transition-colors';
                    newIcon = '<i class="fa-solid fa-a text-yellow-600"></i>';
                } else {
                    newState = 'P';
                    newClass =
                        'btn-asistencia w-8 h-8 rounded-full border border-green-500 bg-green-100 flex items-center justify-center mx-auto cursor-pointer transition-colors';
                    newIcon = '<i class="fa-solid fa-p text-green-600"></i>';
                }

                btn.setAttribute('data-state', newState);
                btn.className = newClass;
                btn.innerHTML = newIcon;
            }
        });

        // Manejar envío del formulario de asistencia
        document.getElementById('formularioAsistencia').addEventListener('submit', function(e) {
            e.preventDefault();

            const fecha = document.getElementById('fechaAsistencia').value;
            const hora = document.getElementById('horaAsistencia').value;
            const descripcion = document.getElementById('descripcionAsistencia').value;
            const idCurso = document.getElementById('inputIdCurso').value;

            if (!fecha || !hora) {
                alert('Por favor completa los campos de fecha y hora');
                return;
            }

            // Recopilar datos de asistencia
            const detalles = [];
            const filas = document.querySelectorAll('#tablaAsistenciaBody tr');

            filas.forEach(fila => {
                const btn = fila.querySelector('.btn-asistencia');
                const textInput = fila.querySelector('input[type="text"]');

                if (btn) {
                    detalles.push({
                        idEstudiante: btn.getAttribute('data-id'),
                        estado: btn.getAttribute('data-state'),
                        observacion: textInput ? textInput.value : ''
                    });
                }
            });

            if (detalles.length === 0) {
                alert('Por favor selecciona al menos una asistencia');
                return;
            }

            // Enviar datos al servidor
            fetch('{{ route('asistencia.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        fecha: fecha,
                        hora: hora,
                        descripcion: descripcion,
                        idCurso: idCurso,
                        detalles: detalles
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Asistencia registrada correctamente');
                        document.getElementById('modal').style.display = 'none';
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al registrar la asistencia');
                });
        });

        // Abrir modal de listado
        document.getElementById('openListadoEstudiantes').addEventListener('click', function(e) {
            e.preventDefault();
            const modal = document.getElementById('modalListado');
            modal.classList.remove('hidden');

            // Cargar los estudiantes
            cargarEstudiantes();
        });

        // Cerrar modal de listado
        document.getElementById('closeModalListado').addEventListener('click', function() {
            document.getElementById('modalListado').classList.add('hidden');
        });

        // Cargar estudiantes vía AJAX
        function cargarEstudiantes() {
            fetch('{{ route('estudiante.api.all') }}')
                .then(response => response.json())
                .then(data => {
                    // Guardar datos en una variable global para filtrado
                    window.estudiantes_data = data;

                    const tbody = document.getElementById('tablaEstudiantesBody');
                    tbody.innerHTML = ''; // Limpiar tabla

                    data.forEach((estudiante, index) => {
                        const row = document.createElement('tr');
                        row.className = 'border-t border-slate-400 hover:bg-slate-100';
                        row.addEventListener('click', function() {
                            toggleCheckbox(this);
                        });
                        row.setAttribute('data-codigo', estudiante.id_estudiante.toLowerCase());
                        row.setAttribute('data-rude', (estudiante.rude || '').toLowerCase());
                        row.setAttribute('data-nombre', (estudiante.appaterno + ' ' + estudiante.apmaterno +
                            ' ' + estudiante.nombres).toLowerCase());

                        const generoIcon = estudiante.genero === 'M' ?
                            '<i class="fa-solid fa-person"></i>' :
                            '<i class="fa-solid fa-person-dress"></i>';

                        const estadoClase = estudiante.estado === 'E' ? 'text-green-500' :
                            estudiante.estado === 'R' ? 'text-red-500' :
                            estudiante.estado === 'A' ? 'text-slate-500' : '';

                        const estadoTexto = estudiante.estado === 'E' ? 'Efectivo' :
                            estudiante.estado === 'R' ? 'Retirado' :
                            estudiante.estado === 'A' ? 'Abandono' : '';

                        row.innerHTML = `
                            <td class="py-2 px-2 text-center">
                                <input type="checkbox" class="checkbox-estudiante cursor-pointer" value="${estudiante.id_estudiante}">
                            </td>
                            <td class="py-2 px-2 text-sm">${estudiante.id_estudiante}</td>
                            <td class="py-2 px-2 text-sm">${estudiante.rude}</td>

                            <td class="py-2 px-2 text-sm" id='fila' onclick="toggleCheckbox(this)">${estudiante.appaterno} ${estudiante.apmaterno} ${estudiante.nombres}</td>
                            <td class="py-2 px-2 text-center text-sm">
                                <span class="border border-slate-400 rounded px-2 py-1 cursor-pointer genero-toggle-modal" data-id="${estudiante.id_estudiante}">
                                    ${generoIcon}
                                </span>
                            </td>
                            <td class="py-2 px-2 text-center text-sm">
                                <span class="border border-slate-400 rounded px-2 py-1 ${estadoClase}">
                                    ${estadoTexto}
                                </span>
                            </td>
                        `;

                        tbody.appendChild(row);
                    });

                    // Agregar listener al checkbox de seleccionar todos
                    /* document.getElementById('checkboxSelectAll').addEventListener('change', function() {
                        const checkboxes = document.querySelectorAll('.checkbox-estudiante');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    }); */

                    // Agregar evento de búsqueda
                    document.getElementById('inputBusqueda').addEventListener('keyup', filtrarEstudiantes);
                })
                .catch(error => {
                    console.error('Error cargando estudiantes:', error);
                    alert('Error al cargar los estudiantes');
                });
        }




        function toggleCheckbox(row) {
            const checkbox = row.querySelector('input[type="checkbox"]');

            if (!checkbox) {
                console.error('Checkbox no encontrado en la fila', row);
                return;
            }

            checkbox.checked = !checkbox.checked;
        }


        document.addEventListener('onclick', function(e) {
            if (e.target && e.target.id == 'fila') {
                console.log('hola');
            }
        });
        // Función para filtrar estudiantes en tiempo real
        function filtrarEstudiantes() {
            const busqueda = document.getElementById('inputBusqueda').value.toLowerCase();
            const filas = document.querySelectorAll('#tablaEstudiantesBody tr');

            filas.forEach(fila => {
                const codigo = fila.getAttribute('data-codigo');
                const rude = fila.getAttribute('data-rude');
                const nombre = fila.getAttribute('data-nombre');

                // Mostrar fila si coincide con el código, rude o nombre
                if (codigo.includes(busqueda) || rude.includes(busqueda) || nombre.includes(busqueda)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        }

        // Manejar selección de estudiantes
        document.getElementById('btnSeleccionarEstudiantes').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.checkbox-estudiante:checked');
            const seleccionados = Array.from(checkboxes).map(cb => cb.value);

            if (seleccionados.length === 0) {
                alert('Por favor selecciona al menos un estudiante');
                return;
            }

            // Obtener el ID del curso desde el atributo data del modal
            const idCurso = document.getElementById('modalListado').getAttribute('data-curso-id');

            // Enviar los datos al servidor
            fetch('{{ route('inscripcion.inscribir-multiples') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        estudiante_ids: seleccionados,
                        id_curso: idCurso
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        if (data.errores && data.errores.length > 0) {
                            console.warn('Errores:', data.errores);
                        }
                        document.getElementById('modalListado').classList.add('hidden');
                        // Recargar la página para ver los cambios
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la inscripción');
                });
        });

        // Cambiar género en tabla principal
        document.addEventListener('click', function(e) {
            if (e.target.closest('.genero-toggle')) {
                const elemento = e.target.closest('.genero-toggle');
                const id = elemento.getAttribute('data-id');
                cambiarGeneroEstudiante(id, elemento);
            }
        });

        // Cambiar género en modal de listado
        document.addEventListener('click', function(e) {
            if (e.target.closest('.genero-toggle-modal')) {
                const elemento = e.target.closest('.genero-toggle-modal');
                const id = elemento.getAttribute('data-id');
                cambiarGeneroEstudiante(id, elemento);
            }
        });

        // Función para cambiar el género
        function cambiarGeneroEstudiante(id, elemento) {
            fetch('{{ route('estudiante.cambiarGenero', ['id' => 'PLACEHOLDER']) }}'.replace('PLACEHOLDER', id), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualizar el icono y colores dinámicamente
                        if (data.genero === 'M') {
                            elemento.innerHTML = '<i class="fa-solid fa-person"></i>';
                            elemento.className =
                                'border border-blue-500 bg-white text-blue-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle';
                            elemento.setAttribute('data-id', id);
                        } else {
                            elemento.innerHTML = '<i class="fa-solid fa-person-dress"></i>';
                            elemento.className =
                                'border border-pink-500 bg-white text-pink-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle';
                            elemento.setAttribute('data-id', id);
                        }
                        console.log('Género actualizado correctamente');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al actualizar el género');
                });
        }
    </script>
@endsection

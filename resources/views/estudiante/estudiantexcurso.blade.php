@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div
            class="sticky top-0 z-1 ml-3 w-full mt-2 h-12 bg-[#3B82F6] rounded-md flex justify-between items-center pl-2 pr-2 ">
            <div>
                <a href="" id="openListadoEstudiantes"
                    class="py-1 px-2 rounded text-slate-700 border text-md border-slate-700 bg-white"><i
                        class="fa-regular fa-address-book"></i></a>
                <a href="" class="py-1 px-2 rounded text-green-700 border border-green-700 bg-white"><i
                        class="fa-regular fa-file-excel"></i></a>
            </div>
            {{-- <div class="bg-white w-fit px-4 text-center rounded-md">
                <p class="text-md italic uppercase">Comunicacion y Lenguajes: Lengua originaria</p>
                <p class="text-[10px]">Prof. Lourdes Mamani Chipana</p>

            </div> --}}
            <div class="bg-white w-72 text-center rounded-md">
                <p class="text-md ">{{ $curso->display_name }}</p>
                <p class="text-[10px]">Listado de estudiantes</p>
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
                    <tr class="bg-[#64748B] text-white text-sm text-center ">
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Estudiante</td>
                        <td>Genero</td>
                        <td class="w-30">Estado</td>
                        <td class="w-20">1er Trimestre</td>
                        <td class="w-20">2do Trimestre</td>
                        <td class="w-20">3er Trimestre</td>
                        <td class="w-20">Final</td>
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
                                    <p class="border border-blue-500 bg-white text-blue-500 rounded px-1 w-fit m-auto">
                                        <i class="fa-solid fa-person"></i>
                                    </p>
                                @else
                                    <p class="border border-pink-500 bg-white text-pink-500 rounded px-1 w-fit m-auto">
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
                            <td class="font-bold text-blue-500">51</td>
                            <td>51</td>
                            <td>51</td>
                            <td class="border border-slate-400 bg-slate-200">100</td>
                            <td>
                                {{-- <a href="#"
                                    class="bg-[#1F1F1F] text-white px-2 py-2 rounded hover:text-[#1F1F1F] hover:bg-white border-2 border-[#1F1F1F] "><i
                                        class="fa-solid fa-book"></i> Calificaciones</a> --}}
                                <a href="#"
                                    class="bg-[#888888] text-white text-xs px-2 py-2 rounded hover:text-[#888888] hover:bg-white border-2 border-[#888888] "><i
                                        class="fa-solid fa-list-check"></i> Asistencias</a>
                                <a href="#"
                                    class="bg-[#F62961] text-white text-xs px-2 py-2 rounded hover:text-[#F62961] hover:bg-white border-2 border-[#F62961] ">
                                    <i class="fa-solid fa-box"></i> Observaciones</a>
                                <form action="{{ route('estudiante.destroy', $estudiante->id_estudiante) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                        class="py-2 px-3 border border-red-500 bg-white my-2 rounded-sm text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                                {{-- <a href="#"
                                    class="ml-1 p-2 edit-btn border border-[#3B82F6] bg-white text-[#3B82F6] rounded-sm hover:bg-[#3B82F6] hover:text-white"
                                    data-id="{{ $estudiante->id_estudiante }}"
                                    data-codigo="{{ $estudiante->id_estudiante }}" data-estado="{{ $estudiante->estado }}"
                                    data-rude="{{ $estudiante->rude }}" data-ci="{{ $estudiante->ci }}"
                                    data-nombres="{{ $estudiante->nombres }}"
                                    data-appaterno="{{ $estudiante->appaterno }}"
                                    data-apmaterno="{{ $estudiante->apmaterno }}" data-genero="{{ $estudiante->genero }}"
                                    data-fecha="{{ $estudiante->fecha_nacimiento }}"
                                    data-observacion="{{ $estudiante->observacion }}"
                                    data-id_curso="{{ $estudiante->id_curso ?? 'SIN CURSO' }}">
                                    <i class='bx bx-edit-alt'></i> Editar
                                </a> --}}
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

        {{-- Nos crearemos el formulario modal con el que podamos nosotros registras a nuevos estudiantes --}}
        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">REGISTRO DE NUEVO ESTUDIANTE</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formularioEstudiante" action="{{ route('estudiante.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div id="selectCursoCreate" class="basis-1/2 flex flex-col mt-2 w-full ">
                        <label for="id_curso" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Asignar a curso
                        </label>
                        <select name="id_curso" id="id_curso" class="border border-slate-600 bg-white p-2 rounded-md">
                            <option value="">- seleccione un curso -</option>
                        </select>
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
                    <div class="flex flex-row gap-1 mt-[-25px]">
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
                                <option value="F">FEMENINO</option>
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
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-blue-600 text-white w-1/2 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modalListado"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
            data-curso-id="{{ $curso->id }}">
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
                                    <input type="checkbox" id="checkboxSelectAll" class="cursor-pointer">
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
                        class="px-4 py-2 bg-blue-600 text-white w-1/4 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Seleccionar</button>
                </div>
            </div>
        </div>




    </div>

    <script>
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

                            <td class="py-2 px-2 text-sm">${estudiante.appaterno} ${estudiante.apmaterno} ${estudiante.nombres}</td>
                            <td class="py-2 px-2 text-center text-sm">
                                <span class="border border-slate-400 rounded px-2 py-1">
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
                    document.getElementById('checkboxSelectAll').addEventListener('change', function() {
                        const checkboxes = document.querySelectorAll('.checkbox-estudiante');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    });

                    // Agregar evento de búsqueda
                    document.getElementById('inputBusqueda').addEventListener('keyup', filtrarEstudiantes);
                })
                .catch(error => {
                    console.error('Error cargando estudiantes:', error);
                    alert('Error al cargar los estudiantes');
                });
        }

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
    </script>
@endsection

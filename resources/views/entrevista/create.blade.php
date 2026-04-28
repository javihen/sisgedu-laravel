@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 min-h-screen w-[calc(100%-80px)]  min-h-screen  py-12 px-4 sm:px-6 lg:px-8 absolute">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Registrar Entrevista con Padres</h1>

            {{-- Mostrar errores de validación --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-red-800 mb-3">Por favor corrija los errores:</h3>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('entrevistas.store') }}" method="POST" id="entrevistaForm" class="space-y-8">
                @csrf

                {{-- Sección: Información de la Entrevista --}}
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Información de la Entrevista</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Estudiante --}}
                        <div>
                            <label for="buscarEstudiante" class="block text-sm font-medium text-gray-700 mb-2">
                                Estudiante <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="buscarEstudiante" placeholder="Escriba el nombre del estudiante"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('idEstudiante') border-red-500 @enderror"
                                    autocomplete="off">
                                <input type="hidden" name="idEstudiante" id="idEstudiante" required
                                    value="{{ old('idEstudiante', '') }}">
                                <ul id="listadoEstudiantes"
                                    class="hidden absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg max-h-64 overflow-y-auto z-50 mt-1">
                                </ul>
                            </div>
                            @error('idEstudiante')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Profesor --}}
                        <div>
                            <label for="buscarProfesor" class="block text-sm font-medium text-gray-700 mb-2">
                                Profesor <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" id="buscarProfesor" placeholder="Escriba el nombre del profesor"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('idProfesor') border-red-500 @enderror"
                                    autocomplete="off">
                                <input type="hidden" name="idProfesor" id="idProfesor" required
                                    value="{{ old('idProfesor', '') }}">
                                <ul id="listadoProfesores"
                                    class="hidden absolute top-full left-0 right-0 bg-white border border-gray-300 rounded-lg shadow-lg max-h-64 overflow-y-auto z-50 mt-1">
                                </ul>
                            </div>
                            @error('idProfesor')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fecha --}}
                        <div>
                            <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="fecha" id="fecha" required value="{{ old('fecha') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('fecha') border-red-500 @enderror">
                            @error('fecha')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Hora --}}
                        <div>
                            <label for="hora" class="block text-sm font-medium text-gray-700 mb-2">
                                Hora <span class="text-red-500">*</span>
                            </label>
                            <input type="time" name="hora" id="hora" required value="{{ old('hora') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('hora') border-red-500 @enderror">
                            @error('hora')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Asistió checkbox --}}
                    <div class="mt-6">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input type="hidden" name="asistio" value="0">
                            <input type="checkbox" name="asistio" value="1" {{ old('asistio') ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                            <span class="text-sm font-medium text-gray-700">El padre/madre asistió a la entrevista</span>
                        </label>
                    </div>
                </div>

                {{-- Sección: Observaciones y Acuerdos --}}
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Notas de la Entrevista</h2>

                    <div class="space-y-6">
                        {{-- Observaciones --}}
                        <div>
                            <label for="observaciones" class="block text-sm font-medium text-gray-700 mb-2">
                                Observaciones
                            </label>
                            <textarea name="observaciones" id="observaciones" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('observaciones') border-red-500 @enderror"
                                placeholder="Describa los temas tratados en la entrevista...">{{ old('observaciones') }}</textarea>
                            @error('observaciones')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Acuerdos --}}
                        <div>
                            <label for="acuerdos" class="block text-sm font-medium text-gray-700 mb-2">
                                Acuerdos Alcanzados
                            </label>
                            <textarea name="acuerdos" id="acuerdos" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('acuerdos') border-red-500 @enderror"
                                placeholder="Describa los acuerdos a los que llegaron...">{{ old('acuerdos') }}</textarea>
                            @error('acuerdos')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Sección: Compromisos --}}
                <div class="pb-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-800">Compromisos</h2>
                        <button type="button" id="agregarCompromiso"
                            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Agregar Compromiso
                        </button>
                    </div>

                    <div id="compromisosContainer" class="space-y-4">
                        {{-- Compromiso inicial --}}
                        <div class="compromiso-item bg-gray-50 border border-gray-200 rounded-lg p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                {{-- Descripción --}}
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Descripción del Compromiso
                                    </label>
                                    <textarea name="descripcion[]" rows="2" placeholder="¿Qué debe cumplirse?"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                </div>

                                {{-- Botón eliminar --}}
                                <div class="flex justify-end md:justify-start items-start">
                                    <button type="button"
                                        class="btn-eliminar mt-7 px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {{-- Responsable --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Responsable
                                    </label>
                                    <input type="text" name="responsable[]"
                                        placeholder="Nombre de quien es responsable"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>

                                {{-- Fecha Límite --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Fecha Límite
                                    </label>
                                    <input type="date" name="fechaLimite[]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Botones de acción --}}
                <div class="flex gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition duration-200">
                        Guardar Entrevista
                    </button>
                    <a href="{{ route('entrevistas.index') ?? '#' }}"
                        class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 font-medium rounded-lg hover:bg-gray-300 transition duration-200 text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Datos de estudiantes y profesores desde PHP
        const estudiantesData = @json(
            $estudiantes->map(fn($e) => [
                    'id' => $e->id_estudiante,
                    'nombre' => trim($e->nombres . ' ' . $e->appaterno . ' ' . $e->apmaterno),
                ]));

        const profesoresData = @json(
            $profesores->map(fn($p) => [
                    'id' => $p->id_profesor,
                    'nombre' => trim($p->nombres . ' ' . $p->appaterno . ' ' . $p->apmaterno),
                ]));

        // Función para filtrar y mostrar opciones
        function mostrarOpciones(inputId, listadoId, datos, inputValue) {
            const listado = document.getElementById(listadoId);
            const filtered = datos.filter(item =>
                item.nombre.toLowerCase().includes(inputValue.toLowerCase())
            );

            if (inputValue.trim() === '' || filtered.length === 0) {
                listado.classList.add('hidden');
                return;
            }

            listado.innerHTML = '';
            filtered.forEach(item => {
                const li = document.createElement('li');
                li.className = 'px-4 py-2 cursor-pointer hover:bg-blue-100 transition';
                li.textContent = item.nombre;
                li.addEventListener('click', function() {
                    document.getElementById(inputId).value = item.nombre;
                    document.getElementById(inputId === 'buscarEstudiante' ? 'idEstudiante' : 'idProfesor')
                        .value = item.id;
                    listado.classList.add('hidden');
                });
                listado.appendChild(li);
            });

            listado.classList.remove('hidden');
        }

        // Event listener para campo Estudiante
        document.getElementById('buscarEstudiante').addEventListener('input', function() {
            mostrarOpciones('buscarEstudiante', 'listadoEstudiantes', estudiantesData, this.value);
        });

        // Event listener para campo Profesor
        document.getElementById('buscarProfesor').addEventListener('input', function() {
            mostrarOpciones('buscarProfesor', 'listadoProfesores', profesoresData, this.value);
        });

        // Cerrar listados al hacer click fuera
        document.addEventListener('click', function(event) {
            const estudianteInput = document.getElementById('buscarEstudiante');
            const profesorInput = document.getElementById('buscarProfesor');
            const listadoEstudiantes = document.getElementById('listadoEstudiantes');
            const listadoProfesores = document.getElementById('listadoProfesores');

            if (!estudianteInput.contains(event.target) && !listadoEstudiantes.contains(event.target)) {
                listadoEstudiantes.classList.add('hidden');
            }
            if (!profesorInput.contains(event.target) && !listadoProfesores.contains(event.target)) {
                listadoProfesores.classList.add('hidden');
            }
        });

        // Restaurar valores si existen (al recargar el formulario con errores)
        window.addEventListener('load', function() {
            const idEstudiante = document.getElementById('idEstudiante').value;
            const idProfesor = document.getElementById('idProfesor').value;

            if (idEstudiante) {
                const est = estudiantesData.find(e => e.id == idEstudiante);
                if (est) {
                    document.getElementById('buscarEstudiante').value = est.nombre;
                }
            }

            if (idProfesor) {
                const prof = profesoresData.find(p => p.id == idProfesor);
                if (prof) {
                    document.getElementById('buscarProfesor').value = prof.nombre;
                }
            }
        });

        // Agregar compromisos
        document.addEventListener('DOMContentLoaded', function() {
            const agregarBtn = document.getElementById('agregarCompromiso');
            const container = document.getElementById('compromisosContainer');

            // Agregar nuevo compromiso
            agregarBtn.addEventListener('click', function() {
                const nuevoCompromiso = document.querySelector('.compromiso-item').cloneNode(true);

                // Limpiar los valores del formulario clonado
                nuevoCompromiso.querySelectorAll('input, textarea').forEach(el => {
                    el.value = '';
                });

                // Agregar evento al botón eliminar del nuevo elemento
                agregarEventoEliminar(nuevoCompromiso.querySelector('.btn-eliminar'));

                container.appendChild(nuevoCompromiso);
            });

            // Agregar evento a los botones de eliminar existentes
            document.querySelectorAll('.btn-eliminar').forEach(btn => {
                agregarEventoEliminar(btn);
            });

            function agregarEventoEliminar(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // No eliminar si es el único compromiso
                    const compromisos = document.querySelectorAll('.compromiso-item');
                    if (compromisos.length > 1) {
                        this.closest('.compromiso-item').remove();
                    } else {
                        alert('Debe mantener al menos un compromiso');
                    }
                });
            }
        });
    </script>
@endsection

@extends('layouts.navhorizontal')

@section('content')
    <div class="container mx-auto px-4 py-8 absolute left-14">
        <div class="max-w-3xl mx-auto">
            <!-- Encabezado -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Importar Notas</h1>
                <p class="text-gray-600 mt-2">Sube un archivo Excel con las notas de los estudiantes en formato de matriz</p>
            </div>

            <!-- Mensajes de error/éxito -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    <h3 class="font-bold mb-2">Errores en la validación:</h3>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                    <p class="font-bold">✅ {{ session('success') }}</p>
                </div>
            @endif

            @if (session('errores'))
                <div
                    class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded max-h-64 overflow-y-auto">
                    <p class="font-bold mb-2">⚠️ Errores durante la importación ({{ count(session('errores')) }}):</p>
                    <ul class="list-disc pl-5 text-sm">
                        @foreach (session('errores') as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    ❌ {{ session('error') }}
                </div>
            @endif

            <!-- Tarjeta principal -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Sección de instrucciones -->
                {{-- <div class="mb-8 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                    <h2 class="text-lg font-semibold text-blue-900 mb-4">Instrucciones del Formato:</h2>
                    <ol class="list-decimal pl-5 text-blue-800 space-y-2 text-sm">
                        <li><strong>Descargar plantilla:</strong> Click en "Descargar Plantilla" para obtener el archivo
                            base</li>
                        <li><strong>Celdas F1:P1:</strong> Contienen los IDs de las materias (no modificar)</li>
                        <li><strong>Columna B (A7+):</strong> Contiene los IDs de estudiantes (no modificar)</li>
                        <li><strong>Intersecciones (F7:P...):</strong> Completa con las calificaciones (0-100)</li>
                        <li><strong>Dejar en blanco:</strong> Si un estudiante no tiene nota en una materia</li>
                        <li><strong>Seleccionar período y gestión:</strong> Antes de subir el archivo</li>
                        <li>Sube el archivo completado usando el formulario</li>
                    </ol>
                </div>

                <!-- Botón descargar plantilla -->
                <div class="mb-8">
                    <a href="{{ route('notas.descargar-plantilla') }}"
                        class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Descargar Plantilla
                    </a>
                </div> --}}

                <!-- Formulario -->
                <form action="{{ route('notas.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Período -->
                    <div class="space-y-2">
                        <label for="periodo" class="block text-sm font-medium text-gray-700">
                            Período Académico *
                        </label>
                        <select id="periodo" name="periodo"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Selecciona un BIMESTRE...</option>
                            <option value="1" {{ old('periodo') == '1' ? 'selected' : '' }}>PRIMER</option>
                            <option value="2" {{ old('periodo') == '2' ? 'selected' : '' }}>SEGUNDO</option>
                            <option value="3" {{ old('periodo') == '3' ? 'selected' : '' }}>TERCER</option>
                        </select>
                        @error('periodo')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gestión -->
                    <div class="space-y-2">
                        <label for="id_gestion" class="block text-sm font-medium text-gray-700">
                            Gestión Académica *
                        </label>
                        <select id="id_gestion" name="id_gestion"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Selecciona una gestión...</option>
                            @foreach ($gestiones as $gestion)
                                <option value="{{ $gestion->id_gestion }}"
                                    {{ old('id_gestion') == $gestion->id_gestion ? 'selected' : '' }}>
                                    {{ $gestion->anio }} ({{ $gestion->estado }})
                                </option>
                            @endforeach
                        </select>
                        @error('id_gestion')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Input de archivo -->
                    <div class="space-y-2">
                        <label for="archivo" class="block text-sm font-medium text-gray-700">
                            Seleccionar archivo Excel
                        </label>
                        <div
                            class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-18-6v12m0 0l-4-4m4 4l4-4"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="archivo"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Haz clic para seleccionar un archivo</span>
                                        <input id="archivo" name="archivo" type="file" class="sr-only"
                                            accept=".xlsx,.xls" required>
                                    </label>
                                    <p class="pl-1">o arrastra y suelta</p>
                                </div>
                                <p class="text-xs text-gray-500">Excel (.xlsx o .xls) hasta 2MB</p>
                            </div>
                        </div>
                        @error('archivo')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre del archivo seleccionado -->
                    <div id="archivoSeleccionado" class="hidden p-3 bg-gray-100 rounded text-sm text-gray-700">
                        <span id="nombreArchivo"></span>
                    </div>

                    <!-- Botón submit -->
                    <button type="submit"
                        class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        Importar Notas
                    </button>
                </form>

                <!-- Estructura del archivo -->
                <div class="mt-10 pt-8 border-t border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">📋 Estructura del archivo Excel:</h2>

                    <div class="mb-6 p-4 bg-gray-50 rounded">
                        <h3 class="font-semibold text-gray-800 mb-2">Disposición General:</h3>
                        <ul class="list-disc pl-5 text-sm text-gray-700 space-y-1">
                            <li><strong>Filas 1-6:</strong> Encabezados y títulos</li>
                            <li><strong>Fila 1, Columnas F-P:</strong> IDs de materias (no modificar)</li>
                            <li><strong>Fila 6, Columnas F-P:</strong> "1T" (indicador de trimestre)</li>
                            <li><strong>Columna B, Fila 7+:</strong> IDs de estudiantes (no modificar)</li>
                            <li><strong>Celdas F7-P..:</strong> Espacio para calificaciones (0-100)</li>
                        </ul>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse text-xs">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-2 py-1">Fila</th>
                                    <th class="border border-gray-300 px-2 py-1">Col A</th>
                                    <th class="border border-gray-300 px-2 py-1">Col B</th>
                                    <th class="border border-gray-300 px-2 py-1">Col C</th>
                                    <th class="border border-gray-300 px-2 py-1">Col D</th>
                                    <th class="border border-gray-300 px-2 py-1">Col F-P</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-bold">1</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1 bg-yellow-100"><strong>ID Materia</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-bold">6</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1">-</td>
                                    <td class="border border-gray-300 px-2 py-1 bg-yellow-100">1T</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-bold">7</td>
                                    <td class="border border-gray-300 px-2 py-1">1</td>
                                    <td class="border border-gray-300 px-2 py-1 bg-lightblue-100"><strong>EST001</strong>
                                    </td>
                                    <td class="border border-gray-300 px-2 py-1">Nombre Estudiante</td>
                                    <td class="border border-gray-300 px-2 py-1">EFECTIVO</td>
                                    <td class="border border-gray-300 px-2 py-1 bg-green-100">85.50</td>
                                </tr>
                                <tr>
                                    <td class="border border-gray-300 px-2 py-1 font-bold">8</td>
                                    <td class="border border-gray-300 px-2 py-1">2</td>
                                    <td class="border border-gray-300 px-2 py-1 bg-lightblue-100"><strong>EST002</strong>
                                    </td>
                                    <td class="border border-gray-300 px-2 py-1">Nombre Estudiante</td>
                                    <td class="border border-gray-300 px-2 py-1">EFECTIVO</td>
                                    <td class="border border-gray-300 px-2 py-1 bg-green-100">92.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 p-4 bg-green-50 border-l-4 border-green-500 rounded text-sm text-green-800">
                        <strong>✓ Qué completar:</strong> Solo las celdas verdes (intersecciones de estudiante y materia)
                        con valores 0-100
                    </div>
                    <div class="mt-2 p-4 bg-blue-50 border-l-4 border-blue-500 rounded text-sm text-blue-800">
                        <strong>ℹ️ No modificar:</strong> Encabezados, IDs de estudiantes, ni IDs de materias
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mostrar nombre del archivo seleccionado
        document.getElementById('archivo').addEventListener('change', function(e) {
            const nombreArchivo = e.target.files[0]?.name || '';
            if (nombreArchivo) {
                document.getElementById('nombreArchivo').textContent = '📎 ' + nombreArchivo;
                document.getElementById('archivoSeleccionado').classList.remove('hidden');
            } else {
                document.getElementById('archivoSeleccionado').classList.add('hidden');
            }
        });

        // Drag and drop
        const dropZone = document.querySelector('[for="archivo"]').closest('.border-dashed');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-blue-50', 'border-blue-500');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-blue-50', 'border-blue-500');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-blue-50', 'border-blue-500');
            document.getElementById('archivo').files = e.dataTransfer.files;
            const event = new Event('change', {
                bubbles: true
            });
            document.getElementById('archivo').dispatchEvent(event);
        });
    </script>



    <!-- Botón descargar plantilla -->
    {{-- <div class="mb-8">
        <a href="{{ route('notas.descargar-plantilla') }}"
            class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Descargar Plantilla
        </a>
    </div> --}}

    <!-- Formulario -->
    {{-- <form action="{{ route('notas.import') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Input de archivo -->
        <div class="space-y-2">
            <label for="archivo" class="block text-sm font-medium text-gray-700">
                Seleccionar archivo Excel
            </label>
            <div
                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                        viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-18-6v12m0 0l-4-4m4 4l4-4"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="archivo"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <span>Haz clic para seleccionar un archivo</span>
                            <input id="archivo" name="archivo" type="file" class="sr-only"
                                accept=".xlsx,.xls,.csv" required>
                        </label>
                        <p class="pl-1">o arrastra y suelta</p>
                    </div>
                    <p class="text-xs text-gray-500">Excel o CSV hasta 2MB</p>
                </div>
            </div>
            @error('archivo')
                <p class="text-red-600 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Nombre del archivo seleccionado -->
        <div id="archivoSeleccionado" class="hidden p-3 bg-gray-100 rounded text-sm text-gray-700">
            <span id="nombreArchivo"></span>
        </div>

        <!-- Botón submit -->
        <button type="submit"
            class="w-full px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 flex items-center justify-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                </path>
            </svg>
            Importar Notas
        </button>
    </form> --}}

    <!-- Estructura del archivo -->
    {{-- <div class="mt-10 pt-8 border-t border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Estructura del archivo Excel:</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Columna</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Campo</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Tipo</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">A</td>
                        <td class="border border-gray-300 px-4 py-2 font-mono text-sm">id_estudiante</td>
                        <td class="border border-gray-300 px-4 py-2">Texto</td>
                        <td class="border border-gray-300 px-4 py-2">ID del estudiante (ej: EST001)</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">B</td>
                        <td class="border border-gray-300 px-4 py-2 font-mono text-sm">calificacion</td>
                        <td class="border border-gray-300 px-4 py-2">Decimal</td>
                        <td class="border border-gray-300 px-4 py-2">Calificación (0 a 100, ej: 85.50)</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">C</td>
                        <td class="border border-gray-300 px-4 py-2 font-mono text-sm">periodo</td>
                        <td class="border border-gray-300 px-4 py-2">Número</td>
                        <td class="border border-gray-300 px-4 py-2">Período (1, 2, 3 o 4)</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">D</td>
                        <td class="border border-gray-300 px-4 py-2 font-mono text-sm">idAsignacion</td>
                        <td class="border border-gray-300 px-4 py-2">Número</td>
                        <td class="border border-gray-300 px-4 py-2">ID de la asignación</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">E</td>
                        <td class="border border-gray-300 px-4 py-2 font-mono text-sm">id_gestion</td>
                        <td class="border border-gray-300 px-4 py-2">Número</td>
                        <td class="border border-gray-300 px-4 py-2">ID de la gestión</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Ejemplo de datos -->
        <h3 class="text-md font-semibold text-gray-800 mt-6 mb-3">Ejemplo de datos:</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">id_estudiante</th>
                        <th class="border border-gray-300 px-4 py-2">calificacion</th>
                        <th class="border border-gray-300 px-4 py-2">periodo</th>
                        <th class="border border-gray-300 px-4 py-2">idAsignacion</th>
                        <th class="border border-gray-300 px-4 py-2">id_gestion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-blue-50">
                        <td class="border border-gray-300 px-4 py-2">EST001</td>
                        <td class="border border-gray-300 px-4 py-2">85.50</td>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                    </tr>
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">EST002</td>
                        <td class="border border-gray-300 px-4 py-2">92.00</td>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                        <td class="border border-gray-300 px-4 py-2">1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div>

    <script>
        // Mostrar nombre del archivo seleccionado
        document.getElementById('archivo').addEventListener('change', function(e) {
            const nombreArchivo = e.target.files[0]?.name || '';
            if (nombreArchivo) {
                document.getElementById('nombreArchivo').textContent = '📎 ' + nombreArchivo;
                document.getElementById('archivoSeleccionado').classList.remove('hidden');
            } else {
                document.getElementById('archivoSeleccionado').classList.add('hidden');
            }
        });

        // Drag and drop
        const dropZone = document.querySelector('[for="archivo"]').closest('.border-dashed');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('bg-blue-50', 'border-blue-500');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('bg-blue-50', 'border-blue-500');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('bg-blue-50', 'border-blue-500');
            document.getElementById('archivo').files = e.dataTransfer.files;
            const event = new Event('change', {
                bubbles: true
            });
            document.getElementById('archivo').dispatchEvent(event);
        });
    </script> --}}
@endsection

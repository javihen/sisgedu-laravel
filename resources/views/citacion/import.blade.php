@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center">
            <p class="text-white text-sm">Importar Citaciones</p>
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
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-4 mr-4">
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

        <div class="mx-3 mt-4 bg-white rounded border border-gray-400 p-6">
            <div class="mb-6">
                <h2 class="text-lg font-bold text-gray-800 mb-2">Formato de Archivo Excel</h2>
                <p class="text-sm text-gray-600 mb-4">
                    El archivo debe tener la siguiente estructura:
                </p>
                <div class="bg-gray-100 p-4 rounded border border-gray-300 overflow-x-auto">
                    <table class="w-full text-xs text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-300">
                                <th class="border border-gray-400 px-2 py-1">ID Estudiante</th>
                                <th class="border border-gray-400 px-2 py-1">ID Materia 1</th>
                                <th class="border border-gray-400 px-2 py-1">ID Materia 2</th>
                                <th class="border border-gray-400 px-2 py-1">ID Materia 3</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="bg-white">
                                <td class="border border-gray-400 px-2 py-1">EST001</td>
                                <td class="border border-gray-400 px-2 py-1">1</td>
                                <td class="border border-gray-400 px-2 py-1"></td>
                                <td class="border border-gray-400 px-2 py-1">1</td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="border border-gray-400 px-2 py-1">EST002</td>
                                <td class="border border-gray-400 px-2 py-1">1</td>
                                <td class="border border-gray-400 px-2 py-1">1</td>
                                <td class="border border-gray-400 px-2 py-1"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="text-sm text-gray-600 mt-3">
                    <strong>Instrucciones:</strong>
                <ul class="list-disc list-inside mt-2">
                    <li>Primera columna: IDs de estudiantes</li>
                    <li>Encabezados de columnas: IDs de materias (numéricos o nombres)</li>
                    <li>Celdas: Ingresa <strong>1</strong> si hay citación, déjalo vacío si no la hay</li>
                </ul>
                </p>
            </div>

            <hr class="my-6">

            <form action="{{ route('citacion.import') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <!-- Selección de Archivo -->
                <div>
                    <label for="archivo" class="block text-sm font-medium text-gray-700 mb-2">
                        Archivo Excel
                    </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="archivo"
                            class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 5.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 19V6m0 0L8 8m2-2l2 2" />
                                </svg>
                                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Haz clic para subir</span>
                                    o
                                    arrastra el archivo</p>
                                <p class="text-xs text-gray-500">XLSX, XLS o CSV</p>
                            </div>
                            <input id="archivo" name="archivo" type="file" class="hidden" accept=".xlsx,.xls,.csv"
                                required />
                        </label>
                    </div>
                    @error('archivo')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Curso -->
                <div>
                    <label for="idCurso" class="block text-sm font-medium text-gray-700 mb-2">
                        Curso
                    </label>
                    <select name="idCurso" id="idCurso"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        <option value="">-- Selecciona un curso --</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ old('idCurso') == $curso->id ? 'selected' : '' }}>
                                {{ $curso->nombre_curso }}
                            </option>
                        @endforeach
                    </select>
                    @error('idCurso')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Profesor -->
                <div>
                    <label for="idProfesor" class="block text-sm font-medium text-gray-700 mb-2">
                        Profesor encargado
                    </label>
                    <select name="idProfesor" id="idProfesor"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        <option value="">-- Selecciona un profesor --</option>
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id_profesor }}"
                                {{ old('idProfesor') == $profesor->id_profesor ? 'selected' : '' }}>
                                {{ $profesor->nombres }} {{ $profesor->appaterno }} {{ $profesor->apmaterno }}
                            </option>
                        @endforeach
                    </select>
                    @error('idProfesor')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Selección de Gestión -->
                <div>
                    <label for="idGestion" class="block text-sm font-medium text-gray-700 mb-2">
                        Gestión
                    </label>
                    <select name="idGestion" id="idGestion"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        <option value="">-- Selecciona una gestión --</option>
                        @foreach ($gestiones as $gestion)
                            <option value="{{ $gestion->id_gestion }}"
                                {{ old('idGestion') == $gestion->id_gestion ? 'selected' : '' }}>
                                {{ $gestion->anio }}
                            </option>
                        @endforeach
                    </select>
                    @error('idGestion')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Fecha -->
                <div>
                    <label for="fecha" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Citación
                    </label>
                    <input type="date" name="fecha" id="fecha"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        value="{{ old('fecha') }}" required>
                    @error('fecha')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Hora -->
                <div>
                    <label for="hora" class="block text-sm font-medium text-gray-700 mb-2">
                        Hora de Citación
                    </label>
                    <input type="time" name="hora" id="hora"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        value="{{ old('hora') }}" required>
                    @error('hora')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Motivo -->
                <div>
                    <label for="motivo" class="block text-sm font-medium text-gray-700 mb-2">
                        Motivo (Opcional)
                    </label>
                    <textarea name="motivo" id="motivo" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        placeholder="Ingresa el motivo de la citación">{{ old('motivo') }}</textarea>
                    @error('motivo')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Período -->
                <div>
                    <label for="periodo" class="block text-sm font-medium text-gray-700 mb-2">
                        Período (Opcional)
                    </label>
                    <input type="text" name="periodo" id="periodo"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        placeholder="Ej: Primer Bimestre" value="{{ old('periodo') }}">
                    @error('periodo')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tipo de Citación -->
                <div>
                    <label for="tipo" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Citación
                    </label>
                    <select name="tipo" id="tipo"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        <option value="individual" {{ old('tipo') == 'individual' ? 'selected' : '' }}>Individual</option>
                        <option value="grupal" {{ old('tipo') == 'grupal' ? 'selected' : '' }}>Grupal</option>
                    </select>
                    @error('tipo')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end gap-2 mt-6">
                    <a href="{{ route('citacion.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                        Cancelar
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-[#38BC9B] text-white rounded-md hover:bg-[#2fa387] transition">
                        Importar Citaciones
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Mostrar el nombre del archivo seleccionado
        document.getElementById('archivo').addEventListener('change', function(e) {
            const label = this.parentElement.querySelector('p');
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                label.innerHTML = `<span class="font-semibold">${fileName}</span>`;
            }
        });
    </script>
@endsection

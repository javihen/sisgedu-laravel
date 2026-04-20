@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center">
            <p class="text-white text-sm">Editar Citación</p>
        </div>

        <div class="mx-3 mt-4 bg-white rounded border border-gray-400 p-6">
            <form action="{{ route('citacion.update', $citacion->idCitacion) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Estudiante -->
                <div>
                    <label for="idEstudiante" class="block text-sm font-medium text-gray-700 mb-2">
                        Estudiante
                    </label>
                    <input type="text" readonly class="w-full px-4 py-2 border border-gray-300 rounded-md bg-gray-100"
                        value="{{ $citacion->estudiante->nombres ?? 'N/A' }}">
                    <input type="hidden" name="idEstudiante" value="{{ $citacion->idEstudiante }}">
                </div>

                <!-- Curso -->
                <div>
                    <label for="idCurso" class="block text-sm font-medium text-gray-700 mb-2">
                        Curso
                    </label>
                    <select name="idCurso" id="idCurso"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ $citacion->idCurso == $curso->id ? 'selected' : '' }}>
                                {{ $curso->nombre_curso }}
                            </option>
                        @endforeach
                    </select>
                    @error('idCurso')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Profesor -->
                <div>
                    <label for="idProfesor" class="block text-sm font-medium text-gray-700 mb-2">
                        Profesor
                    </label>
                    <select name="idProfesor" id="idProfesor"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id_profesor }}"
                                {{ $citacion->idProfesor == $profesor->id_profesor ? 'selected' : '' }}>
                                {{ $profesor->nombres }} {{ $profesor->appaterno }}
                            </option>
                        @endforeach
                    </select>
                    @error('idProfesor')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Materia -->
                <div>
                    <label for="idMateria" class="block text-sm font-medium text-gray-700 mb-2">
                        Materia
                    </label>
                    <select name="idMateria" id="idMateria"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->id_materia }}"
                                {{ $citacion->idMateria == $materia->id_materia ? 'selected' : '' }}>
                                {{ $materia->area }} ({{ $materia->abreviatura }})
                            </option>
                        @endforeach
                    </select>
                    @error('idMateria')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Gestión -->
                <div>
                    <label for="idGestion" class="block text-sm font-medium text-gray-700 mb-2">
                        Gestión
                    </label>
                    <select name="idGestion" id="idGestion"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>
                        @foreach ($gestiones as $gestion)
                            <option value="{{ $gestion->id_gestion }}"
                                {{ $citacion->idGestion == $gestion->id_gestion ? 'selected' : '' }}>
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
                        value="{{ $citacion->fecha->format('Y-m-d') }}" required>
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
                        value="{{ $citacion->hora }}" required>
                    @error('hora')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Motivo -->
                <div>
                    <label for="motivo" class="block text-sm font-medium text-gray-700 mb-2">
                        Motivo
                    </label>
                    <textarea name="motivo" id="motivo" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#38BC9B]"
                        required>{{ $citacion->motivo }}</textarea>
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
                        value="{{ $citacion->periodo }}">
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
                        <option value="individual" {{ $citacion->tipo == 'individual' ? 'selected' : '' }}>Individual
                        </option>
                        <option value="grupal" {{ $citacion->tipo == 'grupal' ? 'selected' : '' }}>Grupal</option>
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
                        Actualizar Citación
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

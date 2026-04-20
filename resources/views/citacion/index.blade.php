@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-between items-center">
            <p class="text-white text-sm ml-4">
                <i class='bx bx-list-check mr-2'></i>Listado de Citaciones
                @if ($gestionActiva)
                    <span class="ml-4 text-xs">| Gestión: {{ $gestionActiva->anio }}</span>
                @endif
            </p>
            <div class="flex gap-2 mr-4">
                @if ($citaciones->count() > 0)
                    <a href="{{ route('citacion.pdf.general') }}"
                        class="text-white bg-red-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 hover:text-red-600 hover:bg-white hover:border-red-600 transition">
                        <i class='bx bx-file-pdf mr-1'></i>PDF General
                    </a>
                @endif
                <a href="{{ route('citacion.import') }}"
                    class="text-white bg-blue-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    <i class='bx bx-cloud-upload mr-2'></i>Importar
                </a>
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
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-4 mr-4">
                <div
                    class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif

        <div class="mx-3 mt-4 bg-white h-[calc(100vh-150px)] rounded border border-gray-400 overflow-y-auto">
            @if ($citaciones->count() > 0)
                <!-- Resumen de estadísticas -->
                <div class="sticky top-0 bg-gradient-to-r from-[#e8f5f1] to-white px-4 py-3 border-b border-gray-200">
                    <div class="flex justify-between items-center text-xs">
                        <div>
                            <strong>Total de Citaciones:</strong> {{ $citaciones->count() }}
                            <span class="ml-4">
                                <strong>Individual:</strong>
                                {{ $citaciones->where('tipo', 'individual')->count() }}
                            </span>
                            <span class="ml-4">
                                <strong>Grupal:</strong>
                                {{ $citaciones->where('tipo', 'grupal')->count() }}
                            </span>
                        </div>
                        <div>
                            <strong>Cursos:</strong> {{ $citaciones->groupBy('idCurso')->count() }}
                        </div>
                    </div>
                </div>

                <table class="w-full">
                    <thead class="bg-gray-200 sticky top-12">
                        <tr class="text-center text-xs text-gray-700">
                            <th class="py-2 px-4">Nro</th>
                            <th class="py-2 px-4">Estudiante</th>
                            <th class="py-2 px-4">Curso</th>
                            <th class="py-2 px-4">Profesor</th>
                            <th class="py-2 px-4">Materia</th>
                            <th class="py-2 px-4">Fecha</th>
                            <th class="py-2 px-4">Hora</th>
                            <th class="py-2 px-4">Motivo</th>
                            <th class="py-2 px-4">Tipo</th>
                            <th class="py-2 px-4">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($citaciones as $citacion)
                            <tr class="text-xs text-center hover:bg-gray-100 border-b border-gray-300">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 text-left">
                                    <div class="font-semibold">{{ $citacion->estudiante->nombres ?? 'N/A' }}</div>
                                    <div class="text-gray-500 text-xs">{{ $citacion->estudiante->ci ?? 'N/A' }}</div>
                                </td>
                                <td class="px-4 py-2">{{ $citacion->curso->nombre_curso ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $citacion->profesor->nombres ?? 'N/A' }}</td>
                                <td class="px-4 py-2">
                                    <span class="bg-gray-100 px-2 py-1 rounded">
                                        {{ $citacion->materia->abreviatura ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 font-semibold">{{ $citacion->fecha->format('d/m/Y') }}</td>
                                <td class="px-4 py-2">{{ $citacion->hora }}</td>
                                <td class="px-4 py-2 text-left text-gray-700">{{ substr($citacion->motivo, 0, 20) }}...
                                </td>
                                <td class="px-4 py-2">
                                    <span
                                        class="px-2 py-1 rounded text-white text-xs {{ $citacion->tipo == 'individual' ? 'bg-blue-500' : 'bg-purple-500' }}">
                                        {{ ucfirst($citacion->tipo) }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">
                                    <div class="flex justify-center gap-1">
                                        <a href="{{ route('citacion.pdf.estudiante', $citacion->idEstudiante) }}"
                                            title="PDF Estudiante"
                                            class="text-orange-600 hover:text-orange-900 border border-orange-600 hover:bg-orange-600 hover:text-white rounded bg-white py-1 px-1.5 transition text-xs">
                                            <i class='bx bx-file-pdf'></i>
                                        </a>
                                        <a href="{{ route('citacion.edit', $citacion->idCitacion) }}" title="Editar"
                                            class="text-blue-600 hover:text-blue-900 border border-blue-600 hover:bg-blue-600 hover:text-white rounded bg-white py-1 px-1.5 transition text-xs">
                                            <i class='bx bx-edit-alt'></i>
                                        </a>
                                        <form action="{{ route('citacion.destroy', $citacion->idCitacion) }}"
                                            method="POST" class="inline form-eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Eliminar"
                                                class="text-red-600 border border-red-600 cursor-pointer hover:bg-red-600 hover:text-white rounded bg-white py-1 px-1.5 hover:transition text-xs">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Botones por Curso -->
                <div class="px-4 py-4 border-t border-gray-200">
                    <h3 class="text-sm font-bold mb-3 text-gray-700">Generar PDF por Curso:</h3>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $citacionesPorCurso = $citaciones->groupBy('idCurso');
                        @endphp
                        @forelse ($citacionesPorCurso as $idCurso => $cursosCits)
                            @php
                                $curso = $cursosCits->first()->curso;
                            @endphp
                            <a href="{{ route('citacion.pdf.curso', $idCurso) }}"
                                class="text-xs bg-green-500 hover:bg-green-700 text-white px-3 py-1 rounded transition">
                                <i class='bx bx-file-pdf mr-1'></i>{{ $curso->nombre_curso ?? 'Curso' }}
                                ({{ $cursosCits->count() }})
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>
            @else
                <div class="flex items-center justify-center h-full">
                    <div class="text-center">
                        <i class='bx bx-inbox text-gray-300 text-6xl mb-4'></i>
                        <p class="text-gray-500 font-semibold">No hay citaciones registradas</p>
                        <p class="text-gray-400 text-sm mt-2">Importa citaciones para comenzar</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
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

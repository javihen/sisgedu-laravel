@extends('layouts.navhorizontal')

@section('content')
    <style>
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            white-space: nowrap;
            min-height: 140px;
        }
    </style>


    <div class=" mx-auto px-4 py-8 absolute left-1/2 -translate-x-1/2 flex flex-col gap-6 w-2/3 justify-center">
        <div class="mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Centralizador de Calificaciones</h1>
                <p class="text-gray-600 mt-2">Resumen de notas por curso y área según filtros.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('notas.import-form') }}"
                    class="px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    Importar Notas
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filtros de búsqueda -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <form action="{{ route('notas.index') }}" method="get" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label for="id_gestion" class="block text-sm font-medium text-gray-700">Gestión</label>
                    <select id="id_gestion" name="id_gestion"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($gestiones as $gestion)
                            <option value="{{ $gestion->id_gestion }}"
                                {{ $selectedGestion == $gestion->id_gestion ? 'selected' : '' }}>
                                {{ $gestion->anio }} - {{ $gestion->estado }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="periodo" class="block text-sm font-medium text-gray-700">Período</label>
                    <select id="periodo" name="periodo"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todos los períodos</option>
                        @foreach ($periodos as $key => $label)
                            <option value="{{ $key }}" {{ $selectedPeriodo == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="nivel" class="block text-sm font-medium text-gray-700">Nivel Educativo</label>
                    <select id="nivel" name="nivel"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Todos los niveles</option>
                        @foreach ($niveles as $key => $label)
                            <option value="{{ $key }}"
                                {{ $selectedNivel !== null && $selectedNivel == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                    Ver Resultados
                </button>
            </form>
        </div>

        <!-- Matriz de Cursos vs Áreas -->
        @if (request()->has('id_gestion'))
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Curso</th>
                            @foreach ($materias as $materia)
                                <th class="px-2 py-3 text-center text-sm font-semibold text-gray-800 align-bottom">
                                    <div class="vertical-text">{{ $materia }}</div>
                                </th>
                            @endforeach
                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-800">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($courses as $cursoId => $cursoNombre)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $cursoNombre }}</td>
                                @foreach ($materias as $idMateria => $materiaNombre)
                                    <td class="px-2 py-4 text-center text-sm text-gray-900">
                                        <span
                                            class="inline-flex items-center justify-center h-10 w-10 rounded-full font-semibold {{ isset($matrix[$cursoId][$idMateria]) && $matrix[$cursoId][$idMateria] > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $matrix[$cursoId][$idMateria] ?? 0 }}
                                        </span>
                                    </td>
                                @endforeach
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ route('notas.centralizador', ['idCurso' => $cursoId, 'id_gestion' => $selectedGestion, 'periodo' => $selectedPeriodo, 'nivel' => $selectedNivel]) }}"
                                            class="px-3 py-1 bg-blue-100 text-blue-700 rounded-md hover:bg-blue-200 text-xs font-bold transition">
                                            Ver Centralizador
                                        </a>
                                        @if ($selectedGestion && $selectedPeriodo)
                                            <form action="{{ route('notas.delete-by-periodo') }}" method="POST"
                                                class="inline"
                                                onsubmit="return confirm('¿Está seguro de eliminar todas las calificaciones de {{ $cursoNombre }} para este periodo?')">
                                                @csrf
                                                <input type="hidden" name="id_gestion" value="{{ $selectedGestion }}">
                                                <input type="hidden" name="periodo" value="{{ $selectedPeriodo }}">
                                                <input type="hidden" name="id_curso" value="{{ $cursoId }}">
                                                <input type="hidden" name="nivel" value="{{ $selectedNivel }}">
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-100 text-red-700 rounded-md hover:bg-red-200 text-xs font-bold transition">
                                                    Eliminar Notas
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 2 + $materias->count() }}" class="px-6 py-8 text-center text-gray-500">
                                    No hay registros para mostrar con los filtros actuales.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center border-2 border-dashed border-gray-200">
                <p class="text-gray-500 text-lg">
                    <i class="fas fa-search mr-2"></i>
                    Seleccione los filtros superiores y presione <strong>"Ver Resultados"</strong> para visualizar el
                    centralizador.
                </p>
            </div>
        @endif
    </div>


@endsection

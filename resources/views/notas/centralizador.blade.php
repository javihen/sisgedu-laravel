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

    <div class="mx-auto px-4 py-8 absolute left-1/2 -translate-x-1/2">
        <div class="mb-8 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Centralizador de Calificaciones</h1>
                <p class="text-gray-600 mt-2">Vista previa del curso {{ $curso->display_name }} según filtros seleccionados.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('notas.index', ['id_gestion' => $selectedGestion, 'periodo' => $selectedPeriodo, 'nivel' => $selectedNivel]) }}"
                    class="px-5 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition">
                    Volver al Resumen
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-lg border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Curso</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $curso->display_name }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Gestión</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ optional($gestiones->find($selectedGestion))->anio ?? 'No seleccionado' }}</p>
                </div>
                <div class="rounded-lg border border-gray-200 p-4">
                    <p class="text-sm text-gray-500">Período</p>
                    <p class="text-lg font-semibold text-gray-900">
                        {{ $selectedPeriodo ? $periodos[$selectedPeriodo] ?? $selectedPeriodo : 'Todos los períodos' }}
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto border">
            <table class="min-w-full border-collapse text-sm">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="border border-gray-200 px-3 py-2 text-left text-xs font-semibold text-gray-700">N°</th>
                        <th class="border border-gray-200 px-3 py-2 text-left text-xs font-semibold text-gray-700">CI</th>
                        <th class="border border-gray-200 px-3 py-2 text-left text-xs font-semibold text-gray-700 ">
                            APELLIDOS
                            Y NOMBRES</th>
                        <th class="border border-gray-200 px-3 py-2 text-left text-xs font-semibold text-gray-700">ESTADO
                        </th>
                        @foreach ($materias as $materia)
                            <th
                                class="border border-gray-200 px-2 py-3 text-center text-xs font-semibold text-gray-700 align-bottom">
                                <div class="vertical-text">{{ $materia->area }}</div>
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($students as $index => $student)
                        <tr class="{{ strtoupper($student->estado ?? '') !== 'E' ? 'bg-red-100' : 'hover:bg-gray-50' }}">
                            <td class="border border-gray-200 px-3 py-3 text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="border border-gray-200 px-3 py-3 text-sm text-gray-900">{{ $student->ci ?? 'N/A' }}
                            </td>
                            <td class="border border-gray-200 px-3 py-3 text-sm text-gray-900 w-auto whitespace-nowrap">
                                {{ trim("{$student->appaterno} {$student->apmaterno} {$student->nombres}") }}</td>
                            <td class="border border-gray-200 px-3 py-3 text-sm text-gray-900">
                                {{ strtoupper($student->estado ?? 'N/A') }}</td>
                            @foreach ($materias as $materia)
                                @php
                                    $nota = $studentNotes[$student->id_estudiante][$materia->id_materia] ?? null;
                                @endphp
                                <td class="border border-gray-200 px-2 py-3 text-center text-sm">
                                    @if (is_numeric($nota))
                                        <span
                                            class="inline-flex items-center justify-center h-9 w-12 rounded-md font-semibold {{ $nota >= 50 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ number_format($nota, 0) }}
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center justify-center h-9 w-12 rounded-md bg-gray-100 text-gray-500">-</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 4 + $materias->count() }}" class="px-6 py-8 text-center text-gray-500">
                                No hay estudiantes o notas registradas para este curso con los filtros seleccionados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($selectedGestion && $selectedPeriodo)
            <div class="mt-6">
                <form action="{{ route('notas.delete-by-periodo') }}" method="POST"
                    onsubmit="return confirm('¿Está seguro de eliminar todas las calificaciones de {{ $curso->display_name }} para este periodo?')"
                    class="inline-flex items-center gap-3">
                    @csrf
                    <input type="hidden" name="id_gestion" value="{{ $selectedGestion }}">
                    <input type="hidden" name="periodo" value="{{ $selectedPeriodo }}">
                    <input type="hidden" name="id_curso" value="{{ $curso->id }}">
                    <input type="hidden" name="nivel" value="{{ $selectedNivel }}">
                    <button type="submit"
                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 text-sm font-semibold transition">
                        Eliminar todas las notas del curso en este periodo
                    </button>
                </form>
            </div>
        @endif
    </div>
@endsection

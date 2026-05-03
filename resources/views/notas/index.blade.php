@extends('layouts.navhorizontal')


@section('content')
    <div class="container mx-auto px-4 py-8 absolute left-14">
        <!-- Encabezado -->
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Notas</h1>
                <p class="text-gray-600 mt-2">Gestión de calificaciones de estudiantes</p>
            </div>
            <a href="{{ route('notas.import-form') }}"
                class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                Importar Notas
            </a>
        </div>

        <!-- Tabla de notas -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Estudiante</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Asignación</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Calificación</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Período</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-800">Gestión</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($notas as $nota)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $nota->estudiante->nombres ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $nota->asignacion->materia->nombre_materia ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                                {{ $nota->calificacion >= 60 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ number_format($nota->calificacion, 2) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $nota->periodo }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $nota->gestion->nombre ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No hay notas registradas.
                                <a href="{{ route('notas.import-form') }}" class="text-blue-600 hover:underline">
                                    Importa notas
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-6">
            {{ $notas->links() }}
        </div>
    </div>
@endsection

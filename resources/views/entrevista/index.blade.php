@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 min-h-screen w-[calc(100%-80px)]  py-12 px-4 sm:px-6 lg:px-8 absolute">
        <div class="w-full mx-auto">
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Entrevistas con Padres</h1>
                <a href="{{ route('entrevistas.create') }}"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Nueva Entrevista
                </a>
            </div>

            {{-- Mensajes de éxito --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Tabla de entrevistas --}}
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if ($entrevistas->count() > 0)
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Estudiante</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Profesor</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Fecha</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Asistió</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Compromisos</th>
                                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($entrevistas as $entrevista)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="font-medium">{{ $entrevista->estudiante->nombres }}</div>
                                        <div class="text-gray-500">{{ $entrevista->estudiante->appaterno }}
                                            {{ $entrevista->estudiante->apmaterno }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $entrevista->profesor->nombres }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        {{ $entrevista->fecha->format('d/m/Y') }}
                                        <div class="text-gray-500">{{ $entrevista->hora }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        @if ($entrevista->asistio)
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Sí
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                No
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $entrevista->compromisos->count() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center space-x-2">
                                        <a href="{{ route('entrevistas.show', $entrevista->idEntrevista) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('entrevistas.edit', $entrevista->idEntrevista) }}"
                                            class="inline-flex items-center px-3 py-2 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('entrevistas.destroy', $entrevista->idEntrevista) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('¿Está seguro de eliminar esta entrevista?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded hover:bg-red-200 transition">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Paginación --}}
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $entrevistas->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No hay entrevistas</h3>
                        <p class="mt-1 text-gray-500">Comienza creando una nueva entrevista</p>
                        <a href="{{ route('entrevistas.create') }}"
                            class="mt-4 inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Nueva Entrevista
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

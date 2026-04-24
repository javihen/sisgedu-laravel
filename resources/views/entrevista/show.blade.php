@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 relative">
        <div class="max-w-4xl mx-auto">
            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Detalles de Entrevista</h1>
                <div class="space-x-3">
                    <a href="{{ route('entrevistas.edit', $entrevista->idEntrevista) }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                        Editar
                    </a>
                    <a href="{{ route('entrevistas.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                        Volver
                    </a>
                </div>
            </div>

            {{-- Mensajes --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <p class="text-green-800">{{ session('success') }}</p>
                </div>
            @endif

            {{-- Información de la Entrevista --}}
            <div class="bg-white rounded-lg shadow-lg p-8 mb-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Información de la Entrevista</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    {{-- Estudiante --}}
                    <div class="border-l-4 border-blue-600 pl-4">
                        <p class="text-sm text-gray-600">Estudiante</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $entrevista->estudiante->nombres }} {{ $entrevista->estudiante->appaterno }}
                            {{ $entrevista->estudiante->apmaterno }}
                        </p>
                    </div>

                    {{-- Profesor --}}
                    <div class="border-l-4 border-purple-600 pl-4">
                        <p class="text-sm text-gray-600">Profesor</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $entrevista->profesor->nombres }} {{ $entrevista->profesor->appaterno }}
                            {{ $entrevista->profesor->apmaterno }}
                        </p>
                    </div>

                    {{-- Fecha --}}
                    <div class="border-l-4 border-green-600 pl-4">
                        <p class="text-sm text-gray-600">Fecha</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $entrevista->fecha->format('d de F de Y') }}
                        </p>
                    </div>

                    {{-- Hora --}}
                    <div class="border-l-4 border-orange-600 pl-4">
                        <p class="text-sm text-gray-600">Hora</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $entrevista->hora }}
                        </p>
                    </div>

                    {{-- Asistió --}}
                    <div class="border-l-4 border-red-600 pl-4">
                        <p class="text-sm text-gray-600">Asistencia</p>
                        <p class="text-lg font-semibold">
                            @if ($entrevista->asistio)
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Asistió
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    No asistió
                                </span>
                            @endif
                        </p>
                    </div>

                    {{-- Creado --}}
                    <div class="border-l-4 border-gray-600 pl-4">
                        <p class="text-sm text-gray-600">Registrado</p>
                        <p class="text-lg font-semibold text-gray-900">
                            {{ $entrevista->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>
                </div>

                {{-- Observaciones --}}
                @if ($entrevista->observaciones)
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Observaciones:</p>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-gray-800">
                            {{ $entrevista->observaciones }}
                        </div>
                    </div>
                @endif

                {{-- Acuerdos --}}
                @if ($entrevista->acuerdos)
                    <div class="mb-6">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Acuerdos Alcanzados:</p>
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-gray-800">
                            {{ $entrevista->acuerdos }}
                        </div>
                    </div>
                @endif
            </div>

            {{-- Compromisos --}}
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Compromisos ({{ $entrevista->compromisos->count() }})
                </h2>

                @if ($entrevista->compromisos->count() > 0)
                    <div class="space-y-4">
                        @foreach ($entrevista->compromisos as $compromiso)
                            <div class="border border-gray-200 rounded-lg p-6 bg-gray-50">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Descripción</p>
                                        <p class="text-gray-900 mt-1">{{ $compromiso->descripcion }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Responsable</p>
                                        <p class="text-gray-900 mt-1">{{ $compromiso->responsable ?? 'No especificado' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Fecha Límite</p>
                                        <p class="text-gray-900 mt-1">
                                            @if ($compromiso->fechaLimite)
                                                {{ $compromiso->fechaLimite->format('d/m/Y') }}
                                            @else
                                                No especificada
                                            @endif
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-700">Estado</p>
                                        <p class="mt-1">
                                            @switch($compromiso->estado)
                                                @case('pendiente')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                                        Pendiente
                                                    </span>
                                                @break

                                                @case('en progreso')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                        En Progreso
                                                    </span>
                                                @break

                                                @case('cumplido')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                                        Cumplido
                                                    </span>
                                                @break

                                                @case('incumplido')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                                        Incumplido
                                                    </span>
                                                @break
                                            @endswitch
                                        </p>
                                    </div>
                                </div>

                                @if ($compromiso->fechaCumplimiento)
                                    <div class="pt-4 border-t border-gray-200">
                                        <p class="text-sm text-gray-600">Fecha de Cumplimiento:
                                            <strong>{{ $compromiso->fechaCumplimiento->format('d/m/Y') }}</strong>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">No hay compromisos registrados para esta entrevista</p>
                @endif
            </div>
        </div>
    </div>
@endsection

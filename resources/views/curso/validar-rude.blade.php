@extends('layouts.navhorizontal')

@section('content')
    <main class="mx-auto max-w-6xl px-4 py-8">
        <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Validación de RUDE</h1>
                <p class="text-sm text-slate-600">Gestión {{ $gestion->anio }}: RUDE vacíos y duplicados entre estudiantes inscritos.</p>
            </div>
            <a href="{{ route('curso.index') }}"
                class="rounded-lg border border-slate-300 bg-white px-4 py-2 font-semibold text-slate-700 hover:bg-slate-50">
                Volver a cursos
            </a>
        </div>

        <section class="mb-6 rounded-lg border border-amber-200 bg-amber-50 p-4 text-amber-900">
            <p class="font-semibold">
                {{ $estudiantesSinRude->count() }} sin RUDE · {{ $rudesDuplicados->count() }} RUDE duplicados
            </p>
            <p class="mt-1 text-sm">La comparación ignora espacios al inicio/final y diferencias entre mayúsculas y minúsculas.</p>
        </section>

        <section class="mb-8 overflow-x-auto rounded-lg border border-slate-200 bg-white shadow-sm">
            <h2 class="border-b border-slate-200 px-4 py-3 text-lg font-semibold text-slate-800">Estudiantes sin RUDE</h2>
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-2">Código</th>
                        <th class="px-4 py-2">Estudiante</th>
                        <th class="px-4 py-2">Cursos de la gestión</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($estudiantesSinRude as $estudiante)
                        <tr class="border-t border-slate-100">
                            <td class="px-4 py-2">{{ $estudiante->id_estudiante }}</td>
                            <td class="px-4 py-2">{{ trim($estudiante->appaterno . ' ' . $estudiante->apmaterno . ' ' . $estudiante->nombres) }}</td>
                            <td class="px-4 py-2">
                                {{ $estudiante->inscripciones->pluck('curso.display_name')->filter()->unique()->join(', ') ?: 'Sin curso asociado' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-6 text-center text-slate-500">Todos los estudiantes inscritos tienen RUDE.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <section class="overflow-x-auto rounded-lg border border-slate-200 bg-white shadow-sm">
            <h2 class="border-b border-slate-200 px-4 py-3 text-lg font-semibold text-slate-800">RUDE duplicados</h2>
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-100 text-slate-700">
                    <tr>
                        <th class="px-4 py-2">RUDE</th>
                        <th class="px-4 py-2">Código</th>
                        <th class="px-4 py-2">Estudiante</th>
                        <th class="px-4 py-2">Cursos de la gestión</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rudesDuplicados as $rude => $grupo)
                        @foreach ($grupo as $estudiante)
                            <tr class="border-t border-slate-100">
                                <td class="px-4 py-2 font-mono">{{ $rude }}</td>
                                <td class="px-4 py-2">{{ $estudiante->id_estudiante }}</td>
                                <td class="px-4 py-2">{{ trim($estudiante->appaterno . ' ' . $estudiante->apmaterno . ' ' . $estudiante->nombres) }}</td>
                                <td class="px-4 py-2">
                                    {{ $estudiante->inscripciones->pluck('curso.display_name')->filter()->unique()->join(', ') ?: 'Sin curso asociado' }}
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-slate-500">No se encontraron RUDE duplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </main>
@endsection

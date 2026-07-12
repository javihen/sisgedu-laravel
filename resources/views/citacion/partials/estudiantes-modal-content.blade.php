<div class="space-y-4">
    <div class="flex items-center justify-between rounded-lg border border-slate-200 bg-slate-50 px-4 py-3">
        <div>
            <p class="text-sm font-semibold text-slate-800">{{ $curso->display_name ?? 'Curso' }}</p>
            <p class="text-xs text-slate-500">Lista de estudiantes inscritos</p>
        </div>
        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
            {{ $estudiantes->count() }} {{ $estudiantes->count() === 1 ? 'estudiante' : 'estudiantes' }}
        </span>
    </div>

    @if ($estudiantes->isEmpty())
        <div
            class="rounded-lg border border-dashed border-slate-300 bg-white px-4 py-8 text-center text-sm text-slate-500">
            No hay estudiantes.
        </div>
    @else
        <div class="overflow-hidden rounded-lg border border-slate-200">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
                    <tr>
                        <th class="px-4 py-3">N°</th>
                        <th class="px-4 py-3">Código</th>
                        <th class="px-4 py-3">Estudiante</th>
                        <th class="px-4 py-3">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($estudiantes as $index => $estudiante)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">{{ $estudiante->id_estudiante }}</td>
                            <td class="px-4 py-3">
                                {{ trim(($estudiante->appaterno ?? '') . ' ' . ($estudiante->apmaterno ?? '') . ' ' . ($estudiante->nombres ?? '')) }}
                            </td>
                            <td class="px-4 py-3">
                                @if ($estudiante->estado === 'E')
                                    <span
                                        class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">Efectivo</span>
                                @elseif ($estudiante->estado === 'R')
                                    <span
                                        class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">Retirado</span>
                                @elseif ($estudiante->estado === 'A')
                                    <span
                                        class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Abandono</span>
                                @else
                                    <span
                                        class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700">Sin
                                        estado</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <button type="button"
                                    class="btn-citar-estudiante rounded-full border border-slate-300 bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 transition hover:bg-slate-200"
                                    data-id-estudiante="{{ $estudiante->id_estudiante }}"
                                    data-id-profesor="{{ $profesorId }}" data-id-asignacion="{{ $asignacionId }}"
                                    data-estado-inicial="disponible">
                                    <i class="fa-solid fa-user-plus mr-1"></i> Disponible
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

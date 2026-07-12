<div class="space-y-4">
    <div
        class="flex flex-col gap-3 rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold text-slate-800">{{ $curso->display_name ?? 'Curso' }}</p>
            <p class="text-xs text-slate-500">Lista de estudiantes inscritos</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                {{ $estudiantes->count() }} {{ $estudiantes->count() === 1 ? 'estudiante' : 'estudiantes' }}
            </span>
            @if (!empty($citacionAbierta))
                <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-medium text-amber-700">
                    Sesión: {{ $citacionAbierta->estado }}
                </span>
            @endif
        </div>
    </div>

    @if (!empty($citacionAbierta))
        <div class="flex flex-wrap items-center justify-end gap-2">
            <button type="button"
                class="btn-cerrar-sesion rounded-full border border-red-300 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-100"
                data-id-asignacion="{{ $asignacionId }}">
                <i class="fa-solid fa-lock mr-1"></i> Cerrar
            </button>
            <a href="{{ route('citacion.imprimir-listado', ['idAsignacion' => $asignacionId]) }}"
                class="btn-imprimir-listado rounded-full border border-emerald-300 bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition hover:bg-emerald-100"
                target="_blank">
                <i class="fa-solid fa-print mr-1"></i> Imprimir Listado
            </a>
        </div>
    @endif

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
                        {{-- <th class="px-4 py-3">Código</th> --}}
                        <th class="px-4 py-3">Estudiante</th>
                        <th class="px-4 py-3" colspan="2">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @foreach ($estudiantes as $index => $estudiante)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            {{-- <td class="px-4 py-3">{{ $estudiante->id_estudiante }}</td> --}}
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

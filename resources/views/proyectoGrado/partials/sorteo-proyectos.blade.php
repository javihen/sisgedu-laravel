<div>
    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
        <span
            class="font-label-md text-label-md uppercase tracking-wider text-on-surface-variant font-semibold flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px] text-primary">view_column</span>
            Cronograma aleatorio para {{ \Illuminate\Support\Carbon::parse($fechaDefensa)->format('d/m/Y') }}
        </span>
        <span
            class="px-2 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed font-data-mono text-data-mono font-bold text-[12px]">
            {{ $proyectosCount }} proyectos distribuidos en {{ count($mesas) }} mesas
        </span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-3.5">
        @foreach ($mesas as $mesa)
            <section
                class="bg-surface-container-lowest rounded border border-outline-variant/30 shadow-sm flex flex-col overflow-hidden">
                <header
                    class="p-3 bg-surface-container-low border-b border-outline-variant/20 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span
                            class="w-7 h-7 rounded bg-primary text-on-primary flex items-center justify-center font-data-mono text-data-mono font-bold text-[13px]">
                            M{{ str_pad((string) $mesa['numeroMesa'], 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="font-label-lg text-label-lg font-bold text-on-surface">
                            Mesa de Tribunal #{{ str_pad((string) $mesa['numeroMesa'], 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                    <span class="font-data-mono text-data-mono text-[11px] text-on-surface-variant">
                        {{ count($mesa['proyectos']) }} proyectos
                    </span>
                </header>

                <div class="p-2.5 flex flex-col gap-2 max-h-[360px] overflow-y-auto bg-surface-container-low/30">
                    @foreach ($mesa['proyectos'] as $asignacion)
                        @php
                            $proyecto = $asignacion['proyecto'];
                            $integrantes = collect([$proyecto->estudiante])
                                ->merge($proyecto->proyectoEstudiantes->pluck('estudiante'))
                                ->filter()
                                ->unique('id_estudiante');
                        @endphp
                        <article
                            class="p-2.5 rounded bg-surface-container-lowest border border-outline-variant/30 shadow-sm flex flex-col gap-1">
                            <div class="flex items-center justify-between gap-2">
                                <span
                                    class="px-1.5 py-0.5 rounded bg-secondary-fixed text-on-secondary-fixed font-data-mono text-data-mono font-bold text-[11px]">
                                    {{ substr($asignacion['horaInicio'], 0, 5) }} - {{ substr($asignacion['horaFin'], 0, 5) }}
                                </span>
                                <span class="font-data-mono text-data-mono text-primary font-bold text-[11px]">
                                    Proyecto #{{ $proyecto->idProyecto }}
                                </span>
                            </div>

                            <h3 class="font-body-md text-body-md font-semibold text-on-surface leading-snug">
                                {{ $proyecto->titulo }}
                            </h3>

                            <div class="text-[11px] text-on-surface-variant pt-1 border-t border-outline-variant/20">
                                <span class="font-semibold text-on-surface">Estudiante(s):</span>
                                @forelse ($integrantes as $integrante)
                                    {{ trim(implode(' ', array_filter([$integrante->nombres, $integrante->appaterno, $integrante->apmaterno]))) }}@if (!$loop->last), @endif
                                @empty
                                    Sin estudiante asociado
                                @endforelse
                            </div>

                            <div class="text-[11px] text-on-surface-variant">
                                <span class="font-semibold text-on-surface">Curso:</span>
                                {{ $proyecto->curso?->display_name ?? 'Sin curso asociado' }}
                                <span class="mx-1">•</span>
                                <span class="font-semibold text-on-surface">Tutor:</span>
                                @if ($proyecto->tutor)
                                    {{ trim(implode(' ', array_filter([$proyecto->tutor->nombres, $proyecto->tutor->appaterno, $proyecto->tutor->apmaterno]))) }}
                                @else
                                    Sin tutor asociado
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</div>

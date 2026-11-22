@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#005edb',
                        secondary: '#00875a',
                        error: '#ba1a1a',
                        'error-container': '#ffdad6',
                        'on-error-container': '#93000a',
                        'surface-container-low': '#f2f3ff',
                        'surface-container-lowest': '#ffffff',
                        'on-surface': '#131b2e',
                        outline: '#737785',
                    }
                }
            }
        };
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <main class="flex-1 overflow-y-auto p-6">
        <div class="mx-auto flex w-full max-w-[1720px] flex-col gap-4">
            <section class="rounded-lg bg-white p-5 shadow-sm">
                <div class="flex flex-col justify-between gap-4 lg:flex-row lg:items-center">
                    <div>
                        <div class="mb-1 flex items-center gap-2 text-xs">
                            <span class="inline-flex items-center gap-1 rounded bg-error-container px-2.5 py-1 font-semibold text-on-error-container">
                                <span class="material-symbols-outlined text-[15px]">error</span>
                                ALERTA ACADÉMICA - CIERRE ANUAL
                            </span>
                            <span class="text-outline">Calificaciones consolidadas de 3 trimestres</span>
                        </div>
                        <h1 class="text-2xl font-bold tracking-tight text-on-surface">Estudiantes reprobados con promedio final</h1>
                        <p class="mt-1 text-sm text-outline">Estudiantes con una o más materias cuyo promedio final es menor a 51 puntos.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-3 rounded bg-surface-container-low px-4 py-2">
                            <div>
                                <span class="block text-[11px] uppercase tracking-wider text-outline">Curso seleccionado</span>
                                <span class="font-semibold text-on-surface">{{ $curso->display_name }}</span>
                            </div>
                            <div class="h-8 w-px bg-slate-300"></div>
                            <div>
                                <span class="block text-[11px] uppercase tracking-wider text-outline">En riesgo crítico</span>
                                <span class="font-mono font-bold text-error">
                                    {{ $estudiantes->count() }} casos
                                    <span class="text-xs font-normal text-outline">/ {{ $totalAlumnos }} alumnos</span>
                                </span>
                            </div>
                        </div>
                        <button id="printReprobaciones" type="button"
                            class="inline-flex items-center gap-1.5 rounded bg-surface-container-low px-3.5 py-2 text-sm font-medium text-on-surface shadow-sm transition hover:bg-slate-200">
                            <span class="material-symbols-outlined text-[18px]">print</span>
                            Imprimir
                        </button>
                        <a href="{{ route('curso.reprobaciones.centralizador', $curso->id) }}" target="_blank" rel="noopener"
                            class="inline-flex items-center gap-1.5 rounded bg-primary px-3.5 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-800">
                            <span class="material-symbols-outlined text-[18px]">picture_as_pdf</span>
                            PDF centralizador
                        </a>
                    </div>
                </div>
            </section>

            <div class="grid grid-cols-1 items-start gap-4 xl:grid-cols-12">
                <section class="flex flex-col xl:col-span-9">
                    <div class="overflow-hidden rounded-lg bg-white shadow-sm">
                        <div class="flex flex-wrap items-center justify-between gap-3 bg-surface-container-low px-4 py-3">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">table_chart</span>
                                <span class="font-semibold text-on-surface">Nómina de materias no promovidas</span>
                                <span class="ml-1 rounded bg-error px-2 py-0.5 text-xs font-bold text-white">Promedio &lt; 51 pts</span>
                            </div>
                            <span class="text-sm text-outline">
                                Gestión escolar:
                                <strong class="font-mono text-on-surface">{{ $gestion?->anio ?? 'Sin gestión activa' }}</strong>
                            </span>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse text-left">
                                <thead>
                                    <tr class="bg-primary text-white">
                                        <th class="w-12 px-3 py-3 text-center text-xs uppercase tracking-wider">No</th>
                                        <th class="min-w-[210px] px-4 py-3 text-xs uppercase tracking-wider">Estudiante</th>
                                        <th class="min-w-[220px] px-4 py-3 text-xs uppercase tracking-wider">Materia / Docente</th>
                                        <th class="w-16 px-3 py-3 text-center text-xs uppercase tracking-wider">1er</th>
                                        <th class="w-16 px-3 py-3 text-center text-xs uppercase tracking-wider">2do</th>
                                        <th class="w-16 px-3 py-3 text-center text-xs uppercase tracking-wider">3er</th>
                                        <th class="w-32 bg-blue-700 px-4 py-3 text-center text-xs uppercase tracking-wider">Promedio final</th>
                                        <th class="w-52 px-4 py-3 text-center text-xs uppercase tracking-wider">Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-on-surface">
                                    @forelse ($estudiantes as $estudiante)
                                        @foreach ($estudiante['materias'] as $indiceMateria => $materia)
                                            <tr class="border-b border-slate-100 transition-colors hover:bg-slate-50">
                                                @if ($indiceMateria === 0)
                                                    <td rowspan="{{ $estudiante['materias']->count() }}"
                                                        class="bg-surface-container-low px-3 py-3 text-center align-middle font-mono text-outline">
                                                        {{ str_pad($loop->parent->iteration, 2, '0', STR_PAD_LEFT) }}
                                                    </td>
                                                    <td rowspan="{{ $estudiante['materias']->count() }}"
                                                        class="bg-slate-50 px-4 py-3 align-middle">
                                                        <div class="flex flex-col">
                                                            <span class="font-bold uppercase leading-tight">{{ $estudiante['nombre'] }}</span>
                                                            @if ($estudiante['rude'])
                                                                <span class="mt-1 font-mono text-[11px] text-outline">RUDE: {{ $estudiante['rude'] }}</span>
                                                            @endif
                                                            <span class="mt-1 inline-flex items-center gap-1 text-[11px] font-medium text-error">
                                                                <span class="h-1.5 w-1.5 rounded-full bg-error"></span>
                                                                {{ $estudiante['materias']->count() }}
                                                                {{ $estudiante['materias']->count() === 1 ? 'materia reprobada' : 'materias reprobadas' }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                @endif
                                                <td class="px-4 py-2.5 align-middle">
                                                    <div class="font-medium">{{ $materia['materia'] }}</div>
                                                    <div class="text-xs text-outline">Prof. {{ $materia['profesor'] }}</div>
                                                </td>
                                                @foreach ([1, 2, 3] as $periodo)
                                                    <td class="px-3 py-2.5 text-center align-middle font-mono {{ ($materia['notas'][$periodo] ?? null) !== null && $materia['notas'][$periodo] < 51 ? 'font-semibold text-error' : '' }}">
                                                        {{ ($materia['notas'][$periodo] ?? null) !== null ? round($materia['notas'][$periodo]) : '—' }}
                                                    </td>
                                                @endforeach
                                                <td class="bg-red-50 px-4 py-2.5 text-center align-middle">
                                                    <span class="inline-block rounded bg-error-container px-3 py-1 font-mono text-sm font-bold text-on-error-container">
                                                        {{ round($materia['promedio_final']) }} pts
                                                    </span>
                                                </td>
                                                @if ($indiceMateria === 0)
                                                    <td rowspan="{{ $estudiante['materias']->count() }}"
                                                        class="bg-white px-4 py-3 text-center align-middle">
                                                        <button type="button"
                                                            class="btn-ver-boletin inline-flex w-full items-center justify-center gap-1.5 rounded bg-secondary px-3 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-green-800"
                                                            data-id-estudiante="{{ $estudiante['id'] }}">
                                                            <span class="material-symbols-outlined text-[17px]">description</span>
                                                            <span>Boletín de calificaciones</span>
                                                        </button>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-4 py-12 text-center text-sm text-outline">
                                                No hay estudiantes con promedio final reprobado en este curso y gestión.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="flex flex-col items-center justify-between gap-3 bg-surface-container-low p-4 text-sm md:flex-row">
                            <span class="inline-flex items-center gap-2 text-outline">
                                <span class="h-3 w-3 rounded bg-error-container"></span>
                                Reprobado definitivo (&lt; 51 pts)
                            </span>
                            <span class="text-outline">Total de materias reprobadas:
                                <strong class="text-on-surface">{{ $totalMateriasReprobadas }}</strong>
                            </span>
                        </div>
                    </div>
                </section>

                <aside class="flex flex-col gap-4 xl:col-span-3">
                    <div class="rounded-lg bg-white p-5 text-center shadow-sm">
                        <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-primary">
                            <span class="material-symbols-outlined text-[32px]">school</span>
                        </div>
                        <h2 class="font-bold uppercase tracking-tight text-on-surface">Unidad Educativa Cristiano</h2>
                        <p class="text-lg font-bold text-primary">"Vida Nueva"</p>
                        <div class="mt-3 rounded bg-surface-container-low px-2 py-2 text-xs text-outline">
                            <span class="block font-semibold text-on-surface">{{ $curso->display_name }}</span>
                            <span>Gestión {{ $gestion?->anio ?? 'Sin gestión activa' }}</span>
                        </div>
                    </div>
                    <div class="rounded-lg bg-white p-5 shadow-sm">
                        <h3 class="mb-3 text-sm font-bold uppercase tracking-wider text-on-surface">Resumen del curso</h3>
                        <dl class="space-y-2 text-sm">
                            <div class="flex justify-between gap-3">
                                <dt class="text-outline">Estudiantes inscritos</dt>
                                <dd class="font-mono font-semibold text-on-surface">{{ $totalAlumnos }}</dd>
                            </div>
                            <div class="flex justify-between gap-3">
                                <dt class="text-outline">Estudiantes reprobados</dt>
                                <dd class="font-mono font-bold text-error">{{ $estudiantes->count() }}</dd>
                            </div>
                            <div class="flex justify-between gap-3">
                                <dt class="text-outline">Materias reprobadas</dt>
                                <dd class="font-mono font-bold text-error">{{ $totalMateriasReprobadas }}</dd>
                            </div>
                        </dl>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <div id="boletinModal" class="fixed inset-0 z-50 hidden items-center justify-center overflow-y-auto bg-slate-900/70 p-4"
        role="dialog" aria-modal="true" aria-labelledby="boletinTitulo">
        <div class="w-full max-w-5xl overflow-hidden rounded-xl bg-white shadow-2xl">
            <header class="flex flex-col justify-between gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center">
                <div>
                    <p class="text-xs uppercase tracking-[0.2em] text-slate-400">Boletín de calificaciones</p>
                    <h2 id="boletinTitulo" class="mt-1 text-xl font-bold text-slate-900">Estudiante</h2>
                    <p id="boletinSubtitulo" class="mt-1 text-sm text-slate-500">Curso • Gestión</p>
                </div>
                <div class="flex gap-2">
                    <button id="btnImprimirBoletin" type="button"
                        class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Imprimir</button>
                    <button id="closeBoletinModal" type="button"
                        class="rounded-full border border-slate-300 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cerrar</button>
                </div>
            </header>
            <div class="print-area max-h-[76vh] overflow-auto bg-slate-50">
                <table class="min-w-full border-separate border-spacing-0 text-sm text-slate-700">
                    <thead class="sticky top-0 bg-slate-100 text-left text-xs uppercase tracking-wider text-slate-600">
                        <tr>
                            <th class="border-b border-slate-200 px-4 py-3">Área / Materia y docente</th>
                            <th class="border-b border-slate-200 px-4 py-3 text-center">1er trimestre</th>
                            <th class="border-b border-slate-200 px-4 py-3 text-center">2do trimestre</th>
                            <th class="border-b border-slate-200 px-4 py-3 text-center">3er trimestre</th>
                            <th class="border-b border-slate-200 px-4 py-3 text-center">Promedio final</th>
                        </tr>
                    </thead>
                    <tbody id="boletinBody" class="divide-y divide-slate-200 bg-white"></tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        #boletinModal:not(.hidden) {
            display: flex;
        }

        .boletin-score-low {
            color: #b91c1c;
            font-weight: 600;
        }

        @media print {
            body.printing-boletin * {
                visibility: hidden;
            }

            body.printing-boletin #boletinModal,
            body.printing-boletin #boletinModal * {
                visibility: visible;
            }

            body.printing-boletin #boletinModal {
                position: static;
                display: block !important;
                background: white;
            }

            body.printing-boletin #boletinModal .print-area {
                max-height: none;
                overflow: visible;
            }
        }
    </style>

    <script>
        (() => {
            const boletinUrlTemplate = @json(route('boletin.obtener', ['idEstudiante' => '__STUDENT_ID__', 'id_curso' => $curso->id]));
            const modal = document.getElementById('boletinModal');
            const body = document.getElementById('boletinBody');
            const titulo = document.getElementById('boletinTitulo');
            const subtitulo = document.getElementById('boletinSubtitulo');

            function escapeHtml(value) {
                return String(value ?? '').replace(/[&<>"']/g, character => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;',
                })[character]);
            }

            function formatNota(value) {
                if (value === null || value === undefined) {
                    return '—';
                }

                const nota = Number(value);
                return Number.isFinite(nota) ? String(Math.round(nota)) : escapeHtml(value);
            }

            document.addEventListener('click', async event => {
                const button = event.target.closest('.btn-ver-boletin');
                if (button) {
                    const studentId = button.dataset.idEstudiante;
                    body.innerHTML = '<tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Cargando boletín...</td></tr>';
                    modal.classList.remove('hidden');
                    titulo.textContent = 'Cargando boletín...';

                    try {
                        const url = boletinUrlTemplate.replace('__STUDENT_ID__', encodeURIComponent(studentId));
                        const response = await fetch(url, { headers: { Accept: 'application/json' } });
                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.error || 'No se pudo cargar el boletín.');
                        }

                        titulo.textContent = data.estudiante?.nombre_completo || 'Estudiante';
                        subtitulo.textContent = `${data.estudiante?.curso || 'Sin curso'} • ${data.estudiante?.gestion || 'Sin gestión'}`;

                        if (!data.asignaciones?.length) {
                            body.innerHTML = '<tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">Este estudiante no tiene calificaciones registradas en este curso y gestión.</td></tr>';
                            return;
                        }

                        body.innerHTML = data.asignaciones.map(asignacion => {
                            const notas = asignacion.notas || {};
                            const celdasNotas = ['1', '2', '3'].map(periodo => {
                                const nota = notas[periodo];
                                const clase = nota !== null && nota !== undefined && nota < 51 ? 'boletin-score-low' : '';
                                return `<td class="px-4 py-3 text-center ${clase}">${formatNota(nota)}</td>`;
                            }).join('');
                            const promedio = asignacion.promedio_final;

                            return `<tr class="border-b border-slate-200 hover:bg-slate-50">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-slate-900">${escapeHtml(asignacion.materia)}</div>
                                    <div class="mt-1 text-xs text-slate-500">Prof. ${escapeHtml(asignacion.profesor)}</div>
                                </td>
                                ${celdasNotas}
                                <td class="px-4 py-3 text-center font-semibold ${promedio !== null && promedio < 51 ? 'boletin-score-low' : ''}">${formatNota(promedio)}</td>
                            </tr>`;
                        }).join('');
                    } catch (error) {
                        console.error('Error cargando boletín:', error);
                        body.innerHTML = '<tr><td colspan="5" class="px-4 py-8 text-center text-red-600">No se pudo cargar el boletín. Intente de nuevo.</td></tr>';
                    }

                    return;
                }

                if (event.target === modal || event.target.closest('#closeBoletinModal')) {
                    modal.classList.add('hidden');
                }
            });

            document.getElementById('btnImprimirBoletin').addEventListener('click', () => {
                document.body.classList.add('printing-boletin');
                window.print();
            });
            window.addEventListener('afterprint', () => document.body.classList.remove('printing-boletin'));
            document.getElementById('printReprobaciones').addEventListener('click', () => window.print());
            document.addEventListener('keydown', event => {
                if (event.key === 'Escape') {
                    modal.classList.add('hidden');
                }
            });
        })();
    </script>
@endsection

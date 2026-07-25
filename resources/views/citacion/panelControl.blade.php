@extends('layouts.navhorizontal')

@section('content')
    <div class="w-full px-4 pb-8 pt-4 sm:px-6 lg:px-8" style="font-family: 'Poppins', sans-serif;">
        <div class="space-y-4">
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                <div
                    class="rounded-md border border-slate-200 bg-white p-5 shadow-sm hover:border-rose-200 hover:bg-rose-200 cursor-pointer">
                    <div class="flex items-start gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-100 text-rose-700">
                            <i class="bx bx-bar-chart text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-slate-500">Total Citaciones</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">
                                {{ isset($citacion) ? $citacion->count() : 0 }}</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">Resumen total del periodo.</p>
                </div>
                <div
                    class="rounded border border-slate-200 bg-white p-5 shadow-sm hover:border-violet-200 hover:bg-violet-200 cursor-pointer">
                    <div class="flex items-start gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                            <i class="bx bx-user-pin text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-slate-500">Profesores que Citaron</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $profesores->count() }}</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">Docentes con citaciones registradas.</p>
                </div>
                <div
                    class="rounded border border-slate-200 bg-white p-5 shadow-sm hover:border-ramber200 hover:bg-amber-200 cursor-pointer">
                    <div class="flex items-start gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                            <i class="bx bx-group text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs uppercase text-slate-500">Estudiantes Citados Aula Abierta
                            </p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $estudiantes->count() }}</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">Atenciones agendadas.</p>
                </div>
                {{-- <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                            <i class="bx bx-calendar-check text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Citaciones Abiertas</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">18</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">Sesiones activas en curso.</p>
                </div>
                <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                            <i class="bx bx-check-circle text-xl"></i>
                        </div>
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-slate-500">Citaciones Cerradas</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900">53</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm text-slate-500">Registros finalizados y cerrados.</p>
                </div> --}}


            </div>

            <div class="grid gap-6 xl:grid-cols-[1.6fr_1fr]">
                <div class="rounded border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-slate-900">Citaciones Recientes</h2>
                            <p class="mt-1 text-sm text-slate-500">Últimas citaciones registradas en el sistema.</p>
                        </div>
                        <button
                            class="inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">
                            Ver todas las citaciones
                            <i class="bx bx-right-arrow-alt ml-2"></i>
                        </button>
                    </div>

                    <div class="mt-6 overflow-hidden rounded-[1.75rem] border border-slate-200">
                        <table class="w-full text-sm text-slate-700">
                            <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.18em] text-slate-500">
                                <tr>
                                    <th class="px-4 py-4">Registrado</th>
                                    <th class="px-4 py-4">Profesor</th>
                                    <th class="px-4 py-4">Curso</th>
                                    <th class="px-4 py-4">Materia</th>
                                    <th class="px-4 py-4">Estudiantes</th>

                                    <th class="px-4 py-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @foreach ($citacion->take(10) as $cita)
                                    <tr>
                                        <td class="px-4 py-4 text-sm text-slate-800">{{ $cita->fecha }}<br><span
                                                class="text-xs text-slate-500">{{ $cita->hora }}</span></td>
                                        <td class="px-4 py-4 text-sm text-slate-800">{{ $cita->profesor }}</td>
                                        <td class="px-4 py-4 text-sm text-slate-800">{{ $cita->curso }}</td>
                                        <td class="px-4 py-4 text-sm text-slate-800">
                                            <p class="border border-slate-500 text-center rounded text-xs">
                                                {{ $cita->materia }}</p>
                                        </td>
                                        <td class="px-4 py-4 text-sm text-slate-800">{{ $cita->estudiante }}</td>

                                        <td class="px-4 py-4">
                                            <div class="flex flex-wrap items-center gap-2">
                                                {{-- <button
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200">
                                                    <i class="bx bx-show"></i>
                                                </button> --}}
                                                <button
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                                <button
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-slate-700 hover:bg-slate-200">
                                                    <i class="bx bx-printer"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-900">Citaciones por Estado</p>
                            <span class="text-xs uppercase tracking-[0.24em] text-slate-400">75% cerradas</span>
                        </div>
                        <div class="mt-6 flex h-64 items-center justify-center">
                            <div class="h-56 w-full rounded-3xl bg-slate-50 p-6 text-center text-slate-400">
                                <i class="bx bx-pie-chart text-[3rem]"></i>
                                <p class="mt-4 text-sm">Gráfico de donut</p>
                            </div>
                        </div>
                        <div class="mt-6 grid gap-3 text-sm text-slate-700">
                            <div class="flex items-center justify-between rounded-3xl bg-emerald-50 px-4 py-3">
                                <span>Cerradas</span>
                                <span class="font-semibold text-slate-900">53 (75%)</span>
                            </div>
                            <div class="flex items-center justify-between rounded-3xl bg-amber-50 px-4 py-3">
                                <span>Abiertas</span>
                                <span class="font-semibold text-slate-900">18 (25%)</span>
                            </div>
                        </div>
                    </div>

                    <div class="rounded border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-semibold text-slate-900">Citaciones por Curso</p>
                            <span class="text-xs uppercase tracking-[0.24em] text-slate-400">Análisis rápido</span>
                        </div>
                        <div class="mt-6 h-64 rounded-[1.5rem] bg-slate-50 p-5 text-center text-slate-400">
                            <i class="bx bx-bar-chart-alt-2 text-[3rem]"></i>
                            <p class="mt-4 text-sm">Gráfico de barras</p>
                        </div>
                        <div class="mt-6 space-y-3 text-sm text-slate-700">
                            <div class="flex items-center justify-between rounded-3xl bg-slate-100 px-4 py-3">
                                <span>5° A</span>
                                <span class="font-semibold">23</span>
                            </div>
                            <div class="flex items-center justify-between rounded-3xl bg-slate-100 px-4 py-3">
                                <span>4° A</span>
                                <span class="font-semibold">12</span>
                            </div>
                            <div class="flex items-center justify-between rounded-3xl bg-slate-100 px-4 py-3">
                                <span>6° B</span>
                                <span class="font-semibold">14</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="grid gap-4 lg:grid-cols-[1fr_0.9fr] xl:grid-cols-[1.2fr_0.8fr]">
                    <div class="space-y-3">
                        <p class="text-base font-semibold text-slate-900">Buscar Citaciones</p>
                        <p class="text-sm text-slate-500">Filtra el historial por fechas, profesor, curso y estado.</p>
                    </div>
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                        <label class="space-y-2 text-sm text-slate-600">
                            Fecha Desde
                            <input type="date"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400" />
                        </label>
                        <label class="space-y-2 text-sm text-slate-600">
                            Fecha Hasta
                            <input type="date"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400" />
                        </label>
                        <label class="space-y-2 text-sm text-slate-600">
                            Profesor
                            <select
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400">
                                <option>Todos</option>
                                <option>Juan Pérez</option>
                                <option>María Gómez</option>
                            </select>
                        </label>
                        <label class="space-y-2 text-sm text-slate-600">
                            Estado
                            <select
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400">
                                <option>Todos</option>
                                <option>Abierta</option>
                                <option>Cerrada</option>
                            </select>
                        </label>
                    </div>
                </div>
                <div class="mt-5 flex flex-wrap items-center gap-3">
                    <button
                        class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">Buscar</button>
                    <button
                        class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Limpiar</button>
                </div>
            </div> --}}

            <div class="rounded border border-slate-200 bg-white p-6 shadow-sm">
                <div class="grid gap-3 md:grid-cols-3 xl:grid-cols-5">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-5 text-center">
                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                            <i class="bx bx-plus text-xl"></i>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-slate-900">Nueva Citación</p>
                        <p class="mt-2 text-xs text-slate-500">Ver citaciones abiertas</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-5 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                            <i class="bx bx-printer text-xl"></i>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-slate-900">Imprimir Citaciones</p>
                        <p class="mt-2 text-xs text-slate-500">Imprimir citaciones</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-5 text-center">
                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-100 text-violet-700">
                            <i class="bx bx-file text-xl"></i>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-slate-900">Reporte General</p>
                        <p class="mt-2 text-xs text-slate-500">Generar reporte</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-5 text-center">
                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                            <i class="bx bx-export text-xl"></i>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-slate-900">Exportar a Excel</p>
                        <p class="mt-2 text-xs text-slate-500">Exportar datos</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 px-4 py-5 text-center">
                        <div
                            class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-700">
                            <i class="bx bx-history text-xl"></i>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-slate-900">Historial Completo</p>
                        <p class="mt-2 text-xs text-slate-500">Ver historial</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

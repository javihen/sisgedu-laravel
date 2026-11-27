@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div
            class="sticky top-0 z-1 ml-3 w-full mt-2 h-12 bg-[#3B82F6] rounded-md flex justify-between items-center pl-2 pr-2 ">
            <div>
                <a href="" id="openListadoEstudiantes"
                    class="py-1 px-2 rounded text-slate-700 border text-md border-slate-700 bg-white"><i
                        class="fa-regular fa-address-book"></i></a>
                <a href="{{ route('estudiante.reportePDF', $curso->id) }}" id="reportePDF"
                    class="py-1 px-2 rounded text-slate-700 border text-md border-slate-700 bg-white" target="_blank"><i
                        class="fa-regular fa-file-pdf"></i></a>
                <a href="" class="py-1 px-2 rounded text-green-700 border border-green-700 bg-white"><i
                        class="fa-regular fa-file-excel"></i></a>
            </div>
            {{-- <div class="bg-white w-fit px-4 text-center rounded-md">
                <p class="text-md italic uppercase">Comunicacion y Lenguajes: Lengua originaria</p>
                <p class="text-[10px]">Prof. Lourdes Mamani Chipana</p>

            </div> --}}
            <div class="bg-white w-72 text-center rounded-md">
                <p class="text-md ">{{ $curso->display_name }}</p>
                <p class="text-[10px]">Listado de estudiantes</p>
            </div>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-[18px] mr-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false"
                        class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif
        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = true, 4000)" x-show="show" x-transition class="w-full ml-4 mr-4">
                <div
                    class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif

        <div class=" ml-3 w-full mt-2  flex flex-col gap-1 ">
            <div class="bg-white w-full  border border-slate-300 rounded-md">
                <table class="w-full ">
                    <tr class="bg-[#64748B] text-white text-sm text-center ">
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Estudiante</td>
                        <td>Genero</td>
                        <td class="w-30">Estado</td>

                        <td>Opciones</td>
                    </tr>
                    @foreach ($estudiantes as $estudiante)
                        <tr class="text-sm text-center border-t border-slate-400 hover:bg-slate-200">
                            <td class="h-8">{{ $loop->iteration }}</td>
                            <td>{{ $estudiante->id_estudiante }}</td>
                            <td class="text-left">{{ $estudiante->appaterno }} {{ $estudiante->apmaterno }}
                                {{ $estudiante->nombres }}</td>

                            <td>
                                @if ($estudiante->genero == 'M')
                                    <p class="border border-blue-500 bg-white text-blue-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle"
                                        data-id="{{ $estudiante->id_estudiante }}">
                                        <i class="fa-solid fa-person"></i>
                                    </p>
                                @else
                                    <p class="border border-pink-500 bg-white text-pink-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle"
                                        data-id="{{ $estudiante->id_estudiante }}">
                                        <i class="fa-solid fa-person-dress"></i>
                                    </p>
                                @endif
                            </td>
                            <td>
                                @if ($estudiante->estado === 'E')
                                    <button type="button" data-id="{{ $estudiante->id_estudiante }}"
                                        class="estado-toggle px-2 py-1 my-2 text-xs text-green-500 border border-green-500 rounded w-fit hover:bg-green-500 hover:text-white cursor-pointer">
                                        Efectivo
                                    </button>
                                @elseif ($estudiante->estado === 'R')
                                    <button type="button" data-id="{{ $estudiante->id_estudiante }}"
                                        class="estado-toggle px-2 py-1 my-2 text-xs text-red-500 border border-red-500 rounded w-fit hover:bg-red-500 hover:text-white cursor-pointer">
                                        Retirado
                                    </button>
                                @elseif ($estudiante->estado === 'A')
                                    <button type="button" data-id="{{ $estudiante->id_estudiante }}"
                                        class="estado-toggle px-2 py-1 my-2 text-xs text-slate-500 border border-slate-500 rounded w-fit hover:bg-slate-500 hover:text-white cursor-pointer">
                                        Abandono
                                    </button>
                                @else
                                    <span class="px-2 text-sm text-gray-500"
                                        data-id="{{ $estudiante->id_estudiante }}">—</span>
                                @endif
                            </td>

                            <td>
                                <a href="#"
                                    class="btn-ver-boletin bg-[#1F1F1F] text-white px-2 py-2 rounded hover:text-[#1F1F1F] hover:bg-white border-2 border-[#1F1F1F]"
                                    data-id="{{ $estudiante->id_estudiante }}"><i class="fa-solid fa-book"></i>
                                    Calificaciones</a>
                                <a href="#"
                                    class="bg-[#888888] text-white text-xs px-2 py-2 rounded hover:text-[#888888] hover:bg-white border-2 border-[#888888] "><i
                                        class="fa-solid fa-list-check"></i> Asistencias</a>
                                <a href="#historial-bth-modal" data-id="{{ $estudiante->id_estudiante }}"
                                    class="btn-historial-bth bg-[#8B00FF] text-white text-xs px-2 py-2 rounded hover:text-[#8B00FF] hover:bg-white border-2 border-[#8B00FF]">
                                    Historial BTH</a>
                                <a href="#"
                                    class="bg-[#F62961] text-white text-xs px-2 py-2 rounded hover:text-[#F62961] hover:bg-white border-2 border-[#F62961] ">
                                    <i class="fa-solid fa-box"></i> Observaciones</a>
                                <form action="{{ route('estudiante.destroy', $estudiante->id_estudiante) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                        class="py-2 px-3 border border-red-500 bg-white my-2 rounded-sm text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </form>
                                {{-- <a href="#"
                                    class="ml-1 p-2 edit-btn border border-[#3B82F6] bg-white text-[#3B82F6] rounded-sm hover:bg-[#3B82F6] hover:text-white"
                                    data-id="{{ $estudiante->id_estudiante }}"
                                    data-codigo="{{ $estudiante->id_estudiante }}" data-estado="{{ $estudiante->estado }}"
                                    data-rude="{{ $estudiante->rude }}" data-ci="{{ $estudiante->ci }}"
                                    data-nombres="{{ $estudiante->nombres }}"
                                    data-appaterno="{{ $estudiante->appaterno }}"
                                    data-apmaterno="{{ $estudiante->apmaterno }}" data-genero="{{ $estudiante->genero }}"
                                    data-fecha="{{ $estudiante->fecha_nacimiento }}"
                                    data-observacion="{{ $estudiante->observacion }}"
                                    data-id_curso="{{ $estudiante->id_curso ?? 'SIN CURSO' }}">
                                    <i class='bx bx-edit-alt'></i> Editar
                                </a> --}}
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
            {{-- modal boletin de calificaciones nuevo --}}

            <div aria-labelledby="modal-title" aria-modal="true" aria-hidden="true"
                class="invisible pointer-events-none fixed inset-0 z-[9999] flex items-center justify-center overflow-y-auto bg-slate-900/60 p-2 font-[poppins] opacity-0 backdrop-blur-sm transition-opacity duration-300 ease-out motion-reduce:transition-none sm:p-4 lg:p-6"
                id="boletin-modal" role="dialog" tabindex="-1">
                <div
                    class="my-auto flex max-h-[92vh] w-full max-w-6xl translate-y-4 scale-95 flex-col overflow-hidden rounded-xl border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-300 ease-out motion-reduce:transition-none">
                    <div
                        class="bg-[#005edb] text-white px-6 py-4 flex items-center justify-between shadow-sm flex-shrink-0">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center border border-white/20">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewbox="0 0 24 24">
                                    <path
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-white leading-tight" id="modal-title">Boletín de
                                    Calificaciones</h3>
                                <p class="text-xs text-blue-100 font-normal mt-0.5" id="boletin-encabezado">Cargando
                                    datos...</p>
                            </div>
                        </div><button aria-label="Cerrar"
                            class="p-1.5 rounded-lg text-blue-100 hover:text-white hover:bg-white/10 transition-colors"
                            id="cerrar-boletin-superior" type="button"><svg class="w-5 h-5" fill="none"
                                stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                <path d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg></button>
                    </div>
                    <div class="p-6 overflow-y-auto space-y-5 flex-1 bg-slate-50/50">
                        <div class="bg-white rounded-lg border border-slate-200 p-4 shadow-xs">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 text-xs">
                                <div class="sm:col-span-2"><span
                                        class="text-slate-400 block font-normal mb-0.5">Estudiante:</span>
                                    <div class="text-sm font-bold text-slate-900 flex items-center space-x-2"><span
                                            class="text-slate-500 font-medium" id="boletin-codigo">—</span><span
                                            id="boletin-estudiante">Cargando...</span></div>
                                </div>
                                <div><span class="text-slate-400 block font-normal mb-0.5">Código RUDE:</span><span
                                        class="font-mono font-semibold text-slate-800" id="boletin-rude">—</span></div>
                                <div><span class="text-slate-400 block font-normal mb-0.5">Estado de Gestión:</span><span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full border text-[11px] font-semibold"
                                        id="boletin-estado">Cargando...</span></div>
                                <div><span class="text-slate-400 block font-normal mb-0.5">Curso y Paralelo:</span><span
                                        class="font-semibold text-slate-800" id="boletin-curso">—</span></div>
                                <div><span class="text-slate-400 block font-normal mb-0.5">Nivel Educativo:</span><span
                                        class="text-slate-700 font-medium" id="boletin-nivel">—</span></div>
                                <div><span class="text-slate-400 block font-normal mb-0.5">Turno:</span><span
                                        class="text-slate-700 font-medium" id="boletin-turno">—</span></div>
                                <div><span class="text-slate-400 block font-normal mb-0.5">Tutor Asignado:</span><span
                                        class="text-slate-700 font-medium">No registrado</span></div>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg border border-slate-200 shadow-xs overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-[760px] text-left text-xs">
                                    <thead
                                        class="bg-slate-100/90 text-slate-700 font-semibold border-b border-slate-200 uppercase text-[11px] tracking-wider">
                                        <tr>
                                            <th class="py-2.5 px-4">Área / Asignatura</th>
                                            <th class="py-2.5 px-3">Docente</th>
                                            <th class="py-2.5 px-2 text-center w-16">1er T.</th>
                                            <th class="py-2.5 px-2 text-center w-16">2do T.</th>
                                            <th class="py-2.5 px-2 text-center w-16">3er T.</th>
                                            <th class="py-2.5 px-3 text-center w-20">Promedio</th>
                                            <th class="py-2.5 px-3 text-center w-32">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100" id="boletin-filas">
                                        <tr class="hover:bg-rose-50/40 transition-colors bg-rose-50/20">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Comunicación y lenguajes
                                                (Castellana)</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Mario F. Mercado
                                                Mamani
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-bold text-rose-600 bg-rose-50/60">45
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-bold text-rose-600 bg-rose-50/60">35
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">75</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-rose-600">51.7</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-rose-100 text-rose-700 rounded-md border border-rose-200">Requiere
                                                    Refuerzo</span></td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Lengua Extranjera (Inglés)
                                            </td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Gladys Choque</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">65</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">70</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">68</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">67.7</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-rose-50/40 transition-colors bg-rose-50/20">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Educación Musical</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Luisa Espinoza
                                                Fernandez
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-bold text-rose-600 bg-rose-50/60">45
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-bold text-rose-600 bg-rose-50/60">35
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">75</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-rose-600">51.7</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-rose-100 text-rose-700 rounded-md border border-rose-200">Requiere
                                                    Refuerzo</span></td>
                                        </tr>
                                        <tr class="hover:bg-rose-50/40 transition-colors bg-rose-50/20">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Artes Plásticas y Visuales
                                            </td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Victor Hugo Sanchez
                                                Lopez
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-bold text-rose-600 bg-rose-50/60">45
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-bold text-rose-600 bg-rose-50/60">35
                                            </td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">75</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-rose-600">51.7</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-rose-100 text-rose-700 rounded-md border border-rose-200">Requiere
                                                    Refuerzo</span></td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Educación Física y Deportes
                                            </td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Roberto Canaviri</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">80</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">85</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">90</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">85.0</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Ciencias Sociales</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Marlene Vargas</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">60</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">62</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">68</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">63.3</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Matemática</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Carlos Mendoza</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">58</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">60</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">64</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">60.7</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Física - Química</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Andrea Rocha</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">62</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">59</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">65</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">62.0</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Biología - Geografía</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Wilson Condori</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">70</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">68</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">72</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">70.0</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="py-2.5 px-4 font-medium text-slate-900">Filosofía y Psicología</td>
                                            <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. Rene Quispe</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">65</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">70</td>
                                            <td class="py-2.5 px-2 text-center font-medium text-slate-700">68</td>
                                            <td class="py-2.5 px-3 text-center font-bold text-slate-800">67.7</td>
                                            <td class="py-2.5 px-3 text-center"><span
                                                    class="inline-block px-2 py-0.5 text-[10px] font-semibold bg-emerald-100 text-emerald-800 rounded-md border border-emerald-200">Aprobado</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div class="bg-white rounded-lg border border-slate-200 p-3 flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-blue-50 text-[#005edb] flex items-center justify-center font-bold text-sm border border-blue-100">
                                    <span id="boletin-promedio">—</span>
                                </div>
                                <div><span class="text-[11px] text-slate-400 block font-normal leading-none">Promedio
                                        General</span><span class="text-xs font-bold text-slate-800">Escala 1 a 100</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg border border-slate-200 p-3 flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center font-bold text-sm border border-emerald-100">
                                    <span id="boletin-aprobadas">— / —</span>
                                </div>
                                <div><span class="text-[11px] text-slate-400 block font-normal leading-none">Materias
                                        Aprobadas</span><span class="text-xs font-bold text-slate-800"
                                        id="boletin-porcentaje">—</span>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg border border-slate-200 p-3 flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 rounded-lg bg-rose-50 text-rose-700 flex items-center justify-center font-bold text-sm border border-rose-100">
                                    <span id="boletin-reprobadas">—</span>
                                </div>
                                <div><span class="text-[11px] text-slate-400 block font-normal leading-none">En Riesgo /
                                        Reprobadas</span> <span class="text-xs font-bold text-rose-600"
                                        id="boletin-riesgo-etiqueta">—</span></div>
                            </div>
                        </div>
                        <div
                            class="bg-amber-50/70 border border-amber-200/80 rounded-lg p-3 text-xs flex items-start space-x-2.5">
                            <svg class="w-4 h-4 text-amber-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor"
                                stroke-width="2" viewbox="0 0 24 24">
                                <path
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            <div><span class="font-bold text-amber-900 block mb-0.5">Observaciones pedagógicas /
                                    Recomendación:</span>
                                <p class="text-amber-800 leading-relaxed" id="boletin-observaciones">Cargando
                                    observaciones...</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-slate-50 border-t border-slate-200 px-6 py-3.5 flex flex-wrap items-center justify-between gap-3 flex-shrink-0">
                        <div class="hidden basis-full rounded-md border px-3 py-2 text-xs" id="boletin-alerta"
                            role="status" aria-live="polite"></div>
                        <button
                            class="px-4 py-2 text-xs font-medium text-slate-700 bg-white border border-slate-300 rounded hover:bg-slate-50 transition-colors shadow-2xs"
                            id="cerrar-boletin" type="button">Cerrar</button>
                        <div class="flex flex-wrap items-center justify-end gap-2.5"><button
                                class="px-4 py-2 text-xs font-semibold text-white bg-blue-600 hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-50 rounded shadow-sm transition-colors"
                                disabled id="editar-calificaciones" type="button">Modificar
                                calificaciones</button><button
                                class="px-3.5 py-2 text-xs font-medium text-slate-700 bg-white border border-slate-300 rounded hover:bg-slate-50 transition-colors shadow-2xs flex items-center space-x-1.5"
                                id="descargar-boletin" type="button"><svg class="w-4 h-4 text-slate-500" fill="none"
                                    stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                    <path d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><span>Descargar PDF</span></button><button
                                class="px-4 py-2 text-xs font-semibold text-white bg-[#00875a] hover:bg-[#00754e] rounded shadow-sm transition-colors flex items-center space-x-1.5"
                                id="imprimir-boletin" type="button"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" stroke-width="2" viewbox="0 0 24 24">
                                    <path
                                        d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4H7v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg><span>Imprimir Boletín Oficial</span></button></div>
                    </div>
                </div>
            </div>

            <div id="historial-bth-modal" aria-labelledby="historial-bth-title" aria-modal="true" aria-hidden="true"
                class="invisible pointer-events-none fixed inset-0 z-[10000] flex items-center justify-center overflow-y-auto bg-slate-900/60 p-2 opacity-0 backdrop-blur-sm transition-opacity duration-300 sm:p-4"
                role="dialog" tabindex="-1">
                <div
                    class="my-auto flex max-h-[92vh] w-full max-w-6xl translate-y-4 scale-95 flex-col overflow-hidden rounded-xl border border-slate-200 bg-white opacity-0 shadow-2xl transition-all duration-300">
                    <div class="flex items-center justify-between bg-[#8B00FF] px-6 py-4 text-white">
                        <div>
                            <h2 id="historial-bth-title" class="text-base font-bold">Historial de promedios BTH</h2>
                            <p id="historial-bth-estudiante" class="mt-1 text-xs text-purple-100">Cargando estudiante...</p>
                        </div>
                        <button id="cerrar-historial-bth" type="button" aria-label="Cerrar"
                            class="rounded-lg p-2 text-purple-100 hover:bg-white/10 hover:text-white">&times;</button>
                    </div>
                    <div class="flex-1 overflow-auto bg-slate-50 p-4 sm:p-6">
                        <p class="mb-4 text-sm text-slate-600">
                            Registre o corrija los promedios anuales de cada materia. Estos datos se guardan por separado
                            y no modifican las calificaciones ni los promedios del boletín actual.
                        </p>
                        <div class="overflow-x-auto rounded-lg border border-slate-200 bg-white">
                            <table class="w-full min-w-[900px] text-sm">
                                <thead class="bg-slate-100 text-center text-xs text-slate-700">
                                    <tr>
                                        <th class="px-3 py-3 text-left">Materia</th>
                                        <th class="px-2 py-3">2022</th>
                                        <th class="px-2 py-3">2023</th>
                                        <th class="px-2 py-3">2024</th>
                                        <th class="px-2 py-3">2025</th>
                                        <th class="px-2 py-3">2026</th>
                                        <th class="px-3 py-3">Promedio 2024–2026</th>
                                    </tr>
                                </thead>
                                <tbody id="historial-bth-filas">
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-slate-500">Seleccione un estudiante.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-200 bg-white px-6 py-4">
                        <div id="historial-bth-alerta" class="hidden rounded-md border px-3 py-2 text-xs" role="status"
                            aria-live="polite"></div>
                        <div class="ml-auto flex gap-2">
                            <button id="cerrar-historial-bth-footer" type="button"
                                class="rounded border border-slate-300 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Cerrar</button>
                            <button id="guardar-historial-bth" type="button" disabled
                                class="rounded bg-[#8B00FF] px-4 py-2 text-sm font-semibold text-white hover:bg-purple-800 disabled:cursor-not-allowed disabled:opacity-50">Guardar promedios</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end bg-white w-full  border border-slate-300 rounded-md mb-16 h-30">
                <div class="flex my-auto flex-col mr-2">
                    <a href=""
                        class="py-1 px-2 rounded mb-2 text-center text-slate-700 border text-md border-slate-700 bg-white"><i
                            class="fa-regular fa-address-book"></i> Adicionar estudiante</a>

                    <a href=""
                        class="py-1 px-2 rounded text-center text-green-700 border border-green-700 bg-white"><i
                            class="fa-regular fa-file-excel"></i> Generar archivo</a>
                </div>
            </div>
        </div>

        {{-- Nos crearemos el formulario modal con el que podamos nosotros registras a nuevos estudiantes --}}
        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">REGISTRO DE NUEVO ESTUDIANTE</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formularioEstudiante" action="{{ route('estudiante.store') }}"
                    method="post">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">

                    <div id="selectCursoCreate" class="basis-1/2 flex flex-col mt-2 w-full ">
                        <label for="id_curso" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Asignar a curso
                        </label>
                        <select name="id_curso" id="id_curso" class="border border-slate-600 bg-white p-2 rounded-md">
                            <option value="">- seleccione un curso -</option>
                        </select>
                    </div>
                    <div class="flex flex-row mt-4 gap-1">
                        <div class="basis-1/2 ">
                            <label for="codigo" class="text-xs relative top-3 left-3 bg-white px-2">Codigo </label>
                            <input type="text" name="codigo" id="codigo"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Estado
                            </label>
                            <select name="estado" id="estado"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="E">EFECTIVO</option>
                                <option value="R">RETIRADO</option>
                                <option value="A">ABANDONO</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row gap-1 mt-[-25px]">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">R.U.D.E. </label>
                            <input type="text" name="rude" id="rude"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">C.I. </label>
                            <input type="text" name="ci" id="ci"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Nombre (s) </label>
                        <input type="text" name="nombres" id="nombres"
                            class="w-full border border-slate-700 rounded-md p-2 uppercase">
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Apellido paterno
                            </label>
                            <input type="text" name="appaterno" id="appaterno"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Apellido materno
                            </label>
                            <input type="text" name="apmaterno" id="apmaterno"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Genero
                            </label>
                            <select name="genero" id="genero"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="">seleccione</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Fecha de nacimiento
                            </label>
                            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Observaciones </label>
                        <textarea name="observacion" id="observacion" class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </textarea>
                    </div>
                    <hr class="border-slate-200 border">
                    <!-- Botones -->
                    <div class="flex justify-end space-x-2  ">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cancelar</button>
                        <button type="submit" id="submitBtn"
                            class="px-4 py-2 bg-blue-600 text-white w-1/2 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modalListado"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50"
            data-curso-id="{{ $curso->id }}">
            <!-- Contenedor del modal -->
            <div id="modalListadoContent" class="bg-white rounded-md shadow-lg w-[800px] p-4 transform transition-all">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left">LISTADO DE ESTUDIANTES</h2>
                <hr class="border border-slate-200 mb-4">

                <!-- Input de búsqueda -->
                <div class="mb-4">
                    <input type="text" id="inputBusqueda" placeholder="Buscar por nombre, RUDE o código..."
                        class="w-full border border-slate-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Tabla de estudiantes -->
                <div class="overflow-auto max-h-96 border border-slate-300 rounded-md">
                    <table class="w-full">
                        <thead class="bg-[#64748B] text-white text-sm sticky top-0">
                            <tr>
                                <th class="py-2 px-2 text-center w-10">
                                    {{-- <input type="checkbox" id="checkboxSelectAll" class="cursor-pointer"> --}}
                                </th>
                                <th class="py-2 px-2 text-left">Codigo</th>
                                <th class="py-2 px-2 text-left">Rude</th>
                                <th class="py-2 px-2 text-left">Nombre Completo</th>
                                <th class="py-2 px-2 text-center">Genero</th>
                                <th class="py-2 px-2 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody id="tablaEstudiantesBody">
                            <!-- Se llena dinamicamente con JavaScript -->
                        </tbody>
                    </table>
                </div>

                <hr class="border-slate-200 border mt-4">

                <!-- Botones -->
                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" id="closeModalListado"
                        class="px-4 py-2 border border-gray-300 rounded-md w-1/4 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cerrar</button>
                    <button type="button" id="btnSeleccionarEstudiantes"
                        class="px-4 py-2 bg-blue-600 text-white w-1/4 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Registrarlos</button>
                </div>
            </div>
        </div>




    </div>

    <script>
        // Abrir modal de listado
        document.getElementById('openListadoEstudiantes').addEventListener('click', function(e) {
            e.preventDefault();
            const modal = document.getElementById('modalListado');
            modal.classList.remove('hidden');

            // Cargar los estudiantes
            cargarEstudiantes();
        });

        // Cerrar modal de listado
        document.getElementById('closeModalListado').addEventListener('click', function() {
            document.getElementById('modalListado').classList.add('hidden');
        });

        // Cargar estudiantes vía AJAX
        function cargarEstudiantes() {
            fetch('{{ route('estudiante.api.all') }}')
                .then(response => response.json())
                .then(data => {
                    // Guardar datos en una variable global para filtrado
                    window.estudiantes_data = data;

                    const tbody = document.getElementById('tablaEstudiantesBody');
                    tbody.innerHTML = ''; // Limpiar tabla

                    data.forEach((estudiante, index) => {
                        const row = document.createElement('tr');
                        row.className = 'border-t border-slate-400 hover:bg-slate-100';
                        row.addEventListener('click', function() {
                            toggleCheckbox(this);
                        });
                        row.setAttribute('data-codigo', estudiante.id_estudiante.toLowerCase());
                        row.setAttribute('data-rude', (estudiante.rude || '').toLowerCase());
                        row.setAttribute('data-nombre', (estudiante.appaterno + ' ' + estudiante.apmaterno +
                            ' ' + estudiante.nombres).toLowerCase());

                        const generoIcon = estudiante.genero === 'M' ?
                            '<i class="fa-solid fa-person"></i>' :
                            '<i class="fa-solid fa-person-dress"></i>';

                        const estadoClase = estudiante.estado === 'E' ? 'text-green-500' :
                            estudiante.estado === 'R' ? 'text-red-500' :
                            estudiante.estado === 'A' ? 'text-slate-500' : '';

                        const estadoTexto = estudiante.estado === 'E' ? 'Efectivo' :
                            estudiante.estado === 'R' ? 'Retirado' :
                            estudiante.estado === 'A' ? 'Abandono' : '';

                        row.innerHTML = `
                            <td class="py-2 px-2 text-center">
                                <input type="checkbox" class="checkbox-estudiante cursor-pointer" value="${estudiante.id_estudiante}">
                            </td>
                            <td class="py-2 px-2 text-sm">${estudiante.id_estudiante}</td>
                            <td class="py-2 px-2 text-sm">${estudiante.rude}</td>

                            <td class="py-2 px-2 text-sm" id='fila' onclick="toggleCheckbox(this)">${estudiante.appaterno} ${estudiante.apmaterno} ${estudiante.nombres}</td>
                            <td class="py-2 px-2 text-center text-sm">
                                <span class="border border-slate-400 rounded px-2 py-1 cursor-pointer genero-toggle-modal" data-id="${estudiante.id_estudiante}">
                                    ${generoIcon}
                                </span>
                            </td>
                            <td class="py-2 px-2 text-center text-sm">
                                <span class="border border-slate-400 rounded px-2 py-1 ${estadoClase}">
                                    ${estadoTexto}
                                </span>
                            </td>
                        `;

                        tbody.appendChild(row);
                    });

                    // Agregar listener al checkbox de seleccionar todos
                    /* document.getElementById('checkboxSelectAll').addEventListener('change', function() {
                        const checkboxes = document.querySelectorAll('.checkbox-estudiante');
                        checkboxes.forEach(checkbox => {
                            checkbox.checked = this.checked;
                        });
                    }); */

                    // Agregar evento de búsqueda
                    document.getElementById('inputBusqueda').addEventListener('keyup', filtrarEstudiantes);
                })
                .catch(error => {
                    console.error('Error cargando estudiantes:', error);
                    alert('Error al cargar los estudiantes');
                });
        }




        function toggleCheckbox(row) {
            const checkbox = row.querySelector('input[type="checkbox"]');

            if (!checkbox) {
                console.error('Checkbox no encontrado en la fila', row);
                return;
            }

            checkbox.checked = !checkbox.checked;
        }


        document.addEventListener('onclick', function(e) {
            if (e.target && e.target.id == 'fila') {
                console.log('hola');
            }
        });
        // Función para filtrar estudiantes en tiempo real
        function filtrarEstudiantes() {
            const busqueda = document.getElementById('inputBusqueda').value.toLowerCase();
            const filas = document.querySelectorAll('#tablaEstudiantesBody tr');

            filas.forEach(fila => {
                const codigo = fila.getAttribute('data-codigo');
                const rude = fila.getAttribute('data-rude');
                const nombre = fila.getAttribute('data-nombre');

                // Mostrar fila si coincide con el código, rude o nombre
                if (codigo.includes(busqueda) || rude.includes(busqueda) || nombre.includes(busqueda)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        }

        // Manejar selección de estudiantes
        document.getElementById('btnSeleccionarEstudiantes').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.checkbox-estudiante:checked');
            const seleccionados = Array.from(checkboxes).map(cb => cb.value);

            if (seleccionados.length === 0) {
                alert('Por favor selecciona al menos un estudiante');
                return;
            }

            // Obtener el ID del curso desde el atributo data del modal
            const idCurso = document.getElementById('modalListado').getAttribute('data-curso-id');

            // Enviar los datos al servidor
            fetch('{{ route('inscripcion.inscribir-multiples') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        estudiante_ids: seleccionados,
                        id_curso: idCurso
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        if (data.errores && data.errores.length > 0) {
                            console.warn('Errores:', data.errores);
                        }
                        document.getElementById('modalListado').classList.add('hidden');
                        // Recargar la página para ver los cambios
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la inscripción');
                });
        });

        // Cambiar género en tabla principal
        document.addEventListener('click', function(e) {
            if (e.target.closest('.genero-toggle')) {
                const elemento = e.target.closest('.genero-toggle');
                const id = elemento.getAttribute('data-id');
                cambiarGeneroEstudiante(id, elemento);
            }
        });

        // Cambiar género en modal de listado
        document.addEventListener('click', function(e) {
            if (e.target.closest('.genero-toggle-modal')) {
                const elemento = e.target.closest('.genero-toggle-modal');
                const id = elemento.getAttribute('data-id');
                cambiarGeneroEstudiante(id, elemento);
            }
        });

        // Función para cambiar el género
        function cambiarGeneroEstudiante(id, elemento) {
            fetch('{{ route('estudiante.cambiarGenero', ['id' => 'PLACEHOLDER']) }}'.replace('PLACEHOLDER', id), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualizar el icono y colores dinámicamente
                        if (data.genero === 'M') {
                            elemento.innerHTML = '<i class="fa-solid fa-person"></i>';
                            elemento.className =
                                'border border-blue-500 bg-white text-blue-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle';
                            elemento.setAttribute('data-id', id);
                        } else {
                            elemento.innerHTML = '<i class="fa-solid fa-person-dress"></i>';
                            elemento.className =
                                'border border-pink-500 bg-white text-pink-500 rounded px-1 w-fit m-auto cursor-pointer genero-toggle';
                            elemento.setAttribute('data-id', id);
                        }
                        console.log('Género actualizado correctamente');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al actualizar el género');
                });
        }

        const boletinRutaTemplate = '{{ route('boletin.obtener', ['idEstudiante' => ':id']) }}';
        const cursoBoletinId = @json($curso->id);
        const boletinModal = document.getElementById('boletin-modal');
        const boletinPanel = boletinModal.firstElementChild;
        const boletinContenido = boletinPanel.querySelector('.overflow-y-auto');
        const boletinFilas = document.getElementById('boletin-filas');
        const botonEditarCalificaciones = document.getElementById('editar-calificaciones');
        const alertaBoletin = document.getElementById('boletin-alerta');
        let estudianteBoletinActual = null;
        let modoEdicionCalificaciones = false;
        let temporizadorAlertaBoletin;
        document.body.appendChild(boletinModal);
        const historialBthModal = document.getElementById('historial-bth-modal');
        const historialBthPanel = historialBthModal.firstElementChild;
        const historialBthFilas = document.getElementById('historial-bth-filas');
        const historialBthGuardar = document.getElementById('guardar-historial-bth');
        const historialBthAlerta = document.getElementById('historial-bth-alerta');
        const historialBthRuta = '{{ route('estudiante.historial-bth.obtener', ['idEstudiante' => ':id']) }}';
        let estudianteHistorialBthActual = null;
        document.body.appendChild(historialBthModal);
        boletinFilas.innerHTML =
            '<tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">Seleccione un estudiante para consultar sus calificaciones.</td></tr>';

        document.addEventListener('click', event => {
            const button = event.target.closest('.btn-historial-bth');
            if (!button) {
                return;
            }

            event.preventDefault();
            abrirHistorialBth(button.dataset.id);
        });

        ['cerrar-historial-bth', 'cerrar-historial-bth-footer'].forEach(id => {
            document.getElementById(id).addEventListener('click', cerrarHistorialBth);
        });

        historialBthModal.addEventListener('click', event => {
            if (event.target === historialBthModal) {
                cerrarHistorialBth();
            }
        });

        historialBthFilas.addEventListener('input', event => {
            if (event.target.matches('.historial-bth-input')) {
                actualizarPromedioUltimasTres(event.target.dataset.materia);
            }
        });

        historialBthGuardar.addEventListener('click', guardarHistorialBth);

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && historialBthModal.getAttribute('aria-hidden') === 'false') {
                cerrarHistorialBth();
            }
        });

        function mostrarHistorialBth() {
            historialBthModal.classList.remove('invisible', 'pointer-events-none', 'opacity-0');
            historialBthModal.classList.add('opacity-100');
            historialBthModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
            requestAnimationFrame(() => {
                historialBthPanel.classList.remove('translate-y-4', 'scale-95', 'opacity-0');
                historialBthPanel.classList.add('translate-y-0', 'scale-100', 'opacity-100');
            });
            historialBthModal.focus();
        }

        function cerrarHistorialBth() {
            historialBthModal.classList.remove('opacity-100');
            historialBthModal.classList.add('opacity-0', 'pointer-events-none');
            historialBthPanel.classList.remove('translate-y-0', 'scale-100', 'opacity-100');
            historialBthPanel.classList.add('translate-y-4', 'scale-95', 'opacity-0');
            historialBthModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            window.setTimeout(() => {
                if (historialBthModal.getAttribute('aria-hidden') === 'true') {
                    historialBthModal.classList.add('invisible');
                }
            }, 300);
        }

        function mostrarAlertaHistorialBth(mensaje, error = false) {
            historialBthAlerta.className = error ?
                'rounded-md border border-red-200 bg-red-50 px-3 py-2 text-xs text-red-700' :
                'rounded-md border border-emerald-200 bg-emerald-50 px-3 py-2 text-xs text-emerald-700';
            historialBthAlerta.textContent = mensaje;
        }

        async function abrirHistorialBth(idEstudiante) {
            estudianteHistorialBthActual = idEstudiante;
            historialBthGuardar.disabled = true;
            historialBthAlerta.className = 'hidden';
            document.getElementById('historial-bth-estudiante').textContent = 'Cargando estudiante...';
            historialBthFilas.innerHTML =
                '<tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">Cargando historial...</td></tr>';
            mostrarHistorialBth();
            await cargarHistorialBth();
        }

        async function cargarHistorialBth() {
            const url = `${historialBthRuta.replace(':id', encodeURIComponent(estudianteHistorialBthActual))}?id_curso=${encodeURIComponent(cursoBoletinId)}`;

            try {
                const response = await fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                    },
                });
                const data = await response.json().catch(() => ({}));

                if (!response.ok) {
                    const validationError = data.errors ? Object.values(data.errors).flat()[0] : null;
                    throw new Error(validationError || data.error || 'No se pudo cargar el historial BTH.');
                }

                document.getElementById('historial-bth-estudiante').textContent =
                    `${data.estudiante.nombre} · Promedios anuales 2022-2026`;
                if (!data.materias.length) {
                    historialBthFilas.innerHTML =
                        '<tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">No hay materias asignadas a este curso en la gestión activa.</td></tr>';
                    return false;
                }

                historialBthFilas.innerHTML = data.materias.map(materia => {
                    const celdas = data.anios.map(anio => {
                        const valor = materia.promedios[anio] ?? '';

                        return `<td class="px-2 py-2 text-center">
                            <input aria-label="${escapeHtml(materia.materia)} ${anio}" class="historial-bth-input w-20 rounded border border-slate-300 px-2 py-1.5 text-center text-sm focus:border-purple-500 focus:outline-none focus:ring-1 focus:ring-purple-500"
                                type="number" min="0" max="100" step="0.01" value="${escapeHtml(valor)}"
                                data-materia="${escapeHtml(materia.id_materia)}" data-anio="${anio}">
                        </td>`;
                    }).join('');

                    return `<tr class="border-t border-slate-200 hover:bg-slate-50">
                        <td class="px-3 py-2 font-medium text-slate-800">${escapeHtml(materia.materia)}</td>
                        ${celdas}
                        <td class="px-3 py-2 text-center font-semibold text-purple-800" data-promedio-ultimas-tres="${escapeHtml(materia.id_materia)}">${materia.promedio_ultimas_tres ?? '-'}</td>
                    </tr>`;
                }).join('');
                historialBthGuardar.disabled = false;
                return true;
            } catch (error) {
                console.error('Error cargando historial BTH:', error);
                historialBthFilas.innerHTML =
                    '<tr><td colspan="7" class="px-4 py-8 text-center text-red-600">No se pudo cargar el historial BTH.</td></tr>';
                mostrarAlertaHistorialBth(error.message, true);
                return false;
            }
        }

        function actualizarPromedioUltimasTres(idMateria) {
            const valores = ['2024', '2025', '2026']
                .map(anio => historialBthFilas.querySelector(
                    `.historial-bth-input[data-materia="${CSS.escape(idMateria)}"][data-anio="${anio}"]`
                )?.value)
                .filter(valor => valor !== '' && Number.isFinite(Number(valor)))
                .map(Number);
            const promedio = valores.length ?
                (valores.reduce((total, valor) => total + valor, 0) / valores.length).toFixed(2) :
                '-';
            const celda = historialBthFilas.querySelector(
                `[data-promedio-ultimas-tres="${CSS.escape(idMateria)}"]`
            );
            if (celda) {
                celda.textContent = promedio;
            }
        }

        async function guardarHistorialBth() {
            const promedios = {};
            historialBthFilas.querySelectorAll('.historial-bth-input').forEach(input => {
                const { materia, anio } = input.dataset;
                promedios[materia] ??= {};
                promedios[materia][anio] = input.value === '' ? null : input.value;
            });

            historialBthGuardar.disabled = true;
            historialBthGuardar.textContent = 'Guardando...';
            historialBthAlerta.className = 'hidden';

            try {
                const url = '{{ route('estudiante.historial-bth.actualizar', ['idEstudiante' => ':id']) }}'
                    .replace(':id', encodeURIComponent(estudianteHistorialBthActual));
                const response = await fetch(url, {
                    method: 'PUT',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        id_curso: cursoBoletinId,
                        promedios,
                    }),
                });
                const data = await response.json().catch(() => ({}));

                if (!response.ok) {
                    const validationError = data.errors ? Object.values(data.errors).flat()[0] : null;
                    throw new Error(validationError || data.error || data.message ||
                        'No se pudieron guardar los promedios históricos.');
                }

                if (await cargarHistorialBth()) {
                    mostrarAlertaHistorialBth(data.message || 'Los promedios históricos se guardaron correctamente.');
                }
            } catch (error) {
                console.error('Error guardando historial BTH:', error);
                mostrarAlertaHistorialBth(error.message, true);
            } finally {
                historialBthGuardar.textContent = 'Guardar promedios';
                historialBthGuardar.disabled = false;
            }
        }

        document.addEventListener('click', function(event) {
            const button = event.target.closest('.btn-ver-boletin');
            if (!button) {
                return;
            }

            event.preventDefault();
            const idEstudiante = button.getAttribute('data-id');
            abrirBoletin(idEstudiante);
        });

        botonEditarCalificaciones.addEventListener('click', function() {
            if (modoEdicionCalificaciones) {
                guardarCalificaciones();
                return;
            }

            ocultarAlertaBoletin();
            establecerModoEdicionCalificaciones(true);
        });

        ['cerrar-boletin-superior', 'cerrar-boletin'].forEach(id => {
            document.getElementById(id).addEventListener('click', cerrarBoletin);
        });

        ['descargar-boletin', 'imprimir-boletin'].forEach(id => {
            document.getElementById(id).addEventListener('click', function() {
                window.print();
            });
        });

        boletinModal.addEventListener('click', function(event) {
            if (event.target === boletinModal) {
                cerrarBoletin();
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && boletinModal.getAttribute('aria-hidden') === 'false') {
                cerrarBoletin();
            }
        });

        function mostrarBoletin() {
            boletinModal.classList.remove('invisible', 'pointer-events-none', 'opacity-0');
            boletinModal.classList.add('opacity-100');
            boletinModal.setAttribute('aria-hidden', 'false');
            document.body.classList.add('overflow-hidden');
            requestAnimationFrame(() => {
                boletinPanel.classList.remove('translate-y-4', 'scale-95', 'opacity-0');
                boletinPanel.classList.add('translate-y-0', 'scale-100', 'opacity-100');
            });
            boletinModal.focus();
        }

        function cerrarBoletin() {
            boletinModal.classList.remove('opacity-100');
            boletinModal.classList.add('opacity-0', 'pointer-events-none');
            boletinPanel.classList.remove('translate-y-0', 'scale-100', 'opacity-100');
            boletinPanel.classList.add('translate-y-4', 'scale-95', 'opacity-0');
            boletinModal.setAttribute('aria-hidden', 'true');
            document.body.classList.remove('overflow-hidden');
            window.setTimeout(() => {
                if (boletinModal.getAttribute('aria-hidden') === 'true') {
                    boletinModal.classList.add('invisible');
                }
            }, 300);
        }

        function formatNota(value) {
            return value === null || value === undefined || value === '' ? '-' : value;
        }

        function escapeHtml(value) {
            return String(value ?? '').replace(/[&<>"']/g, character => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            })[character]);
        }

        function mostrarAlertaBoletin(mensaje, tipo = 'success') {
            clearTimeout(temporizadorAlertaBoletin);
            const clases = tipo === 'error' ?
                'border-red-200 bg-red-50 text-red-700' :
                tipo === 'warning' ?
                'border-amber-200 bg-amber-50 text-amber-800' :
                'border-emerald-200 bg-emerald-50 text-emerald-700';
            alertaBoletin.className = `basis-full rounded-md border px-3 py-2 text-xs ${clases}`;
            alertaBoletin.textContent = mensaje;
            temporizadorAlertaBoletin = window.setTimeout(ocultarAlertaBoletin, 6000);
        }

        function ocultarAlertaBoletin() {
            clearTimeout(temporizadorAlertaBoletin);
            alertaBoletin.classList.add('hidden');
            alertaBoletin.textContent = '';
        }

        function establecerModoEdicionCalificaciones(editar) {
            modoEdicionCalificaciones = editar;
            botonEditarCalificaciones.textContent = editar ?
                'Guardar modificaciones' :
                'Modificar calificaciones';

            boletinFilas.querySelectorAll('.boletin-nota-input').forEach(input => {
                input.classList.toggle('hidden', !editar);
            });
            boletinFilas.querySelectorAll('.boletin-nota-texto').forEach(texto => {
                texto.classList.toggle('hidden', editar);
            });
        }

        function renderizarNotaEditable(valor, valorOriginal, idAsignacion, periodo) {
            const valorInput = valorOriginal === null || valorOriginal === undefined ?
                '' :
                String(valorOriginal);
            const claseNota = valor !== null && valor !== undefined && Number(valor) < 51 ?
                'font-bold text-rose-600 bg-rose-50/60' :
                'font-medium text-slate-700';

            return `<td class="py-2.5 px-2 text-center ${claseNota}">
                <span class="boletin-nota-texto">${escapeHtml(formatNota(valor))}</span>
                <input aria-label="Calificación del periodo ${periodo}" class="boletin-nota-input hidden w-16 rounded border border-blue-300 bg-white px-1.5 py-1 text-center text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    type="number" min="0" max="100" step="0.01" value="${escapeHtml(valorInput)}"
                    data-asignacion="${escapeHtml(idAsignacion)}" data-periodo="${periodo}">
            </td>`;
        }

        async function guardarCalificaciones() {
            const calificaciones = {};
            boletinFilas.querySelectorAll('.boletin-nota-input').forEach(input => {
                const idAsignacion = input.dataset.asignacion;
                const periodo = input.dataset.periodo;
                calificaciones[idAsignacion] ??= {};
                calificaciones[idAsignacion][periodo] = input.value === '' ? null : input.value;
            });

            botonEditarCalificaciones.disabled = true;
            botonEditarCalificaciones.textContent = 'Guardando...';
            ocultarAlertaBoletin();

            try {
                const response = await fetch(
                    `{{ route('boletin.calificaciones.actualizar', ['idEstudiante' => ':id']) }}`.replace(
                        ':id',
                        encodeURIComponent(estudianteBoletinActual)
                    ), {
                        method: 'PUT',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({
                            id_curso: cursoBoletinId,
                            calificaciones,
                        }),
                    }
                );
                const data = await response.json().catch(() => ({}));

                if (!response.ok) {
                    const validationError = data.errors ? Object.values(data.errors).flat()[0] : null;
                    throw new Error(validationError || data.error || data.message ||
                        'No se pudieron guardar las calificaciones.');
                }

                establecerModoEdicionCalificaciones(false);
                const actualizado = await abrirBoletin(estudianteBoletinActual, true);
                mostrarAlertaBoletin(
                    actualizado ?
                    (data.message || 'Las calificaciones se guardaron correctamente.') :
                    'Las calificaciones se guardaron, pero no se pudo actualizar la vista. Cierre y vuelva a abrir el boletín.',
                    actualizado ? 'success' : 'warning'
                );
            } catch (error) {
                console.error('Error guardando calificaciones:', error);
                establecerModoEdicionCalificaciones(true);
                mostrarAlertaBoletin(error.message, 'error');
            } finally {
                if (modoEdicionCalificaciones) {
                    botonEditarCalificaciones.disabled = false;
                    botonEditarCalificaciones.textContent = 'Guardar modificaciones';
                }
            }
        }

        function actualizarResumenBoletin(estudiante, asignaciones) {
            const notasFinales = asignaciones
                .filter(asignacion => asignacion.promedio_final !== null &&
                    asignacion.promedio_final !== undefined && asignacion.promedio_final !== '')
                .map(asignacion => Number(asignacion.promedio_final))
                .filter(Number.isFinite);
            const aprobadas = notasFinales.filter(nota => nota >= 51).length;
            const reprobadas = notasFinales.length - aprobadas;
            const promedio = notasFinales.length ?
                (notasFinales.reduce((total, nota) => total + nota, 0) / notasFinales.length).toFixed(1) :
                '—';
            const estado = {
                E: ['Efectivo', 'bg-emerald-100', 'text-emerald-700', 'border-emerald-200'],
                R: ['Retirado', 'bg-rose-100', 'text-rose-700', 'border-rose-200'],
                A: ['Abandono', 'bg-slate-100', 'text-slate-700', 'border-slate-200'],
            } [estudiante.estado] || ['No registrado', 'bg-slate-100', 'text-slate-700', 'border-slate-200'];
            const estadoElemento = document.getElementById('boletin-estado');

            estadoElemento.textContent = estado[0];
            estadoElemento.className =
                `inline-flex items-center px-2.5 py-0.5 rounded-full border text-[11px] font-semibold ${estado.slice(1).join(' ')}`;
            document.getElementById('boletin-promedio').textContent = promedio;
            document.getElementById('boletin-aprobadas').textContent = `${aprobadas} / ${notasFinales.length}`;
            document.getElementById('boletin-porcentaje').textContent = notasFinales.length ?
                `${Math.round((aprobadas / notasFinales.length) * 100)}% de asignaturas` :
                'Sin calificaciones';
            document.getElementById('boletin-reprobadas').textContent = reprobadas;
            document.getElementById('boletin-riesgo-etiqueta').textContent = reprobadas ?
                'Atención prioritaria' :
                'Sin materias reprobadas';

            const observacion = estudiante.observacion?.trim();
            const materiasEnRiesgo = asignaciones
                .filter(asignacion => asignacion.promedio_final !== null &&
                    asignacion.promedio_final !== undefined && asignacion.promedio_final !== '' &&
                    Number.isFinite(Number(asignacion.promedio_final)) &&
                    Number(asignacion.promedio_final) < 51)
                .map(asignacion => asignacion.materia);
            const recomendacion = observacion || (materiasEnRiesgo.length ?
                `Se recomienda reforzar las siguientes áreas: ${materiasEnRiesgo.join(', ')}.` :
                'No hay observaciones registradas para este estudiante.');
            document.getElementById('boletin-observaciones').textContent = recomendacion;
        }

        function abrirBoletin(idEstudiante, refrescar = false) {
            estudianteBoletinActual = idEstudiante;
            botonEditarCalificaciones.disabled = true;

            if (!refrescar) {
                establecerModoEdicionCalificaciones(false);
                ocultarAlertaBoletin();
                boletinModal.scrollTop = 0;
                boletinContenido.scrollTop = 0;
                boletinFilas.innerHTML =
                    '<tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">Cargando boletín...</td></tr>';
                document.getElementById('modal-title').textContent = 'Boletín de Calificaciones';
                document.getElementById('boletin-encabezado').textContent = 'Cargando datos...';
                document.getElementById('boletin-estudiante').textContent = 'Cargando...';
                document.getElementById('boletin-estado').textContent = 'Cargando...';
                document.getElementById('boletin-rude').textContent = '—';
                document.getElementById('boletin-curso').textContent = '—';
                document.getElementById('boletin-nivel').textContent = '—';
                document.getElementById('boletin-turno').textContent = '—';
                document.getElementById('boletin-codigo').textContent = idEstudiante;
                document.getElementById('boletin-promedio').textContent = '—';
                document.getElementById('boletin-aprobadas').textContent = '— / —';
                document.getElementById('boletin-porcentaje').textContent = '—';
                document.getElementById('boletin-reprobadas').textContent = '—';
                document.getElementById('boletin-riesgo-etiqueta').textContent = '—';
                document.getElementById('boletin-observaciones').textContent = 'Cargando observaciones...';
                mostrarBoletin();
            }

            const url =
                `${boletinRutaTemplate.replace(':id', encodeURIComponent(idEstudiante))}?id_curso=${encodeURIComponent(cursoBoletinId)}`;

            return fetch(url, {
                    headers: {
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw new Error(err.error || 'Error al cargar el boletín.');
                        });
                    }

                    return response.json();
                })
                .then(data => {
                    const estudiante = data.estudiante || {};
                    const asignaciones = Array.isArray(data.asignaciones) ? data.asignaciones : [];

                    document.getElementById('boletin-estudiante').textContent =
                        estudiante.nombre_completo || 'Estudiante';
                    document.getElementById('boletin-rude').textContent = estudiante.rude || 'No registrado';
                    document.getElementById('boletin-curso').textContent = estudiante.curso || 'Sin curso asignado';
                    document.getElementById('boletin-nivel').textContent = estudiante.nivel || 'No disponible';
                    document.getElementById('boletin-turno').textContent = estudiante.turno || 'No disponible';
                    document.getElementById('modal-title').textContent =
                        `Boletín de Calificaciones - Gestión ${estudiante.gestion || 'No registrada'}`;
                    document.getElementById('boletin-encabezado').textContent =
                        `${estudiante.curso || 'Sin curso'} · Gestión ${estudiante.gestion || 'No registrada'}`;
                    actualizarResumenBoletin(estudiante, asignaciones);

                    if (asignaciones.length === 0) {
                        boletinFilas.innerHTML =
                            '<tr><td colspan="7" class="px-4 py-8 text-center text-slate-500">Este estudiante no tiene calificaciones registradas.</td></tr>';
                        establecerModoEdicionCalificaciones(false);
                        botonEditarCalificaciones.disabled = true;
                        return true;
                    }

                    boletinFilas.innerHTML = asignaciones.map(asignacion => {
                        const notas = asignacion.notas || {};
                        const notasOriginales = asignacion.notasOriginales || notas;
                        const promedio = formatNota(asignacion.promedio_final);
                        const promedioNumerico = Number(asignacion.promedio_final);
                        const tienePromedio = asignacion.promedio_final !== null &&
                            asignacion.promedio_final !== undefined && asignacion.promedio_final !== '' &&
                            Number.isFinite(promedioNumerico);
                        const necesitaRefuerzo = tienePromedio && promedioNumerico < 51;
                        const filaClase = necesitaRefuerzo ?
                            'hover:bg-rose-50/40 bg-rose-50/20' :
                            'hover:bg-slate-50';
                        const estadoClase = !tienePromedio ?
                            'bg-slate-100 text-slate-700 border-slate-200' :
                            necesitaRefuerzo ?
                            'bg-rose-100 text-rose-700 border-rose-200' :
                            'bg-emerald-100 text-emerald-800 border-emerald-200';
                        const estadoTexto = !tienePromedio ?
                            'Pendiente' :
                            necesitaRefuerzo ?
                            'Requiere refuerzo' :
                            'Aprobado';

                        return `
                            <tr class="transition-colors ${filaClase}">
                                <td class="py-2.5 px-4 font-medium text-slate-900">${escapeHtml(asignacion.materia || 'Sin materia')}</td>
                                <td class="py-2.5 px-3 text-slate-500 text-[11px]">Prof. ${escapeHtml(asignacion.profesor || 'No asignado')}</td>
                                ${renderizarNotaEditable(notas['1'], notasOriginales['1'], asignacion.idAsignacion, 1)}
                                ${renderizarNotaEditable(notas['2'], notasOriginales['2'], asignacion.idAsignacion, 2)}
                                ${renderizarNotaEditable(notas['3'], notasOriginales['3'], asignacion.idAsignacion, 3)}
                                <td class="py-2.5 px-3 text-center font-bold ${necesitaRefuerzo ? 'text-rose-600' : 'text-slate-800'}">${escapeHtml(promedio)}</td>
                                <td class="py-2.5 px-3 text-center"><span class="inline-block rounded-md border px-2 py-0.5 text-[10px] font-semibold ${estadoClase}">${estadoTexto}</span></td>
                            </tr>`;
                    }).join('');
                    establecerModoEdicionCalificaciones(false);
                    botonEditarCalificaciones.disabled = false;
                    return true;
                })
                .catch(error => {
                    console.error('Error cargando boletín:', error);
                    boletinFilas.innerHTML =
                        '<tr><td colspan="7" class="px-4 py-8 text-center text-red-600">No se pudo cargar el boletín. Intente de nuevo.</td></tr>';
                    document.getElementById('boletin-estudiante').textContent = 'No se pudieron cargar los datos';
                    document.getElementById('boletin-observaciones').textContent = error.message;
                    botonEditarCalificaciones.disabled = true;
                    if (refrescar) {
                        mostrarAlertaBoletin('No se pudo volver a cargar la información del boletín.', 'warning');
                    } else {
                        mostrarAlertaBoletin(error.message, 'error');
                    }
                    return false;
                });
        }

        // --- INICIO: Lógica para cambiar estado del estudiante ---
        document.addEventListener('click', function(e) {
            // Verificar si el clic fue en un botón de cambio de estado
            if (e.target.matches('.estado-toggle')) {
                e.preventDefault();
                const button = e.target;
                const studentId = button.dataset.id;
                cambiarEstadoEstudiante(studentId, button);
            }
        });

        function cambiarEstadoEstudiante(studentId, button) {
            // Construir la URL para la petición
            const url = `{{ route('estudiante.cambiarEstado', ['id' => ':id']) }}`.replace(':id', studentId);

            // Realizar la petición fetch
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Actualizar el botón en la UI sin recargar la página
                        actualizarBotonEstado(button, data.estado);
                    } else {
                        // Mostrar un error si algo falla
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Ocurrió un error de red al intentar cambiar el estado.');
                });
        }

        function actualizarBotonEstado(button, nuevoEstado) {
            // Definir los estilos y textos para cada estado
            const estados = {
                'E': {
                    texto: 'Efectivo',
                    clase: 'text-green-500 border-green-500 hover:bg-green-500'
                },
                'R': {
                    texto: 'Retirado',
                    clase: 'text-red-500 border-red-500 hover:bg-red-500'
                },
                'A': {
                    texto: 'Abandono',
                    clase: 'text-slate-500 border-slate-500 hover:bg-slate-500'
                }
            };

            const config = estados[nuevoEstado];

            if (config) {
                // Actualizar el texto del botón
                button.textContent = config.texto;
                // Resetear y aplicar las nuevas clases de estilo
                button.className =
                    `estado-toggle px-2 py-1 my-2 text-xs border rounded w-fit hover:text-white cursor-pointer ${config.clase}`;
            }
        }
        // --- FIN: Lógica para cambiar estado del estudiante ---
    </script>
@endsection

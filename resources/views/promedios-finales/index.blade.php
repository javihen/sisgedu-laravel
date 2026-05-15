@extends('layouts.navhorizontal')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'Poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-between items-center px-4">
            <div class="text-center w-full ">
                <h1 class="text-white text-lg font-semibold">Promedios Finales</h1>
                <p class="text-slate-100 text-sm">Resumen académico por estudiante, curso y gestión.</p>
            </div>
            <div class="text-white text-sm">{{-- Gestión activa: {{ session('gestion_activa') ?? 'Todas' }} --}}</div>
        </div>
        {{--  Tarjetas de estadistica  --}}
        <div class="mx-3 mt-4 grid gap-4 grid-cols-4">
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
                <span class="text-sm text-slate-500">Total estudiantes</span>
                <div class="mt-3 text-center text-3xl font-semibold text-slate-900">{{ $totalEstudiantes }}</div>
            </div>
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
                <span class="text-sm text-slate-500">Promedio general (pts)</span>
                <div class="mt-3 text-center text-3xl font-semibold text-slate-900">{{ number_format($promedioGeneral, 2) }}
                </div>
            </div>
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
                <span class="text-sm text-slate-500">Total aprobados</span>
                <div class="mt-3 text-center text-3xl font-semibold text-emerald-600">{{ $totalAprobados }}</div>
            </div>
            <div class="bg-white rounded-xl p-5 shadow-sm border border-slate-200">
                <span class="text-sm text-slate-500">Total reprobados</span>
                <div class="mt-3 text-center text-3xl font-semibold text-rose-600">{{ $totalReprobados }}</div>
            </div>
        </div>
        {{-- menu lateral tipo arbol --}}
        <div class="mx-3 mt-4 grid gap-4 xl:grid-cols-[320px_minmax(0,1fr)]">
            <aside class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Listado de cursos</h2>
                        {{-- <p class="text-sm text-slate-500 mt-1">Selecciona un curso para filtrar.</p> --}}
                    </div>
                    {{-- <div class="text-xs font-semibold text-slate-500">Filtros</div> --}}
                </div>

                <form id="curso-filter-form" action="{{ route('promedios.finales') }}" method="GET">
                    <input type="hidden" name="id_curso" id="id_curso" value="{{ $courseId }}">
                </form>

                <div class="mt-4 text-sm text-slate-600">
                    <span class="font-semibold">Curso seleccionado:</span>
                    <span id="selected-course-label">{{ $cursoSeleccionado?->display_name ?? 'Todos los cursos' }}</span>
                </div>

                <div class="tree mt-4 text-sm">
                    <style>
                        .tree li::before {
                            bottom: -0.75rem;
                        }

                        .tree li:last-child::before {
                            bottom: 0;
                        }

                        .tree .toggle {
                            display: inline-flex;
                            align-items: center;
                            gap: 0.4rem;
                        }
                    </style>

                    <ul class="pl-4">
                        @foreach ($cursosTree as $turno => $nivelesTree)
                            <li
                                class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300">
                                <button type="button"
                                    class="toggle text-xs font-semibold text-slate-700 bg-slate-100 px-2 py-1 rounded-md"
                                    onclick="toggleTree(this)">
                                    <span class="tree-arrow">▶</span>
                                    {{ $turno === 'M' ? 'Mañana' : ($turno === 'T' ? 'Tarde' : $turno) }}
                                </button>
                                <ul class="nested hidden pl-4 mt-2">
                                    @foreach ($nivelesTree as $nivel => $gradosTree)
                                        <li
                                            class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300">
                                            <button type="button"
                                                class="toggle text-xs font-semibold text-slate-700 bg-slate-100 px-2 py-1 rounded-md"
                                                onclick="toggleTree(this)">
                                                <span class="tree-arrow">▶</span>
                                                {{ $nivel === 0 ? 'Inicial' : ($nivel === 1 ? 'Primaria' : 'Secundaria') }}
                                            </button>
                                            <ul class="nested hidden pl-4 mt-2">
                                                @foreach ($gradosTree as $grado => $paralelos)
                                                    <li
                                                        class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300">
                                                        <button type="button"
                                                            class="toggle text-xs font-semibold text-slate-700 bg-slate-100 px-2 py-1 rounded-md"
                                                            onclick="toggleTree(this)">
                                                            <span class="tree-arrow">▶</span>
                                                            {{ is_numeric($grado) ? $grado . '°' : $grado }}
                                                        </button>
                                                        <ul class="nested hidden pl-4 mt-2">
                                                            @foreach ($paralelos as $paralelo => $cursos)
                                                                <li
                                                                    class="relative pl-5 mb-3 before:absolute before:left-0 before:top-0 before:bottom-0 before:h-auto before:border-l before:border-gray-300">
                                                                    @foreach ($cursos as $curso)
                                                                        <button type="button"
                                                                            onclick="selectCourse({{ json_encode($curso->id) }}, {{ json_encode($curso->display_name) }})"
                                                                            class="w-full text-left rounded-md border border-slate-200 px-3 py-2 text-slate-700 hover:bg-slate-50 transition">
                                                                            {{ $curso->display_name }}
                                                                        </button>
                                                                    @endforeach
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="mt-4 flex gap-2">
                    <button type="button" onclick="clearCourseFilter()"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Limpiar
                        filtro</button>
                </div> --}}
            </aside>

            <section class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm">
                <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-slate-900">Listado de promedios finales -
                            {{ $cursoSeleccionado?->display_name ?? 'Todos los cursos' }}</h2>
                        <p class="text-sm text-slate-500 mt-1">Ordenado por curso y apellidos.</p>
                    </div>
                    <div class="text-sm text-slate-600">Total: {{ $resultados->count() }} estudiantes</div>
                </div>

                <div class="overflow-x-auto mt-6">
                    <table id="promedios-table" class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-slate-700 uppercase text-xs tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">Estudiante</th>
                                {{-- <th class="px-4 py-3 text-left">Curso</th> --}}
                                <th class="px-4 py-3 text-left">Gestión</th>
                                {{-- <th class="px-4 py-3 text-right">Areas</th> --}}
                                <th class="px-4 py-3 text-center">Promedio Final</th>
                                <th class="px-4 py-3 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($resultados as $fila)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap text-slate-900">{{ $fila->nombre_completo }}
                                    </td>
                                    {{-- <td class="px-4 py-4 whitespace-nowrap text-slate-700">{{ $fila->curso }}</td> --}}
                                    <td class="px-4 py-4 whitespace-nowrap text-center text-slate-700">{{ $fila->gestion }}
                                    </td>
                                    {{-- <td class="px-4 py-4 whitespace-nowrap text-right text-slate-900 text-center">
                                        {{ $fila->cantidad_notas }}</td> --}}
                                    <td class="px-4 py-4 whitespace-nowrap text-center font-semibold text-slate-900">
                                        {{ number_format($fila->promedio_final, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <span
                                            class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $fila->estado === 'APROBADO' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">{{ $fila->estado }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-6 text-center text-slate-500">No hay estudiantes
                                        inscritos con notas en el filtro seleccionado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        function toggleTree(button) {
            const nested = button.parentElement.querySelector('.nested');
            if (!nested) {
                return;
            }
            nested.classList.toggle('hidden');
            const arrow = button.querySelector('.tree-arrow');
            if (arrow) {
                arrow.textContent = nested.classList.contains('hidden') ? '▶' : '▼';
            }
        }

        function selectCourse(cursoId, cursoNombre) {
            document.getElementById('id_curso').value = cursoId;
            document.getElementById('selected-course-label').textContent = cursoNombre;
            document.getElementById('curso-filter-form').submit();
        }

        function clearCourseFilter() {
            document.getElementById('id_curso').value = '';
            document.getElementById('selected-course-label').textContent = 'Todos los cursos';
            document.getElementById('curso-filter-form').submit();
        }

        $(document).ready(function() {
            $('#promedios-table').DataTable({
                responsive: true,
                searching: true,
                ordering: true,
                paging: true,
                pageLength: 25,
                lengthChange: true,
                language: {
                    search: 'Buscar:',
                    lengthMenu: 'Mostrar _MENU_ registros',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                    infoEmpty: 'Mostrando 0 a 0 de 0 registros',
                    paginate: {
                        previous: 'Anterior',
                        next: 'Siguiente'
                    },
                    zeroRecords: 'No se encontraron resultados',
                },
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                        titleAttr: 'Exportar a Excel',
                        className: '!bg-green-600 !text-white !rounded px-3 py-1'

                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar PDF',
                        titleAttr: 'Exportar a PDF',
                        className: '!bg-rose-600 !text-white !rounded px-3 py-1'
                    },
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        titleAttr: 'Imprimir reporte',
                        className: '!bg-slate-700 !text-white !rounded px-3 py-1',
                        customize: function(win) {

                            // BODY
                            $(win.document.body)
                                .css('font-size', '12px')
                                .css('background-color', '#ffffff')
                                .css('padding', '20px');

                            // TITULO
                            $(win.document.body)
                                .find('h1')
                                .css('text-align', 'center')
                                .css('font-size', '24px')
                                .css('margin-bottom', '20px')
                                .css('color', '#0f172a');

                            // TABLA
                            $(win.document.body)
                                .find('table')
                                .addClass('compact')
                                .css('font-size', '12px')
                                .css('border-collapse', 'collapse')
                                .css('width', '100%');

                            // HEADERS
                            $(win.document.body)
                                .find('thead th')
                                .css('background-color', '#1e293b')
                                .css('color', 'white')
                                .css('padding', '10px')
                                .css('border', '1px solid #cbd5e1');

                            // CELDAS
                            $(win.document.body)
                                .find('tbody td')
                                .css('padding', '8px')
                                .css('border', '1px solid #cbd5e1');

                            // FILAS ALTERNADAS
                            $(win.document.body)
                                .find('tbody tr:nth-child(even)')
                                .css('background-color', '#f8fafc');

                            // OCULTAR ELEMENTOS
                            $(win.document.body)
                                .find('.no-print')
                                .hide();

                        }
                    }
                ]
            });
        });
    </script>
@endsection

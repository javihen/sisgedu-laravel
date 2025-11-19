@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#3B82F6] rounded-md flex justify-between items-center pl-4 pr-2 ">
            <p class="text-white text-sm ">LISTADO DE ESTUDIANTES</p>
            <div class=" h-full">
                {{-- <input class="bg-white my-2 py-2 rounded-md px-2 text-xs" type="text" name="" id=""
                    placeholder="Buscar estudiante ..."> --}}
                <form method="GET" action="{{ route('estudiante.index') }}">
                    <input type="text" name="buscar" id="buscar" class="bg-white my-2 py-2 rounded-md px-2 text-xs"
                        placeholder="Buscar estudiante..." value="{{ request('buscar') }}">
                </form>

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

        <div class=" ml-3 w-full mt-2  flex gap-1 ">
            <div class="bg-white w-2/3  border border-slate-300 rounded-md mb-16">
                <table class="w-full ">
                    <tr class="bg-[#64748B] text-white text-sm text-center sticky top-0 z-10">
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Ap. Paterno</td>
                        <td>Ap. Materno</td>
                        <td>Nombres</td>
                        <td>Curso</td>
                        <td>Estado</td>
                        <td>Opciones</td>
                    </tr>
                    @foreach ($estudiantes as $estudiante)
                        <tr class="border-b border-[#64748B] text-xs text-center ">
                            <td class="py-3">{{ $loop->iteration }}</td>
                            <td>{{ $estudiante->id_estudiante }}</td>
                            <td>{{ $estudiante->appaterno }}</td>
                            <td>{{ $estudiante->apmaterno }}</td>
                            <td>{{ $estudiante->nombres }}</td>
                            <td>{{ $estudiante->inscripciones->first()?->curso?->display_name ?? 'SIN CURSO' }}</td>
                            {{-- aqui debemos de buscar en la tabla inscripcion si esta registrado en algun curso sino solo colocamos SIN CURSO --}}
                            <td>
                                @if ($estudiante->estado === 'E')
                                    <a href="#"
                                        class="px-2 border border-green-500 bg-white text-green-500 rounded-sm hover:text-white hover:bg-green-500">
                                        Efectivo
                                    </a>
                                @elseif ($estudiante->estado === 'R')
                                    <a href="#"
                                        class="px-2 border border-red-500 bg-white text-red-500 rounded-sm hover:text-white hover:bg-red-500">
                                        Retirado
                                    </a>
                                @elseif ($estudiante->estado === 'A')
                                    <a href="#"
                                        class="px-2 border border-slate-500 bg-white text-slate-500 rounded-sm hover:text-white hover:bg-slate-500">
                                        Abandono
                                    </a>
                                @else
                                    <span class="px-2 text-sm text-gray-500">—</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('estudiante.destroy', $estudiante->id_estudiante) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                        class="py-2 px-3 border border-red-500 bg-white my-2 rounded-sm text-red-500 hover:bg-red-500 hover:text-white cursor-pointer">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>

                                <a href="#"
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
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class=" w-1/3  ">
                <div class=" flex gap-2">
                    <a href="#" id="openModal"
                        class="bg-[#3B82F6] px-4 py-2 text-white w-2/3 flex-auto text-center border-2 hover:border-blue-800 rounded-md text-sm transition-all"><i
                            class='bx  bx-plus'></i>
                        Nuevo
                        estudiante
                    </a>
                    <a href="#" id="openModalSubir"
                        class="rounded-md w-1/3 flex-auto bg-slate-500 text-white text-center py-2 border-2 border-slate-500 hover:border-white text-sm cursor-pointer"><i
                            class='bx bx-download'></i> Subir </a>
                </div>
                <div class="border border-slate-300 bg-white">
                    <p class="text-center p-2">Estadistica</p>
                    <table class="w-full text-center">
                        <tr class="bg-slate-500 text-white sticky top-0 z-10">
                            <td class="w-1/3">Curso</td>
                            <td>M</td>
                            <td>F</td>
                            <td class="w-1/3">Total</td>
                            <td>R</td>
                            <td>A</td>
                        </tr>
                        @foreach ($estadisticas as $curso)
                            <tr class="border-b border-slate-300 text-xs hover:bg-slate-200">
                                <td class="py-2">{{ $curso->display_name }}</td>
                                <td>{{ $curso->hombres_efectivos }}</td>
                                <td>{{ $curso->mujeres_efectivas }}</td>
                                <td class="border-l border-r border-slate-300">
                                    {{ $curso->hombres_efectivos + $curso->mujeres_efectivas }}</td>
                                <td>{{ $curso->hombres_retirados + $curso->mujeres_retiradas }}</td>
                                <td>{{ $curso->hombres_abandono + $curso->mujeres_abandono }}</td>
                            </tr>
                        @endforeach
                    </table>
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
                <form class="space-y-4" id="formularioEstudiante" action="{{ route('estudiante.store') }}" method="post">
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
        <div id="modalSubir"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">

            <div id="modalSubirContent" class="bg-white rounded-md shadow-lg w-[600px] p-5 transform transition-all">

                <h2 class="text-lg font-semibold text-gray-700 flex items-center">
                    <i class='bx bx-cloud-upload mr-2'></i> IMPORTACIÓN DE ESTUDIANTES
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    El archivo debe contener las columnas: RUDE, CI, Nombres, Ap. Paterno, Ap. Materno, Género, Fecha
                    Nacimiento
                </p>

                <hr class="border-slate-200 mt-3">

                <form class="space-y-4" id="formularioImportar" action="{{ route('estudiante.import') }}"
                    method="post">
                    @csrf
                    <div id="selectCursoImport" class="basis-1/2 flex flex-col mt-2 w-full hidden">
                        <label for="idCurso" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Asignar a curso
                        </label>
                        <select name="idCurso" id="idCurso" class="border border-slate-600 bg-white p-2 rounded-md">
                            <option value="">- seleccione un curso -</option>
                        </select>
                    </div>

                    <!-- ÁREA DE SUBIDA -->
                    <div id="dropZone"
                        class="border border-gray-400 border-dashed rounded-md mt-4 p-10 grid place-items-center cursor-pointer transition">

                        <img src="./images/excel.png" class="w-14 opacity-70" alt="">

                        <p class="text-xs text-gray-500 mt-2 text-center">
                            Arrastra o selecciona un archivo Excel o CSV
                        </p>
                        <input type="hidden" id="excelData" name="excelData">
                        <input type="file" id="archivo" name="archivo" accept=".xlsx,.xls,.csv" class="hidden"
                            required>
                    </div>

                    <!-- TABLA DE PREVISUALIZACIÓN -->
                    <div id="previewContainer" class="hidden mt-4 max-h-64 overflow-auto border rounded">
                        <table class="w-full text-xs text-left border-collapse" id="previewTable"></table>
                    </div>

                    <hr class="border-slate-200 mt-4">

                    <!-- BOTONES -->
                    <div class="flex justify-end space-x-2 mt-4">
                        <button type="button" id="closeModalSubir"
                            class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white transition">
                            Cancelar
                        </button>

                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white w-1/2 rounded-lg hover:bg-green-700 transition">
                            Importar
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <script>
            const dropZone = document.getElementById("dropZone");
            const fileInput = document.getElementById("archivo");
            const previewContainer = document.getElementById("previewContainer");
            const previewTable = document.getElementById("previewTable");
            const modal = document.getElementById("modalSubir");
            const closeModal = document.getElementById("closeModalSubir");
            const selectCurso = document.getElementById("selectCursoImport");

            function abrirModalSubir() {
                modal.classList.remove("hidden");
            }
            /* ---------LEER EXCEL O CSV ---------------------------- */
            function procesarArchivo(file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: "array"
                    });
                    const hoja = workbook.Sheets[workbook.SheetNames[0]];
                    // Obtener el rango real (ejemplo: "A1:H5")
                    const rango = hoja["!ref"];
                    const rangoDecod = XLSX.utils.decode_range(rango);

                    const filas = [];
                    for (let R = rangoDecod.s.r; R <= rangoDecod.e.r; R++) {
                        const fila = [];

                        for (let C = rangoDecod.s.c; C <= rangoDecod.e.c; C++) {
                            const celdaRef = XLSX.utils.encode_cell({
                                r: R,
                                c: C
                            });
                            const celda = hoja[celdaRef];
                            fila.push(celda ? celda.v : null);
                        }

                        // Verificar si la fila tiene al menos un valor no nulo
                        const filaNoVacia = fila.some(celda => celda !== null && celda !== "");
                        if (filaNoVacia) {
                            filas.push(fila);
                        }
                    }
                    mostrarTabla(filas);
                    document.getElementById("excelData").value = JSON.stringify(filas);
                };

                reader.readAsArrayBuffer(file);
            }


            /* ----------------------------------------------------------
               MOSTRAR TABLA
            ---------------------------------------------------------- */
            function mostrarTabla(data) {
                previewTable.innerHTML = "";
                previewContainer.classList.remove("hidden");
                if (selectCurso) selectCurso.classList.remove("hidden");
                dropZone.classList.add("hidden");

                data.forEach((row, index) => {
                    let tr = document.createElement("tr");

                    row.forEach(cell => {
                        let td = document.createElement(index === 0 ? "th" : "td");
                        td.textContent = cell === undefined ? " " : cell;
                        td.className =
                            "border px-2 py-1 text-[11px] " +
                            (index === 0 ? "bg-gray-100 font-semibold" : "");
                        tr.appendChild(td);
                    });

                    previewTable.appendChild(tr);
                });

                // 👉 Enviar datos al back-end
                document.getElementById("excelData").value = JSON.stringify(data);

                // Cargar todos los cursos y poblar el select #idCurso
                (function populateAllCursos() {
                    const idCursoSelect = document.getElementById('idCurso');
                    if (!idCursoSelect) return;
                    fetch('/cursos')
                        .then(res => res.json())
                        .then(list => {
                            idCursoSelect.innerHTML = '<option value="">- seleccione un curso -</option>' + list.map(
                                c => `<option value="${c.idCurso}">${c.nombreCurso}</option>`).join('');
                            // mostrar el bloque de asignación si hay cursos
                            const selectCursoBlock = document.getElementById('selectCurso');
                            if (selectCursoBlock) selectCursoBlock.classList.remove('hidden');
                        })
                        .catch(err => {
                            console.error('Error cargando cursos:', err);
                        });
                })();
            }


            /* ----------------------------------------------------------
               DRAG & DROP
            ---------------------------------------------------------- */
            dropZone.addEventListener("click", () => fileInput.click());

            dropZone.addEventListener("dragover", e => {
                e.preventDefault();
                dropZone.classList.add("bg-emerald-50", "border-emerald-500");
            });

            dropZone.addEventListener("dragleave", () => {
                dropZone.classList.remove("bg-emerald-50", "border-emerald-500");
            });

            dropZone.addEventListener("drop", e => {
                e.preventDefault();
                dropZone.classList.remove("bg-emerald-50", "border-emerald-500");

                const file = e.dataTransfer.files[0];
                if (file) {
                    fileInput.files = e.dataTransfer.files;
                    procesarArchivo(file);
                }
            });

            fileInput.addEventListener("change", () => {
                const file = fileInput.files[0];
                if (file) procesarArchivo(file);
            });

            /* ----------------------------------------------------------
               BOTÓN CANCELAR → REINICIAR MODAL
            ---------------------------------------------------------- */
            closeModal.addEventListener("click", () => {
                modal.classList.add("hidden");

                // reset
                fileInput.value = "";
                previewContainer.classList.add("hidden");
                if (selectCurso) selectCurso.classList.add("hidden");
                dropZone.classList.remove("hidden");
                previewTable.innerHTML = "";
                dropZone.classList.remove("bg-emerald-50", "border-emerald-500");
            });
        </script>





        <script>
            llenaSelectCursos();

            function llenaSelectCursos() {
                const idCursoSelect = document.getElementById('id_curso');
                if (!idCursoSelect) return;
                fetch('/cursos')
                    .then(res => res.json())
                    .then(list => {
                        idCursoSelect.innerHTML = '<option value="">- seleccione un curso -</option>' + list.map(
                            c => `<option value="${c.idCurso}">${c.nombreCurso}</option>`).join('');
                    })
                    .catch(err => {
                        console.error('Error cargando cursos:', err);
                    });
            }
            document.addEventListener('DOMContentLoaded', function() {
                const openBtn = document.getElementById('openModal'); // Nuevo estudiante
                const modal = document.getElementById('modal');
                const modalContent = document.getElementById('modalContent');
                const studentForm = document.getElementById('formularioEstudiante');
                const formMethod = document.getElementById('formMethod');
                const submitBtn = document.getElementById('submitBtn');

                // Abre modal para CREAR (limpia campos)
                openBtn.addEventListener('click', () => {
                    studentForm.reset();
                    studentForm.action = "{{ route('estudiante.store') }}";
                    formMethod.value = 'POST';
                    submitBtn.textContent = 'Guardar';
                    modal.classList.remove('hidden');
                    setTimeout(() => {
                        modalContent.classList.remove('opacity-0', 'scale-95');
                        modalContent.classList.add('opacity-100', 'scale-100');
                    }, 10);
                    //llenaSelectCursos();
                });

                // Delegación: escuchar todos los botones "edit-btn"
                document.querySelectorAll('.edit-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id;
                        // llenar campos desde data-attributes
                        document.getElementById('codigo').value = this.dataset.codigo ?? '';
                        document.getElementById('estado').value = this.dataset.estado ?? '';
                        document.getElementById('rude').value = this.dataset.rude ?? '';
                        document.getElementById('ci').value = this.dataset.ci ?? '';
                        document.getElementById('nombres').value = this.dataset.nombres ?? '';
                        document.getElementById('appaterno').value = this.dataset.appaterno ?? '';
                        document.getElementById('apmaterno').value = this.dataset.apmaterno ?? '';
                        document.getElementById('genero').value = this.dataset.genero ?? '';
                        document.getElementById('fecha_nacimiento').value = this.dataset.fecha ?? '';
                        document.getElementById('observacion').value = this.dataset.observacion ?? '';
                        document.getElementById('id_curso').value = this.dataset.id_curso ?? '';
                        // cambiar action a la ruta update (URL RESTful)
                        studentForm.action =
                            `/estudiante/${id}`; // o usa la ruta generada en data-url si prefieres
                        formMethod.value = 'PUT';
                        submitBtn.textContent = 'Actualizar';

                        // abrir modal
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modalContent.classList.remove('opacity-0', 'scale-95');
                            modalContent.classList.add('opacity-100', 'scale-100');
                        }, 10);
                    });
                });

                // Cerrar modal (ya tienes closeBtn)
                const closeBtn = document.getElementById('closeModal');
                closeBtn.addEventListener('click', () => {
                    modalContent.classList.remove('opacity-100', 'scale-100');
                    modalContent.classList.add('opacity-0', 'scale-95');
                    setTimeout(() => modal.classList.add('hidden'), 200);
                });
            });

            const openBtnSubir = document.getElementById('openModalSubir');
            const closeBtnSubir = document.getElementById('closeModalSubir');
            const modalSubir = document.getElementById('modalSubir');
            const modalSubirContent = document.getElementById('modalSubirContent');


            // Abrir modal de importación
            openBtnSubir.addEventListener('click', (e) => {
                e.preventDefault();
                modalSubir.classList.remove('hidden');
                setTimeout(() => {
                    modalSubirContent.classList.remove('opacity-0', 'scale-95');
                    modalSubirContent.classList.add('opacity-100', 'scale-100');
                }, 10);
            });

            // Cerrar modal de importación
            closeBtnSubir.addEventListener('click', () => {
                modalSubirContent.classList.remove('opacity-100', 'scale-100');
                modalSubirContent.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    modalSubir.classList.add('hidden');
                    document.getElementById('formularioImportar').reset();
                }, 200);
            });

            // Función para editar estudiante
            function editarEstudiante(idEstudiante) {
                fetch(`/estudiante/${idEstudiante}`)
                    .then(response => response.json())
                    .then(data => {
                        // Llenar el formulario con los datos
                        document.getElementById('id_estudiante_hidden').value = data.id_estudiante;
                        document.getElementById('turno').value = data.turno || '';
                        document.getElementById('nivel').value = data.nivel || '';
                        document.getElementById('estado').value = data.estado || '';
                        document.getElementById('rude').value = data.rude || '';
                        document.getElementById('ci').value = data.ci || '';
                        document.getElementById('nombres').value = data.nombres || '';
                        document.getElementById('appaterno').value = data.appaterno || '';
                        document.getElementById('apmaterno').value = data.apmaterno || '';
                        document.getElementById('genero').value = data.genero || '';
                        document.getElementById('fecha_nacimiento').value = data.fecha_nacimiento || '';
                        document.getElementById('observacion').value = data.observacion || '';

                        // Cambiar acción del formulario y método
                        document.getElementById('formularioEstudiante').action = `/estudiante/${idEstudiante}`;
                        document.getElementById('formMethod').value = 'PUT';
                        document.getElementById('modalTitle').textContent = 'EDITAR ESTUDIANTE';

                        // Llenar el select de cursos
                        llenaSelectCursos();

                        // Pre-seleccionar el curso actual si existe
                        if (data.id_curso) {
                            setTimeout(() => {
                                document.getElementById('id_curso').value = data.id_curso;
                            }, 300);
                        }

                        // Abrir modal
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modalContent.classList.remove('opacity-0', 'scale-95');
                            modalContent.classList.add('opacity-100', 'scale-100');
                        }, 10);
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Limpiar formulario al cerrar modal
            function limpiarFormulario() {
                document.getElementById('formularioEstudiante').reset();
                document.getElementById('formularioEstudiante').action = "{{ route('estudiante.store') }}";
                document.getElementById('formMethod').value = 'POST';
                document.getElementById('modalTitle').textContent = 'REGISTRO DE NUEVO ESTUDIANTE';
                document.getElementById('id_curso').value = '';
            }

            //codigo para obtener datos de un select
            document.getElementById("nivel").addEventListener('change', function() {
                const nivel = this.value;
                const turno = document.getElementById('turno').value;
                const cursoSelect = document.getElementById('curso');

                cursoSelect.innerHTML = '<option value="">seleccione</option>';
                cursoSelect.disabled = true;

                if (turno && nivel) {
                    // Cargar los cursos pasando ambos parámetros
                    fetch(`/curso/${turno}/${nivel}`)
                        .then(response => response.json())
                        .then(data => {
                            cursoSelect.innerHTML = data.map(item =>
                                `<option value="${item.idCurso}">${item.nombreCurso}</option>`
                            ).join('');
                            cursoSelect.disabled = false;
                        })
                        .catch(error => console.error('Error cargando de los cursos:', error));
                }


            });
        </script>


    </div>
@endsection

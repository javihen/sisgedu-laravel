@extends('layouts.navhorizontal')

@section('content')
    <style>
        .vertical-text {
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            text-align: center;
            white-space: nowrap;
            margin: auto;
            min-height: 120px;
        }
    </style>
    <div class="ml-14 w-full px-4 py-8 absolute flex justify-center">
        <div class="mx-auto">
            <!-- Encabezado -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Importar Notas - Flujo Asistido</h1>
                <p class="text-gray-600 mt-2">Sigue los 4 pasos para importar las notas de los estudiantes</p>
            </div>

            <!-- Indicador de Pasos -->
            <div class="mb-8 flex justify-between items-center">
                <div class="flex items-center flex-1">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-600 text-white font-bold paso-activo"
                            data-paso="1">
                            1
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-700">Subir Archivo</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-300 mx-4 progreso-linea"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-300 text-gray-600 font-bold"
                            data-paso="2">
                            2
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-500">Seleccionar Hoja</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-300 mx-4 progreso-linea"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-300 text-gray-600 font-bold"
                            data-paso="3">
                            3
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-500">Previsualizar</span>
                    </div>
                    <div class="flex-1 h-1 bg-gray-300 mx-4 progreso-linea"></div>
                    <div class="flex items-center">
                        <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-300 text-gray-600 font-bold"
                            data-paso="4">
                            4
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-500">Importar</span>
                    </div>
                </div>
            </div>

            <!-- Mensajes de error/éxito -->
            <div id="mensajeError" class="hidden mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                <p id="textoError" class="font-bold"></p>
            </div>

            <div id="mensajeExito" class="hidden mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded">
                <p id="textoExito" class="font-bold"></p>
            </div>

            <div id="mensajeInfo" class="hidden mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded">
                <p id="textoInfo" class="font-bold"></p>
            </div>

            <!-- Tarjeta principal -->
            <div class="bg-white rounded-lg shadow-lg p-8">

                <!-- PASO 1: SUBIR ARCHIVO -->
                <div id="paso1" class="paso-contenedor space-y-6">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-4">Paso 1: Subir Archivo Excel</h2>

                    <div class="space-y-4">
                        <!-- Período -->
                        <div class="space-y-2">
                            <label for="periodo" class="block text-sm font-medium text-gray-700">
                                Período Académico *
                            </label>
                            <select id="periodo" name="periodo"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">Selecciona un BIMESTRE...</option>
                                <option value="1">PRIMER</option>
                                <option value="2">SEGUNDO</option>
                                <option value="3">TERCER</option>
                            </select>
                        </div>

                        <!-- Gestión -->
                        <div class="space-y-2">
                            <label for="id_gestion" class="block text-sm font-medium text-gray-700">
                                Gestión Académica *
                            </label>
                            <select id="id_gestion" name="id_gestion"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">Selecciona una gestión...</option>
                                @foreach ($gestiones as $gestion)
                                    <option value="{{ $gestion->id_gestion }}">
                                        {{ $gestion->anio }} ({{ $gestion->estado }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Input de archivo -->
                        <div class="space-y-2">
                            <label for="archivo" class="block text-sm font-medium text-gray-700">
                                Seleccionar archivo Excel
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 transition dropzone">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-18-6v12m0 0l-4-4m4 4l4-4"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="archivo"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>Haz clic para seleccionar un archivo</span>
                                            <input id="archivo" name="archivo" type="file" class="sr-only"
                                                accept=".xlsx,.xls">
                                        </label>
                                        <p class="pl-1">o arrastra y suelta</p>
                                    </div>
                                    <p class="text-xs text-gray-500">Excel (.xlsx o .xls) hasta 2MB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre del archivo seleccionado -->
                        <div id="archivoSeleccionado" class="hidden p-3 bg-gray-100 rounded text-sm text-gray-700">
                            <span id="nombreArchivo"></span>
                        </div>
                    </div>

                    <!-- Botón para subir -->
                    <button type="button" id="btnSubirArchivo"
                        class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 flex items-center justify-center"
                        disabled>
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        Subir y Leer Hojas
                    </button>
                </div>

                <!-- PASO 2: SELECCIONAR HOJA -->
                <div id="paso2" class="paso-contenedor space-y-6 hidden">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-4">Paso 2: Seleccionar Hoja</h2>

                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <p class="text-sm text-blue-800">Se encontraron <strong id="cantidadHojas">0</strong> hojas en el
                            archivo. Selecciona una para continuar.</p>
                    </div>

                    <div class="space-y-2">
                        <label for="hojaSeleccionada" class="block text-sm font-medium text-gray-700">
                            Selecciona una hoja
                        </label>
                        <select id="hojaSeleccionada"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Selecciona una hoja --</option>
                        </select>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" id="btnVolverPaso1"
                            class="flex-1 px-4 py-3 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg transition duration-200">
                            ← Volver Atrás
                        </button>
                        <button type="button" id="btnPrevisualizar"
                            class="flex-1 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200"
                            disabled>
                            Previsualizar →
                        </button>
                    </div>
                </div>

                <!-- PASO 3: PREVISUALIZAR DATOS -->
                <div id="paso3" class="paso-contenedor space-y-6 hidden w-full">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-4">Paso 3: Previsualizar Datos</h2>

                    <div class="p-4 bg-amber-50 border-l-4 border-amber-500 rounded">
                        <p class="text-sm text-amber-800">A continuación se muestran los primeros datos de la hoja
                            seleccionada. Verifica que todo sea correcto.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table id="tablaPreview" class="min-w-full border-collapse text-sm">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-3 py-2">N°</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <p class="text-sm text-blue-800">Total de filas en la hoja: <strong id="totalFilasInfo">0</strong>
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" id="btnVolverPaso2"
                            class="flex-1 px-4 py-3 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg transition duration-200">
                            ← Volver Atrás
                        </button>
                        <button type="button" id="btnImportar"
                            class="flex-1 px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200">
                            Importar Datos →
                        </button>
                    </div>
                </div>

                <!-- PASO 4: RESULTADO DE IMPORTACIÓN -->
                <div id="paso4" class="paso-contenedor space-y-6 hidden">
                    <h2 class="text-2xl font-bold text-gray-800 border-b pb-4">Paso 4: Resultado de Importación</h2>

                    <div id="resultadoImportacion" class="space-y-4">
                        <!-- Se llenará con JavaScript -->
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('notas.index') }}"
                            class="flex-1 px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-200 text-center">
                            Ver Notas Importadas
                        </a>
                        <button type="button" id="btnNuevaImportacion"
                            class="flex-1 px-4 py-3 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg transition duration-200">
                            Nueva Importación
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // ============================================
        // VARIABLES GLOBALES
        // ============================================
        let archivoTemporal = null;
        let hojas = [];
        let hojaSeleccionada = null;

        // ============================================
        // UTILIDADES
        // ============================================
        function mostrarMensaje(tipo, mensaje) {
            const elementoError = document.getElementById('mensajeError');
            const elementoExito = document.getElementById('mensajeExito');
            const elementoInfo = document.getElementById('mensajeInfo');

            // Ocultar todos
            elementoError.classList.add('hidden');
            elementoExito.classList.add('hidden');
            elementoInfo.classList.add('hidden');

            if (tipo === 'error') {
                document.getElementById('textoError').textContent = mensaje;
                elementoError.classList.remove('hidden');
            } else if (tipo === 'exito') {
                document.getElementById('textoExito').textContent = mensaje;
                elementoExito.classList.remove('hidden');
            } else if (tipo === 'info') {
                document.getElementById('textoInfo').textContent = mensaje;
                elementoInfo.classList.remove('hidden');
            }

            // Auto-ocultar después de 5 segundos
            if (tipo !== 'error') {
                setTimeout(() => {
                    document.getElementById(`mensaje${tipo === 'exito' ? 'Exito' : 'Info'}`).classList.add(
                        'hidden');
                }, 5000);
            }
        }

        function irAlPaso(numeroPaso) {
            // Ocultar todos los pasos
            document.querySelectorAll('.paso-contenedor').forEach(el => {
                el.classList.add('hidden');
            });

            // Mostrar el paso indicado
            document.getElementById(`paso${numeroPaso}`).classList.remove('hidden');

            // Actualizar indicador de pasos
            document.querySelectorAll('[data-paso]').forEach(el => {
                const paso = parseInt(el.dataset.paso);
                if (paso < numeroPaso) {
                    el.classList.remove('bg-gray-300', 'text-gray-600');
                    el.classList.add('bg-green-600', 'text-white');
                } else if (paso === numeroPaso) {
                    el.classList.remove('bg-gray-300', 'bg-green-600', 'text-gray-600');
                    el.classList.add('bg-blue-600', 'text-white');
                } else {
                    el.classList.remove('bg-green-600', 'bg-blue-600', 'text-white');
                    el.classList.add('bg-gray-300', 'text-gray-600');
                }
            });

            // Actualizar líneas de progreso
            document.querySelectorAll('.progreso-linea').forEach((el, index) => {
                if (index < numeroPaso - 1) {
                    el.classList.remove('bg-gray-300');
                    el.classList.add('bg-green-600');
                } else {
                    el.classList.remove('bg-green-600');
                    el.classList.add('bg-gray-300');
                }
            });

            // Scroll al principio
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // ============================================
        // PASO 1: SUBIR ARCHIVO
        // ============================================
        const inputArchivo = document.getElementById('archivo');
        const btnSubirArchivo = document.getElementById('btnSubirArchivo');
        const archivoSeleccionadoDiv = document.getElementById('archivoSeleccionado');
        const nombreArchivoSpan = document.getElementById('nombreArchivo');

        inputArchivo.addEventListener('change', function(e) {
            const archivo = e.target.files[0];
            if (archivo) {
                nombreArchivoSpan.textContent = '📎 ' + archivo.name;
                archivoSeleccionadoDiv.classList.remove('hidden');
                btnSubirArchivo.disabled = false;
            } else {
                archivoSeleccionadoDiv.classList.add('hidden');
                btnSubirArchivo.disabled = true;
            }
        });

        // Drag and drop
        const dropzone = document.querySelector('.dropzone');
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('bg-blue-50', 'border-blue-500');
        });
        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('bg-blue-50', 'border-blue-500');
        });
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('bg-blue-50', 'border-blue-500');
            inputArchivo.files = e.dataTransfer.files;
            const event = new Event('change', {
                bubbles: true
            });
            inputArchivo.dispatchEvent(event);
        });

        // Subir archivo
        btnSubirArchivo.addEventListener('click', async function() {
            const periodo = document.getElementById('periodo').value;
            const idGestion = document.getElementById('id_gestion').value;
            const archivo = inputArchivo.files[0];

            if (!periodo || !idGestion || !archivo) {
                mostrarMensaje('error', 'Debes completar todos los campos y seleccionar un archivo');
                return;
            }

            btnSubirArchivo.disabled = true;
            btnSubirArchivo.textContent = 'Subiendo...';

            const formData = new FormData();
            formData.append('archivo', archivo);

            try {
                const response = await fetch('{{ route('notas.upload-file') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: formData
                });

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.error);
                }

                archivoTemporal = data.archivo;
                hojas = data.hojas;

                // Llenar select de hojas
                const selectHojas = document.getElementById('hojaSeleccionada');
                selectHojas.innerHTML = '<option value="">-- Selecciona una hoja --</option>';
                hojas.forEach(hoja => {
                    const option = document.createElement('option');
                    option.value = hoja;
                    option.textContent = hoja;
                    selectHojas.appendChild(option);
                });

                document.getElementById('cantidadHojas').textContent = hojas.length;

                mostrarMensaje('exito', data.mensaje);
                irAlPaso(2);

            } catch (error) {
                mostrarMensaje('error', 'Error: ' + error.message);
            } finally {
                btnSubirArchivo.disabled = false;
                btnSubirArchivo.textContent = 'Subir y Leer Hojas';
            }
        });

        // ============================================
        // PASO 2: SELECCIONAR HOJA
        // ============================================
        const selectHojas = document.getElementById('hojaSeleccionada');
        const btnPrevisualizar = document.getElementById('btnPrevisualizar');
        const btnVolverPaso1 = document.getElementById('btnVolverPaso1');

        selectHojas.addEventListener('change', function() {
            hojaSeleccionada = this.value;
            btnPrevisualizar.disabled = !hojaSeleccionada;
        });

        btnVolverPaso1.addEventListener('click', function() {
            irAlPaso(1);
        });

        btnPrevisualizar.addEventListener('click', async function() {
            if (!hojaSeleccionada) {
                mostrarMensaje('error', 'Debes seleccionar una hoja');
                return;
            }

            btnPrevisualizar.disabled = true;
            btnPrevisualizar.textContent = 'Cargando preview...';

            try {
                const response = await fetch('{{ route('notas.preview-sheet') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        archivo: archivoTemporal,
                        hoja: hojaSeleccionada
                    })
                });

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.error);
                }

                // Mostrar tabla de preview
                const tablaPreview = document.getElementById('tablaPreview');
                const thead = tablaPreview.querySelector('thead tr');
                const tbody = tablaPreview.querySelector('tbody');

                // Limpiar encabezados
                thead.innerHTML = '<th class="border border-gray-300 px-3 py-2">N°</th>';

                // Agregar encabezados de la hoja
                const colLetras = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
                    'P'
                ];
                data.encabezados.forEach((encabezado, idx) => {
                    const th = document.createElement('th');
                    th.className = 'border border-gray-300 px-3 py-2 bg-blue-100 font-semibold text-xs';
                    // Si no hay ID de materia en fila 1, mostramos la letra de la columna
                    th.textContent = encabezado ? encabezado : 'Col ' + colLetras[idx];
                    thead.appendChild(th);
                });

                // Agregar datos
                tbody.innerHTML = '';
                data.datos.forEach((fila, idx) => {

                    const tr = document.createElement('tr');

                    // Número de fila
                    tr.innerHTML = `
                        <td class="border border-gray-300 px-3 py-2 font-semibold bg-gray-50 whitespace-nowrap">
                            ${idx + 3}
                        </td>
                    `;

                    fila.forEach((valor, colIndex) => {

                        // ❌ OCULTAR COLUMNA C (índice 2)
                        if (colIndex === 2) {
                            return;
                        }

                        const td = document.createElement('td');

                        // Estilos base
                        td.className =
                            'border border-gray-300 px-3 py-2 text-center whitespace-nowrap';

                        // Convertir a texto
                        const texto = valor ? valor.toString().trim() : '';
                        if (idx === 1) {
                            td.innerHTML = `
                        <div class="vertical-text">
                            ${texto}
                        </div>
                    `;
                            td.classList.add('bg-blue-50', 'font-semibold');
                        } else {
                            td.textContent = texto;
                            const numero = Number(texto);
                            // Verifica que realmente sea número
                            if (!isNaN(numero) && texto !== '') {
                                if (numero < 51) {
                                    td.textContent = numero;
                                    td.classList.add(
                                        'text-red-600',
                                        'font-bold',
                                        'bg-red-100'
                                    );
                                } else if (numero === 51) {
                                    td.textContent = numero;
                                    td.classList.add(
                                        'text-black',
                                        'font-bold',
                                        'bg-gray-200'
                                    );
                                }
                            }
                        }
                        tr.appendChild(td);
                    });
                    tbody.appendChild(tr);
                });

                document.getElementById('totalFilasInfo').textContent = data.totalFilas;

                mostrarMensaje('exito', 'Preview cargado correctamente');
                irAlPaso(3);

            } catch (error) {
                mostrarMensaje('error', 'Error al cargar preview: ' + error.message);
            } finally {
                btnPrevisualizar.disabled = false;
                btnPrevisualizar.textContent = 'Previsualizar →';
            }
        });

        // ============================================
        // PASO 3: IMPORTAR DATOS
        // ============================================
        const btnVolverPaso2 = document.getElementById('btnVolverPaso2');
        const btnImportar = document.getElementById('btnImportar');

        btnVolverPaso2.addEventListener('click', function() {
            irAlPaso(2);
        });

        btnImportar.addEventListener('click', async function() {
            const periodo = document.getElementById('periodo').value;
            const idGestion = document.getElementById('id_gestion').value;

            if (!periodo || !idGestion || !hojaSeleccionada) {
                mostrarMensaje('error', 'Faltan datos necesarios');
                return;
            }

            btnImportar.disabled = true;
            btnImportar.textContent = 'Importando...';

            try {
                const response = await fetch('{{ route('notas.import-data') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        archivo: archivoTemporal,
                        hoja: hojaSeleccionada,
                        periodo: periodo,
                        id_gestion: idGestion
                    })
                });

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.error);
                }

                // Mostrar resultados
                const resultadoDiv = document.getElementById('resultadoImportacion');
                resultadoDiv.innerHTML = `
                    <div class="p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <p class="text-green-800 font-bold">✅ ${data.mensaje}</p>
                    </div>
                    <div class="p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                        <p class="text-blue-800"><strong>Notas importadas:</strong> ${data.notasCreadas}</p>
                    </div>
                `;

                // Mostrar errores si los hay
                if (data.errores && data.errores.length > 0) {
                    const erroresHtml = data.errores.slice(0, 10).map(err => `<li>${err}</li>`).join('');
                    resultadoDiv.innerHTML += `
                        <div class="p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                            <p class="text-yellow-800 font-bold mb-2">⚠️ Se encontraron ${data.errores.length} errores:</p>
                            <ul class="list-disc pl-5 text-sm text-yellow-800">
                                ${erroresHtml}
                                ${data.errores.length > 10 ? `<li>... y ${data.errores.length - 10} errores más</li>` : ''}
                            </ul>
                        </div>
                    `;
                }

                irAlPaso(4);

            } catch (error) {
                mostrarMensaje('error', 'Error en la importación: ' + error.message);
                btnImportar.disabled = false;
                btnImportar.textContent = 'Importar Datos →';
            }
        });

        // ============================================
        // PASO 4: NUEVA IMPORTACIÓN
        // ============================================
        const btnNuevaImportacion = document.getElementById('btnNuevaImportacion');

        btnNuevaImportacion.addEventListener('click', function() {
            // Limpiar datos
            archivoTemporal = null;
            hojas = [];
            hojaSeleccionada = null;
            inputArchivo.value = '';
            archivoSeleccionadoDiv.classList.add('hidden');
            document.getElementById('hojaSeleccionada').value = '';
            document.getElementById('tablaPreview tbody').innerHTML = '';

            // Volver al paso 1
            irAlPaso(1);
        });

        // Inicializar: verificar CSRF token
        if (!document.querySelector('meta[name="csrf-token"]')) {
            const csrfToken = document.createElement('meta');
            csrfToken.name = 'csrf-token';
            csrfToken.content = '{{ csrf_token() }}';
            document.head.appendChild(csrfToken);
        }
    </script>
@endsection

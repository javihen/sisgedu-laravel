@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">Listado de cursos asignados al profesor</p>
        </div>
        <div class=" mx-3 mt-2 flex flex-row gap-1 w-full flex-wrap">
            @foreach ($asignaciones as $asignacion)
                {{-- card --}}
                <div
                    class="w-[245px] h-[176px] bg-white rounded-lg shadow flex flex-col overflow-hidden border border-slate-400">
                    {{-- encabezado --}}
                    <div class="w-full h-[57px] bg-[#F4F2FF] flex items-center px-5">
                        <div class="">
                            <div class="w-7 h-7 bg-[#3B82F6] rounded-full"></div>
                        </div>
                        <div class="ml-2 leading-tight">
                            <p class="text-[11px] font-semibold">{{ $asignacion->curso->display_name }}</p>
                            <p class="text-[9px] text-gray-500">{{ $asignacion->materia->area }}</p>
                        </div>
                    </div>
                    {{-- cuerpo con imagen --}}
                    <div class="flex-1 bg-cover bg-center" style="background-image: url('/images/asignatura.webp');">
                        {{-- opcional: overlay --}}
                        <div class="w-full h-full bg-white/40"></div>
                    </div>
                    {{-- pie --}}
                    <div onclick="openModal('{{ $asignacion->curso->id }}', '{{ $asignacion->curso->display_name }}')"
                        class="w-full h-[36px] bg-white flex justify-end items-center px-5 cursor-pointer hover:bg-gray-100 transition-colors">
                        <p class="text-[9px] mr-2 text-gray-600">Mostrar</p>
                        <i class="fa-solid fa-expand text-gray-500"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="modalOpciones"
        class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
        <!-- Contenedor del modal -->
        <div id="modalContent" class="bg-white rounded-md shadow-lg w-fit p-4 transform transition-all scale-95 opacity-0">

            <!-- Título -->
            <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">Actualizar datos</h2>
            <hr class="border border-slate-200 mb-4">
            <!-- Formulario -->
            <div class="flex flex-row gap-4">
                <a href="#" id="linkAsistencia"
                    class="text-xs flex items-center justify-center gap-3 w-[150px] h-[150px] p-3 border-2 bg-red-600 hover:bg-transparent hover:border-red-600 hover:text-red-600 text-white rounded-md shadow transition-colors duration-200">
                    <i class="fa-solid fa-clipboard-user text-lg"></i>
                    <span class="font-medium">Asistencias</span>
                </a>

                <a href="#" id="linkActividades"
                    class="text-xs flex items-center justify-center gap-3 w-[150px] h-[150px] p-3 border-2 bg-orange-500 hover:bg-transparent hover:border-orange-600 hover:text-orange-600 text-white rounded-md shadow transition-colors duration-200">
                    <i class="fa-solid fa-list-check text-lg"></i>
                    <span class="font-medium">Actividades</span>
                </a>

                <a href="#" id="linkActividades"
                    class="text-xs flex items-center justify-center gap-3 w-[150px] h-[150px] p-3 border-2 bg-yellow-500 hover:bg-transparent hover:border-yellow-600 hover:text-yellow-600 text-white rounded-md shadow transition-colors duration-200">
                    <i class="fa-solid fa-list-check text-lg"></i>
                    <span class="font-medium">Otros ...</span>
                </a>
            </div>
        </div>
    </div>
    {{-- Modal de Opciones --}}
    <div id="modal"
        class="fixed inset-0 z-50 hidden w-full h-full bg-black bg-opacity-50 flex justify-center items-center backdrop-blur-sm">
        <div class="bg-white rounded-lg shadow-xl w-80 md:w-96 transform transition-all scale-100 overflow-hidden">
            {{-- Modal Header --}}
            <div class="bg-[#38BC9B] px-4 py-3 flex justify-between items-center">
                <h3 id="modalTitle" class="text-white font-semibold text-sm">Opciones del Curso</h3>
                <button onclick="closeModal()" class="text-white hover:text-gray-200 focus:outline-none">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="p-6 flex flex-col gap-4">
                <a id="linkAsistencia" href="#"
                    class="flex items-center justify-center gap-3 w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow transition-colors duration-200">
                    <i class="fa-solid fa-clipboard-user text-lg"></i>
                    <span class="font-medium">ASISTENCIA</span>
                </a>

                <a id="linkActividades" href="#"
                    class="flex items-center justify-center gap-3 w-full py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-md shadow transition-colors duration-200">
                    <i class="fa-solid fa-list-check text-lg"></i>
                    <span class="font-medium">ACTIVIDADES</span>
                </a>
            </div>
        </div>
    </div>

    <script>
        function openModal(idCurso, nombreCurso) {
            const modal = document.getElementById('modalOpciones');
            const title = document.getElementById('modalTitle');
            const linkAsistencia = document.getElementById('linkAsistencia');
            const linkActividades = document.getElementById('linkActividades');

            // Actualizar título
            title.textContent = nombreCurso;

            // Actualizar enlaces con el ID del curso
            // Ajusta estas rutas según tu archivo routes/web.php
            // Se asume que la ruta de asistencia es /estudiante/asistencia/{id} basado en EstudianteController
            linkAsistencia.href = "{{ url('/estudiante/asistencia') }}/" + idCurso;

            // Se asume una ruta para actividades
            linkActividades.href = "{{ url('/curso/actividades') }}/" + idCurso;

            // Mostrar modal
            modal.classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('modalContent').classList.remove('scale-95',
                    'opacity-0');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('modalOpciones');
            modal.classList.add('hidden');
        }

        // Cerrar al hacer click fuera del modal
        window.onclick = function(event) {
            const modal = document.getElementById('modalOpciones');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
@endsection

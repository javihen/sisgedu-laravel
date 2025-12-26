@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">ASIGNATURAS</p>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-[18px] mr-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
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

        {{-- Contenedores por nivel de cursos --}}
        <div class=" mx-3 mt-2 flex flex-row gap-1 w-full h-[calc(100vh-150px)]">
            <div class="w-1/4 bg-white h-fit rounded-md flex flex-col items-center border border-gray-400">
                <a href="#" id="openModal"
                    class="w-[calc(100%-1rem)] mx-2 text-center flex items-center justify-center
           text-white bg-blue-600  border border-transparent shadow-xs
           font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    <i class='bx bx-plus mr-2'></i>Nueva asignatura
                </a>
                <a href="#"
                    class="w-[calc(100%-1rem)] mx-2 text-center flex items-center justify-center
           text-white bg-blue-600  border border-transparent shadow-xs
           font-medium leading-5 rounded text-xs px-3 py-1.5 my-2">
                    <i class='bx bx-plus mr-2'></i> Asignar profesor a materia
                </a>
            </div>
            <div
                class="relative w-3/4 bg-white h-[calc(100%-2rem)] rounded border border-gray-400 overflow-y-scroll scrollbar-thin">
                <!-- Tabs -->
                <div class="mb-4 ">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" role="tablist">

                        <li class="me-2" role="presentation">
                            <button class="tab-btn inline-block p-4 border-b-2 rounded-t-base" data-tabs-target="#profile"
                                type="button" role="tab">
                                <i class='bx bx-chalkboard'></i> Inicial en familia comunitaria
                            </button>
                        </li>

                        <li class="me-2" role="presentation">
                            <button class="tab-btn inline-block p-4 border-b-2 rounded-t-base" data-tabs-target="#dashboard"
                                type="button" role="tab">
                                <i class='bx bx-chalkboard'></i> Primaria comunitaria vocacional
                            </button>
                        </li>

                        <li class="me-2" role="presentation">
                            <button class="tab-btn inline-block p-4 border-b-2 rounded-t-base" data-tabs-target="#settings"
                                type="button" role="tab">
                                <i class='bx bx-chalkboard'></i> Secundaria comunitaria productiva
                            </button>
                        </li>


                    </ul>
                </div>

                <!-- Content -->
                <div id="default-tab-content ">
                    <div class="tab-panel hidden p-4 rounded-base bg-neutral-secondary-soft" id="profile">
                        <ol id="sortable-list" class="relative border-s border-default">
                            @foreach ($inicial as $MInicial)
                                <li class=" ms-4">
                                    <div
                                        class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                    </div>
                                    <div
                                        class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                        <div class="flex flex-row gap-2 w-1/2">

                                            <div class="border border-gray-400 p-2 w-9">{{ $MInicial->orden }}.</div>

                                            <p class="border border-gray-400 p-2 w-full">{{ $MInicial->area }}</p>
                                            <p class="border border-gray-400 p-2 w-16 text-center">
                                                {{ $MInicial->abreviatura }}</p>
                                        </div>
                                        <div class="flex flex-row gap-1">
                                            <form action="{{ route('materia.destroy', $MInicial->id_materia) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-center flex items-center justify-center text-white bg-red-600 border border-transparent shadow-xs font-medium leading-5 rounded px-3 py-2.5 hover:border-red-600 hover:text-red-600 hover:bg-white"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                            <a href="#"
                                                class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5 hover:text-slate-600 hover:border-slate-600 hover:bg-white"><i
                                                    class='bx bx-user-circle mr-2'></i> Docentes</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="tab-panel hidden p-4 rounded-base bg-neutral-secondary-soft" id="dashboard">
                        <ol id="sortable-list" class="relative border-s border-default">
                            @foreach ($primaria as $Mprimaria)
                                <li class=" ms-4">
                                    <div
                                        class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                    </div>
                                    <div
                                        class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                        <div class="flex flex-row gap-2 w-1/2">

                                            <div class="border border-gray-400 p-2 w-9">{{ $Mprimaria->orden }}.</div>

                                            <p class="border border-gray-400 p-2 w-full">{{ $Mprimaria->area }}</p>
                                            <p class="border border-gray-400 p-2 w-16 text-center">
                                                {{ $Mprimaria->abreviatura }}</p>
                                        </div>
                                        <div class="flex flex-row gap-1">

                                            <form action="{{ route('materia.destroy', $Mprimaria->id_materia) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-center flex items-center justify-center text-white bg-red-600 border border-transparent shadow-xs font-medium leading-5 rounded px-3 py-2.5 hover:border-red-600 hover:text-red-600 hover:bg-white"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                            <a href="#"
                                                class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5 hover:text-slate-600 hover:border-slate-600 hover:bg-white"><i
                                                    class='bx bx-user-circle mr-2'></i> Docentes</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="tab-panel hidden p-4 rounded-base bg-neutral-secondary-soft" id="settings">
                        <ol id="sortable-list" class="relative border-s border-default">
                            @foreach ($secundaria as $Msecundaria)
                                <li class=" ms-4">
                                    <div
                                        class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                    </div>
                                    <div
                                        class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                        <div class="flex flex-row gap-2 w-1/2">

                                            <div class="border border-gray-400 p-2 w-9">{{ $Msecundaria->orden }}.</div>

                                            <p class="border border-gray-400 p-2 w-full">{{ $Msecundaria->area }}</p>
                                            <p class="border border-gray-400 p-2 w-16 text-center">
                                                {{ $Msecundaria->abreviatura }}</p>
                                        </div>
                                        <div class="flex flex-row gap-1">
                                            <form action="{{ route('materia.destroy', $Msecundaria->id_materia) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-center flex items-center justify-center text-white bg-red-600 border border-transparent shadow-xs font-medium leading-5 rounded px-3 py-2.5 hover:border-red-600 hover:text-red-600 hover:bg-white"><i
                                                        class='bx bx-trash'></i></button>
                                            </form>
                                            <a href="#"
                                                class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5 hover:text-slate-600 hover:border-slate-600 hover:bg-white"><i
                                                    class='bx bx-user-circle mr-2'></i> Docentes</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                {{-- <p class="absolute bottom-0 text-xs text-red-500 m-2">La posicion de la materia se replicara en todos los
                    documentos y paginas en el sistema.</p> --}}
            </div>
        </div>

        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[422px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">Formulario materia</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formMateria" action="{{ route('materia.store') }}" method="post">
                    @csrf
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Codigo </label>
                        <input type="text" name="id_materia" id="id_materia"
                            class="w-full border border-slate-700 rounded-md px-2  pt-5 pb-2">
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="w-full flex flex-col mt-2 ">
                            <label for="rude"
                                class="text-xs relative top-5 left-1 bg-white px-2 w-fit text-slate-600">Nivel
                            </label>
                            <select name="nivel" id="nivel"
                                class="border border-slate-600 bg-white px-2  pt-5 pb-2">
                                <option value="">seleccione</option>
                                <option value="0">Inicial en Familia Comunitaria</option>
                                <option value="1">Primaria Comunitaria Vocacional</option>
                                <option value="2">Secundaria Comunitaria Productiva</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="w-full flex flex-col mt-2 ">
                            <label for="rude"
                                class="text-xs relative top-5 left-1 bg-white px-2 w-fit text-slate-600">Campo
                            </label>
                            <select name="campo" id="campo"
                                class="border border-slate-600 bg-white px-2  pt-5 pb-2">
                                <option value="">seleccione</option>
                                <option value="Comunidad y Sociedad">Comunidad y Sociedad</option>
                                <option value="Vida, Tierra y Territorio">Vida, Tierra y Territorio</option>
                                <option value="Ciencia, Tecnologia y produccion">Ciencia, Tecnologia y produccion</option>
                                <option value="Cosmos y Pensamiento">Cosmos y Pensamiento</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Area </label>
                        <input type="text" name="area" id="area"
                            class="w-full border border-slate-700 rounded-md px-2 pt-5 pb-2">
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Abreviatura </label>
                        <input type="text" name="abreviatura" id="abreviatura"
                            class="w-full border border-slate-700 rounded-md px-2 pt-5 pb-2">
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-6 left-1 bg-white px-2">Orden </label>
                        <input type="number" name="orden" id="orden"
                            class="w-full border border-slate-700 rounded-md px-2 pt-5 pb-2">
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
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {

                const sortable = new Sortable(document.getElementById('sortable-list'), {
                    animation: 150, // animación suave
                    ghostClass: 'bg-gray-200', // clase mientras arrastras
                    handle: '.drag-handle', // opcional si quieres un botón para arrastrar
                });

                const tabButtons = document.querySelectorAll('.tab-btn');
                const tabPanels = document.querySelectorAll('.tab-panel');

                tabButtons.forEach(btn => {
                    btn.addEventListener('click', () => {

                        // Remover clases activas de todos
                        tabButtons.forEach(b => {
                            b.classList.remove(
                                'text-gray-600',
                                'border-b',
                                'border-slate-400'
                            );
                            b.classList.add(
                                'text-gray-600',
                                'bg-transparent',
                                'border-transparent'
                            );
                        });

                        // Agregar clases activas al botón presionado
                        btn.classList.remove(
                            'text-gray-600',
                            'bg-transparent',
                            'border-transparent'
                        );
                        btn.classList.add(
                            'text-gray-600',
                            'border-b',
                            'border-slate-400'
                        );

                        // Ocultar todos los paneles
                        tabPanels.forEach(panel => panel.classList.add('hidden'));

                        // Mostrar panel correspondiente
                        const target = btn.getAttribute('data-tabs-target');
                        document.querySelector(target).classList.remove('hidden');
                    });
                });

                // Activar el primer tab
                if (tabButtons.length > 0) {
                    tabButtons[0].click();
                }

                const openBtn = document.getElementById('openModal');
                const closeBtn = document.getElementById('closeModal');

                openBtn.addEventListener('click', () => {
                    document.getElementById('modal').classList.remove('hidden');
                    setTimeout(() => {
                        document.getElementById('modalContent').classList.remove('scale-95',
                            'opacity-0');
                    }, 10);
                });
                closeBtn.addEventListener('click', () => {
                    document.getElementById('modalContent').classList.add('scale-95',
                        'opacity-0');
                    setTimeout(() => {
                        document.getElementById('modal').classList.add('hidden');
                    }, 200);
                });
            });
        </script>
    </div>
@endsection

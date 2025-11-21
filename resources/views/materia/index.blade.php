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
                <a href="#"
                    class="w-[calc(100%-1rem)] mx-2 text-center flex items-center justify-center
           text-white bg-blue-600  border border-transparent shadow-xs
           font-medium leading-5 rounded text-xs px-3 py-1.5 my-2">
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
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">1.</div>

                                        <p class="border border-gray-400 p-2 w-full"> Comunicacion y lenguajes: Lengua
                                            castellana y
                                            originaria</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center"> LCyO</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5"><i
                                            class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">
                                        <div class="border border-gray-400 p-2 w-9">2.</div>
                                        <p class="border border-gray-400 p-2 w-full"> Lengua extranjera</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">LEx</p>
                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5"><i
                                            class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">
                                        <div class="border border-gray-400 p-2 w-9">3.</div>
                                        <p class="border border-gray-400 p-2 w-full">Ciencias Sociales</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center"> CS</p>
                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5"><i
                                            class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">5.</div>

                                        <p class="border border-gray-400 p-2 w-full">Educacion Musical</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">EM</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">6.</div>

                                        <p class="border border-gray-400 p-2 w-full">Artes Plasticas y Visuales</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">APyV</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">7.</div>

                                        <p class="border border-gray-400 p-2 w-full">Matematica</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">M</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">8.</div>

                                        <p class="border border-gray-400 p-2 w-full">Tecnica Tecnologica General</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">TTG</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">9.</div>

                                        <p class="border border-gray-400 p-2 w-full">Tecnica Tecnologica Especializada:
                                            Sistemas Informaticos</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">TTE:SI</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">10.</div>

                                        <p class="border border-gray-400 p-2 w-full">Ciencias Naturales: Fisica</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">CNF</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">11.</div>

                                        <p class="border border-gray-400 p-2 w-full">Ciencias Naturales: Quimica</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">CNQ</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">12.</div>

                                        <p class="border border-gray-400 p-2 w-full">Ciencias Naturales: Biologia</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">CNB</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">13.</div>

                                        <p class="border border-gray-400 p-2 w-full">Valores Espiritualidad y Religiones
                                        </p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">VEyR</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                            <li class=" ms-4">
                                <div class="absolute w-3 h-3 bg-white rounded-full mt-3 -start-1.5 border border-buffer">
                                </div>
                                <div
                                    class="text-xs flex flex-row justify-between pb-1 drag-handle cursor-grab active:cursor-grabbing">
                                    <div class="flex flex-row gap-2 w-1/2">

                                        <div class="border border-gray-400 p-2 w-9">14.</div>

                                        <p class="border border-gray-400 p-2 w-full">Cosmovisiones y Filosofia</p>
                                        <p class="border border-gray-400 p-2 w-16 text-center">CyF</p>

                                    </div>
                                    <a href="#"
                                        class=" text-center flex items-center justify-center text-white bg-slate-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-6 py-1.5">
                                        <i class='bx bx-user-circle mr-2'></i> Docentes</a>
                                </div>
                            </li>
                        </ol>
                    </div>
                    <div class="tab-panel hidden p-4 rounded-base bg-neutral-secondary-soft" id="dashboard">
                        Dashboard...
                    </div>
                    <div class="tab-panel hidden p-4 rounded-base bg-neutral-secondary-soft" id="settings">
                        Settings...
                    </div>
                </div>
                {{-- <p class="absolute bottom-0 text-xs text-red-500 m-2">La posicion de la materia se replicara en todos los
                    documentos y paginas en el sistema.</p> --}}
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
            });
        </script>
    </div>
@endsection

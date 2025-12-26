@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">LISTADO DE CURSOS</p>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full  my-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif

        {{-- Contenedores por nivel de cursos --}}
        <div class=" mx-3 mt-2 flex flex-row gap-1 w-full">
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col items-center justify-center p-4 border-slate-300 border shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">INICIAL EN FAMILIA COMUNITARIA</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                {{-- <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Estudiantes</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Retirados</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Efectivo</p>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO MAÑANA
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Minicial as $MI)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $MI->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $MI->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $MI->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $MI->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO TARDE
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Tinicial as $TI)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $TI->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $TI->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $TI->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $TI->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col flex-auto items-center justify-center p-4 border border-slate-300 shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">PRIMARIA COMUNITARIA VOCACIONAL</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                {{-- <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Estudiantes</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Retirados</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Efectivo</p>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO MAÑANA
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-[550px] group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Mprimaria as $MP)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $MP->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $MP->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $MP->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $MP->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO TARDE
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Tprimaria as $TP)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $TP->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $TP->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $TP->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $TP->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col flex-auto items-center justify-center p-4 border border-slate-300 shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">SECUNDARIA COMUNITARIA PRODUCTIVA</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                {{-- <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Estudiantes</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Retirados</p>
                    </div>
                    <div class="flex-auto justify-center flex flex-col items-center">
                        <p class="text-[14px] font-semibold">250</p>
                        <p class="text-[10px]">Efectivo</p>
                    </div>
                </div> --}}
                <div class="flex flex-col mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO MAÑANA
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-[550px] group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Msecundaria as $MS)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $MS->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $MS->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $MS->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $MS->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="group w-full">
                        <!-- Botón principal -->
                        <a href="#"
                            class="w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold transition-colors">
                            TURNO TARDE
                        </a>

                        <!-- Contenido oculto que se mostrará al hacer hover -->
                        <div
                            class="flex flex-col mt-2 gap-1 bg-slate-200 p-2 rounded-sm max-h-0 overflow-hidden opacity-0 group-hover:max-h-96 group-hover:opacity-100 transition-all duration-500 ease-in-out">
                            @foreach ($Tsecundaria as $TS)
                                <div class="flex flex-row gap-1">
                                    <div
                                        class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full hover:bg-slate-500 hover:text-white cursor-pointer">
                                        <p class="text-[12px]">{{ $TS->display_name }}</p>
                                    </div>
                                    <div>
                                        <a href="#"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">{{ $TS->total_estudiantes }}</a>
                                    </div>
                                    <div>
                                        <a href="{{ route('estudiante.curso', $TS->id) }}"
                                            class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                            <i class='bx bx-book'></i>
                                        </a>
                                    </div>
                                    <div>
                                        <form action="{{ route('curso.destroy', $TS->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('¿Estás seguro de eliminar este curso?')"
                                                class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed bottom-16 right-5 animate-bounce ">
            <a href="#" id="openModal"
                class="px-5 py-2 text-blue-600 border border-blue-600 bg-white rounded-lg hover:text-white hover:bg-blue-700 text-md transition-all">
                Nuevo
                curso </a>
        </div>
        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
                x-transition:enter="transition transform ease-out duration-300"
                x-transition:enter-start="translate-y-[-20px] opacity-0"
                x-transition:enter-end="translate-y-0 opacity-100"
                x-transition:leave="transition transform ease-in duration-300"
                x-transition:leave-start="translate-y-0 opacity-100"
                x-transition:leave-end="translate-y-[-20px] opacity-0" class="fixed top-20 right-5 w-full max-w-sm z-50">
                <div
                    class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex items-center justify-between">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 text-red-700 hover:text-red-900 font-bold">&times;</button>
                </div>
            </div>
        @endif

        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mb-2 text-left">Nuevo curso</h2>
                <hr class="border border-slate-200">
                <!-- Formulario -->
                <form class="space-y-4" action="{{ route('curso.store') }}" method="post">
                    @csrf
                    <div class="flex flex-row mt-4">
                        <div class="basis-1/2">
                            <img src="./images/estudents.png" alt="">
                        </div>
                        <div class="basis-1/2">
                            <div>
                                <label for="" class="text-xs block">Turno</label>
                                <select name="turno" id="turno"
                                    class="text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="M">MANANA</option>
                                    <option value="T">TARDE</option>
                                </select>
                                <label for="" class="text-xs block mt-2">Nivel</label>
                                <select name="nivel" id="nivel"
                                    class=" text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="0">INICIAL EN FAMILIA COMUNITARIA</option>
                                    <option value="1">PRIMARIA COMUNITARIA VOCACIONAL</option>
                                    <option value="2">SECUNDARIA COMUNITARIA PRODUCTIVA</option>
                                </select>
                                <label for="" class="text-xs block mt-2">Grado</label>
                                <select name="grado" id="grado"
                                    class="text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="1">PRIMERO</option>
                                    <option value="2">SEGUNDO</option>
                                    <option value="3">TERCERO</option>
                                    <option value="4">CUARTO</option>
                                    <option value="5">QUINTO</option>
                                    <option value="6">SEXTO</option>
                                </select>
                                <label for="" class="text-xs block mt-2">Paralelo</label>
                                <select name="paralelo" id="paralelo"
                                    class="text-md w-full mt-2 p-2 block h-11 border border-slate-500 rounded">
                                    <option value=""> Seleccione ...</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <hr class="border-slate-200 border">
                    <!-- Botones -->
                    <div class="flex justify-end space-x-2  ">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 border border-gray-300 rounded-md w-1/2 hover:bg-gray-400 hover:text-white hover:cursor-pointer transition">Cancelar</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white w-1/2 rounded-lg hover:bg-blue-700 transition hover:cursor-pointer">Guardar</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            const openBtn = document.getElementById('openModal');
            const closeBtn = document.getElementById('closeModal');
            const modal = document.getElementById('modal');
            const modalContent = document.getElementById('modalContent');

            // Abrir modal
            openBtn.addEventListener('click', () => {
                modal.classList.remove('hidden');
                setTimeout(() => {
                    modalContent.classList.remove('opacity-0', 'scale-95');
                    modalContent.classList.add('opacity-100', 'scale-100');
                }, 10);
            });

            // Cerrar modal
            closeBtn.addEventListener('click', () => {
                modalContent.classList.remove('opacity-100', 'scale-100');
                modalContent.classList.add('opacity-0', 'scale-95');
                setTimeout(() => modal.classList.add('hidden'), 200);
            });
        </script>
        <script>
            console.log(@json(session()->all()));
        </script>
    </div>
@endsection

@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">Formulario de asignacion</p>
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
            <div
                class="relative w-3/4 bg-white h-[calc(100%-2rem)] rounded border border-gray-400 overflow-y-scroll scrollbar-thin">


            </div>
        </div>

        {{-- <div id="modal"
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
        </div> --}}

    </div>
@endsection

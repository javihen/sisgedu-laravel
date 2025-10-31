@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center ">
            <p class="text-white text-sm ">LISTADO DE CURSOS</p>
        </div>
        {{-- Contenedores por nivel de cursos --}}
        <div class=" mx-3 mt-2 flex flex-row gap-1 w-full">
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col items-center justify-center p-4 border-slate-300 border shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">INICIAL EN FAMILIA COMUNITARIA</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
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
                </div>
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

                            <!-- Fila 1 -->
                            <div class="flex flex-row gap-1">
                                <div class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full">
                                    <p class="text-[12px]">1º SECUNDARIO - "B"</p>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">32</a>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600">
                                        <i class='bx bx-book'></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                            </div>

                            <!-- Fila 2 -->
                            <div class="flex flex-row gap-1">
                                <div class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full">
                                    <p class="text-[12px]">2º SECUNDARIO - "B"</p>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">32</a>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600 hover:text-white hover:bg-green-600">
                                        <i class='bx bx-book'></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600 hover:text-white hover:bg-red-600">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Fila 3 -->
                            <div class="flex flex-row gap-1">
                                <div class="border bg-white border-slate-600 h-9 flex justify-center items-center w-full">
                                    <p class="text-[12px]">3º SECUNDARIO - "B"</p>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-slate-600 text-[12px] text-blue-600">32</a>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-green-600 text-green-600">
                                        <i class='bx bx-book'></i>
                                    </a>
                                </div>
                                <div>
                                    <a href="#"
                                        class="h-9 flex bg-white justify-center items-center w-9 border border-red-600 text-red-600">
                                        <i class='bx bx-trash'></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <a href="#"
                        class="mt-2 w-full text-center flex justify-center items-center text-[12px] bg-[#3B82F5] text-white h-9 hover:bg-[#2c69cc] rounded-sm font-semibold">TURNO
                        TARDE</a>
                </div>
            </div>
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col flex-auto items-center justify-center p-4 border border-slate-300 shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">PRIMARIA COMUNITARIA VOCACIONAL</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
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
                </div>
            </div>
            <div class="flex-auto">
                <div
                    class=" bg-white flex flex-col flex-auto items-center justify-center p-4 border border-slate-300 shadow-md rounded-xs h-fit">
                    <p class="text-[14px] font-semibold">SECUNDARIA COMUNITARIA PRODUCTIVA</p>
                    <p class="text-[10px]">Unidad Educativa Cristiano Vida Nueva</p>
                </div>
                <div class=" flex mt-1 bg-white h-fit border border-slate-300 shadow-md rounded-xs p-4">
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
                </div>
            </div>
        </div>
    </div>
@endsection

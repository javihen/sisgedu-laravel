@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 bg-[#3B82F6] rounded-md flex justify-between items-center pl-4 pr-2 ">
            <p class="text-white text-sm ">LISTADO DE ESTUDIANTES</p>
            <div class=" h-full">
                <i class='bx  bx-search' class="relative "></i>
                <input class="bg-white my-2 py-2 rounded-md px-2 text-xs" type="text" name="" id=""
                    placeholder="Buscar estudiante ...">
            </div>
        </div>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full  my-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false"
                        class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif

        <div class=" ml-3 w-full mt-2  flex gap-1 ">
            <div class="bg-white w-2/3  border border-slate-300 rounded-md">
                <table class="w-full">
                    <tr class="bg-[#64748B] text-white text-sm text-center ">
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Ap. Paterno</td>
                        <td>Ap. Materno</td>
                        <td>Nombres</td>
                        <td>Curso</td>
                        <td>Estado</td>
                        <td>Opciones</td>
                    </tr>
                    <tr class="border-b border-[#64748B] text-sm text-center ">
                        <td class="py-3">1.</td>
                        <td>E5A112</td>
                        <td>ACUCHIRI</td>
                        <td>CALLISAYA</td>
                        <td>ARNOLD CESAR</td>
                        <td>C4A1</td>
                        <td>
                            <a href="#"
                                class="px-2 border border-green-500 bg-white text-green-500 rounded-sm hover:text-white hover:bg-green-500">Efectivo</a>
                        </td>
                        <td>
                            <a href="#"
                                class="py-2 px-3 border border-red-500 bg-white my-2 rounded-sm text-red-500 hover:bg-red-500 hover:text-white"><i
                                    class='bx  bx-trash '></i></a>
                            <a href="#"
                                class="ml-1 p-2 border border-[#3B82F6] bg-white text-[#3B82F6] hover:bg-[#3B82F6] hover:text-white rounded-sm"><i
                                    class='bx  bx-edit-alt '></i>
                                Editar</a>
                        </td>
                    </tr>

                </table>
            </div>
            <div class=" w-1/3  ">
                <div class=" flex gap-2">
                    <a href="#"
                        class="bg-[#3B82F6] px-4 py-2 text-white w-2/3 flex-auto text-center border-2 hover:border-blue-800 rounded-md "><i
                            class='bx  bx-plus'></i>
                        Nuevo
                        estudiante
                    </a>
                    <a href="#"
                        class="rounded-md w-1/3 flex-auto bg-slate-500 text-white text-center py-2 border-2 border-slate-500 hover:border-white"><i
                            class='bx bx-download'></i> Subir </a>
                </div>
                <div class="border border-slate-300 bg-white">
                    <p class="text-center p-2">Estadistica</p>
                    <table class="w-full text-center">
                        <tr class="bg-slate-500 text-white ">
                            <td>Curso</td>
                            <td>M</td>
                            <td>F</td>
                            <td>Total</td>
                        </tr>
                        <tr class="border-b border-slate-300">
                            <td>1o PRIMARIA "A"</td>
                            <td>32</td>
                            <td>8</td>
                            <td>40</td>
                        </tr>
                        <tr class="border-b border-slate-300">
                            <td>1o PRIMARIA "A"</td>
                            <td>32</td>
                            <td>8</td>
                            <td>40</td>
                        </tr>
                        <tr class="border-b border-slate-300">
                            <td>1o PRIMARIA "A"</td>
                            <td>32</td>
                            <td>8</td>
                            <td>40</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>





    </div>
@endsection

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
                        <td class="py-2">Nro.</td>
                        <td>Codigo</td>
                        <td>Ap. Paterno</td>
                        <td>Ap. Materno</td>
                        <td>Nombres</td>
                        <td>Curso</td>
                        <td>Estado</td>
                        <td>Opciones</td>
                    </tr>
                </table>
            </div>
            <div class="bg-white w-1/3  border border-slate-300">
                estadistica por curso
            </div>
        </div>





    </div>
@endsection

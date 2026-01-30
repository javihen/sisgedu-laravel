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
                    <div class="w-full h-[36px] bg-white flex justify-end items-center px-5">
                        <p class="text-[9px] mr-2 text-gray-600">Mostrar</p>
                        <i class="fa-solid fa-expand text-gray-500"></i>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

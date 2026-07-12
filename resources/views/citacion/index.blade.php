@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-between items-center">
            <p class="text-white text-sm ml-4">
                <i class='bx bx-list-check mr-2'></i>Listado de Reuniones de Citación

            </p>
            <div class="flex gap-2 mr-4">
                <a href="{{ route('citacion.pdf.general') }}"
                    class="text-white bg-red-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 hover:text-red-600 hover:bg-white hover:border-red-600 transition">
                    <i class='bx bx-file-pdf mr-1'></i>PDF General
                </a>
                <a href="{{ route('citacion.import') }}"
                    class="text-white bg-blue-600 border border-transparent shadow-xs font-medium leading-5 rounded text-xs px-3 py-1.5 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                    <i class='bx bx-cloud-upload mr-2'></i>Importar
                </a>
            </div>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-[18px] mr-4">
                <div
                    class="mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false"
                        class="ml-4 font-bold text-green-700 hover:text-green-900">&times;</button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="w-full ml-4 mr-4">
                <div
                    class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-red-700 hover:text-red-900">&times;</button>
                </div>
            </div>
        @endif

        <div class="mx-3 mt-2 flex flex-row gap-1 w-full flex-wrap">
            {{--  --}}

            <a href="{{ route('citacionv2.index') }}" rel="noopener noreferrer"
                class="w-[245px] h-[176px] rounded-lg shadow border border-slate-400 overflow-hidden
                      bg-[url('/images/patron4.jpg')] bg-cover bg-center bg-no-repeat
                      flex flex-col cursor-pointer hover:shadow-lg transition-all duration-200 no-underline">
                <div
                    class="justify-center items-center flex-1 flex-col flex gap-1 bg-slate-500 hover:bg-slate-500/70 transition-colors duration-200 overflow-hidden">
                    <img src="{{ asset('images/018-salon-de-clases.png') }}" alt="Logo" class="w-12 h-12">
                    <p class="text-2xl font-[pacifico]">Aula Abierta</p>
                    <hr class="w-1/3 border border-slate-200 my-1">
                    <p class="text-xs">Segundo Trimestre</p>
                </div>
                <div class="bg-slate-700 h-8 w-full flex justify-center items-center">
                    <p class="text-white text-sm">Vigente</p>
                </div>
            </a>

        </div>
    </div>

    <script>
        // Implementar SweetAlert para eliminar citaciones
        document.querySelectorAll('.form-eliminar').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "Se eliminará la citación de forma permanente.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center">
            <p class="text-white text-sm">CREAR NUEVO PERMISO</p>
        </div>
        <div class="flex justify-center">
            <div class="mx-3 mt-6 bg-white rounded-lg shadow-md p-6 max-w-2xl w-full border border-slate-300">
                <form action="{{ route('permisos.store') }}" method="POST">
                    @csrf

                    <div class="mb-6">
                        <label for="nombrePermiso" class="block text-sm text-gray-700 mb-2">
                            Nombre del Permiso <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nombrePermiso" name="nombrePermiso" value="{{ old('nombrePermiso') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('nombrePermiso') border-red-500 @enderror"
                            placeholder="Ej: ver_cursos, crear_estudiante">
                        @error('nombrePermiso')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 hidden">
                        <label for="descripcion" class="block text-sm text-gray-700 mb-2">
                            Descripción <span class="text-gray-500 text-xs">(Opcional)</span>
                        </label>
                        <textarea id="descripcion" name="descripcion" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('descripcion') border-red-500 @enderror"
                            placeholder="Descripción del permiso...">{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-4">
                        <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white text-xs text-center w-1/2 py-2 px-6 rounded transition-colors">
                            <i class="fa-solid fa-save mr-2"></i>Guardar Permiso
                        </button>
                        <a href="{{ route('permisos.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white text-xs text-center w-1/2 py-2 px-6 rounded transition-colors">
                            <i class="fa-solid fa-arrow-left mr-2"></i>Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

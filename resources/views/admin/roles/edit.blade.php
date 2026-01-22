@extends('layouts.navhorizontal')

@section('content')
    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-center items-center">
            <p class="text-white text-sm font-bold">EDITAR ROL</p>
        </div>
        <div class="flex justify-center">
            <div class= "mx-3 mt-6 bg-white rounded-lg shadow-md p-6 max-w-2xl">
                <form action="{{ route('roles.update', $rol->idRol) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="nombreRol" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nombre del Rol <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nombreRol" name="nombreRol"
                            value="{{ old('nombreRol', $rol->nombreRol) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 @error('nombreRol') border-red-500 @enderror"
                            placeholder="Ej: Administrador, Profesor, Estudiante">
                        @error('nombreRol')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-4">
                            Asignar Permisos
                        </label>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @forelse($permisos as $permiso)
                                <div class="flex items-center">
                                    <input type="checkbox" id="permiso_{{ $permiso->idPermiso }}" name="permisos[]"
                                        value="{{ $permiso->idPermiso }}" @if (in_array($permiso->idPermiso, $permisosDelRol)) checked @endif
                                        class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                                    <label for="permiso_{{ $permiso->idPermiso }}"
                                        class="ml-3 text-sm text-gray-700 cursor-pointer">
                                        {{ $permiso->nombrePermiso }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-gray-500 text-sm col-span-2">No hay permisos disponibles</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="flex gap-4 justify-center">
                        <a href="{{ route('roles.index') }}"
                            class="bg-gray-500 w-1/2 text-center hover:bg-gray-600 text-white text-xs py-2 px-6 rounded transition-colors">
                            <i class="fa-solid fa-arrow-left mr-2"></i>Cancelar
                        </a>
                        <button type="submit"
                            class="bg-green-500 w-1/2 text-center hover:bg-green-600 text-white text-xs py-2 px-6 rounded transition-colors">
                            <i class="fa-solid fa-save mr-2"></i>Actualizar Rol
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

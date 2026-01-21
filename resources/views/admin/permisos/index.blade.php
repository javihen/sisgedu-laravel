@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class="ml-3 w-full mt-2 h-12 bg-[#38BC9B] rounded-md flex justify-between items-center px-4">
            <p class="text-white text-sm font-bold">GESTIÓN DE PERMISOS</p>
            <a href="{{ route('permisos.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold py-2 px-4 rounded transition-colors">
                <i class="fa-solid fa-plus mr-2"></i>Crear Nuevo Permiso
            </a>
        </div>

        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition class="mx-3 my-4">
                <div
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow-md flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-4 font-bold text-green-700">&times;</button>
                </div>
            </div>
        @endif

        <div class="mx-3 mt-4 overflow-hidden flex justify-center mb-14">
            <table class="w-1/2 bg-white rounded-lg shadow-md">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 text-xs text-center text-gray-700">ID</th>
                        <th class="px-6 text-xs text-center text-gray-700">Nombre del Permiso</th>
                        <th class="px-6 text-xs text-center text-gray-700">Roles Asignados</th>
                        <th class="px-6 text-xs text-center text-gray-700">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($permisos as $permiso)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 text-sm text-center text-gray-800">{{ $permiso->idPermiso }}</td>
                            <td class="px-6 text-sm text-gray-800">
                                {{ $permiso->nombrePermiso }}
                            </td>
                            <td class="px-6 text-sm text-center">
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs ">
                                    {{ $permiso->roles_count }}
                                </span>
                            </td>
                            <td class="px-6 py-1 text-sm text-center">
                                <a href="{{ route('permisos.edit', $permiso->idPermiso) }}"
                                    class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-xs font-semibold mr-2 transition-colors">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <button onclick="eliminarPermiso({{ $permiso->idPermiso }})"
                                    class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-xs font-semibold transition-colors">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                No hay permisos registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function eliminarPermiso(idPermiso) {
            Swal.fire({
                title: '¿Está seguro?',
                text: '¿Desea eliminar este permiso?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/admin/permisos/${idPermiso}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Eliminado!', data.message, 'success').then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Error al eliminar el permiso', 'error');
                        });
                }
            });
        }
    </script>
@endsection

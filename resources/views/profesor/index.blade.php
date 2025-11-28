@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 px-4 bg-[#38BC9B] rounded-md flex justify-between items-center ">
            <p class="text-white text-sm ">Listado de Docentes</p>
            <a href="#" id="openModal"
                class=" mx-2 text-center flex items-center justify-center
           text-white bg-blue-600  border border-transparent shadow-xs
           font-medium leading-5 rounded text-xs px-3 py-1.5 my-2 hover:text-blue-600 hover:bg-white hover:border-blue-600 transition">
                <i class='bx bx-plus mr-2'></i>Nuevo Docente
            </a>
        </div>
        <div class="">

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
                class="w-full bg-white h-[calc(100%-2rem)] rounded border border-gray-400 overflow-y-scroll scrollbar-thin">
                <table class="w-full ">
                    <thead class="bg-gray-200 sticky top-0">
                        <tr class="text-center text-xs text-gray-700">
                            <th class="py-2">Nro</th>
                            <th>CI</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Nombres</th>
                            <th>Fuente de financiamiento</th>
                            <th>Rol</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesores as $profesor)
                            <tr class="text-xs text-center hover:bg-gray-100">
                                <td class="px-4 py-2 border-b border-gray-300">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->ci }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->appaterno }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->apmaterno }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->nombres }}</td>
                                <td class="px-4 py-2 border-b border-gray-300">{{ $profesor->fuenteFinan }}</td>
                                <td class="px-4 py-2 border-b border-gray-300 ">
                                    <p
                                        class="w-fit mx-auto py-1 px-2 border border-blue-600 text-blue-600 rounded bg-white">
                                        Profesor
                                    </p>
                                </td>
                                <td>
                                    @if ($profesor->estado == 'A')
                                        <p
                                            class="w-fit mx-auto py-1 px-2 border border-green-600 text-green-600 rounded bg-white hover:bg-green-600 hover:text-white">
                                            Activo
                                        </p>
                                    @else
                                        <p
                                            class="w-fit mx-auto py-1 px-2 border border-red-600 text-red-600 rounded bg-white hover:bg-red-600 hover:text-white">
                                            Inactivo
                                        </p>
                                    @endif
                                </td>
                                <td class="px-4 py-2 border-b border-gray-300 flex justify-center items-center gap-2">
                                    <a href="{{ route('profesor.perfil', $profesor->id_profesor) }}"
                                        class="bg-slate-600 text-white py-2 px-3 border border-black shadow hover:bg-slate-700 rounded">Perfil
                                        -
                                        Asignacion</a>
                                    <a href="#"
                                        class="text-blue-600 hover:underline border border-blue-600 hover:bg-blue-600 hover:text-white rounded bg-white py-2 px-3 edit-btn"
                                        data-id="{{ $profesor->id_profesor }}" data-rda="{{ $profesor->rda }}"
                                        data-ci="{{ $profesor->ci }}" data-appaterno="{{ $profesor->appaterno }}"
                                        data-apmaterno="{{ $profesor->apmaterno }}"
                                        data-nombres="{{ $profesor->nombres }}" data-genero="{{ $profesor->genero }}"
                                        data-fecha-nac="{{ $profesor->fechaNac ?? '' }}"
                                        data-nivel-formacion="{{ $profesor->nivelFormacion ?? '' }}"
                                        data-fuente-finan="{{ $profesor->fuenteFinan ?? '' }}"
                                        data-observacion="{{ $profesor->observacion ?? '' }}">
                                        <i class='bx bx-edit-alt'></i>
                                    </a>
                                    <form action="{{ route('profesor.destroy', $profesor->id_profesor) }}" method="POST"
                                        class="inline form-eliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 border border-red-600 cursor-pointer hover:bg-red-600 hover:text-white rounded bg-white py-2 px-3 hover:underline"><i
                                                class='bx bx-trash'></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div id="modal"
            class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex border-2 border-slate-600 items-center justify-center z-50">
            <!-- Contenedor del modal -->
            <div id="modalContent"
                class="bg-white rounded-md shadow-lg w-[622px] p-4 transform transition-all scale-95 opacity-0">

                <!-- Título -->
                <h2 class="text-md font-semibold mt-4 mb-6 text-left" id="modalTitle">Registrar profesor</h2>
                <hr class="border border-slate-200 mb-4">
                <!-- Formulario -->
                <form class="space-y-4" id="formularioProfesor" method="post" action="{{ route('profesor.store') }}">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <div class="flex flex-row gap-1 mt-[-25px]">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">RDA </label>
                            <input type="text" name="rda" id="rda"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">CI </label>
                            <input type="text" name="ci" id="ci"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Apellido paterno
                            </label>
                            <input type="text" name="appaterno" id="appaterno"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Apellido materno
                            </label>
                            <input type="text" name="apmaterno" id="apmaterno"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Nombre (s) </label>
                        <input type="text" name="nombres" id="nombres"
                            class="w-full border border-slate-700 rounded-md p-2 uppercase">
                    </div>
                    <div class="flex flex-row mt-[-25px] gap-1">
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Genero
                            </label>
                            <select name="genero" id="genero"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="">seleccione</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                        </div>
                        <div class="basis-1/2">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Fecha de nacimiento
                            </label>
                            <input type="date" name="fechaNac" id="fechaNac"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                    </div>
                    <div class="flex flex-row gap-1 mt-[-25px]">
                        <div class="basis-1/2 ">
                            <label for="codigo" class="text-xs relative top-3 left-3 bg-white px-2">Grado de estudio
                            </label>
                            <input type="text" name="nivelFormacion" id="nivelFormacion"
                                class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </div>
                        <div class="basis-1/2 flex flex-col mt-2 ">
                            <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2 w-fit">Fuente de
                                financiamiento
                            </label>
                            <select name="fuenteFinan" id="fuenteFinan"
                                class="border border-slate-600 bg-white p-2 rounded-md">
                                <option value="PPFF">PADRES DE FAMILIA</option>
                                <option value="TGE">TESORO GENERAL DEL ESTADO</option>
                                <option value="RP">RECURSOS PROPIOS</option>
                            </select>
                        </div>
                    </div>



                    <div class="mt-[-25px]">
                        <label for="rude" class="text-xs relative top-3 left-3 bg-white px-2">Observaciones </label>
                        <textarea name="observacion" id="observacion" class="w-full border border-slate-700 rounded-md p-2 uppercase">
                        </textarea>
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
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {


                const modal = document.getElementById('modal');
                const openBtn = document.getElementById('openModal');
                const closeBtn = document.getElementById('closeModal');
                const formularioProfesor = document.getElementById('formularioProfesor')
                const formMethod = document.getElementById('formMethod');
                const submitBtn = document.getElementById('submitBtn');

                openBtn.addEventListener('click', () => {
                    document.getElementById('modal').classList.remove('hidden');
                    formularioProfesor.reset();
                    formularioProfesor.action = "{{ route('profesor.store') }}";
                    formMethod.value = 'POST';
                    submitBtn.textContent = 'Guardar';


                    setTimeout(() => {
                        document.getElementById('modalContent').classList.remove('scale-95',
                            'opacity-0');
                    }, 10);
                });
                closeBtn.addEventListener('click', () => {
                    document.getElementById('modalContent').classList.add('scale-95',
                        'opacity-0');
                    setTimeout(() => {
                        document.getElementById('modal').classList.add('hidden');
                    }, 200);
                });
                // Editar: abrir modal y llenar campos desde data-attributes
                document.querySelectorAll('.edit-btn').forEach(btn => {
                    btn.addEventListener('click', function(e) {
                        e.preventDefault();
                        const id = this.dataset.id;
                        // rellenar campos
                        document.getElementById('rda').value = this.dataset.rda ?? '';
                        document.getElementById('ci').value = this.dataset.ci ?? '';
                        document.getElementById('appaterno').value = this.dataset.appaterno ?? '';
                        document.getElementById('apmaterno').value = this.dataset.apmaterno ?? '';
                        document.getElementById('nombres').value = this.dataset.nombres ?? '';
                        document.getElementById('genero').value = this.dataset.genero ?? '';
                        document.getElementById('fechaNac').value = this.dataset.fechaNac ?? '';
                        document.getElementById('nivelFormacion').value = this.dataset.nivelFormacion ??
                            '';
                        document.getElementById('fuenteFinan').value = this.dataset.fuenteFinan ?? '';
                        document.getElementById('observacion').value = this.dataset.observacion ?? '';

                        // cambiar acción y método
                        const form = document.getElementById('formularioProfesor');
                        form.action = `/profesor/${id}`;
                        const formMethod = document.getElementById('formMethod');
                        if (formMethod) formMethod.value = 'PUT';
                        document.getElementById('submitBtn').textContent = 'Actualizar';

                        // abrir modal
                        document.getElementById('modal').classList.remove('hidden');
                        setTimeout(() => {
                            document.getElementById('modalContent').classList.remove('scale-95',
                                'opacity-0');
                        }, 10);
                    });
                });
                /* Utilizamos SweetAlert para confirmar la eliminacion */

                document.querySelectorAll('.form-eliminar').forEach(form => {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault(); // Detener envío

                        Swal.fire({
                            title: "¿Estás seguro?",
                            text: "Se eliminará el profesor de forma permanente.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#d33",
                            cancelButtonColor: "#3085d6",
                            confirmButtonText: "Sí, eliminar",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Enviar formulario si confirma
                            }
                        });
                    });
                });
            });
        </script>
    </div>
@endsection

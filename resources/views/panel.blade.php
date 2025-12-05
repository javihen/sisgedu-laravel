@extends('layouts.navhorizontal')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <div class="ml-14 w-[calc(100%-80px)] absolute" style="font-family: 'poppins'">
        <div class=" ml-3 w-full mt-2 h-12 px-4  rounded-md flex justify-center items-center ">
            <p class="w-[500px] text-sm py-2 border border-slate-500 rounded-md bg-white text-center">Panel de administracion
            </p>

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

            <div class="shadow-[0_0_5px_rgba(0,0,0,0.25)] bg-white/50 w-[300px] h-fit rounded-xs">
                <p class="text-md m-4">Estadistica</p>
                <div
                    class="mb-2 flex flex-row border border-[#26C1EB] hover:bg-[#26C1EB] cursor-pointer w-[279px] h-[89px] border-l-[25px] mx-auto bg-white rounded-md">
                    <div class="w-2/3">
                        <p class="m-2 text-xs">cursos</p>
                        <p class="w-full text-center text-xl">32</p>
                    </div>
                    <div class=" flex justify-center items-center">
                        <img src="/images/018-salon-de-clases.png" alt="">
                    </div>
                </div>
                <div
                    class="mb-2 flex flex-row border border-[#7F6BC2] hover:bg-[#7F6BC2] cursor-pointer w-[279px] h-[89px] border-l-[25px] mx-auto bg-white rounded-md">
                    <div class="w-2/3">
                        <p class="m-2 text-xs">Estudiantes</p>
                        <p class="w-full text-center text-xl">1214</p>
                    </div>
                    <div class=" flex justify-center items-center">
                        <img src="/images/019-educacion.png" alt="">
                    </div>
                </div>
                <div
                    class="mb-2 flex flex-row border border-[#CD4596] hover:bg-[#CD4596] cursor-pointer w-[279px] h-[89px] border-l-[25px] mx-auto bg-white rounded-md">
                    <div class="w-2/3">
                        <p class="m-2 text-xs">Profesores</p>
                        <p class="w-full text-center text-xl">64</p>
                    </div>
                    <div class=" flex justify-center items-center">
                        <img src="/images/021-profesor.png" alt="">
                    </div>
                </div>
                <div
                    class="mb-2 flex flex-row border border-[#FA9D3C] hover:bg-[#FA9D3C] cursor-pointer w-[279px] h-[89px] border-l-[25px] mx-auto bg-white rounded-md">
                    <div class="w-2/3">
                        <p class="m-2 text-xs">Otros</p>
                        <p class="w-full text-center text-xl">64</p>
                    </div>
                    <div class=" flex justify-center items-center">
                        <img src="/images/006-escribiendo.png" alt="">
                    </div>
                </div>
            </div>
            <div class=" w-[525px]">
                <div class="w-full h-72 shadow-[0_0_5px_rgba(0,0,0,0.25)] bg-white/50">
                    grafica
                </div>
                <div class="w-full h-fit shadow-[0_0_5px_rgba(0,0,0,0.25)] bg-white/50">
                    <div class=" p-4 flex flex-row justify-between">
                        <p class=" text-md">Notificaciones</p>
                        <a href="" class="text-xs bg-blue-500 px-2 py-1 rounded text-white"><i
                                class='bx bxs-notification'></i></a>
                    </div>
                    <div
                        class="flex flex-row border hover:bg-slate-500 hover:text-white border-slate-500 p-2 m-2 rounded bg-white">
                        <i class='bx bx-check-circle mr-4'></i>
                        <p class="text-xs">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi, et! Excepturi
                            soluta amet culpa
                            quis aspernatur aut numquam maxime neque inventore.</p>
                    </div>
                    <div class="flex flex-row border border-slate-500 p-2 m-2 rounded bg-white">
                        <i class='bx bx-check-circle mr-4'></i>
                        <p class="text-xs">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi, et! Excepturi
                            soluta amet culpa
                            quis aspernatur aut numquam maxime neque inventore.</p>
                    </div>
                    <div class="flex flex-row border border-slate-500 p-2 m-2 rounded bg-white">
                        <i class='bx bx-check-circle mr-4'></i>
                        <p class="text-xs">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi, et! Excepturi
                            soluta amet culpa
                            quis aspernatur aut numquam maxime neque inventore.</p>
                    </div>
                </div>
            </div>
            <div class=" w-[525px]">
                <div class="w-full h-72 shadow-[0_0_5px_rgba(0,0,0,0.25)] bg-white/50">
                    grafica
                </div>
                <div class="w-full h-72 shadow-[0_0_5px_rgba(0,0,0,0.25)] bg-white/50">
                    <div class=" p-4 flex flex-row justify-between">
                        <p class=" text-md">Gestiones</p>
                        <a href=""
                            class="text-xs border border-green-500 bg-white hover:bg-green-500 px-2 py-1 rounded hover:text-white text-green-500"><i
                                class='bx bx-plus'></i> Adicionar</a>
                    </div>
                    <table class="text-xs w-full bg-white">
                        <tr class="text-center border-b border-slate-500">
                            <td>Nombre</td>
                            <td>Inicio</td>
                            <td>Fin</td>
                            <td>Estado</td>
                        </tr>
                        <tr class="text-center border-b h-9 ">
                            <td>2022</td>
                            <td>02/02/2022</td>
                            <td>02/12/2022</td>
                            <td><a href=""
                                    class="text-xs border border-red-500 bg-white hover:bg-red-500 px-2 py-1 rounded hover:text-white text-red-500">
                                    Inactivo</a></td>
                        </tr>
                        <tr class="text-center border-b h-9 ">
                            <td>2023</td>
                            <td>02/02/2022</td>
                            <td>02/12/2022</td>
                            <td><a href=""
                                    class="text-xs border border-red-500 bg-white hover:bg-red-500 px-2 py-1 rounded hover:text-white text-red-500">
                                    Inactivo</a></td>
                        </tr>
                        <tr class="text-center border-b h-9 ">
                            <td>2024</td>
                            <td>02/02/2022</td>
                            <td>02/12/2022</td>
                            <td><a href=""
                                    class="text-xs border border-red-500 bg-white hover:bg-red-500 px-2 py-1 rounded hover:text-white text-red-500">
                                    Inactivo</a></td>
                        </tr>
                        <tr class="text-center border-b h-9 bg-slate-400 text-white">
                            <td>2025</td>
                            <td>02/02/2022</td>
                            <td>02/12/2022</td>
                            <td><a href=""
                                    class="text-xs border border-green-500 bg-green-500 px-2 py-1 rounded text-white ">
                                    Activo</a></td>
                        </tr>
                        <tr class="text-center border-b h-9 ">
                            <td>2026</td>
                            <td>02/02/2022</td>
                            <td>02/12/2022</td>
                            <td><a href=""
                                    class="text-xs border border-red-500 bg-white hover:bg-red-500 px-2 py-1 rounded hover:text-white text-red-500">
                                    Inactivo</a></td>
                        </tr>
                    </table>
                </div>
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

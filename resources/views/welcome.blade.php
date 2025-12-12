<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>{{ config('app.name', 'SISGEDU') }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fondo {
            background-image: url('/images/patron5.jpg');
            background-repeat: repeat;
            position: fixed;
            z-index: 0;
            width: 100%;
            height: 100vh;

        }
    </style>

</head>

<body class="min-h-screen bg-cover bg-center" style="background-image: url('/images/fondo2.jpg');">
    {{-- <div class="fondo"></div> --}}
    <div class="flex h-[700px] w-full relative z-10 ">
        {{-- <div class="w-full hidden md:inline-block">
            <img class="h-full"
                src="https://raw.githubusercontent.com/prebuiltui/prebuiltui/main/assets/login/leftSideImage.png"
                alt="leftSideImage">
        </div> --}}

        <div class="w-full flex flex-col items-center justify-center  ">

            <form method="POST" action="{{ route('login.post') }}"
                class="w-[500px] flex flex-col items-center justify-center bg-white/70 px-6 py-9 rounded-md backdrop-blur-xs shadow-lg">
                @csrf
                <h2 class="text-4xl text-gray-900 font-medium">SISGEDU V.2</h2>
                <p class="text-sm text-gray-700 mt-3">¡Bienvenido de nuevo! Por favor, inicie sesión para continuar
                </p>



                <div class="flex items-center gap-4 w-full my-5">
                    <div class="w-full h-px bg-gray-400"></div>
                    <p class="w-full text-nowrap text-sm text-gray-700">Ingresa tus credenciales
                    </p>
                    <div class="w-full h-px bg-gray-400"></div>
                </div>

                <div
                    class="flex items-center w-full bg-transparent border border-gray-500 h-12 rounded-full overflow-hidden pl-6 gap-2">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"
                            fill="#364153" />
                    </svg>

                    <input type="text" name="username"
                        class="uppercase bg-transparent text-gray-700 placeholder-gray-500/80 outline-none text-sm w-full h-full"
                        required>
                </div>

                <div
                    class="flex items-center mt-6 w-full bg-transparent border border-gray-500 h-12 rounded-full overflow-hidden pl-6 gap-2">
                    <svg width="13" height="17" viewBox="0 0 13 17" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 8.5c0-.938-.729-1.7-1.625-1.7h-.812V4.25C10.563 1.907 8.74 0 6.5 0S2.438 1.907 2.438 4.25V6.8h-.813C.729 6.8 0 7.562 0 8.5v6.8c0 .938.729 1.7 1.625 1.7h9.75c.896 0 1.625-.762 1.625-1.7zM4.063 4.25c0-1.406 1.093-2.55 2.437-2.55s2.438 1.144 2.438 2.55V6.8H4.061z"
                            fill="#364153" />
                    </svg>
                    <input type="password" name="password"
                        class="bg-transparent text-gray-700 placeholder-gray-500/80 outline-none text-sm w-full h-full"
                        required>
                </div>

                <div class="w-full flex items-center justify-between mt-8 text-gray-500/80">
                    <div class="flex items-center gap-2">
                        <input class="h-5" type="checkbox" id="checkbox">
                        <label class="text-sm text-gray-700" for="checkbox">Recuerdame</label>
                    </div>
                    <a class="text-sm underline text-gray-700" href="#">Olvido su contrasena?</a>
                </div>

                <button type="submit"
                    class="mt-8 w-full h-11 rounded-full text-white bg-indigo-500 hover:opacity-90 transition-opacity">
                    Iniciar sesion
                </button>
                <button type="button"
                    class="w-full mt-4 text-gray-700 border border-gray-500 cursor-pointer hover:text-white hover:bg-gray-600 flex items-center justify-center h-12 rounded-full hover:animate-pulse">
                    Soy Estudiante
                </button>
                <p class="text-gray-700 text-sm mt-4 ">No tienes una cuenta? <a class="text-indigo-700 hover:underline"
                        href="#">Registrate</a></p>
            </form>
        </div>
    </div>
</body>

@if (session('swal'))
    <script>
        Swal.fire(@json(session('swal')));
    </script>
@endif
<script>
    console.log(@json(session()->all()));
</script>

</html>

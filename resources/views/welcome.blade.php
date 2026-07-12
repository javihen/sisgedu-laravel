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

<body class="min-h-screen bg-cover bg-center" style="background-image: url('/images/fondoVN.png');">
    <div class="relative z-10 flex min-h-screen w-full items-center justify-center px-4 py-6 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('login.post') }}"
            class="w-full max-w-[500px] rounded-xl border border-white/40 bg-white/60 px-4 py-6 shadow-xl backdrop-blur-md sm:px-6 sm:py-8 md:px-8 lg:px-10 lg:py-9">
            @csrf
            <h2 class="text-center text-3xl font-semibold text-gray-900 sm:text-4xl">SISGEDU V.2</h2>
            <p class="mt-3 text-center text-sm text-gray-700 sm:text-base">
                ¡Bienvenido de nuevo! Por favor, inicie sesión para continuar
            </p>

            <div class="my-5 flex items-center gap-3 sm:gap-4">
                <div class="h-px flex-1 bg-gray-400"></div>
                <p class="text-center text-xs text-gray-700 sm:text-sm">Ingresa tus credenciales</p>
                <div class="h-px flex-1 bg-gray-400"></div>
            </div>

            <div
                class="flex items-center w-full h-12 rounded-full border border-gray-500 bg-transparent overflow-hidden pl-4 gap-2 sm:pl-6">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"
                        fill="#364153" />
                </svg>

                <input type="text" name="username"
                    class="h-full w-full bg-transparent text-sm text-gray-700 uppercase outline-none placeholder-gray-500/80"
                    placeholder="Usuario" required>
            </div>

            <div
                class="mt-4 flex items-center w-full h-12 rounded-full border border-gray-500 bg-transparent overflow-hidden pl-4 gap-2 sm:pl-6 sm:mt-6">
                <svg width="13" height="17" viewBox="0 0 13 17" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13 8.5c0-.938-.729-1.7-1.625-1.7h-.812V4.25C10.563 1.907 8.74 0 6.5 0S2.438 1.907 2.438 4.25V6.8h-.813C.729 6.8 0 7.562 0 8.5v6.8c0 .938.729 1.7 1.625 1.7h9.75c.896 0 1.625-.762 1.625-1.7zM4.063 4.25c0-1.406 1.093-2.55 2.437-2.55s2.438 1.144 2.438 2.55V6.8H4.061z"
                        fill="#364153" />
                </svg>
                <input type="password" name="password"
                    class="h-full w-full bg-transparent text-sm text-gray-700 outline-none placeholder-gray-500/80"
                    placeholder="Contraseña" required>
            </div>

            <div
                class="mt-6 flex flex-col gap-3 text-gray-500/80 sm:mt-8 sm:flex-row sm:items-center sm:justify-between">
                {{-- <div class="flex items-center gap-2">
                    <input class="h-5" type="checkbox" id="checkbox">
                    <label class="text-sm text-gray-700" for="checkbox">Recuérdame</label>
                </div>
                <a class="text-sm text-gray-700 underline" href="#">¿Olvidó su contraseña?</a> --}}
            </div>

            <button type="submit"
                class="mt-6 h-11 w-full rounded-full bg-indigo-500 text-white transition-opacity hover:opacity-90 sm:mt-8">
                Iniciar sesión
            </button>
            <button type="button"
                class="mt-4 flex h-12 w-full items-center justify-center rounded-full border border-gray-500 text-gray-700 transition hover:bg-gray-600 hover:text-white hover:animate-pulse">
                Soy Estudiante
            </button>
            <p class="mt-4 text-center text-sm text-gray-700">
                ¿No tienes una cuenta?
                <a class="text-indigo-700 hover:underline" href="#">Regístrate</a>
            </p>
        </form>
    </div>
</body>

@if (session('swal'))
    <script>
        Swal.fire(@json(session('swal')));
    </script>
@endif
<script>
    //console.log(@json(session()->all()));
</script>

</html>

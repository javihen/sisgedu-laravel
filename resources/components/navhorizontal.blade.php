<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lobster&family=Madimi+One&family=Playwrite+GB+S:ital,wght@0,100..400;1,100..400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Story+Script&display=swap"
        rel="stylesheet">
    <style>
        .fondo {
            background-image: url('/images/patron5.jpg');
            background-repeat: repeat;
            position: fixed;
            z-index: 0;
            width: 100%;
            height: 100vh;
            opacity: 0.2;
        }
    </style>
</head>

<body>


    {{-- Esta linea colocara un fondo repetido detras del contenido --}}
    <div class="fondo"></div>

    <nav class="relative z-10 bg-white px-1.5 flex justify-between align-items-center h-15 border-b-slate-200">
        <div class=" ml-16 flex flex-row items-center h-full">
            <p style='font-family: "Playwrite GB S", cursive;'>Sistema de Gestion Educativa</p>
            <div class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm mx-2">Gestion
                2025
            </div>
        </div>
        <div class=" mr-4 h-full flex items-center justify-center">
            <div class="bg-[#E3DFE7] m-auto py-2 px-3 rounded-md text-[14px]"
                style='font-family: "Poppins",
                cursive;'>
                PROF. JAVIER HENRY QUISPE PINTO
            </div>
        </div>

    </nav>

</body>

</html>

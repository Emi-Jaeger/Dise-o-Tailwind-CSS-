<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head> <!-- Color del fondo, Color texto, suavizado de fuentes, altura minima de la pantalla, flexbox, tipo de fuente -->
<body class="bg-[#f2f4f8] text-gray-800 antialiased min-h-screen flex flex-col font-sans">

    <!-- Barra de navegación -->
    <nav class="bg-[#0f172a] text-white py-4 px-6 md:px-12 shadow-md">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-tight">Galeria</h1>

            <!-- Barra para pc y tablets -->
            <div class="hidden sm:flex space-x-10 text-sm font-medium text-gray-300">
                <a href="#" class="hover:text-white transition">Inicio</a>
                <a href="#" class="hover:text-white transition">Galeria</a>
                <a href="#" class="hover:text-white transition">Nosotros</a>
                <a href="#" class="hover:text-white transition">Contacto</a>
            </div>

            <!-- Barra para telefonos -->
            <div class="sm:hidden">
                <button type="button" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <!-- sm:para pantallas medianas, lg:para pantallas grandes, y px solo para pantallas pequeñas -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12 flex-grow">

        <!-- md:para pantallas medianas en adelante y mb solo para pantallas pequeñas. Para margenes-->
        <h2 class="text-3xl md:text-4xl font-bold text-center text-[#111827] mb-8 md:mb-10">
            Nuestra Galeria
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            @php
                $tarjetas = [
                    ['titulo' => 'Paisaje Natural', 'desc' => 'Una hermosa vista de la naturaleza.', 'img' => 'https://i.pinimg.com/474x/15/db/0e/15db0e51ceca810c09a001ebe4d6e75d.jpg?w=600&auto=format&fit=crop'],
                    ['titulo' => 'Montañas', 'desc' => 'Paisajes increíbles rodeados de montañas.', 'img' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDE0fHx8ZW58MHx8fHx8?w=600&auto=format&fit=crop'],
                    ['titulo' => 'Bosque', 'desc' => 'Un tranquilo bosque rodeado de naturaleza.', 'img' => 'https://geoapps.esri.co/storymaps/Dia_mundial_de_la_vida_silvestre/img/principal.jpg?w=600&auto=format&fit=crop'],
                    ['titulo' => 'Playa', 'desc' => 'Un lugar perfecto para descansar.', 'img' => 'https://hotel.hardrock.com/all-inclusive/es/files/6215/best-beach-in-riviera-maya.jpg?w=600&auto=format&fit=crop'],
                    ['titulo' => 'Ciudad', 'desc' => 'Arquitectura moderna en una gran ciudad.', 'img' => 'https://editeca.com/wp-content/uploads/2023/10/masters-online-y-especialidades-1.webp?w=600&auto=format&fit=crop'],
                    ['titulo' => 'Aventura', 'desc' => 'Explora nuevos lugares y vive nuevas experiencias.', 'img' => 'https://http2.mlstatic.com/D_NQ_NP_947048-CBT92470507455_092025-O.webp?w=600&auto=format&fit=crop'],
                ];
            @endphp

            @foreach ($tarjetas as $card)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition border border-gray-100 flex flex-col">
                    <img src="{{ $card['img'] }}" alt="{{ $card['titulo'] }}" class="w-full h-48 object-cover">
                    <div class="p-5 flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $card['titulo'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $card['desc'] }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </main>

</body>
</html>
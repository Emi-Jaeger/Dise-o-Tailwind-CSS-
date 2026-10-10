<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-xl font-bold mb-4">Agregar Categoría</h1>

        <!-- Formulario -->
        <form action="{{ route('categoria.create') }}" method="POST" class="flex flex-col gap-4">
            @csrf
            <div>
                <label for="categoria" class="block text-sm font-medium text-gray-700 mb-1">Nombre de Categoría</label>
                <input type="text" name="categoria" id="categoria" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Guardar
            </button>
        </form>

        <!-- Lista de Categorías registradas -->
        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-2">Categorías Registradas:</h2>
            <ul class="list-disc pl-5 space-y-1">
                @foreach($categoria as $cat)
                    <li class="text-gray-800">{{ $cat->categoria }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
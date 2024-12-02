<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservas</title>
    <link href="style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-blue-600 text-white text-center py-4">
        <h1 class="text-3xl">Sistema de Reservas de Restaurantes</h1>
    </header>
    <main class="container mx-auto p-4">
        <!-- Sección de Restaurantes -->
        <section id="restaurantes" class="mb-8">
            <h2 class="text-xl font-bold mb-4">Restaurantes</h2>
            <div id="lista-restaurantes" class="grid grid-cols-3 gap-4"></div>
        </section>

        <!-- Formulario de Reserva -->
        <section id="formulario-reserva">
            <h2 class="text-xl font-bold mb-4">Hacer una Reserva</h2>
            <form id="form-reserva" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cliente">Nombre del Cliente:</label>
                    <input id="cliente" name="cliente" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="restaurante">Restaurante:</label>
                    <select id="restaurante" name="restaurante" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha">Fecha:</label>
                    <input id="fecha" name="fecha" type="date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="personas">Número de Personas:</label>
                    <input id="personas" name="personas" type="number" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Reservar</button>
                </div>
            </form>
        </section>
    </main>
    <script src="../../frontend/Js/index.js"></script>
</body>
</html>

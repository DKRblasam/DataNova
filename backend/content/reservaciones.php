<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Reservas de Restaurantes</title>
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
          <select id="restaurante" name="restaurante" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            <!-- Las opciones serán añadidas dinámicamente por JavaScript -->
          </select>
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

  <footer class="bg-blue-600 text-white text-center py-4">
    <p>&copy; 2024 Sistema de Reservas de Restaurantes. Todos los derechos reservados.</p>
  </footer>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Hacer la solicitud fetch para obtener los restaurantes
      fetch('tu-script.php') // Llamar al script PHP que genera el JSON
        .then(response => response.json()) // Convertir la respuesta JSON en un objeto JavaScript
        .then(data => {
          const selectRestaurante = document.getElementById('restaurante');
          const listaRestaurantes = document.getElementById('lista-restaurantes');

          // Verificar si hay datos
          if (data.length > 0) {
            // Agregar opciones al select
            data.forEach(restaurante => {
              const option = document.createElement('option');
              option.value = restaurante.id; // Asume que 'id' es la columna con el identificador único
              option.textContent = restaurante.nombre; // Nombre del restaurante
              selectRestaurante.appendChild(option);

              // Crear tarjetas de restaurante para mostrar en la página
              const divRestaurante = document.createElement('div');
              divRestaurante.classList.add('bg-white', 'p-4', 'shadow-md', 'rounded-lg');
              divRestaurante.innerHTML = `
                                <h3 class="font-semibold text-xl">${restaurante.nombre}</h3>
                                <p class="text-gray-700">${restaurante.direccion}</p>
                                <p class="text-gray-500">${restaurante.o_h}</p>
                            `;
              listaRestaurantes.appendChild(divRestaurante);
            });
          } else {
            listaRestaurantes.innerHTML = '<p>No se encontraron restaurantes.</p>';
          }
        })
        .catch(error => {
          console.error('Error al obtener los restaurantes:', error);
        });
    });
  </script>
</body>

</html>
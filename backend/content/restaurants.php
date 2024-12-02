<?php
include("../data/db.php");

// Consultar los restaurantes
$restaurantesData = []; // Inicializar la variable
try {
    $sql_restaurantes = "SELECT * FROM RESTAURANTES";
    $stmt_restaurantes = $pdo->prepare($sql_restaurantes);
    $stmt_restaurantes->execute();

    if ($stmt_restaurantes->rowCount() > 0) {
        while ($row = $stmt_restaurantes->fetch()) {
            $restaurantesData[] = $row;
        }
    }
} catch (PDOException $e) {
    $errorMessage = "Error al obtener los restaurantes: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva tu Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        section {
            padding: 10px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <header class="bg-blue-600 text-white py-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-extrabold">Reserva en tu Restaurante Favorito</h1>
            <p class="mt-2 text-xl">Explora nuestros restaurantes y haz tu reserva fácilmente.</p>
        </div>
    </header>

    <main class="container mx-auto my-8 px-4">

        <!-- Mostrar Restaurantes -->
        <section>
            <h2 class="text-3xl font-semibold text-center mb-6">Nuestros Restaurantes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($restaurantesData)): ?>
                    <?php foreach ($restaurantesData as $restaurante): ?>
                        <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300">
                            <img src="https://via.placeholder.com/400x200?text=Imagen+Restaurante" alt="Imagen de <?= $restaurante['nombre']; ?>" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h3 class="font-semibold text-xl text-blue-800"><?= $restaurante['nombre']; ?></h3>
                                <p class="text-gray-700"><?= $restaurante['direccion']; ?></p>
                                <p class="text-gray-500"><?= $restaurante['o_h']; ?></p>
                                <a href="#" class="text-blue-600 mt-4 block text-center py-2 px-4 rounded-lg border-2 border-blue-600 hover:bg-blue-600 hover:text-white transition duration-300">Ver más</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center text-red-500">No se encontraron restaurantes disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Modal de Información del Restaurante -->
        <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-6 rounded-lg w-11/12 sm:w-1/2 md:w-1/3">
                <button id="close-modal" class="text-gray-500 absolute top-2 right-2 text-xl">&times;</button>
                <h3 id="modal-title" class="text-2xl font-semibold mb-4">Detalles del Restaurante</h3>
                <p id="modal-description" class="text-gray-700 mb-2"></p>
                <p id="modal-address" class="text-gray-700 mb-2"></p>
                <p id="modal-hours" class="text-gray-700 mb-4"></p>
                <p id="modal-phone" class="text-gray-700 mb-2"></p>
                <a id="modal-website" href="#" target="_blank" class="text-blue-600">Visitar sitio web</a>
            </div>
        </div>


    </main>

    <footer class="bg-blue-600 text-white py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sistema de Reservas. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        // Función para abrir el modal con información del restaurante
        function showRestaurantDetails(restaurante) {
            // Llenamos el modal con la información del restaurante
            document.getElementById('modal-title').innerText = restaurante.nombre;
            document.getElementById('modal-description').innerText = restaurante.descripcion || 'Descripción no disponible';
            document.getElementById('modal-address').innerText = "Dirección: " + restaurante.direccion;
            document.getElementById('modal-hours').innerText = "Horario: " + restaurante.o_h;
            document.getElementById('modal-phone').innerText = "Teléfono: " + restaurante.telefono || 'No disponible';
            document.getElementById('modal-website').setAttribute('href', restaurante.sitio_web || '#');

            // Mostrar el modal
            document.getElementById('modal').classList.remove('hidden');
        }

        // Función para cerrar el modal
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('modal').classList.add('hidden');
        });

        // Evitar que el modal se cierre si se hace clic dentro de él
        document.getElementById('modal').addEventListener('click', function(event) {
            if (event.target === document.getElementById('modal')) {
                document.getElementById('modal').classList.add('hidden');
            }
        });
    </script>

    <script>
        // Datos de clientes para depuración
        <?php
        try {
            $sql_clientes = "SELECT * FROM CLIENTES";
            $stmt_clientes = $pdo->prepare($sql_clientes);
            $stmt_clientes->execute();

            if ($stmt_clientes->rowCount() > 0) {
                $clientesData = [];
                while ($row = $stmt_clientes->fetch()) {
                    $clientesData[] = $row;
                }
                echo "const clientes = " . json_encode($clientesData) . ";";
            } else {
                echo "const clientes = [];";
            }
        } catch (PDOException $e) {
            echo "const clientes = [];";
            echo "console.error('Error al obtener los clientes: " . json_encode($e->getMessage()) . "');";
        }
        ?>

        // Mostrar en consola
        console.log("Clientes:", clientes);

        // Mostrar en el HTML (opcional para visualizar)
        const clientesDiv = document.getElementById('clientes-data');
        if (clientes.length > 0) {
            clientes.forEach(cliente => {
                clientesDiv.innerHTML += `<p>${cliente.nombre} - ${cliente.correo}</p>`;
            });
        } else {
            clientesDiv.innerHTML = "<p>No hay clientes registrados.</p>";
        }
    </script>

</body>

</html>
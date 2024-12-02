<?php
include ("../data/db.php");

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
</head>
<body class="bg-gray-100">

    <header class="bg-blue-600 text-white py-4">
        <div class="container mx-auto text-center">
            <h1 class="text-3xl font-bold">Reserva en tu Restaurante Favorito</h1>
            <p class="mt-2">Explora nuestros restaurantes y haz tu reserva fácilmente.</p>
        </div>
    </header>

    <main class="container mx-auto my-8">

        <!-- Mostrar Restaurantes -->
        <section>
            <h2 class="text-2xl font-semibold text-center mb-6">Nuestros Restaurantes</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (!empty($restaurantesData)): ?>
                    <?php foreach ($restaurantesData as $restaurante): ?>
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <h3 class="font-semibold text-xl"><?= $restaurante['nombre']; ?></h3>
                            <p class="text-gray-700"><?= $restaurante['direccion']; ?></p>
                            <p class="text-gray-500"><?= $restaurante['o_h']; ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No se encontraron restaurantes disponibles.</p>
                <?php endif; ?>
            </div>
        </section>

        

    </main>

    <footer class="bg-blue-600 text-white py-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Sistema de Reservas. Todos los derechos reservados.</p>
        </div>
    </footer>

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

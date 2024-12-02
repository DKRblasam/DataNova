<?php
// Incluir el archivo de conexión a la base de datos
include("../data/db.php");

// Inicializar un array vacío para almacenar los platillos
$platillosData = [];

try {
    // Preparar la consulta SQL para seleccionar todos los platos
    $sql_platillos = "SELECT * FROM PLATOS";
    $stmt_platillos = $pdo->prepare($sql_platillos);  // Preparar la consulta
    $stmt_platillos->execute();  // Ejecutar la consulta

    // Verificar si se han encontrado platos
    if ($stmt_platillos->rowCount() > 0) {
        // Recorrer los resultados de la consulta y almacenarlos en el array $platillosData
        while ($row = $stmt_platillos->fetch()) {
            $platillosData[] = $row;  // Agregar cada plato al array
        }
    }
} catch (PDOException $e) {
    // Manejar errores si ocurre una excepción en la consulta
    $errorMessage = "Error al obtener los platillos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platos Disponibles</title>
    <!-- Enlace a archivo de estilo externo -->
    <link rel="stylesheet" href="../../frontend/src/CSS/style.css">
    <!-- Enlace a TailwindCSS para estilos adicionales -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        section {
            padding: 10px;  /* Estilo para los elementos de la sección */
        }
    </style>
</head>

<body class="bg-gray-100"> <!-- Fondo gris claro para la página -->

    <header class="head"> <!-- Sección del encabezado -->
        <div class="title">
            <div class="img-icon">
                <!-- Aquí puedes colocar un logo o imagen representativa -->
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                    <g fill="#666a83">
                        <path d="M179 473.3 c-20.2 -1.9 ..." />
                    </g>
                </svg>
            </div>
        </div>
    </header>

    <section>
        <h2>Platos Disponibles</h2>

        <?php if (!empty($platillosData)): ?>
            <!-- Si hay platos en el array, se muestra una lista -->
            <ul>
                <?php foreach ($platillosData as $platillo): ?>
                    <li>
                        <!-- Mostrar cada plato con sus respectivos detalles -->
                        <h3><?php echo htmlspecialchars($platillo['nombre']); ?></h3>
                        <p>Precio: $<?php echo number_format($platillo['precio'], 2); ?></p>
                        <p>Categoría: <?php echo htmlspecialchars($platillo['categoria']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <!-- Si no se encuentran platos, mostrar un mensaje de error -->
            <p>No se encontraron platos disponibles.</p>
        <?php endif; ?>
    </section>

    <footer>
        <!-- Pie de página para la página -->
        <p>© 2024 Todos los derechos reservados</p>
    </footer>

</body>

</html>

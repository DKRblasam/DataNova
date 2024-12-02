<?php
// Incluir el archivo de conexión a la base de datos
include("../data/db.php");

// Inicializar un array vacío para almacenar los datos de los restaurantes
$restaurantesData = [];

try {
    // Preparar la consulta SQL para seleccionar todos los restaurantes
    $sql_restaurantes = "SELECT * FROM RESTAURANTES";
    $stmt_restaurantes = $pdo->prepare($sql_restaurantes);  // Preparar la consulta
    $stmt_restaurantes->execute();  // Ejecutar la consulta

    // Verificar si se han encontrado restaurantes
    if ($stmt_restaurantes->rowCount() > 0) {
        // Recorrer los resultados de la consulta y almacenarlos en el array $restaurantesData
        while ($row = $stmt_restaurantes->fetch()) {
            $restaurantesData[] = $row;  // Agregar cada restaurante al array
        }
    }
} catch (PDOException $e) {
    // Manejar errores si ocurre una excepción en la consulta
    $errorMessage = "Error al obtener los restaurantes: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva tu Restaurante</title>
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
                <!-- SVG que representa un icono visual (este es un ejemplo, no funcional como tal) -->
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                    <g fill="#666a83">
                        <path d="M179 473.3 c-20.2 -1.9 ..." />
                    </g>
                </svg>
            </div>
        </div>
    </header>

    <section>
        <!-- Aquí puedes colocar el contenido principal de la página, como el listado de restaurantes -->
        <h2>Restaurantes Disponibles</h2>

        <?php if (!empty($restaurantesData)): ?>
            <!-- Si hay restaurantes en el array, se muestra una lista -->
            <ul>
                <?php foreach ($restaurantesData as $restaurante): ?>
                    <li>
                        <!-- Mostrar cada restaurante con sus respectivos detalles -->
                        <h3><?php echo htmlspecialchars($restaurante['nombre']); ?></h3>
                        <p><?php echo htmlspecialchars($restaurante['descripcion']); ?></p>
                        <p>Dirección: <?php echo htmlspecialchars($restaurante['direccion']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <!-- Si no se encuentran restaurantes, mostrar un mensaje de error -->
            <p>No se encontraron restaurantes disponibles.</p>
        <?php endif; ?>
    </section>

    <footer>
        <!-- Pie de página para la página -->
        <p>© 2024 Reserva tu Restaurante</p>
    </footer>

</body>

</html>

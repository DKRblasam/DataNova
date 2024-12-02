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
            padding: 10px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            background-color: #fff;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .card-price {
            font-size: 1.1rem;
            color: #28a745;
            margin-bottom: 5px;
        }

        .card-category {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>

<body class="bg-gray-100">

    <header class="head">
        <div class="title">
            <div class="img-icon">
                <!-- Logo o ícono aquí si lo deseas -->
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                    <g fill="#666a83">
                        <path d="M179 473.3 c-20.2 -1.9 ..." />
                    </g>
                </svg>
            </div>
        </div>
    </header>

    <section class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <h2 class="text-2xl font-semibold text-center mb-6">Platos Disponibles</h2>

        <?php if (!empty($platillosData)): ?>
            <!-- Si hay platos, se muestra cada uno en una tarjeta -->
            <?php foreach ($platillosData as $platillo): ?>
                <div class="card">
                    <div class="card-title"><?php echo htmlspecialchars($platillo['nombre']); ?></div>
                    <div class="card-price">$<?php echo number_format($platillo['precio'], 2); ?></div>
                    <div class="card-category"><?php echo htmlspecialchars($platillo['categoria']); ?></div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron platos disponibles.</p>
        <?php endif; ?>
    </section>

    <footer class="bg-gray-800 text-white py-4 text-center">
        <p>© 2024 Todos los derechos reservados</p>
    </footer>

</body>

</html>

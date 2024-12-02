<?php
// Incluir la conexión a la base de datos
require_once ('../data/db.php');

// Consultar restaurantes
$query = "SELECT nombre, direccion, o_h FROM RESTAURANTES";
$stmt = $pdo->prepare($query);
$stmt->execute();
$restaurants = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #ff5722;
            color: #fff;
            padding: 1rem;
            text-align: center;
            z-index: 1000;
        }

        main {
            margin-top: 80px;
            padding: 1rem;
        }

        .restaurant-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .restaurant-name {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .restaurant-info {
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>
<body>
    <header>
        <h1>Lista de Restaurantes</h1>
    </header>
    <main>
        <?php
        // Mostrar los restaurantes
        if (!empty($restaurants)) {
            foreach ($restaurants as $restaurant) {
                echo '<div class="restaurant-card">';
                echo '<div class="restaurant-name">' . htmlspecialchars($restaurant["nombre"]) . '</div>';
                echo '<div class="restaurant-info"><strong>Dirección:</strong> ' . htmlspecialchars($restaurant["direccion"]) . '</div>';
                echo '<div class="restaurant-info"><strong>Horario:</strong> ' . htmlspecialchars($restaurant["o_h"]) . '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No se encontraron restaurantes.</p>';
        }
        ?>
    </main>
</body>
</html>

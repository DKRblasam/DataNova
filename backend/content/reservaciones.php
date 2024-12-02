<?php
session_start();
include("../data/db.php");

// Habilitar la visualización de errores para depurar
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
  header("Location: login_register.php");
  exit();
}

// Obtener las reservas del usuario
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT r.id_reserva, r.fecha, r.numero_personas, res.nombre AS restaurante_nombre 
                        FROM RESERVAS r 
                        JOIN CLIENTES c ON r.id_cliente = c.id_cliente 
                        JOIN RESTAURANTES res ON r.id_restaurante = res.id_restaurante 
                        WHERE c.id_cliente = ?");
$stmt->execute([$user_id]);
$reservas = $stmt->fetchAll();

// Si el formulario de reserva ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $restaurante_id = $_POST['restaurante'];
    $fecha = $_POST['fecha'];
    $numero_personas = $_POST['numero_personas'];

    // Insertar nueva reserva en la base de datos
    $stmt = $pdo->prepare("INSERT INTO RESERVAS (id_cliente, id_restaurante, fecha, numero_personas) 
                           VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $restaurante_id, $fecha, $numero_personas]);
    echo "Reserva realizada exitosamente!";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Reservas</title>
  <link rel="stylesheet" href="../../frontend/src/CSS/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
  <header class="head">
    <div class="title">
      <div class="img-icon">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
          <g fill="#666a83">
            <!-- SVG path aquí -->
          </g>
        </svg>
      </div>
      <h1 class="text-[#333]">Mis Reservas</h1>
    </div>
  </header>

  <main class="container mx-auto p-4">
    <h2 class="text-xl mb-4">Mis Reservas:</h2>
    <table class="table-auto w-full mb-4">
      <thead>
        <tr>
          <th class="border px-4 py-2">Fecha</th>
          <th class="border px-4 py-2">Número de personas</th>
          <th class="border px-4 py-2">Restaurante</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reservas as $reserva): ?>
        <tr>
          <td class="border px-4 py-2"><?= htmlspecialchars($reserva['fecha']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($reserva['numero_personas']) ?></td>
          <td class="border px-4 py-2"><?= htmlspecialchars($reserva['restaurante_nombre']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <!-- Formulario para hacer nuevas reservas -->
    <h2 class="text-xl mb-4">Realizar una nueva reserva:</h2>
    <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow-md">
      <label for="restaurante" class="block mb-2">Restaurante:</label>
      <select name="restaurante" id="restaurante" class="mb-4 p-2 border border-gray-300 rounded w-full">
        <?php
        // Obtener los restaurantes disponibles
        $stmt = $pdo->query("SELECT id_restaurante, nombre FROM RESTAURANTES");
        $restaurantes = $stmt->fetchAll();
        foreach ($restaurantes as $restaurante) {
          echo "<option value='{$restaurante['id_restaurante']}'>{$restaurante['nombre']}</option>";
        }
        ?>
      </select>

      <label for="fecha" class="block mb-2">Fecha de reserva:</label>
      <input type="date" name="fecha" id="fecha" class="mb-4 p-2 border border-gray-300 rounded w-full" required>

      <label for="numero_personas" class="block mb-2">Número de personas:</label>
      <input type="number" name="numero_personas" id="numero_personas" class="mb-4 p-2 border border-gray-300 rounded w-full" required min="1">

      <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg w-full">Realizar Reserva</button>
    </form>
  </main>

</body>

</html>

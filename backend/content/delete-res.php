<?php
session_start();
include("data/db.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit();
}

// Obtener la reserva a eliminar
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT r.id_reserva, res.nombre AS restaurante_nombre, r.fecha, r.numero_personas 
                        FROM RESERVAS r 
                        JOIN RESTAURANTES res ON r.id_restaurante = res.id_restaurante 
                        WHERE r.id_reserva = ?");
$stmt->execute([$id]);
$reserva = $stmt->fetch();

if (!$reserva) {
    echo "Reserva no encontrada.";
    exit();
}

// Manejar la eliminación de la reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("DELETE FROM RESERVAS WHERE id_reserva = ?");
    $stmt->execute([$id]);

    header("Location: reservations.php"); // Redirigir a la página de reservas
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Reserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">Eliminar Reserva</h1>
        <div class="bg-red-500 text-white p-4 rounded">
            <p>¿Estás seguro de que deseas eliminar la reserva para el restaurante <strong><?php echo htmlspecialchars($reserva['restaurante_nombre']); ?></strong>?</p>
            <p>Fecha: <strong><?php echo htmlspecialchars($reserva['fecha']); ?></strong></p>
            <p>Número de Personas: <strong><?php echo htmlspecialchars($reserva['numero_personas']); ?></strong></p>
        </div>
        <form action="delete_reservation.php?id=<?php echo $id; ?>" method="POST" class="mt-4">
            <button type="submit" class="bg-red-600 text-white p-2 rounded">Eliminar Reserva</button>
            <a href="reservations.php" class="bg-gray-500 text-white p-2 rounded ml-4">Cancelar</a>
        </form>
    </div>
</body>
</html>
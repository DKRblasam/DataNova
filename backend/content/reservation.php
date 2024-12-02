<?php
session_start();
include("data/db.php");

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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">Mis Reservas</h1>

        <table class="min-w-full bg-gray-800 rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4">Restaurante</th>
                    <th class="py-2 px-4">Fecha</th>
                    <th class="py-2 px-4">Número de Personas</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($reserva['restaurante_nombre']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($reserva['fecha']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($reserva['numero_personas']); ?></td>
                        <td class="py-2 px-4">
                            <a href="edit_reservation.php?id=<?php echo $reserva['id_reserva']; ?>" class="text-blue-400 hover:underline">Editar</a>
                            <a href="delete_reservation.php?id=<?php echo $reserva['id_reserva']; ?>" class="text-red-400 hover:underline ml-4">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
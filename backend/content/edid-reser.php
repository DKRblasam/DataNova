<?php
session_start();
include("data/db.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit();
}

// Manejar la edición de la reserva
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $numero_personas = $_POST['numero_personas'];

    $stmt = $pdo->prepare("UPDATE RESERVAS SET fecha = ?, numero_personas = ? WHERE id_reserva = ?");
    $stmt->execute([$fecha, $numero_personas, $id]);

    header("Location: reservations.php"); // Redirigir a la página de reservas
    exit();
}

// Obtener la reserva a editar
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM RESERVAS WHERE id_reserva = ?");
$stmt->execute([$id]);
$reserva = $stmt->fetch();

if (!$reserva) {
    echo "Reserva no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css ```html
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">Editar Reserva</h1>
        <form action="edit_reservation.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($reserva['id_reserva']); ?>">
            <div class="mb-4">
                <label for="fecha" class="block text-gray-200">Fecha:</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($reserva['fecha']); ?>" class="mt-1 block w-full p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label for="numero_personas" class="block text-gray-200">Número de Personas:</label>
                <input type="number" name="numero_personas" id="numero_personas" value="<?php echo htmlspecialchars($reserva['numero_personas']); ?>" class="mt-1 block w-full p-2 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Actualizar Reserva</button>
        </form>
    </div>
</body>
</html>
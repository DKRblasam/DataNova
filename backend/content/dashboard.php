<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}

// Incluir el archivo de conexión a la base de datos
include("data/db.php");

// Obtener la información del usuario
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        body {
            background-color: #22223b;
            color: aliceblue;
        }
    </style>
</head>

<body>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">Bienvenido, <?php echo htmlspecialchars($user['username']); ?>!</h1>

        <div class="bg-gray-800 p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-2">Opciones</h2>
            <ul>
                <li class="mb-2">
                    <a href="reservations.php" class="text-blue-400 hover:underline">Ver Reservas</a>
                </li>
                <li class="mb-2">
                    <a href="restaurants.php" class="text-blue-400 hover:underline">Ver Restaurantes</a>
                </li>
                <li class="mb-2">
                    <a href="profile.php" class="text-blue-400 hover:underline">Mi Perfil</a>
                </li>
            </ul>
        </div>

        <div class="text-center mt-6">
            <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cerrar Sesión</a>
        </div>
    </div>
</body>

</html>
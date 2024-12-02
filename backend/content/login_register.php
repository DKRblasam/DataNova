<?php
// Incluir el archivo de conexión a la base de datos
include("../data/db.php");

// Inicializar variables para mensajes de error
$errorMessage = "";
$successMessage = "";

// Manejar el registro de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña

    // Insertar el nuevo usuario en la base de datos
    try {
        $stmt = $pdo->prepare("INSERT INTO Usuarios (nombre, email, contraseña, rol) VALUES (?, ?, ?, 'cliente')");
        $stmt->execute([$username, $username . '@email.com', $password]); // Usamos el username como email
        $successMessage = "Registro exitoso. Puedes iniciar sesión ahora.";
    } catch (PDOException $e) {
        $errorMessage = "Error al registrar: " . $e->getMessage();
    }
}

// Manejar el inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar las credenciales del usuario
    try {
        $stmt = $pdo->prepare("SELECT * FROM Usuarios WHERE nombre = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['contraseña'])) {
            // Inicio de sesión exitoso
            session_start();
            $_SESSION['user_id'] = $user['id_usuario'];
            header("Location: dashboard.php"); // Redirigir a la página de inicio
            exit();
        } else {
            $errorMessage = "Credenciales incorrectas. Intenta nuevamente.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error al iniciar sesión: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <style>
        body {
            background-color: #22223b;
            color: aliceblue;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #2b2d42;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-2xl font-bold text-center mb-4">Iniciar Sesión</h2>
        <?php if ($errorMessage): ?>
            <div class="bg-red-500 text-white p-2 rounded mb-4"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <?php if ($successMessage): ?>
            <div class="bg-green-500 text-white p-2 rounded mb-4"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="username">Nombre de Usuario:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="password">Contraseña:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" required>
            </div>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">Iniciar Sesión</button>
        </form>

        <h2 class="text-2xl font-bold text-center mb-4 mt-6">Registrar</h2>
        <form method="POST">
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="username">Nombre de Usuario:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold mb-2" for="password">Contraseña:</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" required>
            </div>
            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="register">Registrar</button>
        </form>
    </div>
</body>

</html>

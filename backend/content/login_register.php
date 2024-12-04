<?php

session_start(); // Iniciar la sesión

// Habilitar la visualización de errores para depurar
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}

// Incluir el archivo de conexión a la base de datos
include("../data/db.php");

// Inicializar variables para mensajes de error
$errorMessage = "";
$successMessage = "";

// Manejar el registro de usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $lasname = $_POST['lastname'];
    $password = $_POST['password']; // Hash de la contraseña

    // Insertar el nuevo usuario en la base de datos
    try {
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, contraseña, tipo) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $username . '@email.com', $password, 'cliente']); // Usamos el username como email
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
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre = ?");
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
    <link rel="stylesheet" href="../../frontend/src/CSS/style.css">
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

        .button {
            margin-top: 15px;
            width: 120px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 12px;
            cursor: pointer;
            border: 3px solid rgb(255, 239, 94);
            background-color: rgb(255, 239, 94);
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.137);
        }

        .text {
            width: 70%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgb(27, 27, 27);
            color: white;
        }

        .text:hover {
            color: #22223b;
        }
    </style>
</head>

<body>
    <header class="head">
        <div class="title">
            <div class="img-icon">
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" preserveAspectRatio="xMidYMid meet">
                    <g fill="#666a83">
                        <path
                            d="M179 473.3 c-20.2 -1.9 -27.5 -2.8 -40 -5.3 -23.6 -4.7 -42.3 -11.9 -52.2 -20 -7.6 -6.3 -10.8 -18.1 -7.3 -26.8 0.9 -2 9.3 -15.3 18.7 -29.5 l17.1 -25.8 -2.2 -2.7 c-12.2 -15.2 -20 -29.1 -25.1 -44.8 l-2.8 -8.9 -12.8 -0.3 c-12.4 -0.3 -13 -0.4 -15.6 -2.9 -3.3 -3.2 -3.4 -3.5 -5.3 -29 -2.1 -27.9 -2 -32.4 0.6 -35.7 2 -2.6 2.2 -2.6 15.4 -2.6 l13.3 0 1.7 -9.7 c5.7 -31.8 20.8 -58.8 43.6 -77.9 41.6 -34.9 100.7 -41.1 149 -15.8 3.9 2.1 7.2 3.2 8.2 2.8 1.2 -0.4 1.7 -0.1 1.7 1.2 0 1.1 2.2 3.3 5.2 5.4 6.7 4.6 19.6 16.7 24.4 23 2.1 2.8 4.1 5 4.4 5 0.4 0 2.4 -2.5 4.5 -5.6 4.8 -7 14.9 -16.1 23 -20.9 l6.2 -3.6 0.2 -6.1 c0.2 -8 2.5 -16.7 6.7 -25.2 8.5 -16.9 21.7 -28.4 40.9 -35.7 l8.1 -3.1 -0.1 -7.6 c0 -6 0.5 -8.6 2.2 -11.8 5.6 -10.4 13.4 -15.4 24.2 -15.4 15.7 0 27 11.4 27.1 27.1 0 13.8 -10 24.9 -23.9 26.6 -9.6 1.1 -20.7 -4.5 -26.1 -13.2 l-2.1 -3.4 -7.2 2.5 c-11.9 4.3 -19.6 9.1 -28.2 17.8 -9.3 9.3 -14.5 18.2 -17.5 30.2 -1.9 7.5 -2.6 15.4 -1.4 15.4 0.4 0 3.8 -1.2 7.8 -2.6 17.9 -6.4 33.9 -3 43.2 9.3 3.9 5.1 5.6 12.3 4.4 17.8 -3.3 14.6 -21.8 22.2 -36.5 15.1 -9.6 -4.8 -17.9 -16.3 -20.7 -28.8 -0.6 -2.9 -1.3 -5.5 -1.4 -5.7 -0.5 -0.6 -7.7 4.1 -14.5 9.5 -5.7 4.6 -15.2 15.4 -16.6 19.1 -0.3 0.6 1.4 4.3 3.7 8.2 7.7 12.9 13.1 29.2 16.1 48.4 l1.2 7.7 13.3 0 c7.3 0 14 0.3 14.9 0.6 3.3 1.3 6.3 11.6 3.6 12.6 -1.5 0.5 -4.4 41.8 -3.1 43.4 1.5 1.8 -0.4 8.5 -3.1 11 -1.8 1.6 -4.2 2 -15.1 2.4 l-13 0.5 -2.5 8.5 c-4.7 16.5 -12.7 31.6 -22.9 43.6 -2.4 2.8 -4.4 5.4 -4.4 5.7 0 0.4 7.6 12.1 16.9 26 9.3 14 17.4 27.1 18.1 29.2 1.2 3.6 0.9 11.5 -0.6 16.3 -0.7 2.4 -0.6 2.4 2.3 0.9 1.6 -0.9 4.7 -3.4 6.9 -5.6 3.9 -3.9 4.1 -3.9 8.3 -3 5.5 1.2 9.2 3.1 13.6 7 3.3 2.9 6.5 3.4 6.5 0.9 0 -3 -13.6 -12 -18.2 -12 -0.9 0 -1.9 -0.3 -2.2 -0.8 -0.2 -0.4 2.1 -5.3 5.2 -10.8 3.2 -5.6 7.7 -14.3 10.2 -19.4 l4.5 -9.2 8.2 0.5 c6.4 0.4 9.7 1.2 14.9 3.6 3.6 1.7 7 2.8 7.5 2.5 4.6 -2.8 -8.2 -9.3 -20.1 -10.1 -4.4 -0.3 -8 -0.8 -8 -1.1 0 -0.3 2 -4.8 4.4 -10.1 2.4 -5.3 5.4 -12.4 6.6 -15.8 2 -5.7 2.6 -6.4 5.9 -7.3 5 -1.4 8.9 -1.2 13.6 0.6 7.1 2.7 8.7 2.9 8.3 0.8 -0.7 -3.7 -6.6 -5.9 -15.8 -5.9 l-8.5 0 -0.1 -8 c-0.1 -6.1 -0.7 -9.5 -2.6 -14.3 -2.5 -6.1 -2.6 -6.5 -1.2 -12.8 1.6 -7.7 4 -12.2 10.3 -18.6 3.5 -3.7 4.2 -5.1 3.3 -6 -1.9 -1.9 -5.6 0.5 -10.2 6.5 -3.8 5.2 -8 14.6 -8 18.3 0 1.2 -2.3 -0.5 -6.7 -4.8 -3.8 -3.5 -7.7 -6.9 -8.8 -7.5 -1.4 -0.8 -1.6 -1.4 -0.9 -2.5 0.6 -0.7 1.7 -9.8 2.3 -20.3 0.7 -10.4 1.4 -19.1 1.5 -19.3 0.2 -0.1 5.7 2.5 12.3 5.9 20.3 10.3 29.1 18.2 36.1 32.4 5.4 10.8 6.7 17.4 6.6 34 -0.1 13.5 -0.4 16.2 -3.2 26.7 -4.3 16.2 -9 28.4 -18.3 47.6 -18.4 38.4 -31.9 54.5 -53.4 64.3 -9.8 4.4 -20.9 7 -30.7 7 -9.9 0 -14.9 -1.1 -22.9 -5.2 l-5.7 -2.8 -8.9 1.9 c-11.3 2.4 -27.7 4.7 -42.8 6 -10.9 0.9 -59 1.2 -67.5 0.3z m75 -3.3 c15.6 -1.7 38.3 -5.5 40.1 -6.6 0.4 -0.2 -2.3 -3.5 -6 -7.2 -11.6 -12 -26.9 -41.7 -27.9 -54 -0.4 -5.1 -0.8 -6.2 -2.1 -5.8 -25.1 7.4 -51.8 8.4 -77.6 3.1 -20.9 -4.4 -43.6 -15 -57.9 -27.2 -2.2 -1.8 -4.5 -3.3 -5.1 -3.3 -1.1 0 -26.2 36.7 -26.7 39.1 -0.6 2.4 33.2 15.2 55.1 21 6.4 1.7 19 4.3 28 5.8 10.6 1.7 16.6 3.2 16.9 4 0.5 1.4 0.6 1.4 -17.8 -1.6 -21.1 -3.4 -51.1 -12.2 -71.9 -21 -5.8 -2.5 -11.1 -4.7 -11.7 -4.9 -1.6 -0.7 -8.1 10 -8.9 14.7 -1 5.8 1.8 14.2 6.3 18.7 12.5 12.4 48.9 22.8 92.2 26.2 14.3 1.1 62.2 0.5 75 -1z m65.9 -8.7 c2.3 -3.1 5 -8.3 5.9 -11.5 1.2 -4.2 2.1 -5.7 3.1 -5.3 0.8 0.3 3.3 0.3 5.6 -0.1 3.6 -0.5 4.6 -1.2 6.3 -4.3 2.8 -5 3.6 -10.8 2.2 -15.9 -0.6 -2.5 -8.1 -14.8 -18.1 -29.8 l-17 -25.5 -3.7 3.1 c-2 1.7 -7.4 5.6 -11.9 8.6 -4.6 3 -8.3 5.7 -8.3 5.9 0 0.1 1.7 3.2 3.9 6.6 2.1 3.5 5.4 9.8 7.3 14 l3.6 7.7 -4.7 4.5 c-3.9 4 -10.5 7.7 -17.4 10.1 -3 1 -1.3 3.1 2.4 3 4.8 -0.2 12.3 -4 17.3 -8.8 l4.3 -4.2 3.1 5.7 c3.6 6.6 10.2 13.5 15.5 16.3 3.2 1.8 3.5 2.3 3 5 -0.8 4.3 -3.8 9.9 -7.4 14.1 -3.1 3.5 -3.3 6.5 -0.6 6.5 0.8 0 3.3 -2.6 5.6 -5.7z m-85.2 -62.4 c17.3 -2.3 38.5 -9.3 51.5 -17 36.8 -21.7 54.9 -59.3 55 -113.9 0.1 -47.6 -10.4 -79.9 -34.5 -105.6 -6.5 -7 -21.3 -18.7 -22.9 -18.2 -1.9 0.7 -18.8 43.7 -18.8 47.9 0 0.5 2.5 2.1 5.7 3.4 9.3 4.2 21.7 13 29 20.9 13 14 18.3 28.1 18.3 49 0 15.1 -1.8 23.6 -7.1 34.3 -14.6 29.5 -52.8 48.3 -97.9 48.3 -15.8 0 -25.5 -1.1 -38.6 -4.6 -19.2 -4.9 -35.6 -13.9 -47.1 -25.6 -9.9 -10 -15.5 -19.7 -18.9 -32.8 -2.4 -9 -2.4 -30.2 0 -38.9 1.7 -6.3 6.6 -16.8 10.5 -22.5 4.1 -6 13.9 -15.1 22.1 -20.4 4.7 -3.1 8.6 -5.6 8.8 -5.7 0.1 -0.1 -1 -3.5 -2.5 -7.6 -1.4 -4.1 -5 -14.8 -7.8 -23.8 -2.8 -9.1 -5.5 -16.6 -6 -16.8 -1.6 -0.5 -15 11.7 -21.7 19.8 -15.3 18.6 -25.5 44.2 -28.8 73.1 -1.8 14.9 -0.8 41.1 2 55.2 9.6 48.6 34.9 79.5 77.1 94.4 7.8 2.8 23.7 6.6 31.4 7.5 6.8 0.9 33.9 0.6 41.2 -0.4z m-93.6 -105.9 c2.2 -15.1 17.9 -39.5 36.9 -57.2 5 -4.7 9 -9 9 -9.6 0 -6.2 -20.1 11.8 -32.3 29 -9.5 13.3 -15.9 26.3 -17.7 35.6 -0.9 5.3 -0.4 7.4 1.9 7 1 -0.2 1.8 -1.8 2.2 -4.8z m216 -7 c2.2 -30.2 2.3 -29 0 -29 -1.2 0 -2.1 0.1 -2.2 0.3 -0.4 1.2 -2.5 36.4 -2.2 37 0.3 0.4 1.2 0.7 2.1 0.5 1.4 -0.3 1.8 -2 2.3 -8.8z m-180.6 2.8 c1.4 -4.5 9.6 -17.7 15.5 -24.7 5.9 -7 7.3 -10.1 4.6 -10.1 -4.5 0 -24.6 28.7 -24.6 35.1 0 2.7 3.7 2.5 4.5 -0.3z m-108.4 -8.3 c-0.6 -16.3 -1.5 -22 -3.1 -22 -1.3 0 -1.5 2.2 -1.2 14.5 0.1 8 0.5 15.1 0.7 15.8 0.3 0.8 1.3 1.2 2.2 1 1.6 -0.3 1.8 -1.4 1.4 -9.3z m97.7 -89 c29 -10.1 62.2 -10.4 94.7 -1 1.8 0.5 2.5 -0.8 6.4 -12.2 2.4 -7 6.6 -17.9 9.2 -24.2 2.7 -6.2 4.9 -11.7 4.9 -12 0 -0.4 -3.5 -2.6 -7.7 -4.8 -31.3 -16.5 -70.4 -19.2 -105.4 -7.2 -7.3 2.5 -17.7 7.5 -26.2 12.6 -6.7 4 -6.8 1.3 1.1 25.8 8 25.2 9.1 27.8 11.1 27.1 0.9 -0.3 6.2 -2.2 11.9 -4.1z m229 -11.9 c8.8 -3.1 14.2 -10.1 14.2 -18.2 0 -9.3 -8.7 -19.6 -18.8 -22.5 -6.8 -1.9 -20.4 -0.7 -28.5 2.6 l-6.8 2.8 0.6 4.1 c1.7 10 7.4 20.7 13.9 26 7.6 6.3 16.9 8.2 25.4 5.2z m27.2 -114.5 c0 -2.2 4.3 -7.6 7.3 -9.3 1.1 -0.6 4.3 -1.3 7.1 -1.7 4.3 -0.5 5.2 -1 5.4 -2.8 0.3 -1.9 -0.1 -2.3 -2.5 -2.3 -11.2 0 -23.5 9.7 -20.9 16.5 0.8 2.2 3.6 1.8 3.6 -0.4z" />
                        <path
                            d="M257 372 c0 -0.5 1.9 -1.4 4.3 -2 18 -4.6 31.7 -12.6 44.8 -26.3 3.2 -3.4 5.9 -5.5 6.3 -4.9 0.9 1.5 -12.6 14.9 -19.9 19.9 -8.3 5.6 -14.6 8.6 -24.3 11.7 -9 2.8 -11.2 3.1 -11.2 1.6z" />
                        <path
                            d="M106.3 327.8 c-5.6 -8.3 -9.7 -17.8 -8.4 -19.1 0.7 -0.7 1.3 -0.2 1.9 1.4 2.6 6.8 4.4 10.2 7.9 15.6 2.1 3.2 4.2 6.4 4.6 7.1 0.5 0.7 0.3 1.2 -0.5 1.2 -0.7 0 -3.2 -2.8 -5.5 -6.2z" />
                        <path
                            d="M231 169.8 c-11.1 -2.9 -33.1 -3.6 -45.5 -1.3 -9.5 1.7 -12.4 1.6 -8.8 -0.3 6.4 -3.5 30.1 -5 43.8 -2.8 11.5 1.7 20.5 4.2 20.5 5.6 0 1.3 -1 1.2 -10 -1.2z" />
                        <path
                            d="M183.2 145.8 c0.3 -0.7 3.1 -2.6 6.3 -4.3 5.4 -2.7 6.7 -3 15.9 -3 8 0 11.5 0.5 16.8 2.3 6.2 2.2 8.7 3.7 7.6 4.7 -0.2 0.3 -2.8 -0.4 -5.6 -1.5 -12.2 -4.7 -26 -4.5 -35.5 0.5 -5.6 2.9 -6 3 -5.5 1.3z" />
                        <path
                            d="M437.4 140.6 c-2.6 -1.9 -1 -3.2 2.2 -1.8 2.9 1.4 6.2 0.8 11.8 -2 2.3 -1.2 4.2 -1.6 4.8 -1 1.2 1.2 -10 6.2 -13.9 6.2 -1.6 0 -3.8 -0.6 -4.9 -1.4z" />
                        <path
                            d="M422.1 119.4 c-6.1 -1.6 -13.2 -5.3 -17.5 -9 -2.7 -2.4 -2.9 -4.9 -0.2 -2.9 10.5 7.8 17.8 10.5 28.4 10.5 9.2 0 15.9 -1.8 22.4 -5.9 2.6 -1.7 5 -2.6 5.2 -2.2 1.3 2 -8.1 7.3 -17.1 9.6 -7.1 1.8 -14.1 1.8 -21.2 -0.1z" />
                        <path
                            d="M123.1 111.6 c-7.3 -9.1 -16.1 -17 -22.8 -20.3 -5 -2.4 -7 -2.8 -14.5 -2.8 -7.2 0 -9.1 0.3 -11.5 2.1 -7.4 5.5 -9.6 14.6 -4.9 20.1 2 2.3 3.4 2.9 8.2 3.3 5.5 0.5 5.8 0.6 3.5 1.9 -5.2 2.9 -14.1 -1.8 -16.2 -8.8 -2.5 -8.5 3.5 -17.7 13.7 -20.7 11.4 -3.3 23.8 1 35.6 12.4 6.4 6.1 15.8 17.2 15.8 18.6 0 1.9 -2.4 -0.2 -6.9 -5.8z" />
                        <path
                            d="M132.8 101.8 c-5.9 -8.4 -6.1 -8.8 -4.6 -8.8 1.7 0 11.1 13.7 9.9 14.4 -0.5 0.4 -2.9 -2.2 -5.3 -5.6z" />
                        <path
                            d="M152.9 99.9 c-2.5 -4.7 -4.9 -13.5 -4.9 -17.8 0 -5.5 3.3 -12.6 7.1 -15.4 3.7 -2.7 11.2 -3.4 14.3 -1.3 3 1.9 4.9 7.6 4.4 13.4 -0.4 5.9 -2.2 5.7 -2.6 -0.3 -0.4 -9.3 -2.2 -12.5 -6.8 -12.5 -4 0 -10.2 3.8 -12.1 7.3 -2.6 4.8 -2.2 13.8 1.1 21.6 3 7.4 2.9 7.1 1.6 7.1 -0.5 0 -1.4 -0.9 -2.1 -2.1z" />
                    </g>
                </svg>
            </div>
            <h2 class="tile-pag">
                MesaEstelar
            </h2>
        </div>
        <nav class="nav">
            <ul class="menuItems">
                <li><a href='../../frontend/pages/' data-item='Inicio'>Inicio</a></li>
                <li><a href='./reservaciones.php' data-item='Reservaciones'>Reservaciones</a></li>
                <li><a href='./restaurants.php' data-item='Restaurantes'>Restaurantes</a></li>
                <li><a href='./platillos.php' data-item='Platillos'>Platillos</a></li>
                <li><a href='../../backend/content/login_register.php' data-item='Ingresar'>Ingresar</a></li>
                <li><a href='../../backend/content/dashboard.php' data-item='Perfil'>Perfil</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="login">
            <h2 class="text-2xl font-bold text-center mb-4">Iniciar Sesión</h2>
            <?php if ($errorMessage): ?>
                <div class="bg-red-500 text-white p-2 rounded mb-4"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <?php if ($successMessage): ?>
                <div class="bg-green-500 text-white p-2 rounded mb-4"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="username">Ingrese su nombre:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="password">Contraseña:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" required>
                </div>
                <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="login">Iniciar Sesión</button>
            </form>
            <p style="margin-top: 10px; font-size: 20px;">
                ¿No tienes cuanta?
            </p>
            <button class="button" id="reg">
                <span class="text">Registrase</span>
            </button>
        </div>
        <div class="registrer" style="display: none;">
            <h2 class="text-2xl font-bold text-center mb-4 mt-6">Registrar</h2>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="username">Nombre (s):</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" required>
                    <label class="block text-sm font-bold mb-2" for="lastname">Apellido (s):</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" name="lastname" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-2" for="password">Contraseña:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" required>
                </div>
                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit" name="register">Registrar</button>

            </form>
        </div>
    </div>

    <script>
        // Función para cambiar entre formularios
        document.getElementById('reg').addEventListener('click', function() {
            document.querySelector('.login').style.display = 'none';
            document.querySelector('.registrer').style.display = 'block';
        });

        // Agregar un botón para volver al formulario de inicio de sesión
        const backButton = document.createElement('button');
        backButton.innerText = 'Volver a Iniciar Sesión';
        backButton.className = 'bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4';
        backButton.addEventListener('click', function() {
            document.querySelector('.registrer').style.display = 'none';
            document.querySelector('.login').style.display = 'block';
        });
        document.querySelector('.registrer').appendChild(backButton);
    </script>

</body>

</html>
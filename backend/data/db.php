<?php
// backend/databases/db.php

$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'RestaurantManagementDB';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'El.Pass_w0rd';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Manejo de errores en caso de que la conexión falle
    error_log("Database connection failed: " . $e->getMessage());
    // No es necesario mostrar el error en la salida JSON
    echo json_encode(['error' => 'Error en la conexión a la base de datos.']);
    exit;
}
?>
<?php
// backend/databases/db.php

$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'RestaurantManagementDB';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'El.Pass_w0rd';
$charset = 'utf8mb4';

// Mostrar el host en la consola
echo "<script> console.log('HOST: " . json_encode($host) . "'); </script>";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "<script> console.log('Conexión a la base de datos exitosa'); </script>";
} catch (\PDOException $e) {
    error_log("Database connection failed: " . $e->getMessage());
    echo "<script> console.error('Error en la conexión: " . json_encode($e->getMessage()) . "'); </script>";
    // No es necesario volver a lanzar la excepción si ya se ha manejado el error.
    // throw new \PDOException("Database connection failed.", 500);
}
?>
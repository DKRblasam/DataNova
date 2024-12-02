<?php
// backend/databases/db.php

$host = getenv('DB_HOST') ?: 'localhost';
$db   = getenv('DB_NAME') ?: 'RestaurantManagementDB';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'El.Pass_w0rd';
$charset = 'utf8mb4';

echo "<script> console.log('HOST: $host'); </script>";

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
    echo "<script> console.error('Error en la conexión: {$e->getMessage()}'); </script>";
    throw new \PDOException("Database connection failed.", 500);
}

try {
    $sql = "SELECT * FROM clientes";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    while ($row = $stmt->fetch()) {
        echo "<script> console.log('ID: {$row['id_cliente']} - Name: {$row['nombre']} - Address: {$row['correo']} - Phone: {$row['telefono']}'); </script>";
    }
} catch (PDOException $e) {
    echo "<script> console.error('Error al ejecutar la consulta: {$e->getMessage()}'); </script>";
}

$pdo = null;
?>

<?php
// backend/databases/db.php

$host = getenv('DB_HOST') ?: '127.0.0.1';
$db   = getenv('DB_NAME') ?: 'RestaurantManagementDB';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'El.Pass_w0rd';
$charset = 'utf8mb4';

echo "<script> console.log ('HOST: ',$host) </script>";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Log the error to a file or a centralized logging system
    error_log("Database connection failed: " . $e->getMessage());
    throw new \PDOException("Database connection failed.", 500);
}

try {
    $sql = "SELECT * FROM clientes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while ($row = $stmt->fetch()) {
        echo " <script> console.log ('
        ID: {$row['id_cliente']} - Name: {$row['nombre']} - adrres: {$row['correo']} cel: {$row['telefono']} <br>'); </script>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../data/db.php");
header('Content-Type: application/json');

$id_restaurante = filter_input(INPUT_GET, 'id_restaurante', FILTER_VALIDATE_INT);

if (!$id_restaurante) {
    echo json_encode(['error' => 'ID de restaurante no especificado o no válido']);
    exit;
}

try {
    // preparar consulta
    $stmt = $pdo->prepare("SELECT platos.nombre, platos.precio, platos.categoria 
    FROM restaurantes_platos 
    JOIN platos ON platos.id_plato = restaurantes_platos.id_plato
    WHERE restaurantes_platos.id_restaurante = ?");
    
    $stmt->execute([$id_restaurante]);
    $platillos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($platillos) {
        echo json_encode($platillos);
    } else {
        echo json_encode(['error' => 'No se encontraron platillos para este restaurante.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
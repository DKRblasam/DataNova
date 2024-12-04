<?php
header("Content-Type: application/json");
require '../databases/db.php';

// Verifica que el parámetro 'action' exista
$action = $_GET['action'] ?? null;

if (!$action) {
    echo json_encode(['error' => 'Acción no especificada']);
    exit;
}

try {
    switch ($action) {
        case 'getRestaurants':
            $stmt = $pdo->query("SELECT id, nombre AS name, direccion AS location FROM restaurantes");
            $restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($restaurants);
            break;

        case 'createReservation':
            $data = json_decode(file_get_contents('php://input'), true);
            if (!$data) {
                echo json_encode(['error' => 'Datos inválidos']);
                exit;
            }

            $stmt = $pdo->prepare("INSERT INTO  reservas  (restaurant_id, customer_name, reservation_time) VALUES (?, ?, ?)");
            $stmt->execute([$data['restaurant_id'], $data['customer_name'], $data['reservation_time']]);
            echo json_encode(['message' => 'Reserva creada con éxito']);
            break;

        default:
            echo json_encode(['error' => 'Acción no válida']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Error del servidor: ' . $e->getMessage()]);
}
?>

<?php
include 'db_connection.php';

$sql = "SELECT * FROM RESTAURANTES";
$result = $conn->query($sql);

$restaurantes = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $restaurantes[] = $row;
    }
}

echo json_encode(['restaurantes' => $restaurantes]);
$conn->close();
?>

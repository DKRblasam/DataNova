<?php
// Incluir el archivo de conexión a la base de datos
include("../data/db.php"); // Asegúrate de que la ruta sea correcta

// Configurar las cabeceras para indicar que la respuesta es en formato JSON
header('Content-Type: application/json');

// Consultar los restaurantes
try {
    $sql_restaurantes = "SELECT id, nombre, direccion, o_h FROM RESTAURANTES";  // Consulta para obtener los datos
    $stmt_restaurantes = $pdo->prepare($sql_restaurantes);
    $stmt_restaurantes->execute();

    $restaurantesData = [];  // Array para almacenar los datos de los restaurantes

    // Verificar si hay resultados
    if ($stmt_restaurantes->rowCount() > 0) {
        // Si existen restaurantes, los agregamos al array
        while ($row = $stmt_restaurantes->fetch()) {
            // Aquí se envían los datos como un array
            $restaurantesData[] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'direccion' => $row['direccion'],
                'o_h' => $row['o_h']
            ];
        }
    } else {
        // Si no hay restaurantes, podemos devolver un array vacío
        $restaurantesData = [];
    }

    // Codificar el array de restaurantes a formato JSON y enviarlo
    echo json_encode($restaurantesData);  // Devuelve los datos como JSON

} catch (PDOException $e) {
    // En caso de error en la consulta, se muestra un mensaje de error
    echo json_encode([["error" => "Error al obtener los restaurantes: " . $e->getMessage()]]);
}
?>

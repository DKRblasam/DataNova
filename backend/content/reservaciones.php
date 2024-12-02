<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserva de Restaurante</title>
</head>

<body>
  <h1>Reservar en un Restaurante</h1>
  <select id="restaurantSelect"></select>
  <input type="text" id="customerName" placeholder="Tu nombre">
  <input type="datetime-local" id="reservationTime">
  <button onclick="createReservation()">Reservar</button>
  <div id="message"></div>

  <script>
    // Cargar restaurantes
    fetch('backend/api.php?action=getRestaurants')
      .then(response => response.json())
      .then(data => {
        const select = document.getElementById('restaurantSelect');
        data.forEach(restaurant => {
          const option = document.createElement('option');
          option.value = restaurant.id;
          option.textContent = `${restaurant.name} - ${restaurant.location}`;
          select.appendChild(option);
        });
      });

    // Crear reserva
    function createReservation() {
      const restaurantId = document.getElementById('restaurantSelect').value;
      const customerName = document.getElementById('customerName').value;
      const reservationTime = document.getElementById('reservationTime').value;

      fetch('backend/api/api.php?action=getRestaurants')
        .then(response => {
          if (!response.ok) throw new Error('Error al cargar restaurantes');
          return response.json();
        })
        .then(data => {
          const select = document.getElementById('restaurantSelect');
          data.forEach(restaurant => {
            const option = document.createElement('option');
            option.value = restaurant.id;
            option.textContent = `${restaurant.name} - ${restaurant.location}`;
            select.appendChild(option);
          });
        })
        .catch(error => console.error(error.message));


      fetch('backend/api/api.php?action=createReservation', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            restaurant_id: restaurantId,
            customer_name: customerName,
            reservation_time: reservationTime
          })
        })
        .then(response => response.json())
        .then(data => {
          document.getElementById('message').textContent = data.message;
        });
    }
  </script>
</body>

</html> -->

<?php
session_start();
include("data/db.php");

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    header("Location: login_register.php");
    exit();
}

// Obtener las reservas del usuario
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT r.id_reserva, r.fecha, r.numero_personas, res.nombre AS restaurante_nombre 
                        FROM RESERVAS r 
                        JOIN CLIENTES c ON r.id_cliente = c.id_cliente 
                        JOIN RESTAURANTES res ON r.id_restaurante = res.id_restaurante 
                        WHERE c.id_cliente = ?");
$stmt->execute([$user_id]);
$reservas = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold text-center mb-4">Mis Reservas</h1>

        <table class="min-w-full bg-gray-800 rounded">
            <thead>
                <tr>
                    <th class="py-2 px-4">Restaurante</th>
                    <th class="py-2 px-4">Fecha</th>
                    <th class="py-2 px-4">Número de Personas</th>
                    <th class="py-2 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($reserva['restaurante_nombre']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($reserva['fecha']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($reserva['numero_personas']); ?></td>
                        <td class="py-2 px-4">
                            <a href="edit_reservation.php?id=<?php echo $reserva['id_reserva']; ?>" class="text-blue-400 hover:underline">Editar</a>
                            <a href="delete_reservation.php?id=<?php echo $reserva['id_reserva']; ?>" class="text-red-400 hover:underline ml-4">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
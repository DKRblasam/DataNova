<!DOCTYPE html>
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

</html>
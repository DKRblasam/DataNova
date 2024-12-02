document.addEventListener("DOMContentLoaded", () => {
  const restaurantesContainer = document.getElementById("lista-restaurantes");
  const selectRestaurante = document.getElementById("restaurante");

  // Cargar restaurantes
  fetch("api/get_restaurantes.php")
      .then(res => res.json())
      .then(data => {
          data.restaurantes.forEach(restaurante => {
              // Mostrar restaurantes
              const div = document.createElement("div");
              div.className = "p-4 bg-white shadow rounded";
              div.innerHTML = `<h3 class="font-bold">${restaurante.nombre}</h3><p>${restaurante.direccion}</p><p>${restaurante.o_h}</p>`;
              restaurantesContainer.appendChild(div);

              // Llenar select
              const option = document.createElement("option");
              option.value = restaurante.id_restaurante;
              option.textContent = restaurante.nombre;
              selectRestaurante.appendChild(option);
          });
      });

  // Manejar el formulario de reservas
  document.getElementById("form-reserva").addEventListener("submit", e => {
      e.preventDefault();
      const data = new FormData(e.target);
      fetch("api/reservar.php", {
          method: "POST",
          body: data
      })
          .then(res => res.json())
          .then(result => {
              if (result.success) {
                  alert("Reserva realizada con éxito");
              } else {
                  alert("Error: " + result.error);
              }
          });
  });
});

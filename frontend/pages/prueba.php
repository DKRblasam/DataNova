<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    body {
      height: 500vh;
    }

    /* Estilo para el header en la parte derecha */
    .header-right {
      background-color: #333;
      color: white;
      padding: 20px;
      text-align: center;
      position: fixed;
      /* Fijar el header */
      top: 20px;
      /* Colocarlo un poco hacia abajo */
      right: 0;
      /* Colocarlo en la parte derecha */
      z-index: 1000;
      /* Para que esté por encima de otros elementos */
      width: 200px;
      /* Ancho fijo */
    }

    /* Para el contenido de la página */
    body {
      margin-right: 220px;
      /* Para evitar que el contenido quede oculto debajo del header */
    }
  </style>
</head>

<body>
  <header class="header-right">
    <div class="logo">
      <h1>Mi Logo</h1>
    </div>
  </header>


</body>

</html>
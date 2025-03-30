<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php
    include 'barra.php';
    ?>
    <div class="contenido1">
      <div class="contenedor_cuadros">
        <div class="tot_usuarios verde">
          <h2>Total usuarios</h2>
          <?php
          require "conexion.php";
          $datos = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
          $resultado = mysqli_query($conectar, $datos);
          if ($resultado) {
            $fila = mysqli_fetch_assoc($resultado);
            $total_usuarios = $fila['total_usuarios'];
            echo "<h1>".$total_usuarios." <i class='fas fa-users'></i></h1>";
          } else {
            echo "<p class='no-datos'>No hay datos disponibles.</p>";
            exit;
          }
          ?>
        </div>
      </div>
      <img src="imagenes/libreria.jpg" alt="imagen presentacion">
    </div>
  </div>
</body>

</html>
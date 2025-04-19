<?php
require 'seguridad.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver carrera</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php include 'barra.php'; ?>
    <div class="contenido2">
      <h2 class="centrar mb16"><i class='fas fa-eye'></i> Ver carrera</h2>
      <div class="form">
        <?php
        require "conexion.php";

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
          $id_carrera = mysqli_real_escape_string($conectar, $_GET['id']);

          $ver_carrera = "SELECT * FROM carreras WHERE id_carrera = '$id_carrera'";
          $resultado = mysqli_query($conectar, $ver_carrera);

          if ($fila = $resultado->fetch_assoc()) {
        ?>
            <div class="info_usuario">
              <p><strong>Nombre de la carrera:</strong></p>
              <p><?php echo htmlspecialchars($fila["nombre_carrera"]); ?></p>
            </div>
        <?php
          } else {
            echo "<p>No se encontró la carrera.</p>";
          }
        } else {
          echo "<p>ID de carrera no válido.</p>";
        }
        ?>
      </div>
      <div class="contenedor_boton_form">
        <a href="lista_carreras.php" class="boton_circular">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
</body>

</html>
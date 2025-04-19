<?php
require 'seguridad.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver usuario</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php include 'barra.php'; ?>
    <div class="contenido2">
      <h2 class="centrar mb16"><i class='fas fa-eye'></i> Ver usuario</h2>
      <div class="form">
        <?php
        require "conexion.php";

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
          $id_usuario = mysqli_real_escape_string($conectar, $_GET['id']);

          $ver_usuario = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
          $resultado = mysqli_query($conectar, $ver_usuario);

          if ($fila = $resultado->fetch_assoc()) {
        ?>
            <div class="info_usuario">
              <p><strong>Nombre del usuario:</strong></p>
              <p><?php echo htmlspecialchars($fila["nombre_usuario"] . " " . $fila["apellido_usuario"]); ?></p>
              <hr>
              <p><strong>Correo:</strong></p>
              <p><?php echo htmlspecialchars($fila["correo_usuario"]); ?></p>
              <hr>
              <p><strong>Contraseña:</strong></p>
              <p><?php echo htmlspecialchars($fila["contra_usuario"]); ?></p>
              <hr>
              <p><strong>Fecha de Nacimiento:</strong></p>
              <p><?php echo htmlspecialchars($fila["nacimiento_usuario"]); ?></p>
            </div>

        <?php
          } else {
            echo "<p>No se encontró el usuario.</p>";
          }
        } else {
          echo "<p>ID de usuario no válido.</p>";
        }
        ?>
      </div>
      <div class="contenedor_boton_form">
        <a href="lista_usuarios.php" class="boton_circular">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
</body>

</html>
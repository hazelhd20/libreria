<?php
require 'seguridad.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver libro</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">
    <?php include 'barra.php'; ?>
    <div class="contenido2">
      <h2 class="centrar mb16"><i class='fas fa-eye'></i> Ver libro</h2>
      <div class="form">
        <?php
        require "conexion.php";

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
          $id_libro = mysqli_real_escape_string($conectar, $_GET['id']);

          $ver_libro = "SELECT * FROM libros INNER JOIN autores ON libros.autor_libro = autores.id_autor INNER JOIN carreras ON libros.carrera_libro = carreras.id_carrera WHERE id_libro = '$id_libro'";
          $resultado = mysqli_query($conectar, $ver_libro);

          if ($fila = $resultado->fetch_assoc()) {
        ?>
            <div class="info_usuario">
              <p><strong>Nombre del libro:</strong></p>
              <p><?php echo htmlspecialchars($fila["titulo_libro"]); ?></p>
              <hr>
              <p><strong>Autor del libro:</strong></p>
              <p><?php echo htmlspecialchars($fila["nombre_autor"]); ?></p>
              <hr>
              <p><strong>Año del libro:</strong></p>
              <p><?php echo htmlspecialchars($fila["fecha_libro"]); ?></p>
              <hr>
              <p><strong>Editorial del libro:</strong></p>
              <p><?php echo htmlspecialchars($fila["editorial_libro"]); ?></p>
              <hr>
              <p><strong>Carrera del libro:</strong></p>
              <p><?php echo htmlspecialchars($fila["nombre_carrera"]); ?></p>
            </div>
        <?php
          } else {
            echo "<p>No se encontró el libro.</p>";
          }
        } else {
          echo "<p>ID de libro no válido.</p>";
        }
        ?>
      </div>
      <div class="contenedor_boton_form">
        <a href="lista_libros.php" class="boton_circular">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
</body>

</html>
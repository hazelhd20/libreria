<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar carrera</title>
  <link rel="icon" href="imagenes/logo.ico" type="image/x-icon"/>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">

    <?php
    include 'barra.php';
    ?>

    <div class="contenido2">
      <h2 class="centrar mb16"><i class='fas fa-edit'></i> Editar carrera</h2>

      <?php
      require "conexion.php";
      $id_carrera = $_GET['id'];
      $ver_carrera = "SELECT * FROM carreras WHERE id_carrera = '$id_carrera'";
      $resultado = mysqli_query($conectar, $ver_carrera);
      $fila = $resultado->fetch_assoc();
      ?>

      <form action="actualizar_carrera.php" method="post" id="formEditarCarrera" class="form">
        <input type="hidden" name="id_carrera" value="<?php echo $fila['id_carrera']; ?>">
        <div class="fila">
          <div class="columna">
            <label for="nombre_carrera">Nombre:</label>
            <input type="text" id="nombre_carrera" name="nombre_carrera" value="<?php echo htmlspecialchars($fila['nombre_carrera']); ?>">
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="button">Actualizar carrera</button>
      </form>
      <div class="contenedor_boton_form">
        <a href="lista_carreras.php" class="boton_circular">
          <i class="fas fa-arrow-left"></i>
        </a>
      </div>
    </div>
  </div>
</body>

</html>

<script>
  document.getElementById("btn_validar").addEventListener("click", function(event) {
    // Evitar el envío del formulario por defecto
    event.preventDefault();

    // Obtener los valores de los campos de entrada y selección
    const nombre_carrera = document.getElementById("nombre_carrera");

    // Función para verificar si un campo está vacío
    function verificarCampo(campo, mensaje) {
      if (campo.value.trim() === "") {
        alert(mensaje);
        campo.focus();
        return true; // Indica que hay un error
      }
      return false; // No hay error
    }

    // Verificar todos los campos
    if (verificarCampo(nombre_carrera, "Por favor, introduzca el nombre del autor.")) return;

    // Si todos los campos están correctos, se envía el formulario
    document.getElementById("formEditarCarrera").submit();
  });
</script>
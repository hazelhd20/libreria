<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carreras</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">

    <?php
    include 'barra.php';
    ?>

    <div class="contenido2">
      <h2 class="centrar">Agregar carreras</h2>
      <?php include 'botones_carrera.php' ?>
      <form action="agregar_carrera.php" method="post" id="formNuevaCarrera" class="form pd">
        <div class="fila">
          <div class="columna">
            <label for="nombre_carrera">Nombre:</label>
            <input type="text" id="nombre_carrera" name="nombre_carrera" placeholder="Introduzca el nombre de la carrera">
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="button">Guardar carrera</button>
      </form>
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
    if (verificarCampo(nombre_carrera, "Por favor, introduzca el nombre de la carrera.")) return;

    // Si todos los campos están correctos, se envía el formulario
    document.getElementById("formNuevaCarrera").submit();
  });
</script>
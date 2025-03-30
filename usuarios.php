<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">

    <?php
    include 'barra.php';
    ?>

    <div class="contenido2">
      <h2 class="centrar">Agregar usuarios</h2>
      <?php include 'botones_usuario.php' ?>
      <form action="agregar_usuario.php" method="post" id="frmRegis" class="form pd">
        <div class="fila">
          <div class="columna">
            <input type="hidden" name="formulario" value="interno">
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" placeholder="Introduzca el nombre del usuario">
          </div>
          <div class="columna">
            <label for="apellido_usuario">Apellido:</label>
            <input type="text" id="apellido_usuario" name="apellido_usuario" placeholder="Introduzca el apellido del usuario">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="correo_usuario">Correo:</label>
            <input type="text" id="correo_usuario" name="correo_usuario" placeholder="Introduzca el correo del usuario">
          </div>
          <div class="columna">
            <label for="contra_usuario">Contraseña:</label>
            <input type="password" id="contra_usuario" name="contra_usuario" placeholder="Debe tener al menos 6 caracteres">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="nacimiento_usuario">Fecha de nacimiento</label>
            <input type="date" id="nacimiento_usuario" name="nacimiento_usuario">
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="button">Guardar usuario</button>
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
    const nombre_usuario = document.getElementById("nombre_usuario");
    const apellido_usuario = document.getElementById("apellido_usuario");
    const correo_usuario = document.getElementById("correo_usuario");
    const contra_usuario = document.getElementById("contra_usuario");
    const nacimiento_usuario = document.getElementById("nacimiento_usuario");

    // Expresión regular para validar el formato del correo
    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

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
    if (verificarCampo(nombre_usuario, "Por favor, introduzca su nombre.")) return;
    if (verificarCampo(apellido_usuario, "Por favor, introduzca su apellido.")) return;
    if (verificarCampo(correo_usuario, "Por favor, introduzca un correo.")) return;
    if (!correoRegex.test(correo_usuario.value.trim())) {
      alert("Por favor, introduzca un correo válido.");
      correo_usuario.focus();
      return;
    }
    if (verificarCampo(contra_usuario, "Por favor, introduzca una contraseña.")) return;
    if (verificarCampo(nacimiento_usuario, "Por favor, seleccione su fecha de nacimiento.")) return;

    // Si todos los campos están correctos, se envía el formulario
    document.getElementById("frmRegis").submit();
  });
</script>
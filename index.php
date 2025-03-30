<?php
require 'sesion_activa.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div class="contenedor_logo">
    <img src="imagenes/logo.png" alt="">
  </div>
  <form action="autenticar.php" method="post" class="cont_form" id="frmSes">
    <h3>Accede al sistema</h3>
    <?php
    if (isset($_GET["errorusuario"])) {
      $error = $_GET["errorusuario"];
      if ($error == "SI") {
        echo "<p id='errorMensaje' class='error'>Correo o contraseña incorrectos</p>";
      } elseif ($error == "VACIO") {
        echo "<p id='errorMensaje' class='error'>Por favor, llena todos los campos</p>";
      } elseif ($error == "NOPOST") {
        echo "<p id='errorMensaje' class='error'>Acceso no autorizado</p>";
      }
    }
    ?>
    <div class="fila">
      <input type="text" id="correo_usuario" name="correo_usuario" required placeholder="Correo">
    </div>
    <div class="fila">
      <input type="password" id="contra_usuario" name="contra_usuario" required placeholder="Contraseña">
    </div>
    <button class="boton azul" id="btn_validar" type="button">Iniciar sesión</button>
  </form>
</body>

</html>

<script>
  document.getElementById('correo_usuario').addEventListener('input', function() {
    let errorMensaje = document.getElementById('errorMensaje');
    if (errorMensaje) {
      errorMensaje.style.display = 'none';
    }
  });

  document.getElementById('contra_usuario').addEventListener('input', function() {
    let errorMensaje = document.getElementById('errorMensaje');
    if (errorMensaje) {
      errorMensaje.style.display = 'none';
    }
  });

  document.getElementById("btn_validar").addEventListener("click", function(event) {
    // Evitar el envío del formulario por defecto
    event.preventDefault();

    // Obtener los valores de los campos de entrada y selección
    const correo_usuario = document.getElementById("correo_usuario");
    const contra_usuario = document.getElementById("contra_usuario");

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
    if (verificarCampo(correo_usuario, "Por favor, introduzca su correo.")) return;
    if (verificarCampo(contra_usuario, "Por favor, introduzca su contraseña.")) return;

    // Si todos los campos están llenos, se envía el formulario
    document.getElementById("frmSes").submit();
  });
</script>
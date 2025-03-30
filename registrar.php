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
    <img src="imagenes/merida.png" alt="">
  </div>
  <form action="agregar_usuario.php" method="post" class="cont_form" id="frmRegis">
    <h3>Registrate</h3>
    <div class="fila">
      <input type="hidden" name="formulario" value="externo">
      <input type="text" id="nombre" name="nombre" placeholder="Nombre">
    </div>
    <div class="fila">
      <input type="text" id="apellido" name="apellido" placeholder="Apellido">
    </div>
    <div class="fila">
      <input type="text" id="correo" name="correo" placeholder="Correo electrónico">
    </div>
    <div class="fila">
      <input type="password" id="contra" name="contra" placeholder="Contraseña">
    </div>
    <div class="fila">
      <label for="nacimiento">Fecha de nacimiento</label>
      <input type="date" id="nacimiento" name="nacimiento">
    </div>
    <button class="boton azul" id="btn_validar" type="button">Registrar</button>
    <p class="terminos">Al hacer click en "registrar", aceptas nuestras <a href="#">Condiciones</a>, la <a href="#">Politica de datos</a> y la <a href="#">Politica de cookies</a>. Es posible que te enviemos notificaciones por SMS, que puedes desactivar cunado quieras</p>
  </form>
</body>

</html>

<script>
  document.getElementById("btn_validar").addEventListener("click", function(event) {
    // Evitar el envío del formulario por defecto
    event.preventDefault();

    // Obtener los valores de los campos de entrada y selección
    const nombre = document.getElementById("nombre");
    const apellido = document.getElementById("apellido");
    const correo = document.getElementById("correo");
    const contra = document.getElementById("contra");
    const nacimiento = document.getElementById("nacimiento");

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
    if (verificarCampo(nombre, "Por favor, introduzca su nombre.")) return;
    if (verificarCampo(apellido, "Por favor, introduzca su apellido.")) return;
    if (verificarCampo(correo, "Por favor, introduzca un correo.")) return;
    if (!correoRegex.test(correo.value.trim())) {
      alert("Por favor, introduzca un correo válido.");
      correo.focus();
      return;
    }
    if (verificarCampo(contra, "Por favor, introduzca una contraseña.")) return;
    if (verificarCampo(nacimiento, "Por favor, seleccione su fecha de nacimiento.")) return;

    // Si todos los campos están correctos, se envía el formulario
    document.getElementById("frmRegis").submit();
  });
</script>

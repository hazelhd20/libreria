<?php
require 'seguridad.php';
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="styles.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body>
  <div class="contenedor">

    <?php include 'barra.php'; ?>

    <div class="contenido2">
      <h2 class="centrar mb16"><i class='fas fa-edit'></i> Editar usuario</h2>

      <?php
      require "conexion.php";
      $id_usuario = $_GET['id'];
      $verusuario = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
      $resultado = mysqli_query($conectar, $verusuario);
      $fila = $resultado->fetch_array();
      ?>

      <form action="actualizar_usuario.php" method="post" id="frmEditar" class="form">
        <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
        <div class="fila">
          <div class="columna">
            <label for="nombre_usuario">Nombre:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" value="<?php echo htmlspecialchars($fila['nombre_usuario']); ?>">
          </div>
          <div class="columna">
            <label for="apellido_usuario">Apellido:</label>
            <input type="text" id="apellido_usuario" name="apellido_usuario" value="<?php echo htmlspecialchars($fila['apellido_usuario']); ?>">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="correo_usuario">Correo:</label>
            <input type="email" id="correo_usuario" name="correo_usuario" value="<?php echo htmlspecialchars($fila['correo_usuario']); ?>" disabled>
          </div>
          <div class="columna">
            <label for="contra_usuario">Nueva Contraseña (opcional):</label>
            <input type="password" id="contra_usuario" name="contra_usuario" maxlength="10">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="nacimiento_usuario">Fecha de nacimiento:</label>
            <input type="date" id="nacimiento_usuario" name="nacimiento_usuario" value="<?php echo htmlspecialchars($fila['nacimiento_usuario']); ?>">
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="submit">Actualizar usuario</button>
      </form>
      <a href="lista_usuarios.php" class="boton_circular">
        <i class="fas fa-arrow-left"></i>
      </a>
    </div>
  </div>
</body>

</html>

<script>
  document.getElementById("btn_validar").addEventListener("click", function(event) {
    event.preventDefault();

    const nombre_usuario = document.getElementById("nombre_usuario");
    const apellido_usuario = document.getElementById("apellido_usuario");
    const correo_usuario = document.getElementById("correo_usuario");
    const contra_usuario = document.getElementById("contra_usuario");
    const nacimiento_usuario = document.getElementById("nacimiento_usuario");

    const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    function verificarCampo(campo, mensaje) {
      if (campo.value.trim() === "") {
        alert(mensaje);
        campo.focus();
        return true;
      }
      return false;
    }

    if (verificarCampo(nombre_usuario, "Por favor, introduzca su nombre.")) return;
    if (verificarCampo(apellido_usuario, "Por favor, introduzca su apellido.")) return;
    if (!correoRegex.test(correo_usuario.value.trim())) {
      alert("Por favor, introduzca un correo válido.");
      correo_usuario.focus();
      return;
    }
    if (verificarCampo(nacimiento_usuario, "Por favor, seleccione su fecha de nacimiento.")) return;

    document.getElementById("frmEditar").submit();
  });
</script>
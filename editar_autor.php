<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar autor</title>
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
      <h2 class="centrar mb16"><i class='fas fa-edit'></i> Editar autor</h2>

      <?php
      require "conexion.php";
      $id_autor = $_GET['id'];
      $ver_autor = "SELECT * FROM autores WHERE id_autor = '$id_autor'";
      $resultado = mysqli_query($conectar, $ver_autor);
      $fila = $resultado->fetch_assoc();
      ?>

      <form action="actualizar_autor.php" method="post" id="formEditarAutor" class="form">
        <input type="hidden" name="id_autor" value="<?php echo $fila['id_autor']; ?>">
        <div class="fila">
          <div class="columna">
            <label for="nombre_autor">Nombre:</label>
            <input type="text" id="nombre_autor" name="nombre_autor" value="<?php echo htmlspecialchars($fila['nombre_autor']); ?>">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="nacionalidad_autor">Nacionalidad:</label>
            <input type="text" id="nacionalidad_autor" name="nacionalidad_autor" value="<?php echo htmlspecialchars($fila['nacionalidad_autor']); ?>">
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="button">Actualizar autor</button>
      </form>
      <div class="contenedor_boton_form">
        <a href="lista_autores.php" class="boton_circular">
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
    const nombre_autor = document.getElementById("nombre_autor");
    const nacionalidad_autor = document.getElementById("nacionalidad_autor");

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
    if (verificarCampo(nombre_autor, "Por favor, introduzca el nombre del autor.")) return;
    if (verificarCampo(nacionalidad_autor, "Por favor, introduzca la nacionalidad del autor.")) return;

    // Si todos los campos están correctos, se envía el formulario
    document.getElementById("formEditarAutor").submit();
  });
</script>
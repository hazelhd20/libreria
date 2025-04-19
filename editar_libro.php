<?php
require 'seguridad.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Usuarios</title>
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
      <h2 class="centrar">Editar libros</h2>

      <?php
      require "conexion.php";
      $id_libro = $_GET['id'];
      $ver_libro = "SELECT * FROM libros WHERE id_libro = '$id_libro'";
      $resultado = mysqli_query($conectar, $ver_libro);
      $fila = $resultado->fetch_assoc();
      ?>

      <?php include 'botones_libro.php' ?>
      <form action="actualizar_libro.php" method="post" id="formEditarLibro" class="form">
        <input type="hidden" name="id_libro" value="<?php echo $fila['id_libro']; ?>">
        <div class="fila">
          <div class="columna">
            <label for="titulo_libro">Nombre del libro:</label>
            <input type="text" id="titulo_libro" name="titulo_libro" value="<?php echo htmlspecialchars($fila['titulo_libro']); ?>">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="autor_libro">Autor del libro:</label>
            <select name="autor_libro" id="autor_libro">
              <option value="default" disabled selected>Seleccione un autor</option>
              <?php
              $variable_autor = $fila['autor_libro']; // Variable que almacena el autor actual del libro
              $ver_autor = "SELECT * FROM autores";
              $resultado_autor = mysqli_query($conectar, $ver_autor);
              while ($fila_autor = $resultado_autor->fetch_array()) {
              ?>
                <option value="<?php echo $fila_autor["id_autor"]; ?>"
                  <?php
                  if ($fila_autor["id_autor"] == $variable_autor) {
                    echo "selected";
                  }
                  ?>>
                  <?php echo $fila_autor["nombre_autor"]; ?>
                </option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="columna">
            <label for="fecha_libro">Año del libro:</label>
            <input type="text" id="fecha_libro" name="fecha_libro" value="<?php echo htmlspecialchars($fila['fecha_libro']); ?>">
          </div>
        </div>
        <div class="fila">
          <div class="columna">
            <label for="editorial_libro">Editorial:</label>
            <input type="text" id="editorial_libro" name="editorial_libro" value="<?php echo htmlspecialchars($fila['editorial_libro']); ?>">
          </div>
          <div class="columna">
            <label for="carrera_libro">Carrera del libro:</label>
            <select name="carrera_libro" id="carrera_libro">
              <option value="default" disabled selected>Seleccione una carrera</option>
              <?php
              $variable_carrera = $fila['carrera_libro']; // Variable que almacena la carrera actual del libro
              $ver_carrera = "SELECT * FROM carreras";
              $resultado_carrera = mysqli_query($conectar, $ver_carrera);
              while ($fila_carrera = $resultado_carrera->fetch_array()) {
              ?>
                <option value="<?php echo $fila_carrera["id_carrera"]; ?>"
                  <?php
                  if ($fila_carrera["id_carrera"] == $variable_carrera) {
                    echo "selected";
                  }
                  ?>>
                  <?php echo $fila_carrera["nombre_carrera"]; ?>
                </option>
              <?php
              }
              ?>
            </select>
          </div>
        </div>
        <button class="boton gris" id="btn_validar" type="button">Actualizar libro</button>
      </form>
      <div class="contenedor_boton_form">
        <a href="lista_libros.php" class="boton_circular">
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
    const titulo_libro = document.getElementById("titulo_libro");
    const autor_libro = document.getElementById("autor_libro");
    const fecha_libro = document.getElementById("fecha_libro");
    const editorial_libro = document.getElementById("editorial_libro");
    const carrera_libro = document.getElementById("carrera_libro");

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
    if (verificarCampo(titulo_libro, "Por favor, introduzca el nombre del libro.")) return;
    if (verificarCampo(autor_libro, "Por favor, seleccione un autor.")) return;
    if (verificarCampo(fecha_libro, "Por favor, introduzca el año del libro.")) return;
    if (verificarCampo(editorial_libro, "Por favor, introduzca la editorial del libro.")) return;
    if (verificarCampo(carrera_libro, "Por favor, seleccione una carrera.")) return;

    // Si todos los campos están correctos, se envía el formulario
    document.getElementById("formEditarLibro").submit();
  });
</script>
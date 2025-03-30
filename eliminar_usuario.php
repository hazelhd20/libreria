<?php
require "conexion.php";
if (isset($_GET['id'])) {
  $id_elemento = intval($_GET['id']);
  $eliminar_datos = "DELETE FROM usuarios WHERE id_usuario = $id_elemento";
  $query = mysqli_query($conectar, $eliminar_datos);
  if ($query) {
    echo "<script>
      alert('Los datos han sido eliminados correctamente.');
      location.href = 'lista_usuarios.php';
    </script>";
  } else {
    echo "<script>
      alert('Error al eliminar los datos.');
      location.href = 'lista_usuarios.php';
    </script>";
  }
} else {
  echo "<script>
    alert('ID no válido.');
    location.href = 'lista_usuarios.php';
  </script>";
}
?>
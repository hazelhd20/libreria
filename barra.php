<?php
$usuario = $_SESSION['username'];
?>
<div class="barra">
  <div class="logo_barra">
    <img src="imagenes/logo.png" alt="logo tec">
    <h4 class="correo_usuario">
      <?php echo $usuario; ?>
    </h4>
  </div>
  <ul>
    <li><a href="principal.php"><i class="fas fa-home"></i> Inicio</a></li>
    <li><a href="lista_autores.php"><i class="fas fa-user-edit"></i> Autores</a></li>
    <li><a href="lista_carreras.php"><i class="fas fa-graduation-cap"></i> Carreras</a></li>
    <li><a href="lista_libros.php"><i class="fas fa-book"></i> Libros</a></li>
    <li><a href="lista_usuarios.php"><i class="fas fa-users"></i> Usuarios</a></li>
  </ul>
  <div class="btn_salir">
    <a class="rojo" href="salir.php"><i class="fas fa-sign-out-alt"></i> Salir</a>
  </div>
</div>
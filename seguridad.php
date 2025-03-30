<?php
session_start();
if ($_SESSION["autenticado"] != "Si") {
  header("Location: index.php");
  exit();
} else {
  //Nombre y tiempo de la cookie
$nombre_cookie = "tiempo_inicio";
$tiempo_expiracion = 3600;

//Crear la cookie con expiracion en 10 segundos
setcookie($nombre_cookie, time(), time() + $tiempo_expiracion, "/");

function verificarTiempoCookie($nombre_cookie, $tiempo_expiracion)
{
  if (isset($_COOKIE[$nombre_cookie])) {
    if (time() - $_COOKIE[$nombre_cookie] > $tiempo_expiracion) {

      //Borrar cookie y destruir la sesión
      setcookie($nombre_cookie, '', time() - 3600, '/');
      session_unset();
      session_destroy();
      header("Location: index.php");
      exit();
    }
  } else {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
  }
}
verificarTiempoCookie($nombre_cookie, $tiempo_expiracion);
}
?>
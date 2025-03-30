<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $apellido_usuario = trim($_POST['apellido_usuario'] ?? '');
    $correo_usuario = trim($_POST['correo_usuario'] ?? '');
    $contra_usuario = trim($_POST['contra_usuario'] ?? '');
    $nacimiento_usuario = trim($_POST['nacimiento_usuario'] ?? '');
    $formulario = $_POST['formulario'] ?? '';

    // Validaciones básicas
    if (empty($nombre_usuario) || empty($apellido_usuario) || empty($correo_usuario) || empty($contra_usuario) || empty($nacimiento_usuario)) {
        echo "<script>
        alert('Todos los campos son obligatorios.');
        history.go(-1);
        </script>";
        exit();
    }

    // Verifica que el correo tenga un formato válido
    if (!filter_var($correo_usuario, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
        alert('Formato de correo inválido.');
        history.go(-1);
        </script>";
        exit();
    }

    // Hash de la contraseña
    $contra_encriptada = password_hash($contra_usuario, PASSWORD_DEFAULT);

    // Verifica si el correo ya está registrado
    $stmt = $conectar->prepare("SELECT id_usuario FROM usuarios WHERE correo_usuario = ? LIMIT 1");
    $stmt->bind_param("s", $correo_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
        alert('El correo ingresado ya está registrado.');
        history.go(-1);
        </script>";
        exit();
    }

    $stmt->close();

    // Inserta los datos de forma segura
    $stmt = $conectar->prepare("INSERT INTO usuarios (nombre_usuario, apellido_usuario, correo_usuario, contra_usuario, nacimiento_usuario) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre_usuario, $apellido_usuario, $correo_usuario, $contra_encriptada, $nacimiento_usuario);

    if ($stmt->execute()) {
        $redireccion = ($formulario === "interno") ? "lista_usuarios.php" : "index.php";
        echo "<script>
        alert('Los datos han sido guardados correctamente.');
        location.href = '$redireccion';
        </script>";
    } else {
        echo "<script>
        alert('Error al guardar los datos.');
        history.go(-1);
        </script>";
    }

    $stmt->close();
    $conectar->close();
} else {
    header("Location: index.php");
    exit();
}
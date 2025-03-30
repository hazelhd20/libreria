<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'] ?? '';
    $nombre_usuario = trim($_POST['nombre_usuario'] ?? '');
    $apellido_usuario = trim($_POST['apellido_usuario'] ?? '');
    $contra_usuario = trim($_POST['contra_usuario'] ?? '');
    $nacimiento_usuario = trim($_POST['nacimiento_usuario'] ?? '');

    // Validaciones básicas
    if (empty($id_usuario) || empty($nombre_usuario) || empty($apellido_usuario) || empty($nacimiento_usuario)) {
        echo "<script>
        alert('Todos los campos son obligatorios.');
        history.go(-1);
        </script>";
        exit();
    }

    // Verifica si el usuario existe
    $stmt = $conectar->prepare("SELECT contra_usuario FROM usuarios WHERE id_usuario = ? LIMIT 1");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "<script>
        alert('El usuario no existe.');
        history.go(-1);
        </script>";
        exit();
    }

    $stmt->bind_result($contra_actual);
    $stmt->fetch();
    $stmt->close();

    // Si el usuario ingresa una nueva contraseña, la encripta. Si no, mantiene la anterior.
    $contra_encriptada = !empty($contra_usuario) ? password_hash($contra_usuario, PASSWORD_DEFAULT) : $contra_actual;

    // Actualiza los datos del usuario
    $stmt = $conectar->prepare("UPDATE usuarios SET nombre_usuario = ?, apellido_usuario = ?, contra_usuario = ?, nacimiento_usuario = ? WHERE id_usuario = ?");
    $stmt->bind_param("ssssi", $nombre_usuario, $apellido_usuario, $contra_encriptada, $nacimiento_usuario, $id_usuario);

    if ($stmt->execute()) {
        echo "<script>
        alert('Usuario actualizado correctamente.');
        location.href='ver_usuario.php?id=$id_usuario';
        </script>";
    } else {
        echo "<script>
        alert('Error al actualizar el usuario.');
        history.go(-1);
        </script>";
    }

    $stmt->close();
    $conectar->close();
} else {
    header("Location: index.php");
    exit();
}
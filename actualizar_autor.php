<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_autor = $_POST['id_autor'] ?? '';
    $nombre_autor = trim($_POST['nombre_autor'] ?? '');
    $nacionalidad_autor = trim($_POST['nacionalidad_autor'] ?? '');

    // Validaciones básicas
    if (empty($id_autor) || empty($nombre_autor) || empty($nacionalidad_autor)) {
        echo "<script>
            alert('Todos los campos son obligatorios.');
            history.go(-1);
            </script>";
        exit();
    }

    // Verificar si el autor existe
    $stmt = $conectar->prepare("SELECT COUNT(*) FROM autores WHERE id_autor = ?");
    $stmt->bind_param("i", $id_autor);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        echo "<script>
            alert('El autor no existe.');
            history.go(-1);
            </script>";
        exit();
    }

    // Actualizar los datos del autor
    $stmt = $conectar->prepare("UPDATE autores SET nombre_autor = ?, nacionalidad_autor = ? WHERE id_autor = ?");
    $stmt->bind_param("ssi", $nombre_autor, $nacionalidad_autor, $id_autor);

    if ($stmt->execute()) {
        echo "<script>
            alert('Autor actualizado correctamente.');
            location.href='ver_autor.php?id=$id_autor';
            </script>";
    } else {
        echo "<script>
            alert('Error al actualizar el autor.');
            history.go(-1);
            </script>";
    }

    $stmt->close();
    $conectar->close();
} else {
    header("Location: index.php");
    exit();
}
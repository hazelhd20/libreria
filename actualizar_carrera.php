<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_carrera = $_POST['id_carrera'] ?? '';
    $nombre_carrera = trim($_POST['nombre_carrera'] ?? '');

    // Validaciones básicas
    if (empty($id_carrera) || empty($nombre_carrera)) {
        echo "<script>
            alert('Todos los campos son obligatorios.');
            history.go(-1);
            </script>";
        exit();
    }

    // Verificar si la carrera existe
    $stmt = $conectar->prepare("SELECT COUNT(*) FROM carreras WHERE id_carrera = ?");
    $stmt->bind_param("i", $id_carrera);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        echo "<script>
            alert('La carrera no existe.');
            history.go(-1);
            </script>";
        exit();
    }

    // Actualizar los datos del autor
    $stmt = $conectar->prepare("UPDATE carreras SET nombre_carrera = ? WHERE id_carrera = ?");
    $stmt->bind_param("si", $nombre_carrera, $id_carrera);

    if ($stmt->execute()) {
        echo "<script>
            alert('Carrera actualizada correctamente.');
            location.href='ver_carrera.php?id=$id_carrera';
            </script>";
    } else {
        echo "<script>
            alert('Error al actualizar la carrera.');
            history.go(-1);
            </script>";
    }

    $stmt->close();
    $conectar->close();
} else {
    header("Location: index.php");
    exit();
}
<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_libro = $_POST['id_libro'] ?? '';
    $titulo_libro = trim($_POST['titulo_libro'] ?? '');
    $autor_libro = trim($_POST['autor_libro'] ?? '');
    $fecha_libro = trim($_POST['fecha_libro'] ?? '');
    $editorial_libro = trim($_POST['editorial_libro'] ?? '');
    $carrera_libro = trim($_POST['carrera_libro'] ?? '');

    // Validaciones básicas
    if (empty($id_libro) || empty($titulo_libro) || empty($autor_libro) || empty($fecha_libro) || empty($editorial_libro) || empty($carrera_libro)) {
        echo "<script>
            alert('Todos los campos son obligatorios.');
            history.go(-1);
            </script>";
        exit();
    }

    // Verificar si el libro existe
    $stmt = $conectar->prepare("SELECT COUNT(*) FROM libros WHERE id_libro = ?");
    $stmt->bind_param("i", $id_libro);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        echo "<script>
            alert('El libro no existe.');
            history.go(-1);
            </script>";
        exit();
    }

    // Actualizar los datos del libro
    $stmt = $conectar->prepare("UPDATE libros SET titulo_libro = ?, autor_libro = ?, fecha_libro = ?, editorial_libro = ?, carrera_libro = ? WHERE id_libro = ?");
    $stmt->bind_param("sissii", $titulo_libro, $autor_libro, $fecha_libro, $editorial_libro, $carrera_libro, $id_libro);

    if ($stmt->execute()) {
        echo "<script>
            alert('Libro actualizado correctamente.');
            location.href='ver_libro.php?id=$id_libro';
            </script>";
    } else {
        echo "<script>
            alert('Error al actualizar el libro.');
            history.go(-1);
            </script>";
    }

    $stmt->close();
    $conectar->close();
} else {
    header("Location: index.php");
    exit();
}
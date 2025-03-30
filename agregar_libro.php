<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo_libro = trim($_POST['titulo_libro'] ?? '');
    $autor_libro = trim($_POST['autor_libro'] ?? '');
    $fecha_libro = trim($_POST['fecha_libro'] ?? '');
    $editorial_libro = trim($_POST['editorial_libro'] ?? '');
    $carrera_libro = trim($_POST['carrera_libro'] ?? '');

    // Validaciones básicas
    if (empty($titulo_libro) || empty($autor_libro) || empty($fecha_libro) || empty($editorial_libro) || empty($carrera_libro)) {
        echo "<script>
        alert('Todos los campos son obligatorios.');
        history.go(-1);
        </script>";
        exit();
    }

    // Verifica si el libro ya está registrado
    $stmt = $conectar->prepare("SELECT id_libro FROM libros WHERE titulo_libro = ? LIMIT 1");
    $stmt->bind_param("s", $titulo_libro);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
        alert('El libro ingresado ya está registrado.');
        history.go(-1);
        </script>";
        exit();
    }

    $stmt->close();

    // Inserta los datos de forma segura
    $stmt = $conectar->prepare("INSERT INTO libros (titulo_libro, autor_libro, fecha_libro, editorial_libro, carrera_libro) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sissi", $titulo_libro, $autor_libro, $fecha_libro, $editorial_libro, $carrera_libro);

    if ($stmt->execute()) {
        echo "<script>
        alert('Los datos han sido guardados correctamente.');
        location.href = 'lista_libros.php';
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
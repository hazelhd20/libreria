<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_autor = trim($_POST['nombre_autor'] ?? '');
    $nacionalidad_autor = trim($_POST['nacionalidad_autor'] ?? '');

    // Validaciones básicas
    if (empty($nombre_autor) || empty($nacionalidad_autor)) {
        echo "<script>
        alert('Todos los campos son obligatorios.');
        history.go(-1);
        </script>";
        exit();
    }

    // Verifica si el autor ya está registrado
    $stmt = $conectar->prepare("SELECT id_autor FROM autores WHERE nombre_autor = ? LIMIT 1");
    $stmt->bind_param("s", $nombre_autor);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
        alert('El autor ingresado ya está registrado.');
        history.go(-1);
        </script>";
        exit();
    }

    $stmt->close();

    // Inserta los datos de forma segura
    $stmt = $conectar->prepare("INSERT INTO autores (nombre_autor, nacionalidad_autor) VALUES (?, ?)");
    $stmt->bind_param("ss", $nombre_autor, $nacionalidad_autor);

    if ($stmt->execute()) {
        echo "<script>
        alert('Los datos han sido guardados correctamente.');
        location.href = 'lista_autores.php';
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
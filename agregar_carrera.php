<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_carrera = trim($_POST['nombre_carrera'] ?? '');

    // Validaciones básicas
    if (empty($nombre_carrera)) {
        echo "<script>
        alert('Todos los campos son obligatorios.');
        history.go(-1);
        </script>";
        exit();
    }

    // Verifica si la carrera ya está registrada
    $stmt = $conectar->prepare("SELECT id_carrera FROM carreras WHERE nombre_carrera = ? LIMIT 1");
    $stmt->bind_param("s", $nombre_carrera);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>
        alert('La carrera ingresada ya está registrado.');
        history.go(-1);
        </script>";
        exit();
    }

    $stmt->close();

    // Inserta los datos de forma segura
    $stmt = $conectar->prepare("INSERT INTO carreras (nombre_carrera) VALUES (?)");
    $stmt->bind_param("s", $nombre_carrera);

    if ($stmt->execute()) {
        echo "<script>
        alert('Los datos han sido guardados correctamente.');
        location.href = 'lista_carreras.php';
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
<?php
session_start();
if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] === "Si") {
    header("Location: principal.php");
    exit;
}
?>

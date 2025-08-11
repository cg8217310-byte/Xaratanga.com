<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexion = new mysqli("localhost", "root", "", "folklorica");
    if ($conexion->connect_error) {
        die("Error: " . $conexion->connect_error);
    }

    $id = $_POST['id'];
    $leido = $_POST['leido'];
    $stmt = $conexion->prepare("UPDATE mensajes SET leido = ? WHERE id = ?");
    $stmt->bind_param("ii", $leido, $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: mensajes.php");
exit();

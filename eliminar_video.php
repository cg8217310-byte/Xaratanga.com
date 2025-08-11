<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conexion->prepare("SELECT ruta_video FROM videos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($archivo);
    if ($stmt->fetch()) {
        $stmt->close();
        $ruta = "videos_galeria/" . $archivo;
        if (file_exists($ruta)) {
            unlink($ruta);
        }
        $del = $conexion->prepare("DELETE FROM videos WHERE id = ?");
        $del->bind_param("i", $id);
        $del->execute();
        $del->close();
        header("Location: videos.php?eliminado=ok");
        exit();
    } else {
        echo "❌ Video no encontrado.";
    }
} else {
    echo "❌ ID inválido.";
}
?>

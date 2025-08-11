<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conexion->prepare("SELECT ruta_imagen FROM galeria WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($ruta);
    if ($stmt->fetch()) {
        $stmt->close();
        $archivo = "imagenes_galeria/" . $ruta;
        if (file_exists($archivo)) {
            unlink($archivo);
        }

        $del = $conexion->prepare("DELETE FROM galeria WHERE id = ?");
        $del->bind_param("i", $id);
        $del->execute();
        $del->close();
        header("Location: galeria.php?eliminado=ok");
        exit();
    } else {
        echo "Imagen no encontrada.";
    }
} else {
    echo "ID inválido.";
}
?>

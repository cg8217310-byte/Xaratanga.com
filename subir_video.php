<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['video'])) {
    $nombre_video = $_POST['nombre'] ?? '';
    $archivo = $_FILES['video'];

    $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
    $nombre_final = uniqid('vid_', true) . '.' . $extension;
    $ruta = 'videos_galeria/' . $nombre_final;

    $permitidos = ['mp4', 'webm', 'ogg'];

    if (in_array($extension, $permitidos)) {
        if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
            $stmt = $conexion->prepare("INSERT INTO videos (nombre, ruta_video) VALUES (?, ?)");
            $stmt->bind_param("ss", $nombre_video, $nombre_final);
            $stmt->execute();
            $stmt->close();
            header("Location: videos.php?subido=ok");
            exit();
        } else {
            echo "❌ Error al mover el video.";
        }
    } else {
        echo "❌ Formato de video no permitido.";
    }
} else {
    echo "❌ Video no recibido.";
}
?>

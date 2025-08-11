<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_imagen = $_POST['nombre'] ?? '';
    $archivo = $_FILES['imagen'];

    if ($archivo['error'] === UPLOAD_ERR_OK) {
        $extensiones_validas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        if (in_array($extension, $extensiones_validas)) {
            $nuevo_nombre = uniqid('img_', true) . '.' . $extension;
            $ruta = 'imagenes_galeria/' . $nuevo_nombre;

            if (move_uploaded_file($archivo['tmp_name'], $ruta)) {
                $stmt = $conexion->prepare("INSERT INTO galeria (nombre, ruta_imagen) VALUES (?, ?)");
                $stmt->bind_param("ss", $nombre_imagen, $nuevo_nombre);
                $stmt->execute();
                $stmt->close();
                header("Location: galeria.php?subida=ok");
                exit();
            } else {
                echo "❌ Error al mover el archivo.";
            }
        } else {
            echo "❌ Tipo de archivo no permitido.";
        }
    } else {
        echo "❌ Error en la carga del archivo.";
    }
} else {
    echo "❌ Método no permitido.";
}
?>

<?php
// Mostrar errores (para depurar)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "folklorica");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$mensajeExito = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"] ?? "";
    $comentario = $_POST["comentario"] ?? "";

    if ($nombre && $comentario) {
        $stmt = $conexion->prepare("INSERT INTO comentarios (nombre, comentario, aprobado) VALUES (?, ?, 0)");
        $stmt->bind_param("ss", $nombre, $comentario);
        $stmt->execute();
        $stmt->close();

        $mensajeExito = "✅ ¡Comentario enviado! Será visible cuando sea aprobado.";
    } else {
        $mensajeExito = "❌ Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dejar Comentario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">💬 Deja tu comentario</h2>

    <?php if ($mensajeExito): ?>
        <div class="alert alert-info"><?php echo $mensajeExito; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario:</label>
            <textarea name="comentario" id="comentario" rows="4" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar comentario</button>
    </form>
</div>
</body>
</html>

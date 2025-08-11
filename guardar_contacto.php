<?php
$conexion = new mysqli("localhost", "root", "", "folklorica");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    if ($nombre && $correo && $mensaje) {
        $stmt = $conexion->prepare("INSERT INTO mensajes (nombre, correo, mensaje) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $correo, $mensaje);
        $stmt->execute();
        $stmt->close();
        echo "✅ Mensaje enviado correctamente.";
    } else {
        echo "❌ Todos los campos son obligatorios.";
    }
}
?>

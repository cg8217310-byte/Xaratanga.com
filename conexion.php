<?php
$conexion = new mysqli("localhost", "root", "", "folklorica");

// Verificar conexión
if ($conexion->connect_error) {
    die(" Error de conexión a la base de datos: " . $conexion->connect_error);
}

// Opcional: establecer codificación UTF-8
$conexion->set_charset("utf8");
?>

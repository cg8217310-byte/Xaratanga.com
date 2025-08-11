<?php
include("include/conexion.php");
file_put_contents("debug.txt", file_get_contents("php://input"));


$data = json_decode(file_get_contents("php://input"), true);

$titulo = $data["titulo"] ?? '';
$descripcion = $data["descripcion"] ?? '';
$fecha = $data["fecha"] ?? '';

if ($titulo && $fecha) {
    $stmt = $conexion->prepare("INSERT INTO eventos (titulo, descripcion, fecha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $titulo, $descripcion, $fecha);
    $stmt->execute();
    echo "Evento guardado";
} else {
    http_response_code(400);
    echo "Datos incompletos";
}

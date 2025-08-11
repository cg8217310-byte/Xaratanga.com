<?php
include("include/conexion.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["id"] ?? null;
$titulo = $data["titulo"] ?? '';
$descripcion = $data["descripcion"] ?? '';

if ($id && $titulo) {
    $stmt = $conexion->prepare("UPDATE eventos SET titulo = ?, descripcion = ? WHERE id = ?");
    $stmt->bind_param("ssi", $titulo, $descripcion, $id);
    $stmt->execute();
    echo "Evento actualizado";
} else {
    http_response_code(400);
    echo "Datos incompletos";
}

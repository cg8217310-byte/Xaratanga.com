<?php
include("include/conexion.php");

$data = json_decode(file_get_contents("php://input"), true);
$id = $data["id"] ?? null;

if ($id) {
    $stmt = $conexion->prepare("DELETE FROM eventos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Evento eliminado";
} else {
    http_response_code(400);
    echo "ID no válido";
}

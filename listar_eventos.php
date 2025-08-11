<?php
include("include/conexion.php");

$filtro = $_GET["buscar"] ?? '';
$fecha = $_GET["fecha"] ?? '';

$sql = "SELECT * FROM eventos WHERE 1";

if ($filtro !== '') {
    $filtro = "%$filtro%";
    $sql .= " AND (titulo LIKE ? OR descripcion LIKE ?)";
}
if ($fecha !== '') {
    $sql .= " AND fecha = ?";
}

$stmt = $conexion->prepare($sql);

// Bind dinámico según los filtros
if ($filtro !== '' && $fecha !== '') {
    $stmt->bind_param("sss", $filtro, $filtro, $fecha);
} elseif ($filtro !== '') {
    $stmt->bind_param("ss", $filtro, $filtro);
} elseif ($fecha !== '') {
    $stmt->bind_param("s", $fecha);
}

$stmt->execute();
$resultado = $stmt->get_result();

$eventos = [];

while ($fila = $resultado->fetch_assoc()) {
    $eventos[] = $fila;
}

header('Content-Type: application/json');
echo json_encode($eventos);

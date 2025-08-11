<?php
include("include/conexion.php");

$resultado = $conexion->query("SELECT * FROM eventos");

$eventos = [];

while ($fila = $resultado->fetch_assoc()) {
    $eventos[] = [
        'id' => $fila['id'],
        'title' => $fila['titulo'],
        'start' => $fila['fecha'],
        'description' => $fila['descripcion']
    ];
}

header('Content-Type: application/json');
echo json_encode($eventos);

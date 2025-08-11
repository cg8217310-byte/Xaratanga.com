<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

include('conexion.php');

$id = intval($_GET['id']);
$estado = intval($_GET['estado']);

$stmt = $conexion->prepare("UPDATE comentarios SET aprobado = ? WHERE id = ?");
$stmt->bind_param("ii", $estado, $id);
$stmt->execute();

header("Location: comentarios.php");
exit();

<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}

include('conexion.php');

$id = intval($_GET['id']);

$stmt = $conexion->prepare("DELETE FROM comentarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: comentarios.php");
exit();

<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}

// Conexión
$conexion = new mysqli("localhost", "root", "", "folklorica");
if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}

// Filtros
$nombre = $_GET['nombre'] ?? '';
$correo = $_GET['correo'] ?? '';
$fecha = $_GET['fecha'] ?? '';

// Consulta con filtros
$sql = "SELECT * FROM mensajes WHERE 1";
if ($nombre) $sql .= " AND nombre LIKE '%$nombre%'";
if ($correo) $sql .= " AND correo LIKE '%$correo%'";
if ($fecha) $sql .= " AND DATE(fecha) = '$fecha'";
$sql .= " ORDER BY fecha DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>📧 Mensajes Recibidos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<a href="admin_panel.php" class="btn btn-outline-dark mb-4">⬅️ Volver al panel</a>

<h2 class="mb-4">📨 Mensajes de Contacto</h2>

<!-- Filtros -->
<form method="GET" class="row g-3 mb-4">
  <div class="col-md-3">
    <input type="text" name="nombre" class="form-control" placeholder="Filtrar por nombre" value="<?php echo htmlspecialchars($nombre); ?>">
  </div>
  <div class="col-md-3">
    <input type="email" name="correo" class="form-control" placeholder="Filtrar por correo" value="<?php echo htmlspecialchars($correo); ?>">
  </div>
  <div class="col-md-3">
    <input type="date" name="fecha" class="form-control" value="<?php echo htmlspecialchars($fecha); ?>">
  </div>
  <div class="col-md-3">
    <button type="submit" class="btn btn-primary w-100">🔍 Filtrar</button>
  </div>
</form>

<!-- Tabla de mensajes -->
<table class="table table-bordered table-hover bg-white">
  <thead class="table-dark text-center">
    <tr>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Mensaje</th>
      <th>Fecha</th>
      <th>Leído</th>
      <th>Acción</th>
    </tr>
  </thead>
  <tbody class="text-center">
    <?php while ($fila = $resultado->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($fila['nombre']) ?></td>
        <td><?= htmlspecialchars($fila['correo']) ?></td>
        <td><?= nl2br(htmlspecialchars($fila['mensaje'])) ?></td>
        <td><?= $fila['fecha'] ?></td>
        <td><?= $fila['leido'] ? '✅' : '❌' ?></td>
        <td>
          <form method="POST" action="marcar_leido.php" style="display:inline;">
            <input type="hidden" name="id" value="<?= $fila['id'] ?>">
            <input type="hidden" name="leido" value="<?= $fila['leido'] ? 0 : 1 ?>">
            <button type="submit" class="btn btn-sm <?= $fila['leido'] ? 'btn-secondary' : 'btn-success' ?>">
              <?= $fila['leido'] ? 'Marcar como no leído' : 'Marcar como leído' ?>
            </button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>

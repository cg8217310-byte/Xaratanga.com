<?php
session_start();
if (!isset($_SESSION["admin"])) {
  header("Location: login.php");
  exit();
}
include('conexion.php');
include("include/headerAdmin.php"); ?>
<link rel="stylesheet" href="css/comentariosPanel.css">
<div class="espacio-header"></div>

<h2> Gestión de Comentarios</h2>

<a href="admin_panel.php" class="btn btn-outline-dark mb-3">⬅️ Volver al panel</a>
<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>Autor</th>
      <th>Comentario</th>
      <th>Fecha</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $consulta = "SELECT * FROM comentarios ORDER BY fecha DESC";
    $resultado = mysqli_query($conexion, $consulta);
    while ($comentario = mysqli_fetch_assoc($resultado)) {
      $autor = htmlspecialchars($comentario['autor']);
      $contenido = htmlspecialchars($comentario['contenido']);
      $fecha = date("d/m/Y H:i", strtotime($comentario['fecha']));
      $estado = $comentario['aprobado'] ? '✅ Aprobado' : '⏳ Pendiente';
      $accionTexto = $comentario['aprobado'] ? 'Desaprobar' : 'Aprobar';
      $nuevoEstado = $comentario['aprobado'] ? 0 : 1;

      echo "<tr>";
      echo "<td data-label='Autor'>{$autor}</td>";
      echo "<td data-label='Comentario'>{$contenido}</td>";
      echo "<td data-label='Fecha'>{$fecha}</td>";
      echo "<td data-label='Estado'>{$estado}</td>";
      echo "<td data-label='Acciones'>
              <a href='aprobar_comentario.php?id={$comentario['id']}&estado={$nuevoEstado}' class='btn btn-sm btn-warning'>{$accionTexto}</a>
              <a href='eliminar_comentario.php?id={$comentario['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('¿Eliminar este comentario?')\">Eliminar</a>
            </td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>

<?php include('include/footer.php'); ?>

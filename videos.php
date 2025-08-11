<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
include('conexion.php');
include("include/headerAdmin.php");
?>
<link rel="stylesheet" href="css/videosPanel.css">
<div class="espacio-header"></div>

<h2>🎥 Galería de Videos</h2>

<a href="admin_panel.php" class="btn btn-outline-dark mb-4">⬅️ Volver al panel</a>

<!-- Subir video -->
<div class="upload-card" style="max-width: 600px; margin: 0 auto;">
  <form action="subir_video.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="video" class="form-label">Selecciona un video:</label>
      <input type="file" name="video" id="video" class="form-control" accept="video/*" required>
    </div>
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre del video:</label>
      <input type="text" name="nombre" id="nombre" class="form-control">
    </div>
    <button type="submit" class="btn btn-danger">Subir Video</button>
  </form>
</div>
<div class="espacio-header"></div>
<!-- Mostrar videos -->
<div class="video-grid">
  <?php
  $consulta = "SELECT * FROM videos ORDER BY id DESC";
  $resultado = mysqli_query($conexion, $consulta);
  while ($fila = mysqli_fetch_assoc($resultado)) {
    echo '<div class="card">';
    echo '  <video controls>';
    echo '    <source src="videos_galeria/' . htmlspecialchars($fila['ruta_video']) . '" type="video/mp4">';
    echo '    Tu navegador no soporta este video.';
    echo '  </video>';
    echo '  <div class="card-body">';
    echo '    <h5>' . htmlspecialchars($fila['nombre']) . '</h5>';
    echo '    <p class="text-muted">Subido el: ' . date("d/m/Y H:i", strtotime($fila['fecha_subida'])) . '</p>';
    echo '    <a href="eliminar_video.php?id=' . $fila['id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'¿Eliminar video?\')">Eliminar</a>';
    echo '  </div>';
    echo '</div>';
  }
  ?>
</div>

<?php include('include/footer.php'); ?>

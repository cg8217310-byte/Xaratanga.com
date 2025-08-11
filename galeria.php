<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
include('conexion.php');
include("include/headerAdmin.php"); 
?>
<link rel="stylesheet" href="css/GaleriaPanel.css">

<a href="admin_panel.php" class="btn btn-outline-dark mb-4">⬅️ Volver al panel</a>

<h2>Galería de Imágenes</h2>

<!-- Subir imagen -->
<div class="card p-4 mb-5" style="max-width: 600px; margin: 0 auto;">
  <form action="subir_imagen.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="imagen" class="form-label">Selecciona una imagen:</label>
      <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
    </div>
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre de la imagen (opcional):</label>
      <input type="text" name="nombre" id="nombre" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary w-100">Subir Imagen</button>
  </form>
</div>

<!-- Mostrar galería -->
<div class="gallery-grid">
  <?php
  $consulta = "SELECT * FROM galeria ORDER BY id DESC";
  $resultado = mysqli_query($conexion, $consulta);
  if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo '<div class="card">';
      echo '  <img src="imagenes_galeria/' . htmlspecialchars($fila['ruta_imagen']) . '" alt="Imagen">';
      echo '  <div class="card-body">';
      echo '    <p class="card-text">' . htmlspecialchars($fila['nombre']) . '</p>';
      echo '    <a href="eliminar_imagen.php?id=' . $fila['id'] . '" class="btn btn-danger" onclick="return confirm(\'¿Eliminar imagen?\')">Eliminar</a>';
      echo '  </div>';
      echo '</div>';
    }
  } else {
    echo '<p style="text-align:center;">No hay imágenes en la galería.</p>';
  }
  ?>
</div>

<?php include('include/footer.php'); ?>

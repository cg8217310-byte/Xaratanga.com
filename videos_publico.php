<?php include('conexion.php'); ?>
<?php include("include/header.php"); ?>

<link rel="stylesheet" href="css/videos.css?v=1.0.4">

<section class="seccion-videos">
  <div class="container">
    <h2 class="text-center">Nuestros Videos</h2>
    <div class="row justify-content-center">
      <?php
      $consulta = "SELECT * FROM videos ORDER BY id DESC";
      $resultado = mysqli_query($conexion, $consulta);
      while ($fila = mysqli_fetch_assoc($resultado)) {
        echo '<div class="video-col col-12 col-sm-6 col-lg-4 mb-4 px-2">';
        echo '  <div class="video-card">';
        echo '    <video controls>';
        echo '      <source src="videos_galeria/' . htmlspecialchars($fila['ruta_video']) . '" type="video/mp4">';
        echo '      Tu navegador no soporta el video.';
        echo '    </video>';
        echo '    <div class="video-info">';
        echo '      <h5>' . htmlspecialchars($fila['nombre']) . '</h5>';
        echo '      <p>Subido el: ' . date("d/m/Y", strtotime($fila['fecha_subida'])) . '</p>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
      }
      ?>
    </div>
  </div>
</section>

<?php include("include/footer.php"); ?>

<!-- Carga Bootstrap JS para que funcione bootstrap.Modal y otros -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  document.querySelectorAll('video').forEach(video => {
    video.addEventListener('fullscreenchange', () => {
      if (document.fullscreenElement === video) {
        video.classList.add('expandido');
      } else {
        video.classList.remove('expandido');
      }
    });

    // Compatibilidad con otros navegadores
    video.addEventListener('webkitfullscreenchange', () => {
      if (document.webkitFullscreenElement === video) {
        video.classList.add('expandido');
      } else {
        video.classList.remove('expandido');
      }
    });
  });
</script>



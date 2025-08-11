<?php include('conexion.php'); ?> 
<?php include("include/header.php"); ?>
<div class="espacio-header"></div>

<link rel="stylesheet" href="css/galeria.css">
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

<div class="galeria-mosaico">
  <?php
  $consulta = "SELECT * FROM galeria ORDER BY id DESC";
  $resultado = mysqli_query($conexion, $consulta);

  if (mysqli_num_rows($resultado) > 0) {
      while ($fila = mysqli_fetch_assoc($resultado)) {
          $imagen = htmlspecialchars($fila['ruta_imagen']);
          $nombre = htmlspecialchars($fila['nombre']);
          echo '
          <div class="item-galeria">
              <div class="img-wrapper">
                  <img src="imagenes_galeria/' . $imagen . '" alt="' . $nombre . '" onclick="abrirModal(this.src, \'' . $nombre . '\')">
                  <div class="descripcion-hover">
                      <p>' . $nombre . '</p>
                  </div>
              </div>
          </div>
          ';
      }
  } else {
      echo '<p class="text-muted">Aún no hay imágenes para mostrar.</p>';
  }
  ?>
</div>

<!-- Modal para ampliar imagen -->
<div id="modalImagen" class="modal" onclick="cerrarModal()">
    <span class="cerrar" onclick="cerrarModal()">×</span>
    <img class="modal-contenido" id="imgGrande">
    <div id="textoModal"></div>
</div>

<script>
  function abrirModal(src, texto) {
    const modal = document.getElementById("modalImagen");
    const imgGrande = document.getElementById("imgGrande");
    const textoModal = document.getElementById("textoModal");

    modal.style.display = "flex";
    imgGrande.src = src;
    textoModal.textContent = texto;
  }

  function cerrarModal() {
    const modal = document.getElementById("modalImagen");
    modal.style.display = "none";
  }
</script>

<?php include("include/footer.php"); ?>

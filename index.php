<?php include("include/header.php"); ?>

<!-- SOLO SE USA EN ESTA PÁGINA -->
<link rel="stylesheet" href="css/estilos_index.css">

<?php include('secciones/presentacion.php'); ?>
<?php include('secciones/historia_evolucion.php'); ?>
<?php include('secciones/mision_vision_valores.php'); ?>
<?php include('secciones/reconocimientos_logros.php'); ?>
<?php include('secciones/giras_participaciones.php'); ?>
<?php include('secciones/estructura_colectivo.php'); ?>
<?php include('secciones/cronica.php'); ?>
<?php include('secciones/contacto_redes.php'); ?>

<!-- MODAL DE IMAGEN -->
<div class="modal fade" id="modalImagen" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img src="" id="imagenAmpliada" class="img-fluid rounded shadow">
      </div>
    </div>
  </div>
</div>

<?php include("include/footer.php"); ?>

<!-- CSS Bootstrap 5.3.0 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  

<!-- JS Bootstrap Bundle 5.3.0 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.img-carrusel').forEach(img => {
      img.addEventListener('click', () => {
        const modal = new bootstrap.Modal(document.getElementById('modalImagen'));
        document.getElementById('imagenAmpliada').src = img.src;
        modal.show();
      });
    });
  });
</script>

<!-- Script para cambio de fondo dinámico -->
<script>
  const secciones = document.querySelectorAll('.seccion-dinamica');
  const colores = [
    '#C0D5EE', '#F3D1DC', '#D9E3DC', '#F7ECD9',
    '#D5E1F2', '#F0D9E7', '#E0D2C0', '#E6E7D9'
  ];

  window.addEventListener('scroll', () => {
    let scrollPos = window.scrollY + window.innerHeight / 2;
    secciones.forEach((seccion, i) => {
      let top = seccion.offsetTop;
      let bottom = top + seccion.offsetHeight;
      if (scrollPos >= top && scrollPos < bottom) {
        document.body.style.backgroundColor = colores[i] || '#fff';
      }
    });
  });
</script>


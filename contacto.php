<?php include("include/header.php"); ?>
<link rel="stylesheet" href="css/contacto.css">
<div class="espacio-header"></div>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-sm-10 col-md-8 col-lg-6 p-4 contacto-card shadow rounded">

      <h2 class="text-center mb-4">Contáctanos</h2>

      <?php if (isset($_GET['enviado']) && $_GET['enviado'] === 'ok'): ?>
        <div class="alert alert-success text-center">✅ Mensaje enviado correctamente.</div>
      <?php elseif (isset($_GET['error'])): ?>
        <div class="alert alert-danger text-center">❌ Ocurrió un error. Intenta de nuevo.</div>
      <?php endif; ?>

      <form action="guardar_contacto.php" method="POST" novalidate>
        <div class="mb-3">
          <label for="nombre" class="form-label">Nombre:</label>
          <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Nombre completo">
        </div>

        <div class="mb-3">
          <label for="correo" class="form-label">Correo electrónico:</label>
          <input type="email" name="correo" id="correo" class="form-control" required placeholder="tucorreo@ejemplo.com">
        </div>

        <div class="mb-3">
          <label for="mensaje" class="form-label">Mensaje:</label>
          <textarea name="mensaje" id="mensaje" rows="5" class="form-control" required placeholder="Escribe tu mensaje aquí..."></textarea>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Enviar mensaje</button>
        </div>
      </form>

      <div class="text-center mt-4 redes-sociales">
        <p class="mb-2">Síguenos en nuestras redes sociales</p>
        <div class="d-flex justify-content-center gap-4">
          <a href="https://www.facebook.com/share/1BCXp9i2st/" target="_blank" aria-label="Facebook">
            <img src="css/iconos/facebook.svg" alt="Facebook" width="32" height="32">
          </a>
          <a href="https://www.instagram.com/xaratangacolectivofolklorico?igsh=cG9mbWQ4dmR1dHdx" target="_blank" aria-label="Instagram">
            <img src="css/iconos/instagram (1).svg" alt="Instagram" width="32" height="32">
          </a>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include("include/footer.php"); ?>





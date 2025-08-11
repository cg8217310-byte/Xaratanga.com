<?php include('conexion.php'); ?> 
<?php include("include/header.php"); ?>
<link rel="stylesheet" href="css/comentarios.css"> <!-- Asegúrate de enlazar el CSS correcto -->

<h2 class="text-center my-4">Comentarios</h2>

<div class="container mb-5">
  <form action="comentarios_publico.php" method="POST" class="mb-4">
    <div class="mb-3">
      <label for="autor" class="form-label">Tu nombre:</label>
      <input type="text" name="autor" id="autor" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="contenido" class="form-label">Comentario:</label>
      <textarea name="contenido" id="contenido" rows="4" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar comentario</button>
  </form>

  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $autor = trim($_POST['autor']);
    $contenido = trim($_POST['contenido']);

    if (!empty($autor) && !empty($contenido)) {
      $stmt = $conexion->prepare("INSERT INTO comentarios (autor, contenido) VALUES (?, ?)");
      $stmt->bind_param("ss", $autor, $contenido);
      $stmt->execute();
      echo "<div class='alert alert-success'>✅ Comentario enviado. Será revisado por un administrador.</div>";
    } else {
      echo "<div class='alert alert-danger'>❌ Todos los campos son obligatorios.</div>";
    }
  }
  ?>
</div>

<!-- Botón para mostrar/ocultar los comentarios -->
<button id="btn-ver-comentarios">Ver comentarios</button>

<!-- Contenedor visual de los comentarios -->
<div class="container comentarios-container" id="comentarios-container">
  <?php
  $resultado = mysqli_query($conexion, "SELECT * FROM comentarios WHERE aprobado = 1 ORDER BY fecha DESC");
  while ($fila = mysqli_fetch_assoc($resultado)) {
    ?>
    <div class="comentario-card">
      <strong><?= htmlspecialchars($fila['autor']) ?></strong>
      <?= htmlspecialchars($fila['contenido']) ?>
      <small><?= date("d/m/Y H:i", strtotime($fila['fecha'])) ?></small>
    </div>
    <?php
  }
  ?>
</div>

<!-- Script para mostrar u ocultar los comentarios -->
<script>
  const btn = document.getElementById('btn-ver-comentarios');
  const contenedor = document.getElementById('comentarios-container');
  let visible = false;

  btn.addEventListener('click', () => {
    visible = !visible;
    contenedor.style.display = visible ? 'flex' : 'none';
    btn.textContent = visible ? 'Ocultar comentarios' : 'Ver comentarios';
  });
</script>

<?php include("include/footer.php"); ?>


<?php include('conexion.php'); ?>
<?php include("include/header.php"); ?>
<link rel="stylesheet" href="css/eventos.css">

<h2 class="text-center my-4">Próximos Eventos</h2>

<div class="container mb-5">
  <div class="eventos-container">
    <?php
    $hoy = date('Y-m-d');
    $consulta = "SELECT * FROM eventos WHERE fecha >= '$hoy' ORDER BY fecha ASC";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        while ($evento = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="postit-card">
              <div class="postit-content">
                <h5><?= htmlspecialchars($evento['titulo']) ?></h5>
                <p class="fecha"><?= date("d M Y", strtotime($evento['fecha'])) ?></p>
                <p class="descripcion"><?= htmlspecialchars($evento['descripcion']) ?></p>
              </div>
            </div>
            <?php
        }
    } else {
        echo '<p class="text-center text-muted">No hay eventos próximos registrados.</p>';
    }
    ?>
  </div>
</div>

<?php include("include/footer.php"); ?>

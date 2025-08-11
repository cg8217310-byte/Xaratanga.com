<?php 
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
include("include/headerAdmin.php");?>

<link rel="stylesheet" href="css/panelAdmin.css">

<div class="admin-panel container py-5">
  <div class="text-center mb-5">
    <h1 class="admin-title">Bienvenido Luis <?php echo htmlspecialchars($_SESSION["admin"]); ?></h1>
    <p class="admin-subtitle">Panel de administración - Grupo de Danza Folklórica Xaratanga</p>
  </div>

  <div class="dashboard-grid">
    <a href="galeria.php" class="dashboard-link galeria">
      <div class="icon">📸</div>
      Galería de Imágenes
    </a>

    <a href="calendario.php" class="dashboard-link calendario">
      <div class="icon">📅</div>
      Calendario
    </a>

    <a href="comentarios.php" class="dashboard-link comentarios">
      <div class="icon">💬</div>
      Comentarios
    </a>

    <a href="videos.php" class="dashboard-link videos">
      <div class="icon">🎥</div>
      Videos
    </a>

    <a href="mensajes.php" class="dashboard-link mensajes">
      <div class="icon">📨</div>
      Mensajes
    </a>

    <a href="logout.php" class="dashboard-link logout">
      <div class="icon">🚪</div>
      Cerrar sesión
    </a>
  </div>
</div>

<?php include("include/footer.php"); ?>





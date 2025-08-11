<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calendario de Eventos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FullCalendar -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        body {
            padding: 30px;
            font-family: sans-serif;
            background-color: #f4f4f4;
        }
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <a href="admin_panel.php" class="btn btn-outline-dark mb-3">⬅️ Volver al panel</a>
    <a href="lista_eventos.php" class="btn btn-outline-primary mb-3">📋 Ver lista de eventos</a>

    <h2>📅 Calendario de Eventos</h2>
    <div id="calendar"></div>

    <!-- Modal para editar/eliminar evento -->
    <!-- Modal para editar/eliminar evento -->
<div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="eventoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="eventoModalLabel">📝 Editar Evento</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div id="errorModal" class="alert alert-danger d-none" role="alert">
          ⚠️ El título no puede estar vacío.
        </div>
        <input type="hidden" id="eventoId">
        <div class="mb-3">
          <label for="tituloEvento" class="form-label">Título del evento</label>
          <input type="text" class="form-control" id="tituloEvento" maxlength="100" required>
        </div>
        <div class="mb-3">
          <label for="descripcionEvento" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcionEvento" maxlength="300"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button id="btnEliminar" class="btn btn-outline-danger">🗑️ Eliminar</button>
        <button id="btnGuardar" class="btn btn-success">💾 Guardar cambios</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">❌ Cancelar</button>
      </div>
    </div>
  </div>
</div>
    <!-- Librerías necesarias -->
    <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script del calendario -->
    <script src="calendario.js"></script>
</body>
</html>

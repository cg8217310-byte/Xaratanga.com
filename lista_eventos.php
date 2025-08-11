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
  <title>Lista de Eventos</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f4f4f4;
      padding: 30px;
      font-family: sans-serif;
    }
    table {
      background-color: white;
    }
  </style>
</head>
<body>

  <a href="admin_panel.php" class="btn btn-outline-dark mb-4">⬅️ Volver al panel</a>

  <h2>📋 Lista de Eventos</h2>

  <!-- Filtros -->
  <div class="row my-4">
    <div class="col-md-5">
      <input type="text" id="buscador" class="form-control" placeholder="Buscar por título o descripción...">
    </div>
    <div class="col-md-4">
      <input type="date" id="filtroFecha" class="form-control">
    </div>
    <div class="col-md-3">
      <button class="btn btn-secondary w-100" onclick="cargarEventosTabla()">🔄 Mostrar todo</button>
    </div>
  </div>

  <!-- Tabla -->
  <table class="table table-bordered table-striped text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tablaEventos"></tbody>
  </table>

  <!-- Botones exportar -->
  <div class="d-flex gap-3 mt-3">
    <button id="btnExportarPDF" class="btn btn-danger">📄 Exportar a PDF</button>
    <button id="btnExportarExcel" class="btn btn-success">📊 Exportar a Excel</button>
  </div>

  <!-- Modal para editar evento -->
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

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script src="eventos.js"></script> <!-- ← El script acoplado correctamente -->
</body>
</html>

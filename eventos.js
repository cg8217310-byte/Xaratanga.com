document.addEventListener('DOMContentLoaded', function () {
    const modal = new bootstrap.Modal(document.getElementById('eventoModal'));

    // Cargar la tabla de eventos con filtros
    function cargarEventosTabla() {
        const buscar = document.getElementById("buscador").value;
        const fecha = document.getElementById("filtroFecha").value;

        axios.get("listar_eventos.php", {
            params: {
                buscar,
                fecha
            }
        }).then(res => {
            const eventos = res.data;
            const tabla = document.getElementById("tablaEventos");
            tabla.innerHTML = "";

            if (eventos.length === 0) {
                tabla.innerHTML = `<tr><td colspan="4">No se encontraron eventos</td></tr>`;
                return;
            }

            eventos.forEach(evento => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${evento.id}</td>
                    <td>${evento.fecha}</td>
                    <td>${evento.titulo}</td>
                    <td>${evento.descripcion}</td>
                    <td>
                      <button class="btn btn-sm btn-primary btnEditar" data-id="${evento.id}" data-titulo="${evento.titulo}" data-descripcion="${evento.descripcion}">Editar</button>
                      <button class="btn btn-sm btn-danger btnEliminar" data-id="${evento.id}">Eliminar</button>
                    </td>
                `;
                tabla.appendChild(fila);
            });

            // Añadir eventos a botones después de crear las filas
            document.querySelectorAll('.btnEditar').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.getAttribute('data-id');
                    const titulo = e.target.getAttribute('data-titulo');
                    const descripcion = e.target.getAttribute('data-descripcion');

                    document.getElementById('eventoId').value = id;
                    document.getElementById('tituloEvento').value = titulo;
                    document.getElementById('descripcionEvento').value = descripcion;
                    modal.show();
                });
            });

            document.querySelectorAll('.btnEliminar').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.getAttribute('data-id');
                    if (confirm("¿Estás seguro de eliminar este evento?")) {
                        axios.post('eliminar_evento.php', { id })
                            .then(() => {
                                cargarEventosTabla();
                            })
                            .catch(() => alert("Error eliminando el evento."));
                    }
                });
            });
        }).catch(() => {
            alert("Error cargando eventos.");
        });
    }

    // Guardar cambios del modal (editar evento)
    document.getElementById('btnGuardar').addEventListener('click', () => {
    const id = document.getElementById('eventoId').value;
    const titulo = document.getElementById('tituloEvento').value.trim();
    const descripcion = document.getElementById('descripcionEvento').value.trim();

    if (!titulo) {
        alert("El título no puede estar vacío.");
        return;
    }

    axios.post('editar_evento.php', {
        id,
        titulo,
        descripcion
    }).then(() => {
        modal.hide();
        cargarEventosTabla();
    }).catch(() => {
        alert("Error al guardar el evento.");
    });
});


    // Eventos para filtros
    document.getElementById("buscador").addEventListener("input", cargarEventosTabla);
    document.getElementById("filtroFecha").addEventListener("change", cargarEventosTabla);

    // Exportar a PDF
    document.getElementById("btnExportarPDF").addEventListener("click", () => {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();
        doc.text("Lista de eventos", 14, 15);

        const filas = [];
        document.querySelectorAll("#tablaEventos tr").forEach(tr => {
            const fila = [];
            tr.querySelectorAll("td:not(:last-child)").forEach(td => { // Excluye la columna con botones
                fila.push(td.textContent);
            });
            if (fila.length) filas.push(fila);
        });

        doc.autoTable({
            head: [["ID", "Fecha", "Título", "Descripción"]],
            body: filas,
            startY: 20
        });

        doc.save("eventos.pdf");
    });

    // Exportar a Excel
    document.getElementById("btnExportarExcel").addEventListener("click", () => {
        const tabla = document.getElementById("tablaEventos");
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.table_to_sheet(tabla);
        XLSX.utils.book_append_sheet(wb, ws, "Eventos");
        XLSX.writeFile(wb, "eventos.xlsx");
    });

    // Hacer la función visible globalmente
    window.cargarEventosTabla = cargarEventosTabla;

    // Carga inicial
    cargarEventosTabla();
});

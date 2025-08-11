document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');
    const modal = new bootstrap.Modal(document.getElementById('eventoModal'));

    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: 'obtener_eventos.php',

        dateClick: function(info) {
            const titulo = prompt("Título del evento:");
            if (titulo) {
                const descripcion = prompt("Descripción:");
                axios.post('guardar_evento.php', {
                    fecha: info.dateStr,
                    titulo: titulo,
                    descripcion: descripcion
                }).then(() => {
                    calendar.refetchEvents();
                });
            }
        },

        eventClick: function(info) {
            document.getElementById('eventoId').value = info.event.id;
            document.getElementById('tituloEvento').value = info.event.title;
            document.getElementById('descripcionEvento').value = info.event.extendedProps.description || '';
            modal.show();
        }
    });

    calendar.render();

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
        calendar.refetchEvents();
    }).catch(() => {
        alert("Error al guardar el evento.");
    });
});

    });

    document.getElementById('btnEliminar').addEventListener('click', () => {
        const id = document.getElementById('eventoId').value;

        if (confirm("¿Estás seguro de eliminar este evento?")) {
            axios.post('eliminar_evento.php', { id }).then(() => {
                modal.hide();
                calendar.refetchEvents();
            });
        }
    });


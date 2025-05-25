function editarSolicitud(solicitud) {
    document.getElementById('accion').value = 'modificar';
    document.getElementById('id_codigo').value = solicitud.id_codigo;
    document.getElementById('cliente').value = solicitud.cliente;
    document.getElementById('tecnico_asignado').value = solicitud.tecnico_asignado;
    document.getElementById('descripcion').value = solicitud.descripcion;
    document.getElementById('sede').value = solicitud.sede;
    document.getElementById('fecha').value = solicitud.fecha;
    document.getElementById('estado_ticket').value = solicitud.estado_ticket;
    document.getElementById('prioridad').value = solicitud.prioridad;

    const modal = new bootstrap.Modal(document.getElementById('solicitudModal'));
    modal.show();
}

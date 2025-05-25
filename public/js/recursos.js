function editarRecurso(recurso) {
    document.getElementById('accion').value = 'modificar';
    document.getElementById('codigo_de_herramientas').value = recurso.codigo_de_herramientas;
    document.getElementById('codigo_de_herramientas').readOnly = true;
    document.getElementById('nombre').value = recurso.nombre;
    document.getElementById('tipo_de_h').value = recurso.tipo_de_h;
    document.getElementById('herramientas').value = recurso.herramientas;
    document.getElementById('materiales').value = recurso.materiales;
    document.getElementById('disponibilidad').value = recurso.disponibilidad;
    document.getElementById('cantidad').value = recurso.cantidad;

    const modal = new bootstrap.Modal(document.getElementById('recursoModal'));
    modal.show();
}

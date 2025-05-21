function editarCliente(cliente) {
    document.getElementById('accion').value = 'modificar';
    document.getElementById('cedula').value = cliente.cedula;
    document.getElementById('cedula').readOnly = true;
    document.getElementById('nombre').value = cliente.nombre;
    document.getElementById('apellido').value = cliente.apellido;
    document.getElementById('correo').value = cliente.correo;
    document.getElementById('telefono').value = cliente.telefono;
    document.getElementById('direccion').value = cliente.direccion;
    document.getElementById('organizacion').value = cliente.organizacion;
    document.getElementById('sede').value = cliente.sede;

    const modal = new bootstrap.Modal(document.getElementById('clienteModal'));
    modal.show();
}

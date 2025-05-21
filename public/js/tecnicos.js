function editarTecnico(tecnico) {
    document.getElementById('accion').value = 'modificar';
    document.getElementById('cedula').value = tecnico.cedula;
    document.getElementById('cedula').readOnly = true;

    document.getElementById('nombre').value = tecnico.nombre;
    document.getElementById('apellido').value = tecnico.apellido;
    document.getElementById('cargo').value = tecnico.cargo;
    document.getElementById('direccion').value = tecnico.direccion;
    document.getElementById('correo').value = tecnico.correo;
    document.getElementById('telefono').value = tecnico.telefono;
    document.getElementById('cursos_realizados').value = tecnico.cursos_realizados;

    let modal = new bootstrap.Modal(document.getElementById('tecnicoModal'));
    modal.show();
}

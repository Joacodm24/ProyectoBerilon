function editarTaller(taller) {
    // Llenar el formulario con los datos del taller
    const form = document.querySelector('#tallerModal form');
    form.querySelector('input[name="accion"]').value = 'modificar';
    form.querySelector('input[name="codigo_taller"]').value = taller.codigo_taller;
    form.querySelector('input[name="encargado"]').value = taller.encargado;
    form.querySelector('input[name="participante"]').value = taller.participante;
    form.querySelector('input[name="correo"]').value = taller.correo;
    form.querySelector('input[name="fecha"]').value = taller.fecha;
    form.querySelector('input[name="hora"]').value = taller.hora;
    form.querySelector('textarea[name="descripcion_taller"]').value = taller.descripcion_taller;
    
    // Cambiar el título del modal
    document.getElementById('tallerModalLabel').textContent = 'Modificar Taller';
    
    // Mostrar el modal
    const modal = new bootstrap.Modal(document.getElementById('tallerModal'));
    modal.show();
}

// Resetear el formulario cuando se cierre el modal
document.getElementById('tallerModal').addEventListener('hidden.bs.modal', function () {
    const form = this.querySelector('form');
    form.querySelector('input[name="accion"]').value = 'crear';
    document.getElementById('tallerModalLabel').textContent = 'Registrar Taller';
    form.reset();
});

// Validación para fecha y hora
document.querySelector('#tallerModal form').addEventListener('submit', function(e) {
    const fechaInput = this.querySelector('input[name="fecha"]');
    const horaInput = this.querySelector('input[name="hora"]');
    const fechaHoy = new Date();
    const fechaSeleccionada = new Date(fechaInput.value);
    
    // Validar que la fecha no sea pasada
    fechaSeleccionada.setHours(0, 0, 0, 0);
    fechaHoy.setHours(0, 0, 0, 0);
    
    if (fechaSeleccionada < fechaHoy) {
        e.preventDefault();
        alert('La fecha del taller no puede ser anterior al día actual');
        fechaInput.focus();
        return;
    }
    
    // Validar que si es hoy, la hora no sea pasada
    if (fechaSeleccionada.getTime() === fechaHoy.getTime()) {
        const horaActual = new Date();
        const [horas, minutos] = horaInput.value.split(':');
        const horaSeleccionada = new Date();
        horaSeleccionada.setHours(horas, minutos, 0, 0);
        
        if (horaSeleccionada < horaActual) {
            e.preventDefault();
            alert('Para talleres hoy, la hora debe ser futura');
            horaInput.focus();
        }
    }
});
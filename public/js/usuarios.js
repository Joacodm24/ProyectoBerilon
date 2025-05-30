document.addEventListener('DOMContentLoaded', () => {
  // Inicializar la tabla de usuarios con DataTables
  const tabla = new DataTable('#tablaUsuarios', {
    ajax: {
      url: 'index.php?pagina=usuarios',
      type: 'POST',
      data: { accion: 'listar' },
      dataSrc: 'data'
    },
    responsive: true,
    columns: [
      { data: 'id', visible: false }, // ID oculto, no visible en tabla
      { data: 'nombre' },
      { data: 'usuario' },
      { data: 'contrasena' },
      { data: 'cargo' },
      {
        data: null,
        render: (data, type, row) => `
          <button class="btn btn-sm btn-warning me-2 btn-editar" data-usuario='${JSON.stringify(row)}'>
            <i class="bi bi-pencil"></i>
          </button>
          <button class="btn btn-sm btn-danger btn-eliminar" data-id="${row.id}">
            <i class="bi bi-trash"></i>
          </button>
        `
      }
    ],
    language: { url: 'public/DataTables/es-ES.json' }
  });

  // Referencias al formulario y modal
  const formUsuario = document.getElementById('formUsuario');
  const modalUsuario = new bootstrap.Modal(document.getElementById('usuarioModal'));

  // Inputs y mensajes de error
  const inputContrasena = formUsuario.querySelector('#contrasena');
  const errorContrasena = formUsuario.querySelector('#scontrasena');

  // Validación en tiempo real para la contraseña
  inputContrasena.addEventListener('input', () => {
    if (inputContrasena.value.length === 0 || inputContrasena.value.length >= 6) {
      inputContrasena.classList.remove('is-invalid');
      inputContrasena.classList.add('is-valid');
      errorContrasena.textContent = '';
    } else {
      inputContrasena.classList.remove('is-valid');
      inputContrasena.classList.add('is-invalid');
      errorContrasena.textContent = 'La contraseña debe tener al menos 6 caracteres.';
    }
  });

  // Enviar formulario (crear o modificar usuario)
  formUsuario.addEventListener('submit', e => {
    e.preventDefault();

    // Validar contraseña antes de enviar
    if (inputContrasena.value.length > 0 && inputContrasena.value.length < 6) {
      inputContrasena.focus();
      errorContrasena.textContent = 'La contraseña debe tener al menos 6 caracteres.';
      inputContrasena.classList.add('is-invalid');
      return;
    }

    // Enviar datos al servidor
    fetch('index.php?pagina=usuarios', {
      method: 'POST',
      body: new FormData(formUsuario)
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          modalUsuario.hide();
          tabla.ajax.reload(null, false);
          formUsuario.reset();
          formUsuario.accion.value = 'crear';
          formUsuario.id.value = '';
          inputContrasena.classList.remove('is-valid', 'is-invalid');
          errorContrasena.textContent = '';
        } else {
          mostrarAlertaBootstrap(data.error || 'Ocurrió un error.');
        }
      })
      .catch(() => mostrarAlertaBootstrap('Error de conexión o servidor.'));
  });

  // Delegar eventos para botones Editar y Eliminar en la tabla
  document.querySelector('#tablaUsuarios tbody').addEventListener('click', e => {
    const btnEditar = e.target.closest('.btn-editar');
    const btnEliminar = e.target.closest('.btn-eliminar');

    if (btnEditar) {
      const usuario = JSON.parse(btnEditar.getAttribute('data-usuario'));
      formUsuario.accion.value = 'modificar';
      formUsuario.id.value = usuario.id;
      formUsuario.nombre.value = usuario.nombre;
      formUsuario.usuario.value = usuario.usuario;
      formUsuario.cargo.value = usuario.cargo;
      formUsuario.contrasena.value = usuario.contrasena;
      inputContrasena.classList.remove('is-valid', 'is-invalid');
      errorContrasena.textContent = '';
      modalUsuario.show();
    }

    if (btnEliminar) {
      const id = btnEliminar.getAttribute('data-id');
      if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        const formData = new FormData();
        formData.append('accion', 'eliminar');
        formData.append('id', id);

        fetch('index.php?pagina=usuarios', {
          method: 'POST',
          body: formData
        })
          .then(res => res.json())
          .then(data => {
            if (data.success) {
              tabla.ajax.reload(null, false);
            } else {
              mostrarAlertaBootstrap(data.error || 'Error al eliminar el usuario.');
            }
          })
          .catch(() => mostrarAlertaBootstrap('Error de conexión o servidor.'));
      }
    }
  });

  // Función para mostrar alertas con Bootstrap (mensaje visual)
  function mostrarAlertaBootstrap(mensaje) {
    let contenedor = document.getElementById('alertaUsuarios');
    if (!contenedor) {
      contenedor = document.createElement('div');
      contenedor.id = 'alertaUsuarios';
      contenedor.className = 'alert alert-danger alert-dismissible fade show';
      contenedor.role = 'alert';
      contenedor.style.position = 'fixed';
      contenedor.style.top = '20px';
      contenedor.style.right = '20px';
      contenedor.style.zIndex = '1055';
      document.body.appendChild(contenedor);
    }
    contenedor.innerHTML = `
      ${mensaje}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    contenedor.classList.add('show');
  }
});

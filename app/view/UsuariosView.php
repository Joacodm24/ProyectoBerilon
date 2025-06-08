<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">
        <i class="bi bi-person-circle me-2 text-primary"></i>Gestión de Usuarios
    </h2>

    <!-- Botón Nuevo Usuario -->
    <div class="mb-4 text-center">
        <button class="btn btn-primary px-4 shadow-sm" id="btnNuevoUsuario" data-bs-toggle="modal" data-bs-target="#usuarioModal">
            <i class="bi bi-person-plus-fill me-2"></i>Nuevo Usuario
        </button>
    </div>

    <!-- Modal de Usuario (Crear/Modificar) -->
    <div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <form id="formUsuario">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="usuarioModalLabel">Registrar Usuario</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <input type="hidden" name="id" id="id"> <!-- Campo oculto para el ID del usuario -->

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100">
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <div class="input-group"> <!-- INICIO: Grupo de entrada para el toggle -->
                                <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Mínimo 6 caracteres" minlength="6" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye-fill"></i> <!-- Icono de ojo -->
                                </button>
                            </div> <!-- FIN: Grupo de entrada -->
                            <small class="form-text text-muted">Mínimo 6 caracteres.</small>
                            <span id="scontrasena" class="text-danger small"></span>
                        </div>
                        <div class="mb-3">
                            <label for="cargo" class="form-label">Cargo</label>
                            <select name="cargo" id="cargo" class="form-select" required>
                                <option value="">Seleccione un cargo</option>
                                <option value="Coordinador">Coordinador Técnico</option>
                                <option value="Técnico">Técnico</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Eliminar -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content shadow">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="confirmModalLabel">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                    <input type="hidden" id="confirmIdToDelete">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN: Modal de Confirmación -->

    <!-- Tabla de Usuarios -->
    <div class="card shadow-sm">
        <div class="card-header text-white bg-dark text-center fw-semibold">
            <i class="bi bi-table me-2"></i>Lista de Usuarios
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="tablaUsuarios" class="table table-bordered table-hover table-striped align-middle mb-0 display nowrap" style="width:100%">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID</th> <!-- Oculto por JS -->
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Cargo</th> <!-- La contraseña no se muestra en la tabla por seguridad -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <!-- Contenido generado por AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/usuarios.js"></script>

</body>
</html>

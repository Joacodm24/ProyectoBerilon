<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
    <link rel="stylesheet" href="public/DataTables/datatables.min.css">
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">Gestión de Usuarios</h2>

    <div class="mb-4 text-center">
        <button class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#usuarioModal">
            <i class="bi bi-plus-circle me-2"></i>Nuevo Usuario
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="usuarioModal" tabindex="-1" aria-labelledby="usuarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <form id="formUsuario">
                    <div id="alertaUsuario" class="alert alert-danger d-none" role="alert"></div>
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="usuarioModalLabel">Registrar Usuario</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <input type="hidden" name="id" id="id">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Completo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control" required>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card shadow-sm">
        <div class="card-header text-white bg-dark text-center fw-semibold">Lista de Usuarios</div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="tablaUsuarios" class="table table-bordered table-hover table-striped align-middle mb-0 display nowrap" style="width:100%">
                    <thead class="table-dark text-center">
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Contraseña</th>
                            <th>Cargo</th>
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
<script src="public/DataTables/datatables.min.js"></script>
<script src="public/js/usuarios.js"></script>

</body>
</html>

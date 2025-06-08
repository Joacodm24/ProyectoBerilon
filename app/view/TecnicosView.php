<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Personal Técnico</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
</head>

<body>

<?php include_once __DIR__ . '/layouts/navbar.php'; ?>

<div class="container py-4">
    <h2 class="text-center mb-4 text-dark fw-bold">
        <i class="bi bi-tools text-primary me-2"></i>Gestión de Personal Técnico
    </h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Botón registrar técnico -->
    <div class="text-center mb-4">
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#tecnicoModal">
            <i class="bi bi-person-plus-fill me-2"></i>Registrar Técnico
        </button>
    </div>

    <!-- Modal de técnico (para crear/modificar) -->
    <div class="modal fade" id="tecnicoModal" tabindex="-1" aria-labelledby="tecnicoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <form id="formTecnico">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="tecnicoModalLabel">
                            <i class="bi bi-person-lines-fill me-2"></i>Registrar Técnico
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" name="cedula" id="cedula" class="form-control" required maxlength="15">
                            </div>
                            <div class="col-md-4">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="50">
                            </div>
                            <div class="col-md-4">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" required maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label for="cargo" class="form-label">Cargo</label>
                                <select name="cargo" id="cargo" class="form-select" required>
                                    <option value="">Seleccione un cargo</option>
                                    <option value="Coordinador Técnico">Coordinador Técnico</option>
                                    <option value="Técnico Integral">Técnico Integral</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" name="correo" id="correo" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" name="telefono" id="telefono" class="form-control" maxlength="20">
                            </div>
                            <div class="col-md-6">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control" maxlength="255">
                            </div>
                            <div class="col-12">
                                <label for="especializacion" class="form-label">Especialización</label>
                                <textarea name="especializacion" id="especializacion" class="form-control" rows="3" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Técnico
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
                <p>¿Estás seguro de que deseas eliminar este registro?</p>
                <!-- ¡CAMBIO CRÍTICO AQUÍ! De confirmCedulaToDelete a confirmIdToDelete -->
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

    <!-- Tabla de técnicos -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-table me-2"></i>Lista de Técnicos
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaTecnicos" class="table table-hover table-bordered align-middle nowrap w-100">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cargo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Especialización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Datos cargados dinámicamente por JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/tecnicos.js"></script>

</body>
</html>

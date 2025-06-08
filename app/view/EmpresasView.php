<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Empresas</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
</head>

<body>

<?php include_once __DIR__ . '/layouts/navbar.php'; ?>

<div class="container py-4">
    <h2 class="text-center mb-4 text-dark fw-bold">
        <i class="bi bi-building-fill-gear text-success me-2"></i>Gestión de Empresas
    </h2>

    <!-- Botón para registrar empresa -->
    <div class="text-center mb-4">
        <button class="btn btn-primary shadow-sm" id="btnNuevaEmpresa" data-bs-toggle="modal" data-bs-target="#empresaModal">
            <i class="bi bi-building-add me-2"></i>Registrar Empresa
        </button>
    </div>

    <!-- Modal de empresa (para crear/modificar) -->
    <div class="modal fade" id="empresaModal" tabindex="-1" aria-labelledby="empresaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <form id="formEmpresa">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="empresaModalLabel">
                            <i class="bi bi-building-add me-2"></i>Registrar Empresa
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campo oculto para acción -->
                        <input type="hidden" name="accion" id="accion" value="crear">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="RIF" class="form-label">RIF</label>
                                <input type="text" name="RIF" id="RIF" class="form-control" required maxlength="20">
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-12">
                                <label for="direccion_fiscal" class="form-label">Dirección Fiscal</label>
                                <input type="text" name="direccion_fiscal" id="direccion_fiscal" class="form-control" maxlength="255">
                            </div>
                            <div class="col-md-6">
                                <label for="numero_telefono" class="form-label">Número de Teléfono</label>
                                <input type="text" name="numero_telefono" id="numero_telefono" class="form-control" maxlength="20">
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Empresa
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
                    <p>¿Estás seguro de que deseas eliminar este registro de empresa?</p>
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

    <!-- Tabla de empresas -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-table me-2"></i>Lista de Empresas
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaEmpresas" class="table table-hover table-bordered align-middle nowrap w-100">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>RIF</th>
                            <th>Nombre</th>
                            <th>Dirección Fiscal</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Datos cargados por AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/empresas.js"></script>

</body>
</html>

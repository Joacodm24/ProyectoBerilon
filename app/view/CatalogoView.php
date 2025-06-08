<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Catálogo</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center fw-bold">
        <i class="bi bi-box-seam-fill me-2 text-info"></i>Gestión de Catálogo
    </h2>

    <!-- Botón para abrir modal -->
    <div class="mb-3 text-center">
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#catalogoModal" id="btnNuevoCatalogo">
            <i class="bi bi-plus-circle-fill me-2"></i> Registrar Ítem
        </button>
    </div>

    <!-- Modal de Catálogo (para crear/modificar) -->
    <div class="modal fade" id="catalogoModal" tabindex="-1" aria-labelledby="catalogoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg">
                <form id="formCatalogo">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="catalogoModalLabel">Registrar Ítem del Catálogo</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="codigo_de_herramienta" class="form-label">Código de Herramienta</label>
                                <input type="text" name="codigo_de_herramienta" id="codigo_de_herramienta" class="form-control" required maxlength="20">
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select name="tipo" id="tipo" class="form-select"> 
                                    <option value="">Seleccione el Tipo</option>
                                    <option value="Material">Material</option>
                                    <option value="Herramienta">Herramienta</option>
                                    <option value="Equipo">Equipo</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                                <input type="number" name="cantidad_disponible" id="cantidad_disponible" class="form-control" min="0" required>
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Ítem
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación para Eliminar (Reutilizado) -->
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
                    <p>¿Estás seguro de que deseas eliminar este ítem del catálogo?</p>
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

    <!-- Tabla de catálogo -->
    <div class="card shadow-sm mt-4">
        <div class="card-header text-white bg-dark text-center fw-semibold">
            <i class="bi bi-table me-2"></i>Lista de Ítems del Catálogo
        </div>
        <div class="card-body p-3">
            <div class="table-responsive">
                <table id="tablaCatalogo" class="table table-bordered table-hover table-striped align-middle mb-0 display nowrap" style="width:100%">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Cantidad Disponible</th>
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
<script src="public/js/catalogo.js"></script>

</body>
</html>

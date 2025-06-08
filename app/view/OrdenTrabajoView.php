<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Órdenes de Trabajo</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
</head>

<body>

<?php include_once __DIR__ . '/layouts/navbar.php'; ?>

<div class="container py-4">
    <h2 class="text-center mb-4 text-dark fw-bold">
        <i class="bi bi-briefcase-fill text-info me-2"></i>Gestión de Órdenes de Trabajo
    </h2>

    <!-- Botón Único para Registrar Orden de Trabajo -->
    <div class="text-center mb-4">
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#ordenTrabajoModal">
            <i class="bi bi-plus-circle-fill me-2"></i>Registrar Orden de Trabajo
        </button>
    </div>

    <!-- Modal Principal de Orden de Trabajo (para crear/modificar) -->
    <div class="modal fade" id="ordenTrabajoModal" tabindex="-1" aria-labelledby="ordenTrabajoModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <form id="formOrdenTrabajo">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="ordenTrabajoModalLabel">
                            <i class="bi bi-file-earmark-text-fill me-2"></i>Registrar Orden de Trabajo
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <input type="hidden" name="id_orden" id="id_orden">
                        <div class="row g-3">
                            <!-- Sección para Solicitud -->
                            <div class="col-md-6">
                                <label for="solicitud_id" class="form-label">ID Solicitud</label>
                                <div class="input-group">
                                    <input type="number" name="solicitud_id" id="solicitud_id" class="form-control" required placeholder="ID Solicitud" readonly>
                                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#solicitudSelectionModal">
                                        <i class="bi bi-search"></i> Buscar Solicitud
                                    </button>
                                </div>
                                <small class="form-text text-muted">Seleccione una solicitud para auto-rellenar.</small>
                            </div>
                            <!-- Datos del Cliente/Empresa y Descripción de Solicitud (se auto-rellenarán) -->
                            <div class="col-md-6">
                                <label for="cliente_nombre" class="form-label">Cliente/Empresa</label>
                                <input type="text" id="cliente_nombre" class="form-control" readonly placeholder="Nombre del Cliente/Empresa">
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_identificacion" class="form-label">Cédula/RIF</label>
                                <input type="text" id="cliente_identificacion" class="form-control" readonly placeholder="V-12345678 / J-12345678-0">
                            </div>
                            <div class="col-md-6">
                                <label for="solicitud_descripcion" class="form-label">Descripción Solicitud</label>
                                <textarea id="solicitud_descripcion" class="form-control" rows="2" readonly placeholder="Descripción de la solicitud"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="direccion_visita" class="form-label">Dirección de Visita</label>
                                <input type="text" name="direccion_visita" id="direccion_visita" class="form-control" required maxlength="255" placeholder="Dirección de la visita" readonly>
                                <small class="form-text text-muted">Esta dirección se auto-rellena y no es modificable.</small>
                            </div>

                            <!-- Separador entre Solicitud y Técnico -->
                            <div class="col-12"><hr class="my-4"></div>

                            <!-- Sección para Técnico -->
                            <div class="col-md-6">
                                <label for="tecnico_cedula" class="form-label">Cédula Técnico</label>
                                <div class="input-group">
                                    <input type="text" name="tecnico_cedula" id="tecnico_cedula" class="form-control" required maxlength="15" placeholder="Cédula Técnico" readonly>
                                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#tecnicoSelectionModal">
                                        <i class="bi bi-search"></i> Asignar Técnico
                                    </button>
                                </div>
                                <small class="form-text text-muted">Seleccione un técnico para auto-rellenar.</small>
                            </div>
                            <!-- Datos del Técnico  -->
                            <div class="col-md-6">
                                <label for="tecnico_nombre" class="form-label">Nombre Técnico</label>
                                <input type="text" id="tecnico_nombre" class="form-control" readonly placeholder="Nombre del Técnico">
                            </div>
                            <div class="col-md-6">
                                <label for="tecnico_telefono" class="form-label">Teléfono Técnico</label>
                                <input type="text" id="tecnico_telefono" class="form-control" readonly placeholder="Teléfono del Técnico">
                            </div>

                            <!-- Separador entre Técnico y Herramientas -->
                            <div class="col-12"><hr class="my-4"></div>

                            <!-- Sección para Herramientas -->
                            <div class="col-md-6">
                                <label for="codigo_herramienta_asignada" class="form-label">Código Herramienta</label>
                                <div class="input-group">
                                    <input type="text" name="codigo_herramienta_asignada" id="codigo_herramienta_asignada" class="form-control" maxlength="20" placeholder="Código Herramienta" readonly>
                                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#herramientaSelectionModal">
                                        <i class="bi bi-search"></i> Asignar Herramienta
                                    </button>
                                </div>
                                <small class="form-text text-muted">Seleccione una herramienta (opcional).</small>
                            </div>
                            <!-- Datos de la Herramienta -->
                            <div class="col-md-6">
                                <label for="herramienta_nombre" class="form-label">Nombre Herramienta</label>
                                <input type="text" id="herramienta_nombre" class="form-control" readonly placeholder="Nombre de la Herramienta">
                            </div>
                            <div class="col-md-6">
                                <label for="herramienta_descripcion" class="form-label">Descripción Herramienta</label>
                                <textarea id="herramienta_descripcion" class="form-control" rows="2" readonly placeholder="Descripción de la Herramienta"></textarea>
                            </div>

                            <!-- eparador-->
                            <div class="col-12"><hr class="my-4"></div>

                            <!-- Otros campos de la Orden de Trabajo -->
                            <div class="col-md-6">
                                <label for="fecha_visita" class="form-label">Fecha de Visita</label>
                                <input type="date" name="fecha_visita" id="fecha_visita" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="estado_planificacion" class="form-label">Estado de Planificación</label>
                                <select name="estado_planificacion" id="estado_planificacion" class="form-select" required>
                                    <option value="">Seleccione un estado</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="Asignada">Asignada</option>
                                    <option value="En Curso">En Curso</option>
                                    <option value="Completada">Completada</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="tipo_de_trabajo" class="form-label">Tipo de Trabajo</label>
                                <select name="tipo_de_trabajo" id="tipo_de_trabajo" class="form-select" required>
                                    <option value="">Seleccione un tipo de trabajo</option>
                                    <option value="Inspección de servicio">Inspección de servicio</option>
                                    <option value="Realización de servicio">Realización de servicio</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="observaciones" class="form-label">Observaciones</label>
                                <textarea name="observaciones" id="observaciones" class="form-control" rows="3" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Orden
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Anidado para Selección de Solicitud (Tablas vacías) -->
    <div class="modal fade" id="solicitudSelectionModal" tabindex="-1" aria-labelledby="solicitudSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="solicitudSelectionModalLabel">
                        <i class="bi bi-list-check me-2"></i>Seleccionar Solicitud
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo Cliente</th>
                                    <th>Cliente/Empresa</th>
                                    <th>Descripción</th>
                                    <th>Dirección</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- La tabla estará vacía -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Anidado para Selección de Técnico (Tablas vacías) -->
    <div class="modal fade" id="tecnicoSelectionModal" tabindex="-1" aria-labelledby="tecnicoSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="tecnicoSelectionModalLabel">
                        <i class="bi bi-person-gear me-2"></i>Asignar Técnico
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Especialidad</th>
                                    <th>Teléfono</th>
                                    <th>Disponibilidad</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- La tabla estará vacía -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Anidado para Selección de Herramienta (Tablas vacías) -->
    <div class="modal fade" id="herramientaSelectionModal" tabindex="-1" aria-labelledby="herramientaSelectionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="herramientaSelectionModalLabel">
                        <i class="bi bi-tools me-2"></i>Asignar Herramienta
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle w-100">
                            <thead class="table-dark">
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- La tabla estará vacía -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
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

    <!-- Tabla de Órdenes de Trabajo -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-table me-2"></i>Lista de Órdenes de Trabajo
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaOrdenes" class="table table-hover table-bordered align-middle nowrap w-100">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID Orden</th>
                            <th>ID Solicitud</th>
                            <th>Cédula Técnico</th>
                            <th>Código Herramienta</th>
                            <th>Fecha Visita</th>
                            <th>Dirección Visita</th>
                            <th>Estado</th>
                            <th>Tipo de Trabajo</th>
                            <th>Observaciones</th>
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
<script src="public/js/orden.js"></script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Solicitudes</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
</head>

<body>
<?php include_once __DIR__ . '/layouts/navbar.php'; ?>

<div class="container py-4">
    <h2 class="text-center mb-4 text-dark fw-bold">
        <i class="bi bi-file-earmark-text-fill text-primary me-2"></i>Gestión de Solicitudes
    </h2>

    <!-- Botones para registrar solicitud: Cliente Particular o Empresa -->
    <div class="text-center mb-4 d-flex justify-content-center flex-wrap gap-3">
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#clienteSolicitudModal" data-solicitud-tipo="cliente">
            <i class="bi bi-person-fill me-2"></i>Registrar Solicitud Cliente Particular
        </button>
        <button class="btn btn-info text-white shadow-sm" data-bs-toggle="modal" data-bs-target="#empresaSolicitudModal" data-solicitud-tipo="empresa">
            <i class="bi bi-building-fill me-2"></i>Registrar Solicitud Empresa
        </button>
    </div>

    <!-- Modal para Registrar Solicitud de CLIENTE PARTICULAR -->
    <div class="modal fade" id="clienteSolicitudModal" tabindex="-1" aria-labelledby="clienteSolicitudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <form id="formClienteSolicitud">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="clienteSolicitudModalLabel">
                            <i class="bi bi-person-fill me-2"></i>Registrar Solicitud Cliente Particular
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campos ocultos -->
                        <input type="hidden" name="accion" id="accionCliente" value="crear">
                        <input type="hidden" name="id_solicitud" id="id_solicitud_cliente">
                        <input type="hidden" name="empresa_rif" value=""> 
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="cedula_cliente" class="form-label">Cédula del Cliente</label>
                                <input type="text" name="cedula_cliente" id="cedula_cliente" class="form-control" required readonly placeholder="Se autocompleta al buscar cliente">
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_nombre" class="form-label">Nombre Cliente</label>
                                <input type="text" id="cliente_nombre" class="form-control" readonly placeholder="Se autocompleta al seleccionar cliente">
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_apellido" class="form-label">Apellido Cliente</label>
                                <input type="text" id="cliente_apellido" class="form-control" readonly placeholder="Se autocompleta al seleccionar cliente">
                            </div>
                            <div class="col-md-6">
                                <label for="cliente_telefono" class="form-label">Teléfono Cliente</label>
                                <input type="text" id="cliente_telefono" class="form-control" readonly placeholder="Se autocompleta al seleccionar cliente">
                            </div>
                             <div class="col-12">
                                <label for="cliente_direccion" class="form-label">Dirección Cliente</label>
                                <input type="text" id="cliente_direccion" class="form-control" readonly placeholder="Se autocompleta al seleccionar cliente">
                            </div>
                            <!-- Botón para abrir modal de selección de cliente (funcionalidad futura) -->
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-outline-primary mt-2 me-2" id="btnBuscarCliente" data-bs-toggle="modal" data-bs-target="#modalClientes">
                                    <i class="bi bi-search me-1"></i>Buscar Cliente
                                </button>
                            </div>
                        </div>

                        <!-- Datos de la solicitud -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fecha_cliente" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha_cliente" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prioridad_cliente" class="form-label">Prioridad</label>
                                <select name="prioridad" id="prioridad_cliente" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="estado_ticket_cliente" class="form-label">Estado del Ticket</label>
                                <select name="estado_ticket" id="estado_ticket_cliente" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="Abierto">Abierto</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Cerrado">Cerrado</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="descripcion_cliente" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion_cliente" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Solicitud
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Registrar Solicitud de EMPRESA -->
    <div class="modal fade" id="empresaSolicitudModal" tabindex="-1" aria-labelledby="empresaSolicitudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow">
                <form id="formEmpresaSolicitud">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="empresaSolicitudModalLabel">
                            <i class="bi bi-building-fill me-2"></i>Registrar Solicitud Empresa
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Campos ocultos -->
                        <input type="hidden" name="accion" id="accionEmpresa" value="crear">
                        <input type="hidden" name="id_solicitud" id="id_solicitud_empresa">
                        <input type="hidden" name="cedula_cliente" value=""> <!-- Siempre vacío para solicitudes de empresa -->
                        
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="empresa_rif" class="form-label">RIF de la Empresa</label>
                                <input type="text" name="empresa_rif" id="empresa_rif" class="form-control" required readonly placeholder="Se autocompleta al buscar empresa">
                            </div>
                            <div class="col-md-6">
                                <label for="empresa_nombre" class="form-label">Nombre Empresa</label>
                                <input type="text" id="empresa_nombre" class="form-control" readonly placeholder="Se autocompleta al seleccionar empresa">
                            </div>
                            <div class="col-md-6">
                                <label for="empresa_telefono" class="form-label">Teléfono Empresa</label>
                                <input type="text" id="empresa_telefono" class="form-control" readonly placeholder="Se autocompleta al seleccionar empresa">
                            </div>
                            <div class="col-12">
                                <label for="empresa_direccion_fiscal" class="form-label">Dirección Fiscal Empresa</label>
                                <input type="text" id="empresa_direccion_fiscal" class="form-control" readonly placeholder="Se autocompleta al seleccionar empresa">
                            </div>
                            
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-outline-info mt-2" id="btnBuscarEmpresa" data-bs-toggle="modal" data-bs-target="#modalEmpresas">
                                    <i class="bi bi-search me-1"></i>Buscar Empresa
                                </button>
                            </div>
                        </div>

                        <!-- Datos de la solicitud (comunes) -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fecha_empresa" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha_empresa" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prioridad_empresa" class="form-label">Prioridad</label>
                                <select name="prioridad" id="prioridad_empresa" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Media">Media</option>
                                    <option value="Baja">Baja</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="estado_ticket_empresa" class="form-label">Estado del Ticket</label>
                                <select name="estado_ticket" id="estado_ticket_empresa" class="form-select" required>
                                    <option value="">Seleccione</option>
                                    <option value="Abierto">Abierto</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Cerrado">Cerrado</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="descripcion_empresa" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion_empresa" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save2-fill me-1"></i>Guardar Solicitud
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar cliente (Diseño para futuro uso) -->
    <div class="modal fade" id="modalClientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-person-lines-fill me-2"></i>Seleccionar Cliente
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaSeleccionarCliente" class="table table-hover table-bordered align-middle nowrap w-100">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Organización</th>
                                    <th>Sede</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Carga dinámica por AJAX (futura implementación) -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para seleccionar empresa (Diseño para futuro uso) -->
    <div class="modal fade" id="modalEmpresas" tabindex="-1" aria-labelledby="modalEmpresasLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-building-fill me-2"></i>Seleccionar Empresa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaSeleccionarEmpresa" class="table table-hover table-bordered align-middle nowrap w-100">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>RIF</th>
                                    <th>Nombre</th>
                                    <th>Dirección Fiscal</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Seleccionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Carga dinámica por AJAX (futura implementación) -->
                            </tbody>
                        </table>
                    </div>
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
                    <p>¿Estás seguro de que deseas eliminar esta solicitud?</p>
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

    <!-- Tabla de solicitudes -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-dark text-white">
            <i class="bi bi-table me-2"></i>Lista de Solicitudes
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaSolicitudes" class="table table-hover table-bordered align-middle nowrap w-100">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>ID Solicitud</th>
                            <th>Cédula Cliente</th>
                            <th>RIF Empresa</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Prioridad</th>
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
<script src="public/js/solicitudes.js"></script>

</body>
</html>

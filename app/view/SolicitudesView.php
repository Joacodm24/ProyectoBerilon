<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Solicitudes</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Gestión de Solicitudes</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="mb-3 text-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#solicitudModal">
            <i class="bi bi-plus-circle"></i> Nueva Solicitud
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="solicitudModal" tabindex="-1" aria-labelledby="solicitudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="solicitudModalLabel">Registrar Solicitud</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <input type="hidden" name="id_codigo" id="id_codigo">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="cliente" class="form-label">Cédula del Cliente</label>
                                <input type="text" name="cliente" id="cliente" class="form-control" required maxlength="15">
                            </div>
                            <div class="col-md-6">
                                <label for="tecnico_asignado" class="form-label">Cédula del Técnico</label>
                                <input type="text" name="tecnico_asignado" id="tecnico_asignado" class="form-control" required maxlength="15">
                            </div>
                            <div class="col-md-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="sede" class="form-label">Sede</label>
                                <input type="text" name="sede" id="sede" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="estado_ticket" class="form-label">Estado</label>
                                <select name="estado_ticket" id="estado_ticket" class="form-select" required>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Completado">Completado</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="prioridad" class="form-label">Prioridad</label>
                                <select name="prioridad" id="prioridad" class="form-select" required>
                                    <option value="Baja">Baja</option>
                                    <option value="Media">Media</option>
                                    <option value="Alta">Alta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Solicitud</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card">
        <div class="card-header">Lista de Solicitudes</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Técnico</th>
                        <th>Descripción</th>
                        <th>Sede</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Prioridad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($solicitudes)): ?>
                        <?php foreach ($solicitudes as $solicitud): ?>
                            <tr>
                                <td><?= htmlspecialchars($solicitud['id_codigo']) ?></td>
                                <td><?= htmlspecialchars($solicitud['cliente']) ?></td>
                                <td><?= htmlspecialchars($solicitud['tecnico_asignado']) ?></td>
                                <td><?= htmlspecialchars($solicitud['descripcion']) ?></td>
                                <td><?= htmlspecialchars($solicitud['sede']) ?></td>
                                <td><?= htmlspecialchars($solicitud['fecha']) ?></td>
                                <td><?= htmlspecialchars($solicitud['estado_ticket']) ?></td>
                                <td><?= htmlspecialchars($solicitud['prioridad']) ?></td>
                                <td class="text-nowrap">
                                    <form action="" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta solicitud?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="id_codigo" value="<?= htmlspecialchars($solicitud['id_codigo']) ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-warning" onclick='editarSolicitud(<?= json_encode($solicitud) ?>)' title="Modificar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-center">No hay solicitudes registradas.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/Solicitudes.js"></script>

</body>
</html>

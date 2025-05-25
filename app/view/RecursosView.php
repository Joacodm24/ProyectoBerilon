<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Recursos Tecnológicos</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Gestión de Recursos Tecnológicos</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Botón para abrir modal -->
    <div class="mb-3 text-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recursoModal">
            <i class="bi bi-plus-circle"></i> Registrar Recurso
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="recursoModal" tabindex="-1" aria-labelledby="recursoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="recursoModalLabel">Registrar Recurso Tecnológico</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="codigo_de_herramientas" class="form-label">Código</label>
                                <input type="text" name="codigo_de_herramientas" id="codigo_de_herramientas" class="form-control" required maxlength="20">
                            </div>
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label for="tipo_de_h" class="form-label">Tipo de Herramienta</label>
                                <input type="text" name="tipo_de_h" id="tipo_de_h" class="form-control" maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label for="disponibilidad" class="form-label">Disponibilidad</label>
                                <input type="text" name="disponibilidad" id="disponibilidad" class="form-control" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" name="cantidad" id="cantidad" class="form-control" min="0">
                            </div>
                            <div class="col-12">
                                <label for="herramientas" class="form-label">Herramientas</label>
                                <textarea name="herramientas" id="herramientas" class="form-control" rows="2" maxlength="1000"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="materiales" class="form-label">Materiales</label>
                                <textarea name="materiales" id="materiales" class="form-control" rows="2" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Recurso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla de recursos -->
    <div class="card mt-4">
        <div class="card-header">Lista de Recursos Tecnológicos</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Herramientas</th>
                        <th>Materiales</th>
                        <th>Disponibilidad</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recursos)): ?>
                        <?php foreach ($recursos as $recurso): ?>
                            <tr>
                                <td><?= htmlspecialchars($recurso['codigo_de_herramientas']) ?></td>
                                <td><?= htmlspecialchars($recurso['nombre']) ?></td>
                                <td><?= htmlspecialchars($recurso['tipo_de_h']) ?></td>
                                <td><?= htmlspecialchars($recurso['herramientas']) ?></td>
                                <td><?= htmlspecialchars($recurso['materiales']) ?></td>
                                <td><?= htmlspecialchars($recurso['disponibilidad']) ?></td>
                                <td><?= htmlspecialchars($recurso['cantidad']) ?></td>
                                <td class="text-nowrap">
                                    <form action="" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este recurso?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="codigo_de_herramientas" value="<?= htmlspecialchars($recurso['codigo_de_herramientas']) ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-warning" onclick='editarRecurso(<?= json_encode($recurso) ?>)' title="Modificar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="8" class="text-center">No hay recursos registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/recursos.js"></script>

</body>
</html>

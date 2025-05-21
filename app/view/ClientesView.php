<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Gestión de Clientes</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Botón para abrir modal centrado -->
    <div class="mb-3 text-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#clienteModal">
            <i class="bi bi-person-plus-fill me-2"></i> Registrar Cliente
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="clienteModalLabel">Registrar Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
                            <div class="col-md-3">
                                <label for="organizacion" class="form-label">Organización</label>
                                <input type="text" name="organizacion" id="organizacion" class="form-control" maxlength="100">
                            </div>
                            <div class="col-md-3">
                                <label for="sede" class="form-label">Sede</label>
                                <input type="text" name="sede" id="sede" class="form-control" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla de clientes -->
<div class="card">
    <div class="card-header">Lista de Clientes</div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Organización</th>
                    <th>Sede</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?= htmlspecialchars($cliente['cedula']) ?></td>
                            <td><?= htmlspecialchars($cliente['nombre']) ?></td>
                            <td><?= htmlspecialchars($cliente['apellido']) ?></td>
                            <td><?= htmlspecialchars($cliente['correo']) ?></td>
                            <td><?= htmlspecialchars($cliente['telefono']) ?></td>
                            <td><?= htmlspecialchars($cliente['direccion']) ?></td>
                            <td><?= htmlspecialchars($cliente['organizacion']) ?></td>
                            <td><?= htmlspecialchars($cliente['sede']) ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <form action="" method="POST" onsubmit="return confirm('¿Deseas eliminar este cliente?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="cedula" value="<?= htmlspecialchars($cliente['cedula']) ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-warning" title="Modificar" onclick='editarCliente(<?= json_encode($cliente) ?>)'>
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="9" class="text-center">No hay clientes registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Bootstrap JS y script externo -->
<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/clientes.js"></script>

</body>
</html>

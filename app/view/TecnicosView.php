<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Personal Técnico</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Gestión de Personal Técnico</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Botón para abrir modal -->
    <div class="mb-3 text-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tecnicoModal">
            <i class="bi bi-person-plus-fill"></i> Registrar Técnico
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tecnicoModal" tabindex="-1" aria-labelledby="tecnicoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tecnicoModalLabel">Registrar Técnico</h5>
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
                                <label for="cargo" class="form-label">Cargo</label>
                                <input type="text" name="cargo" id="cargo" class="form-control" maxlength="50">
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
                                <label for="cursos_realizados" class="form-label">Cursos Realizados</label>
                                <textarea name="cursos_realizados" id="cursos_realizados" class="form-control" rows="3" maxlength="1000"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Técnico</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla de técnicos -->
    <div class="card">
        <div class="card-header">Lista de Técnicos</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cargo</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Cursos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tecnicos)): ?>
                        <?php foreach ($tecnicos as $tecnico): ?>
                            <tr>
                                <td><?= htmlspecialchars($tecnico['cedula']) ?></td>
                                <td><?= htmlspecialchars($tecnico['nombre']) ?></td>
                                <td><?= htmlspecialchars($tecnico['apellido']) ?></td>
                                <td><?= htmlspecialchars($tecnico['cargo']) ?></td>
                                <td><?= htmlspecialchars($tecnico['correo']) ?></td>
                                <td><?= htmlspecialchars($tecnico['telefono']) ?></td>
                                <td><?= htmlspecialchars($tecnico['direccion']) ?></td>
                                <td><?= htmlspecialchars($tecnico['cursos_realizados']) ?></td>
                                <td class="text-nowrap">
                                    <form action="" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar este técnico?');">
                                        <input type="hidden" name="accion" value="eliminar">
                                        <input type="hidden" name="cedula" value="<?= htmlspecialchars($tecnico['cedula']) ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-warning" onclick='editarTecnico(<?= json_encode($tecnico) ?>)' title="Modificar">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="9" class="text-center">No hay técnicos registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once __DIR__ . '/layouts/scripts.php'; ?>
<script src="public/js/tecnicos.js"></script>

</body>
</html>

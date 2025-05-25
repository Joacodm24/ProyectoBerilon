<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Talleres</title>
    <?php include_once __DIR__ . '/layouts/head.php'; ?>
    <?php include_once __DIR__ . '/layouts/navbar.php'; ?>
</head>

<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Gestión de Talleres</h2>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Botón para abrir modal centrado -->
    <div class="mb-3 text-center">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tallerModal">
            <i class="bi bi-plus-circle-fill me-2"></i> Registrar Taller
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="tallerModal" tabindex="-1" aria-labelledby="tallerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tallerModalLabel">Registrar Taller</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="accion" id="accion" value="crear">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="codigo_taller" class="form-label">Código del Taller</label>
                                <input type="text" name="codigo_taller" id="codigo_taller" class="form-control" required maxlength="20">
                            </div>
                            <div class="col-md-4">
                                <label for="encargado" class="form-label">Encargado</label>
                                <input type="text" name="encargado" id="encargado" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label for="participante" class="form-label">Participante</label>
                                <input type="text" name="participante" id="participante" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" name="correo" id="correo" class="form-control" required maxlength="100">
                            </div>
                            <div class="col-md-3">
                                <label for="fecha" class="form-label">Fecha</label>
                                <input type="date" name="fecha" id="fecha" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" name="hora" id="hora" class="form-control" required>
                            </div>
                            <div class="col-12">
                                <label for="descripcion_taller" class="form-label">Descripción</label>
                                <textarea name="descripcion_taller" id="descripcion_taller" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Taller</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Tabla de talleres -->
    <div class="card">
        <div class="card-header">Lista de Talleres</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Encargado</th>
                        <th>Participante</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($talleres)): ?>
                        <?php foreach ($talleres as $taller): ?>
                            <tr>
                                <td><?= htmlspecialchars($taller['codigo_taller']) ?></td>
                                <td><?= htmlspecialchars($taller['descripcion_taller']) ?></td>
                                <td><?= htmlspecialchars($taller['encargado']) ?></td>
                                <td><?= htmlspecialchars($taller['participante']) ?></td>
                                <td><?= htmlspecialchars($taller['fecha']) ?></td>
                                <td><?= htmlspecialchars($taller['hora']) ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <form action="" method="POST" onsubmit="return confirm('¿Deseas eliminar este taller?');">
                                            <input type="hidden" name="accion" value="eliminar">
                                            <input type="hidden" name="codigo_taller" value="<?= htmlspecialchars($taller['codigo_taller']) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                        <button class="btn btn-sm btn-warning" title="Modificar" onclick='editarTaller(<?= json_encode($taller) ?>)'>
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center">No hay talleres registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS y script externo -->
    <?php include_once __DIR__ . '/layouts/scripts.php'; ?>
    <script src="public/js/talleres.js"></script>

</body>
</html>
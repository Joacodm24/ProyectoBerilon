<?php
require_once __DIR__ . '/../model/TecnicosModel.php';

$model = new TecnicosModel();
$accion = $_POST['accion'] ?? null;
$error = null;

if ($accion === 'crear') {
    if ($model->cedulaExiste($_POST['cedula'])) {
        $error = "La cédula ya está registrada.";
    } else {
        try {
            $model->crearTecnico([
                ':cedula'           => $_POST['cedula'],
                ':nombre'           => $_POST['nombre'],
                ':apellido'         => $_POST['apellido'],
                ':cargo'            => $_POST['cargo'],
                ':direccion'        => $_POST['direccion'],
                ':correo'           => $_POST['correo'],
                ':telefono'         => $_POST['telefono'],
                ':cursos_realizados'=> $_POST['cursos_realizados'],
            ]);
            header("Location: index.php?pagina=tecnicos");
            exit;
        } catch (PDOException $e) {
            $error = "Error al registrar el técnico.";
        }
    }
} elseif ($accion === 'eliminar') {
    try {
        $model->eliminarTecnico($_POST['cedula']);
        header("Location: index.php?pagina=tecnicos");
        exit;
    } catch (PDOException $e) {
        $error = "Error al eliminar el técnico.";
    }
} elseif ($accion === 'modificar') {
    try {
        $model->actualizarTecnico([
            ':cedula'           => $_POST['cedula'],
            ':nombre'           => $_POST['nombre'],
            ':apellido'         => $_POST['apellido'],
            ':cargo'            => $_POST['cargo'],
            ':direccion'        => $_POST['direccion'],
            ':correo'           => $_POST['correo'],
            ':telefono'         => $_POST['telefono'],
            ':cursos_realizados'=> $_POST['cursos_realizados'],
        ]);
        header("Location: index.php?pagina=tecnicos");
        exit;
    } catch (PDOException $e) {
        $error = "Error al modificar el técnico.";
    }
}

// Obtener todos los técnicos
$tecnicos = $model->obtenerTecnicos();

// Cargar la vista, pasando $error y $tecnicos
require_once __DIR__ . '/../view/TecnicosView.php';

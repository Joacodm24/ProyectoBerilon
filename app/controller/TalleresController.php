<?php

require_once __DIR__ . '/../model/TalleresModel.php';

$model = new TalleresModel();
$accion = $_POST['accion'] ?? null;
$error = null;

if ($accion === 'crear') {
    if ($model->codigoExiste($_POST['codigo_taller'])) {
        $error = "El código de taller ya está registrado.";
    } else {
        try {
            $model->crear([
                ':codigo_taller' => $_POST['codigo_taller'],
                ':descripcion_taller' => $_POST['descripcion_taller'],
                ':correo' => $_POST['correo'],
                ':participante' => $_POST['participante'],
                ':encargado' => $_POST['encargado'],
                ':fecha' => $_POST['fecha'],
                ':hora' => $_POST['hora']
            ]);
            header("Location: index.php?pagina=talleres");
            exit;
        } catch (PDOException $e) {
            $error = "Error al registrar el taller.";
        }
    }
}

elseif ($accion === 'eliminar') {
    try {
        $model->eliminar($_POST['codigo_taller']);
        header("Location: index.php?pagina=talleres");
        exit;
    } catch (PDOException $e) {
        $error = "Error al eliminar el taller.";
    }
}

elseif ($accion === 'modificar') {
    try {
        $model->modificar([
            ':codigo_taller' => $_POST['codigo_taller'],
            ':descripcion_taller' => $_POST['descripcion_taller'],
            ':correo' => $_POST['correo'],
            ':participante' => $_POST['participante'],
            ':encargado' => $_POST['encargado'],
            ':fecha' => $_POST['fecha'],
            ':hora' => $_POST['hora']
        ]);
        header("Location: index.php?pagina=talleres");
        exit;
    } catch (PDOException $e) {
        $error = "Error al modificar el taller.";
    }
}

// Obtener todos los talleres
$talleres = $model->obtenerTodos();

// Cargar la vista
require __DIR__ . '/../view/TalleresView.php';
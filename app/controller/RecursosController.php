<?php

require_once __DIR__ . '/../model/RecursosModel.php';

$model = new RecursosModel();
$accion = $_POST['accion'] ?? null;
$error = null;

if ($accion === 'crear') {
    if ($model->codigoExiste($_POST['codigo_de_herramientas'])) {
        $error = "El código ya está registrado.";
    } else {
        try {
            $model->crear([
                ':codigo_de_herramientas' => $_POST['codigo_de_herramientas'],
                ':nombre'                 => $_POST['nombre'],
                ':tipo_de_h'              => $_POST['tipo_de_h'],
                ':herramientas'           => $_POST['herramientas'],
                ':materiales'             => $_POST['materiales'],
                ':disponibilidad'         => $_POST['disponibilidad'],
                ':cantidad'               => $_POST['cantidad']
            ]);
            header("Location: index.php?pagina=recursos");
            exit;
        } catch (PDOException $e) {
            $error = "Error al registrar el recurso.";
        }
    }
}

elseif ($accion === 'eliminar') {
    try {
        $model->eliminar($_POST['codigo_de_herramientas']);
        header("Location: index.php?pagina=recursos");
        exit;
    } catch (PDOException $e) {
        $error = "Error al eliminar el recurso.";
    }
}

elseif ($accion === 'modificar') {
    try {
        $model->modificar([
            ':codigo_de_herramientas' => $_POST['codigo_de_herramientas'],
            ':nombre'                 => $_POST['nombre'],
            ':tipo_de_h'              => $_POST['tipo_de_h'],
            ':herramientas'           => $_POST['herramientas'],
            ':materiales'             => $_POST['materiales'],
            ':disponibilidad'         => $_POST['disponibilidad'],
            ':cantidad'               => $_POST['cantidad']
        ]);
        header("Location: index.php?pagina=recursos");
        exit;
    } catch (PDOException $e) {
        $error = "Error al modificar el recurso.";
    }
}

// Obtener todos los recursos tecnológicos
$recursos = $model->obtenerTodos();

// Cargar la vista
require __DIR__ . '/../view/RecursosView.php';

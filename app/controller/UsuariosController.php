<?php

require_once __DIR__ . '/../model/UsuariosModel.php';

$model = new UsuariosModel();
$accion = $_POST['accion'] ?? $_GET['accion'] ?? null;

if ($accion === 'listar') {
    header('Content-Type: application/json');
    $usuarios = $model->obtenerTodos();
    echo json_encode(['data' => $usuarios]);
    exit;
}

if ($accion === 'crear') {
    try {
        if ($model->usuarioExiste($_POST['usuario'])) {
            echo json_encode(['success' => false, 'error' => 'El usuario ya está registrado.']);
            exit;
        }

        $model->crear([
            ':nombre'     => $_POST['nombre'],
            ':usuario'    => $_POST['usuario'],
            ':contrasena' => $_POST['contrasena'],
            ':cargo'      => $_POST['cargo']
        ]);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error al crear el usuario.']);
    }
    exit;
}


if ($accion === 'modificar') {
    try {
        $datos = [
            ':id'      => $_POST['id'],
            ':nombre'  => $_POST['nombre'],
            ':usuario' => $_POST['usuario'],
            ':cargo'   => $_POST['cargo']
        ];

        if (!empty($_POST['contrasena'])) {
            $datos[':contrasena'] = $_POST['contrasena'];
        }

        $model->modificar($datos);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error al modificar el usuario.']);
    }
    exit;
}

if ($accion === 'eliminar') {
    try {
        $model->eliminar($_POST['id']);
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'error' => 'Error al eliminar el usuario.']);
    }
    exit;
}

require __DIR__ . '/../view/UsuariosView.php';

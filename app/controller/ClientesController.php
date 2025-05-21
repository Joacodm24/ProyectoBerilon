<?php

require_once __DIR__ . '/../model/ClientesModel.php';

$model = new ClientesModel();
$accion = $_POST['accion'] ?? null;
$error = null;

if ($accion === 'crear') {
    if ($model->cedulaExiste($_POST['cedula'])) {
        $error = "La cédula ya está registrada.";
    } else {
        try {
            $model->crear([
                ':cedula'       => $_POST['cedula'],
                ':nombre'       => $_POST['nombre'],
                ':apellido'     => $_POST['apellido'],
                ':correo'       => $_POST['correo'],
                ':telefono'     => $_POST['telefono'],
                ':direccion'    => $_POST['direccion'],
                ':organizacion' => $_POST['organizacion'],
                ':sede'         => $_POST['sede']
            ]);
            header("Location: index.php?pagina=clientes");
            exit;
        } catch (PDOException $e) {
            $error = "Error al registrar el cliente.";
        }
    }
}

elseif ($accion === 'eliminar') {
    try {
        $model->eliminar($_POST['cedula']);
        header("Location: index.php?pagina=clientes");
        exit;
    } catch (PDOException $e) {
        $error = "Error al eliminar el cliente.";
    }
}

elseif ($accion === 'modificar') {
    try {
        $model->modificar([
            ':cedula'       => $_POST['cedula'],
            ':nombre'       => $_POST['nombre'],
            ':apellido'     => $_POST['apellido'],
            ':correo'       => $_POST['correo'],
            ':telefono'     => $_POST['telefono'],
            ':direccion'    => $_POST['direccion'],
            ':organizacion' => $_POST['organizacion'],
            ':sede'         => $_POST['sede']
        ]);
        header("Location: index.php?pagina=clientes");
        exit;
    } catch (PDOException $e) {
        $error = "Error al modificar el cliente.";
    }
}

// Obtener todos los clientes
$clientes = $model->obtenerTodos();

// Cargar la vista
require __DIR__ . '/../view/ClientesView.php';

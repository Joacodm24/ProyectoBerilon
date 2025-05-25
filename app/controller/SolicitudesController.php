<?php

require_once __DIR__ . '/../model/SolicitudesModel.php';

$model = new SolicitudesModel();
$accion = $_POST['accion'] ?? null;
$error = null;

if ($accion === 'crear') {
    try {
        $model->crear([
            ':cliente'           => $_POST['cliente'],
            ':descripcion'       => $_POST['descripcion'],
            ':sede'              => $_POST['sede'],
            ':fecha'             => $_POST['fecha'],
            ':estado_ticket'     => $_POST['estado_ticket'],
            ':tecnico_asignado'  => $_POST['tecnico_asignado'],
            ':prioridad'         => $_POST['prioridad']
        ]);
        header("Location: index.php?pagina=Solicitudes");
        exit;
    } catch (PDOException $e) {
        $error = "Error al registrar la solicitud.";
    }
}

elseif ($accion === 'eliminar') {
    try {
        $model->eliminar($_POST['id_codigo']);
        header("Location: index.php?pagina=Solicitudes");
        exit;
    } catch (PDOException $e) {
        $error = "Error al eliminar la solicitud.";
    }
}

elseif ($accion === 'modificar') {
    try {
        $model->modificar([
            ':id_codigo'         => $_POST['id_codigo'],
            ':cliente'           => $_POST['cliente'],
            ':descripcion'       => $_POST['descripcion'],
            ':sede'              => $_POST['sede'],
            ':fecha'             => $_POST['fecha'],
            ':estado_ticket'     => $_POST['estado_ticket'],
            ':tecnico_asignado'  => $_POST['tecnico_asignado'],
            ':prioridad'         => $_POST['prioridad']
        ]);
        header("Location: index.php?pagina=Solicitudes");
        exit;
    } catch (PDOException $e) {
        $error = "Error al modificar la solicitud.";
    }
}

// Obtener todas las solicitudes
$solicitudes = $model->obtenerTodas();

// Cargar la vista
require __DIR__ . '/../view/SolicitudesView.php';

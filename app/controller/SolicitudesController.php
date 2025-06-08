<?php

use App\Model\SolicitudesModel;

$solicitudModel = new SolicitudesModel(); // Instancia la clase SolicitudesModel

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

    switch ($accion) {
        case 'listar':
            $solicitudes = $solicitudModel->listarSolicitudes();
            echo json_encode($solicitudes);
            break;

        case 'crear':
            $datos = [
                'cedula_cliente' => $_POST['cedula_cliente'] ?? null,
                'empresa_rif' => $_POST['empresa_rif'] ?? null,    
                'descripcion' => $_POST['descripcion'],
                'fecha' => $_POST['fecha'],
                'estado_ticket' => $_POST['estado_ticket'],
                'prioridad' => $_POST['prioridad']
            ];
            $resultado = $solicitudModel->crearSolicitud($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
            if (!isset($_POST['id_solicitud']) || empty($_POST['id_solicitud'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'ID de solicitud no válido para modificar.']);
                break;
            }

            $datos = [
                'id_solicitud' => (int)$_POST['id_solicitud'],
                'cedula_cliente' => $_POST['cedula_cliente'] ?? null,
                'empresa_rif' => $_POST['empresa_rif'] ?? null, 
                'descripcion' => $_POST['descripcion'],
                'fecha' => $_POST['fecha'],
                'estado_ticket' => $_POST['estado_ticket'],
                'prioridad' => $_POST['prioridad']
            ];
            $resultado = $solicitudModel->modificarSolicitud($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            if (!isset($_POST['id_solicitud']) || empty($_POST['id_solicitud'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'ID de solicitud no válido para eliminar.']);
                break;
            }
            $id_solicitud = (int)$_POST['id_solicitud'];
            $resultado = $solicitudModel->eliminarSolicitud($id_solicitud);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida']);
    }
    exit; // Termina la ejecución del script para AJAX
} else {
    // Cargar la vista
    include 'app/View/SolicitudesView.php';
}

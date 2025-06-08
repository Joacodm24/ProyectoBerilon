<?php

use App\Model\OrdenTrabajoModel;

$ordenModel = new OrdenTrabajoModel(); // Instancia la clase OrdenTrabajoModel

$accion = $_POST['accion'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    switch ($accion) {
        case 'listar':
            $ordenes = $ordenModel->listarOrdenes();
            echo json_encode($ordenes);
            break; 

        case 'crear':
          
            $datos = [
                'solicitud_id' => (int)$_POST['solicitud_id'],
                'tecnico_cedula' => $_POST['tecnico_cedula'],
                'codigo_herramienta_asignada' => $_POST['codigo_herramienta_asignada'] ?? null, // Asigna null si el campo está vacío.
                'fecha_visita' => $_POST['fecha_visita'],
                'direccion_visita' => $_POST['direccion_visita'],
                'estado_planificacion' => $_POST['estado_planificacion'],
                'tipo_de_trabajo' => $_POST['tipo_de_trabajo'],
                'observaciones' => $_POST['observaciones'] ?? null // Asigna null si el campo está vacío.
            ];
            $resultado = $ordenModel->crearOrden($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
            // Valida que el ID de la orden sea válido antes de intentar modificar.
            if (empty($_POST['id_orden']) || !is_numeric($_POST['id_orden'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'ID de orden no válido para modificar.']);
                break;
            }

            $datos = [
                'id_orden' => (int)$_POST['id_orden'], 
                'solicitud_id' => (int)$_POST['solicitud_id'],
                'tecnico_cedula' => $_POST['tecnico_cedula'],
                'codigo_herramienta_asignada' => $_POST['codigo_herramienta_asignada'] ?? null,
                'fecha_visita' => $_POST['fecha_visita'],
                'direccion_visita' => $_POST['direccion_visita'],
                'estado_planificacion' => $_POST['estado_planificacion'],
                'tipo_de_trabajo' => $_POST['tipo_de_trabajo'],
                'observaciones' => $_POST['observaciones'] ?? null
            ];
            $resultado = $ordenModel->modificarOrden($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Valida que el ID de la orden sea válido antes de intentar eliminar.
            if (empty($_POST['id_orden']) || !is_numeric($_POST['id_orden'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'ID de orden no válido para eliminar.']);
                break;
            }
            $id_orden = (int)$_POST['id_orden']; // Convierte el ID a entero.
            $resultado = $ordenModel->eliminarOrden($id_orden);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida.']);
    }
    // Termina la ejecución del script después de enviar la respuesta AJAX para evitar salida adicional.
    exit;
} else {
    // Si no es una solicitud POST, se carga la vista principal del módulo.
    include 'app/View/OrdenTrabajoView.php';
}

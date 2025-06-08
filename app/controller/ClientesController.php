<?php

use App\Model\ClientesModel;

$clienteModel = new ClientesModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    header('Content-Type: application/json'); // Asegurarse de que el encabezado se envíe siempre

    switch ($accion) {
        case 'listar':
            $clientes = $clienteModel->listarClientes();
            echo json_encode($clientes); 
            break;

        case 'crear':
            // Validar que la cédula no exista antes de crear
            if ($clienteModel->clienteExiste($_POST['cedula'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'La cédula ya está registrada.']);
                break;
            }

            $datos = [
                'cedula' => $_POST['cedula'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion']
    
            ];
            $resultado = $clienteModel->crearCliente($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
        
            if (!isset($_POST['cedula']) || empty($_POST['cedula'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'Cédula de cliente no válida para modificar.']);
                break;
            }

            $datos = [
                'cedula' => $_POST['cedula'], 
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'],
                'direccion' => $_POST['direccion']
                
            ];
            $resultado = $clienteModel->modificarCliente($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            if (!isset($_POST['cedula']) || empty($_POST['cedula'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'Cédula de cliente no válida para eliminar.']);
                break;
            }
            $cedula_cliente = $_POST['cedula'];
            $resultado = $clienteModel->eliminarCliente($cedula_cliente);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida']);
    }
    exit; // Termina la ejecución del script para AJAX
} else {
    // Cargar la vista
    include 'app/View/ClientesView.php';
}

<?php

use App\Model\EmpresasModel;

$empresasModel = new EmpresasModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    header('Content-Type: application/json'); 

    switch ($accion) {
        case 'listar':
            $empresas = $empresasModel->listarEmpresas();
            echo json_encode($empresas);
            break;

        case 'crear':
            // Validar que el RIF no exista antes de crear
            if ($empresasModel->empresaExiste($_POST['RIF'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'El RIF ya está registrado para otra empresa.']);
                break;
            }

            $datos = [
                'RIF' => $_POST['RIF'],
                'nombre' => $_POST['nombre'],
                'direccion_fiscal' => $_POST['direccion_fiscal'],
                'numero_telefono' => $_POST['numero_telefono'],
                'email' => $_POST['email']
            ];
            $resultado = $empresasModel->crearEmpresa($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
            // El RIF es el identificador principal para modificar
            if (!isset($_POST['RIF']) || empty($_POST['RIF'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'RIF de empresa no válido para modificar.']);
                break;
            }

            $datos = [
                'RIF' => $_POST['RIF'], // El RIF es el identificador principal
                'nombre' => $_POST['nombre'],
                'direccion_fiscal' => $_POST['direccion_fiscal'],
                'numero_telefono' => $_POST['numero_telefono'],
                'email' => $_POST['email']
            ];
            $resultado = $empresasModel->modificarEmpresa($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            if (!isset($_POST['RIF']) || empty($_POST['RIF'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'RIF de empresa no válido para eliminar.']);
                break;
            }
            $rif_empresa = $_POST['RIF']; // Usar RIF para eliminar
            $resultado = $empresasModel->eliminarEmpresa($rif_empresa);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida']);
    }
    exit; // Termina la ejecución del script para AJAX
} else {
    // Cargar la vista
    include 'app/View/EmpresasView.php';
}

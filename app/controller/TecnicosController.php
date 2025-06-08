<?php

use App\Model\TecnicosModel;

$tecnicoModel = new TecnicosModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    header('Content-Type: application/json');

    switch ($accion) {
        case 'listar':
            $tecnicos = $tecnicoModel->listarTecnicos();
            echo json_encode($tecnicos);
            break;

        case 'crear':
            // Validación de campos obligatorios
            if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'Cédula, Nombre, Apellido y Correo son obligatorios.']);
                break;
            }

            $datos = [
                'cedula' => $_POST['cedula'],
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'cargo' => $_POST['cargo'] ?? null,
                'direccion' => $_POST['direccion'] ?? null,
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'] ?? null,
                'especializacion' => $_POST['especializacion'] ?? null
            ];
            $resultado = $tecnicoModel->crearTecnico($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
            // Validación de campos obligatorios, incluyendo la cédula para identificar el técnico a modificar
            if (empty($_POST['cedula']) || empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['correo'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'Cédula, Nombre, Apellido y Correo son obligatorios para modificar.']);
                break;
            }

            $datos = [
                'cedula' => $_POST['cedula'], 
                'nombre' => $_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'cargo' => $_POST['cargo'] ?? null,
                'direccion' => $_POST['direccion'] ?? null,
                'correo' => $_POST['correo'],
                'telefono' => $_POST['telefono'] ?? null,
                'especializacion' => $_POST['especializacion'] ?? null
            ];
            $resultado = $tecnicoModel->modificarTecnico($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            if (empty($_POST['cedula'])) { 
                echo json_encode(['estado' => 'error', 'mensaje' => 'Cédula del técnico no válida para eliminar.']);
                break;
            }
            $cedula = $_POST['cedula']; 
            $resultado = $tecnicoModel->eliminarTecnico($cedula);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida']);
    }
    exit;
} else {
    // Cargar la vista
    include 'app/View/TecnicosView.php';
}

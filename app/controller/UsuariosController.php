<?php

use App\Model\UsuariosModel;

$model = new UsuariosModel();

$accion = $_POST['accion'] ?? $_GET['accion'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Envía el encabezado Content-Type para JSON al inicio de la respuesta AJAX
    header('Content-Type: application/json');

    switch ($accion) {
        case 'listar':
            $usuarios = $model->listarUsuarios();
            echo json_encode($usuarios);
            break;

        case 'crear':
            // Valida la longitud de la contraseña
            if (empty($_POST['contrasena']) || strlen($_POST['contrasena']) < 6) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'La contraseña debe tener al menos 6 caracteres.']);
                break;
            }

            // Verifica si el nombre de usuario ya existe
            if ($model->usuarioExiste($_POST['usuario'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'El nombre de usuario ya está registrado.']);
                break;
            }

            $datos = [
                ':nombre'     => $_POST['nombre'],
                ':usuario'    => $_POST['usuario'],
                ':contrasena' => $_POST['contrasena'],
                ':cargo'      => $_POST['cargo']
            ];
            $resultado = $model->crear($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
            // Valida que el ID del usuario sea válido
            if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'ID de usuario no válido para modificar.']);
                break;
            }

            $datos = [
                ':id'      => (int)$_POST['id'],
                ':nombre'  => $_POST['nombre'],
                ':usuario' => $_POST['usuario'],
                ':cargo'   => $_POST['cargo']
            ];

            // Si se proporciona una contraseña, valida su longitud antes de añadirla a los datos
            if (!empty($_POST['contrasena'])) {
                if (strlen($_POST['contrasena']) < 6) {
                    echo json_encode(['estado' => 'error', 'mensaje' => 'La contraseña debe tener al menos 6 caracteres si se va a modificar.']);
                    break;
                }
                $datos[':contrasena'] = $_POST['contrasena'];
            }

            $resultado = $model->modificar($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            // Valida que el ID del usuario sea válido
            if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'ID de usuario no válido para eliminar.']);
                break;
            }
            $id_usuario = (int)$_POST['id'];
            $resultado = $model->eliminar($id_usuario);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida.']);
    }
    exit; // Termina la ejecución del script después de enviar la respuesta AJAX
} else {
    // Si la solicitud no es POST, carga la vista de usuarios
    require __DIR__ . '/../View/UsuariosView.php';
}

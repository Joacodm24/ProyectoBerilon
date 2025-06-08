<?php

use App\Model\CatalogoModel;

$catalogoModel = new CatalogoModel(); // Instancia la clase CatalogoModel

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? null;
    header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

    switch ($accion) {
        case 'listar':
            $items = $catalogoModel->listarCatalogo();
            echo json_encode($items);
            break;

        case 'crear':
            // Validar que el código de herramienta no exista antes de crear
            if ($catalogoModel->codigoExiste($_POST['codigo_de_herramienta'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'El código de herramienta ya está registrado.']);
                break;
            }

            $datos = [
                'codigo_de_herramienta' => $_POST['codigo_de_herramienta'],
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'descripcion' => $_POST['descripcion'],
                'cantidad_disponible' => $_POST['cantidad_disponible']
            ];
            $resultado = $catalogoModel->crear($datos);
            echo json_encode($resultado);
            break;

        case 'modificar':
            // El código de herramienta es el identificador principal para modificar
            if (!isset($_POST['codigo_de_herramienta']) || empty($_POST['codigo_de_herramienta'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'Código de herramienta no válido para modificar.']);
                break;
            }

            $datos = [
                'codigo_de_herramienta' => $_POST['codigo_de_herramienta'], // El código se usa como identificador
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'descripcion' => $_POST['descripcion'],
                'cantidad_disponible' => $_POST['cantidad_disponible']
            ];
            $resultado = $catalogoModel->modificar($datos);
            echo json_encode($resultado);
            break;

        case 'eliminar':
            if (!isset($_POST['codigo_de_herramienta']) || empty($_POST['codigo_de_herramienta'])) {
                echo json_encode(['estado' => 'error', 'mensaje' => 'Código de herramienta no válido para eliminar.']);
                break;
            }
            $codigo_de_herramienta = $_POST['codigo_de_herramienta']; // Usar código para eliminar
            $resultado = $catalogoModel->eliminar($codigo_de_herramienta);
            echo json_encode($resultado);
            break;

        default:
            echo json_encode(['estado' => 'error', 'mensaje' => 'Acción no válida.']);
    }
    exit; // Termina la ejecución del script después de enviar la respuesta AJAX
} else {
    // Cargar la vista de Catálogo si no es una solicitud POST
    require __DIR__ . '/../View/CatalogoView.php';
}

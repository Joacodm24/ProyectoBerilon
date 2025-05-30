<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Carga automática de dependencias si las usas (Composer)
require 'vendor/autoload.php';

// Define la página por defecto
$pagina = $_GET['pagina'] ?? 'login';

// Ruta del controlador según la página
$rutaControlador = "app/controller/" . $pagina . "Controller.php";

// Verifica si existe el controlador
if (file_exists($rutaControlador)) {
    require_once($rutaControlador);
} else {
    // Si no existe, muestra error 404
    echo "<h1>Error 404: Página no encontrada</h1>";
    exit;
}
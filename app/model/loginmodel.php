<?php

// Redirige a la vista por defecto si no se especifica la URL
if (!isset($_GET['url'])) {
    header("Location: ?url=login");
    exit;
}

// Carga la vista de login si la URL es 'login'
if ($_GET['url'] === 'login') {
    require 'app/view/login.php';
} else {
    // Muestra error 404 si la ruta no es válida
    http_response_code(404);
    echo "Error 404: Página no encontrada.";
}

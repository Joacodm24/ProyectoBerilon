<?php
    // Llamada al modelo de Notas
    use App\Mvc2025\Model\notasModel as NotasModel;
    
    $notasModel = new NotasModel();

    // Verifica si existe la variable $_GET['url']
    if (isset($_GET['url'])) {
        
        // Verifica si la variable $_GET es igual a promedio
        if ($_GET['url'] === 'promedio') {

            // Uso de los métodos del modelo
            

        // Llamada a la Vista
        include 'app/view/login.php';

        } else {
            // Si la URL no es igual a promedio, se redirige a la vista de error 404
            die("Error 404");
        }

    } else {
        // Sino existe la URL La función Die redirige a la vista de promedio la cual es la vista por defecto
        die("<script>window.location='?url=promedio'</script>");
    }


?>
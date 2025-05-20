<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulario de Notas</title>
        <link rel="stylesheet" type="text/css" href="../mvc_2025/assets/css/notas.css">
    </head>
    <body>
        <div class="form-container">
            <h1>Ingrese sus notas</h1>
            <form action="?url=promedio" method="post">
                <div class="input-group">
                    <label for="nota1">Nota 1:</label>
                    <input type="number" id="nota1" name="nota1" min="0" max="20" required>
                </div>
                <div class="input-group">
                    <label for="nota2">Nota 2:</label>
                    <input type="number" id="nota2" name="nota2" min="0" max="20" required>
                </div>
                <div class="input-group">
                    <label for="nota3">Nota 3:</label>
                    <input type="number" id="nota3" name="nota3" min="0" max="20" required>
                </div>
                <button type="submit">Calcular Promedio</button>
            </form>
            <div id="resultado" class="resultado">Su promedio es: <?php isset($result) ? print($result) : ' ' ?></div> 
        </div>  
    </body>
</html>
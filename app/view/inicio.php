<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inicio | Berilion</title>
  <?php include_once __DIR__ . '/layouts/head.php'; ?>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .descripcion {
      font-size: 1.2rem;
      color: #555;
    }
    .logo {
      max-width: 150px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <?php include_once __DIR__ . '/layouts/navbar.php'; ?>

  <div class="container text-center mt-5">
    <img src="public/img/logo.svg" alt="Logo de Berilion" class="logo">
    <h2 class="text-primary fw-bold">Bienvenido a Berilion</h2>
    <p class="descripcion mt-3">
      Somos una empresa dedicada al soporte técnico y soluciones tecnológicas innovadoras. 
      Brindamos atención especializada a empresas y particulares, asegurando eficiencia y calidad en cada servicio.
    </p>
  </div>

  <?php include_once __DIR__ . '/layouts/scripts.php'; ?>
</body>
</html>

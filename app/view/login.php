<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Berilion</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  
  <style>
    body {
      background-color: #f2f4f7;
    }

    .card-blur {
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(5px);
    }

    .input-group-text.toggle-password {
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <?php include_once __DIR__ . '/layouts/navbar.php'; ?>

  <!-- LOGIN CENTRADO -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card card-blur shadow-lg border-0 p-4" style="max-width: 400px; width: 100%;">
      <div class="card-body">
        <h2 class="text-center text-primary fw-bold mb-3">Berilion</h2>
        <h5 class="text-center text-secondary mb-4">Iniciar Sesión</h5>

        <form action="/login" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <div class="input-group">
              <span class="input-group-text bg-primary text-white"><i class="bi bi-person-fill"></i></span>
              <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required />
            </div>
          </div>

          <div class="mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
              <span class="input-group-text bg-primary text-white"><i class="bi bi-lock-fill"></i></span>
              <input type="password" class="form-control" id="password" name="password" placeholder="********" required />
              <span class="input-group-text toggle-password" onclick="togglePassword()">
                <i class="bi bi-eye-fill" id="toggleIcon"></i>
              </span>
            </div>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary fw-semibold">
              Ingresar <i class="bi bi-box-arrow-in-right ms-1"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('bi-eye-fill');
        toggleIcon.classList.add('bi-eye-slash-fill');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('bi-eye-slash-fill');
        toggleIcon.classList.add('bi-eye-fill');
      }
    }
  </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login | Berilion</title>
  <?php include_once __DIR__ . '/layouts/head.php'; ?>

  <style>
    body {
      background: linear-gradient(135deg, #e0eafc, #cfdef3);
    }

    .card-blur {
      background-color: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(8px);
      border-radius: 1rem;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .toggle-password {
      cursor: pointer;
    }

    .form-control:focus {
      border-color: #0d6efd;
      box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }
  </style>
</head>
<body>

  <!-- LOGIN CENTRADO -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card card-blur shadow-lg border-0 p-4" style="max-width: 400px; width: 100%;">
      <div class="card-body">
        <h2 class="text-center text-primary fw-bold mb-3">Berilion</h2>
        <h5 class="text-center text-secondary mb-3">Iniciar Sesión</h5>

        <!-- ✅ Mensaje de logout desde $mensaje (controlador lo envía) -->
        <?php if (!empty($mensaje)): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($mensaje) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php endif; ?>

        <!-- ⚠️ Mensajes de error desde JS -->
        <div id="message" class="alert d-none"></div>

        <!-- ✅ FORMULARIO LOGIN -->
        <form id="loginForm" autocomplete="off">
          <!-- Usuario -->
          <div class="mb-3">
            <label for="username" class="form-label">Usuario</label>
            <div class="input-group">
              <span class="input-group-text bg-primary text-white">
                <i class="bi bi-person-fill"></i>
              </span>
              <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required />
            </div>
          </div>

          <!-- Contraseña -->
          <div class="mb-4">
            <label for="password" class="form-label">Contraseña</label>
            <div class="input-group">
              <span class="input-group-text bg-primary text-white">
                <i class="bi bi-lock-fill"></i>
              </span>
              <input type="password" class="form-control" id="password" name="password" placeholder="********" required />
              <span class="input-group-text toggle-password" onclick="togglePassword()">
                <i class="bi bi-eye-fill" id="toggleIcon"></i>
              </span>
            </div>
          </div>

          <!-- Botón -->
          <div class="d-grid">
            <button type="submit" class="btn btn-primary fw-semibold">
              Ingresar <i class="bi bi-box-arrow-in-right ms-1"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php include_once __DIR__ . '/layouts/scripts.php'; ?>
  <script src="public/js/login.js"></script>

  <script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const toggleIcon = document.getElementById('toggleIcon');

      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.replace('bi-eye-fill', 'bi-eye-slash-fill');
      } else {
        passwordInput.type = 'password';
        toggleIcon.classList.replace('bi-eye-slash-fill', 'bi-eye-fill');
      }
    }
  </script>
</body>
</html>

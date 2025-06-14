<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">

    <!-- Logo de la empresa (enlace al inicio) -->
    <a class="navbar-brand d-flex align-items-center" href="index.php?pagina=inicio">
      <img src="public/img/logo.svg" alt="Logo Berilion" width="100" height="auto">
    </a>

    <!-- Botón para mostrar/ocultar el menú en pantallas pequeñas -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido del navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
      <!-- Enlaces del menú -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <!-- Enlace a la página de inicio -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php?pagina=inicio">Inicio</a>
        </li>

        <!-- Menú desplegable: Registrar Datos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Registrar Datos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?pagina=Clientes">Gestionar Cliente</a></li>
            <li><a class="dropdown-item" href="?pagina=Empresas">Gestionar Empresas</a></li> <!-- NUEVO: Enlace a Empresas -->
            <li><a class="dropdown-item" href="?pagina=Tecnicos">Gestionar Personal Técnico</a></li>
          </ul>
        </li>

        <!-- Menú desplegable: Gestionar Datos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestionar Datos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?pagina=Solicitudes">Gestionar Solicitudes</a></li>
            <li><a class="dropdown-item" href="?pagina=Catalogo">Gestionar Catalogo</a></li>
            <li><a class="dropdown-item" href="?pagina=OrdenTrabajo">Gestión de OrdenTrabajo</a></li>
          </ul>
        </li>

        <!-- Enlace a reportes -->
        <li class="nav-item">
          <a class="nav-link" href="?pagina=report">Generar Reportes</a>
        </li>

        <!-- Enlace al manual de usuario -->
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="#.pdf">Manual de usuario</a>
        </li>
      </ul>

      <!-- Botón con ícono para ir al módulo de usuarios -->
      <a href="index.php?pagina=Usuarios" class="btn btn-outline-light me-2 d-flex align-items-center justify-content-center"
         style="width: 40px; height: 40px; padding: 0;">
        <img src="img/usuario.png" alt="Usuarios" class="img-fluid" style="max-width: 100%; max-height: 100%;">
      </a>

      <!-- Botón de cierre de sesión -->
      <a href="index.php?pagina=logout" class="btn btn-outline-light">Cerrar Sesión</a>
    </div>
  </div>
</nav>

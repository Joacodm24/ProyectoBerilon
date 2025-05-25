<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="#">
  <img src="public/img/logo.svg" alt="Logo Berilion" width="100" height="auto">

</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Registrar Datos
          </a>
          <ul class="dropdown-menu">
            <a class="dropdown-item" href="?pagina=Clientes">Gestionar Cliente</a>
            <li><a class="dropdown-item" href="?pagina=Tecnicos">Gestionar Personal Técnico</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Gestionar Datos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?pagina=Solicitudes">Gestionar Solicitudes</a></li>
            <li><a class="dropdown-item" href="?pagina=Recursos">Gestionar Recursos Tecnológicos</a></li>
            <li><a class="dropdown-item" href="?pagina=Talleres">Gestión de Talleres</a></li>
          </ul>
        </li>
        <li class="nav-item">
              <a class="nav-link" href="?pagina=report">
                Generar Reportes
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" target="_blank" href="#.pdf">
                Manual de usuario
              </a>
            </li>
      </ul>
      <!-- Botón de cierre de sesión (opcional) -->
      <form class="d-flex" action="/logout" method="POST">
        <button class="btn btn-outline-light" type="submit">Cerrar Sesión</button>
      </form>
    </div>
  </div>
</nav>



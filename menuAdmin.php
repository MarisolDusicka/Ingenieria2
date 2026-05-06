<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #000;">
  <div class="container-fluid">

    <!-- BRAND -->
    <a class="navbar-brand d-flex align-items-center" href="<?= base_url('admin'); ?>">
      <img src="<?= base_url('assets/img/fotoAdmin.jpg'); ?>" width="35" height="35" class="rounded-circle me-2">
      <span>Admin - Óptica Floripa</span>
    </a>

    <!-- TOGGLE -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- MENU -->
    <div class="collapse navbar-collapse" id="menuAdmin">

      <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

        <!-- CONSULTAS -->
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('ver_consulta'); ?>">
            📩 Consultas
          </a>
        </li>

        <!-- USUARIOS -->
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('lista_ClientesRegistrado'); ?>">
            👥 Usuarios
          </a>
        </li>

        <!-- RECETAS -->
        <li class="nav-item">
          <a class="nav-link"  href="<?= base_url('ver_recetas'); ?>">
            👓 Recetas
          </a>
        </li>

        <!-- ANTEOJOS -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
            🕶️ Anteojos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?= base_url('listar_anteojos'); ?>">Listar</a></li>
            <li><a class="dropdown-item" href="<?= base_url('agregar_anteojo'); ?>">Agregar</a></li>
          </ul>
        </li>

        <!-- VENTAS -->
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('listar_ventas'); ?>">
            💰 Ventas
          </a>
        </li>

      </ul>

      <!-- SALIR -->
      <div class="d-flex">
        <a class="btn btn-danger btn-sm" href="<?= base_url('salir'); ?>">
          🚪 Salir
        </a>
      </div>

    </div>
  </div>
</nav>
<nav class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav align-items-center ml-md-auto">
        <li class="nav-item d-xl-none">
          <!-- Sidenav toggler -->
          <div class="pr-3 sidenav-toggler sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </li>

      </ul>
      <ul class="navbar-nav align-items-center ml-auto ml-md-0">
        <li class="nav-item dropdown">
          <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="media align-items-center">
              <div class="media-body ml-2 d-none d-lg-block text-dark">
                <span class="mb-0 text-sm  font-weight-bold text-dark"><i class="fas fa-user text-dark mr-2"></i><?=$this->session->userdata('usuario')["nombre"]?></span>
              </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header noti-title">
              <h6 class="text-overflow m-0">Bienvenido</h6>
            </div>
            <div class="dropdown-divider"></div>
            <a href="#" data-toggle="modal" data-target="#cambioContrasenaModal" class="dropdown-item">
              <i class="fas fa-key"></i>
              <span>Cambiar contraseña</span>
            </a>
            <a href="<?=base_url()?>auth/logout" class="dropdown-item">
              <i class="ni ni-user-run"></i>
              <span>Salir</span>
            </a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
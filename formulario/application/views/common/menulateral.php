<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?=base_url()?>">
          <img src="<?=base_url()?>assets/img/logo.png"  width="70" style="max-height: initial !important;">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?=$this->session->flashdata('active')=='inicio' ? 'active' : ''?>" href="<?=base_url()?>home" role="button" aria-expanded="false" aria-controls="navbar-components">
                <i class="fas fa-home"></i>
                <span class="nav-link-text">Inicio</span>
              </a>
            </li>
            <?php /*
            <li class="nav-item">
              <a class="nav-link" href="<?=base_url()?>modulos" role="button" aria-expanded="false" aria-controls="navbar-components">
                <i class="fas fa-home"></i>
                <span class="nav-link-text">Modulos</span>
              </a>
            </li> */
            ?>
          
            <!--<i class="fas fa-shopping-bag"></i>-->
           
            <?php 
              if (is_admin(true)) {
            ?>

            <li class="nav-item">
              <a class="nav-link <?=$this->session->flashdata('active')=='proyecto' ? 'active' : ''?>" href="<?=base_url()?>proyecto_controller/">
                <i class="fas fa-briefcase"></i>
                <span class="nav-link-text text-black">Proyectos</span>
              </a>
            </li>    
            
            <li class="nav-item">
              <a class="nav-link <?=$this->session->flashdata('active')=='formulario' ? 'active' : ''?>" href="<?=base_url()?>formulario_controller/">
                <i class="fas fa-keyboard"></i>
                <span class="nav-link-text text-black">Formularios</span>
              </a>
            </li>    
                <!--
            <li class="nav-item">
              <a class="nav-link <?=$this->session->flashdata('active')=='tipo' ? 'active' : ''?>" href="<?=base_url()?>tipo_controller/">
                <i class="fas fa-keyboard"></i>
                <span class="nav-link-text text-black">Tipos de campos</span>
              </a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link <?=$this->session->flashdata('active')=='usuarios' ? 'active' : ''?>" href="<?=base_url()?>usuario_controller/">
                <i class="fas fa-key"></i>
                <span class="nav-link-text text-black">Usuarios backoffice</span>
              </a>
            </li>
           
            <?php 
            }
            ?>

           
          </ul>
          
        </div>
      </div>
    </div>
  </nav>
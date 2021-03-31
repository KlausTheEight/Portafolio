
<!DOCTYPE html>
<html>
<head>
 <?php
 $this->load->view('common/css');
 ?>
 <style>
  .shake:hover {
    /* Start the shake animation and make the animation last for 0.5 seconds */
    animation: shake 0.5s;

    /* When the animation is finished, start again */
    animation-iteration-count: infinite;
  }

  @keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
    50% { transform: translate(-1px, 2px) rotate(-1deg); }
    60% { transform: translate(-3px, 1px) rotate(0deg); }
    70% { transform: translate(3px, 1px) rotate(-1deg); }
    80% { transform: translate(-1px, -1px) rotate(1deg); }
    90% { transform: translate(1px, 2px) rotate(0deg); }
    100% { transform: translate(1px, -2px) rotate(-1deg); }
  }
</style>
</head>

<body class="g-sidenav-hidden">

  <?php
  $this->load->view('common/menulateral');
  ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- MENÚ DE ARRIBA -->
    <?php
    $this->load->view('common/menu');
    ?>
    <!-- END MENÚ DE ARRIBA -->


    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">



          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Inicio</h6>
            </div>

            <!--ESPACIO PARA BONER BOTONES -->
          </div>



        </div>

        <div class="row">
          <div class="col-xl-12">
            <div class="card card-stats">
              <!-- CARD -->
              <div class="card-body">

                <div class="row">
                  <!-- CONTENIDO -->

                  <?php
                  foreach ($proyectos as $key => $proyecto) {
                    ?>
                    <div class="col-md-12 mb-5">
                      <h2><?=$proyecto["nombre"]?></h2>
                      <table class="table">
                        <thead>
                          <th>Formulario</th>
                          <th>Cantidad de registros</th>
                          <th>Acciones</th>
                        </thead>
                        <tbody>
                          <?php
                          foreach ($proyecto["formularios"] as $key2 => $formulario) {
                            ?>
                            <tr>
                              <td><?=$formulario["nombre"]?></td>
                              <td class="text-center"><?= $formulario["total"] ?></td>
                              <td>
                                <a target="_blank" href="<?=base_url()?>formulario_controller/listar/<?=$formulario["id"]?>" class="my-1 btn-block btn btn-info btn-sm">
                                  Ver registros
                                </a>
                                <?php if ($this->session->userdata('usuario')["perfil_id"] == "1"): ?>
                                <a target="_blank" href="<?=base_url()?>publico/formulario?id=<?=sha1($formulario["id"])?>" class="my-1 btn-block btn btn-primary btn-sm">
                                  Ver formulario público
                                </a>
                                <?php endif ?>
                                <?php if ($this->session->userdata('usuario')["perfil_id"] == "1"): ?>
                                  <a target="_blank" href="<?=base_url()?>formulario_controller/view_update/<?=$formulario["id"]?>" class="my-1 btn-block btn btn-warning btn-sm">
                                    Ver configuraciones
                                  </a>
                                <?php endif ?>
                              </td>
                            </tr>
                            <?php
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <?php
                  }
                  ?>

                  <!-- END CONTENIDO -->
                </div>




              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
  </div>
  <?php
  $this->load->view('mensajes');
  $this->load->view('common/js');

  ?>

</body>
</html>
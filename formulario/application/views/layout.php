
<!DOCTYPE html>
<html>


<head>
   <?php 
    $this->load->view('common/css');
   ?>
</head>

<body>

  <?php
    $this->load->view('common/menulateral');
  ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- MENÚ DE ARRIBA -->
    <?php
      $this->load->view('menu');
    ?>
    <!-- END MENÚ DE ARRIBA -->
  
    <div class="header bg-danger pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Inicio</h6>
            </div>
           
            <!--ESPACIO PARA BONER BOTONES -->
            </div>
         
            <div class="row">
              <div class="col-xl-12">
                <div class="card card-stats">
                  <!-- CARD -->
                  <div class="card-body">
                    <div class="row">
                      <!-- CONTENIDO -->

                      <!-- END CONTENIDO -->
                    </div>
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
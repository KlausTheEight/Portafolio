
<!DOCTYPE html>
<html>


<head>
   <?php 
    echo '<?php $this->load->view(\'common/css\'); ?>'.PHP_EOL;
   ?>
</head>

<body>

  <?php
  echo '<?php $this->load->view(\'common/menulateral\'); ?>'.PHP_EOL;
  ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- MENÚ DE ARRIBA -->
    <?php
      echo '<?php $this->load->view(\'common/menu\'); ?>'.PHP_EOL;
    ?>
    <!-- END MENÚ DE ARRIBA -->
  
    <div class="header bg-danger pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Listar elementos</h6>
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
                      <div class="col-xl-12">
                              
                              <div class="table-responsive">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <input class="form-control" id="buscar" placeholder="buscar en tabla...">
                                      </div>
                                  </div>
                                  <table class="table table-striped" id="table_list">
                                      <thead class="thead-light">
                                          <?php echo $thead ?>
                                      </thead>
                                      <tbody>
                                          <?php
                                          echo '<?php foreach($datos as $dato){'.PHP_EOL;
                                          echo $lista;
                                          echo ' } ?>'.PHP_EOL;
                                          ?>
                                      </tbody>
                                  </table>
                              </div>
                              </div>
                          
                              <script>
                                  $(document).ready(function(){
                                      $("#buscar").on("keyup", function() {
                                          var value = $(this).val().toLowerCase();
                                          $("#table_list tbody tr").filter(function() {
                                              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                                          });
                                      });
                                  });
                              </script>
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
  echo '<?php $this->load->view(\'mensajes\'); ?>'.PHP_EOL;
  echo '<?php $this->load->view(\'common/js\'); ?>'.PHP_EOL;
  ?>
</body>
</html>
 
                              

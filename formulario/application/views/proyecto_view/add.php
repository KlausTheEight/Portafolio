
<!DOCTYPE html>
<html>


<head>
   <?php $this->load->view('common/css'); ?>
</head>

<body>

  <?php $this->load->view('common/menulateral'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- MENÚ DE ARRIBA -->
    <?php $this->load->view('common/menu'); ?>
    <!-- END MENÚ DE ARRIBA -->
  
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Agregar elementos</h6>
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
                        <div class="col-xl-12 mb-2">
                            <a class="btn btn-primary text-white btn-sm" href="<?php echo base_url().'proyecto_controller'; ?>
"><i class="fas fa-arrow-left"></i> Volver</a>
                        </div>
                        <div class="col-xl-12">
                            <form method="post" action="<?php echo base_url().'proyecto_controller/add'; ?>
">
                                <div class="row">
                                    <div class="col-md-8 offset-md-2 col-sm-12">
                                        
                    <div class="form-group">
                    <label class="form-control-label">NOMBRE DEL PROYECTO</label>
                    <input required class="form-control" name="nombre" type="text">
                    </div>
                                                            <div class="form-group mt-3 text-center">
                                            <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Listo, guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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
  <?php $this->load->view('mensajes'); ?>
<?php $this->load->view('common/js'); ?>
</body>
</html>
                   
                    
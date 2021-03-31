
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
      $this->load->view('common/menu');
    ?>
    <!-- END MENÚ DE ARRIBA -->
  
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Nuevo Usuario</h6>
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
                        <div class="col-md-12 mb-2">
                            <a href="<?=base_url()?>usuario_controller" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Volver</a>
                           
                        </div>
                       
                      <!-- END CONTENIDO -->
                    </div>

                    <div class="row">
                      <!-- CONTENIDO -->
                      <div class="col-xl-12">
                        <form method="post" action="<?=base_url()?>usuario_controller/add">
                            <div class="row">

                                <div class="col-md-12">
                                  <h3>Datos del usuario</h3>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label class="form-control-label">Etiqueta</label>
                                      <input class="form-control" name="etiqueta" type="text" placeholder="Etiqueta">
                                      <small>ej: SOCIAL, CALL CENTER</small>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label class="form-control-label">Nombre</label>
                                      <input required class="form-control" name="nombre" type="text" placeholder="NOMBRE COMPLETO">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label class="form-control-label">E-mail</label>
                                    <input required class="form-control" name="email" type="email" placeholder="E-MAIL">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label class="form-control-label">Clave</label>
                                    <input required class="form-control" name="password" placeholder="CLAVE">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="form-control-label">Perfil</label>
                                        <select required class="form-control" name="perfil_id">
                                            <?php foreach($lista_perfil as $option){
                                                ?>
                                                <option value="<?php echo $option["id"] ?>"><?php echo $option["nombre"] ?></option>
                                                <?php
                                                } ?>
                                        </select>
                                    </div>
                                </div>   
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label class="form-control-label">Estado</label>
                                      <div class="custom-control custom-checkbox mb-3">
                                          <input class="custom-control-input" id="checkEstado" type="checkbox" name="estado" value="1">
                                          <label class="custom-control-label" for="checkEstado">Activo</label>
                                      </div>
                                    </div>
                                </div>

                               


                                <div class="col-md-12 text-center">                                
                                  <div class="form-group mt-3">
                                      <button class="btn btn-success" type="submit">Listo, guardar</button>
                                  </div>
                                </div>
                                                                    
                              
                            </div>
                        </form>
                   
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
                  
                    
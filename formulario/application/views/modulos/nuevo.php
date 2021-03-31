
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
  
    <div class="header bg-info pb-6">
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
                      <div class="card shadow panel" style="width:100% !important;padding-bottom: 20px;">
                                    <div class="row pt-3 pl-3 pr-3">
                                        <div class="col-md-12">
                                            <form method="post" action="<?=base_url()?>modulos/add">
                                                <div class="form-group">
                                                    <label>Seleccione tabla</label>
                                                    <select class="form-control" name="tabla" onchange="get_campos();" id="tablas">
                                                        <?php
                                                        foreach ($tablas as $tabla) {
                                                            ?>
                                                            <option value="<?=$tabla["tabla"]?>"><?=$tabla["tabla"]?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="table-responsive">
                                                <table class="table align-items-center table-dark table-flush" id="tabla">
                                                        <thead class="thead-dark">
                                                            <th>Campo</th>
                                                            <th>Input</th>
                                                            <th>TextArea</th>
                                                            <th>Imagen</th>
                                                            <th>Select</th>
                                                            <th>CheckBox 1-0</th>
                                                            <th>Etiqueta</th>
                                                            <th>Descartar campo</th>
                                                        </thead>
                                                        <tbody id="tbody">

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="form-group">
                                                    <br>
                                                    <button class="btn btn-info btn-block">Generar módulo</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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
  <?php
    $this->load->view('mensajes');
    $this->load->view('common/js');
    $this->load->view('modulos/custom_js');
  ?>
</body>
</html>

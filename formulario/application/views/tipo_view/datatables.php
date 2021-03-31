
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
                      <div class="col-xl-12 text-right mb-3">
                            <a class="btn btn-success text-white btn-sm" href="<?php echo base_url().'tipo_controller/view_add'; ?>
"><i class="fas fa-plus"></i> Crear nuevo registro</a>
                      </div>    
                      <div class="col-xl-12">
                              <div class="">
                                  <table class="table table-striped" id="tabla">
                                      <thead class="thead-light">
                                          <th>tipo</th><th>type</th><th>html_envoltorio</th><th>html_opcion</th><th>Acciones</th>                                      </thead>
                                      <tbody>
                                      </tbody>
                                  </table>
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
  <?php $this->load->view('mensajes'); ?>
<?php $this->load->view('common/js'); ?>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  
    <!--DATATABLES-->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

    <!--DATATABLES EJEC-->
    <script>
    var dataTable = $('#tabla').DataTable({  
        pageLength: 10,
        "order":[],  
        "processing":true,  
        "serverSide":true,
        "autowidth":true,
        "ajax":{  
             url:'<?php echo base_url().'tipo_controller/ajax_listar'; ?>
',  
             type:"POST"
        },
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "<<",
                "sLast":     ">>",
                "sNext":     ">",
                "sPrevious": "<"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    });  
    </script>
</body>
</html>
 
                              

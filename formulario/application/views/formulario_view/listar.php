<!DOCTYPE html>
<html>
<head>
   <?php $this->load->view('common/css'); ?>
</head>
<body>
  <?php $this->load->view('common/menulateral'); ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- MEN� DE ARRIBA -->
    <?php $this->load->view('common/menu'); ?>
    <!-- END MEN� DE ARRIBA -->

    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-8 col-8">
              <h6 class="h2 text-white d-inline-block mb-0"><?=$formulario["nombre"]?></h6>
            </div>
            <div class="col-4 text-right">
              <?= form_open('formulario_controller/exportar_'); ?>
              <input type="hidden" value="" id="estado" name="estado">
              <input type="hidden" value="<?= $formulario["id"] ?>" id="formulario" name="formulario">
              <button type="submit" class="btn-success btn-small">Exportar</button>
              <?= form_close(); ?>
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
                      <div class="col-xl-3">
                          <div class="form-group">
                            <label class="form-control-label">Estado por defecto</label>
                              <select name="estado_id" id="estado_id" onchange="redraw();" required class="form-control form-control-sm">
                                <option value="">-Todos-</option>
                                <?php
                                  foreach ($estados as $key => $estado) {
                                      ?>
                                        <option value="<?=$estado["id"]?>"><?=$estado["nombre"]?></option>
                                      <?php
                                  }
                                ?>
                              </select>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                      <!-- CONTENIDO -->
                      <div class="col-xl-12">
                              <div class="">
                                  <table class="table table-striped" id="tabla">
                                        <tr>
                                          <thead class="thead-light">
                                            <?php
                                                foreach ($campos as $key => $campo) {
                                                    ?>
                                                    <th><?=$campo["nombre"]?></th>
                                                    <?php
                                                }
                                            ?>
                                            <th>Observaciones</th>
                                            <th>Estado</th>
                                            <?php
                                              if (is_admin(true)) {
                                                ?>
                                                <th>Usuario asignado</th>
                                                <?php
                                              }
                                            ?>
                                            
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                          </thead>
                                        </tr>
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



    <!-- Modal -->
    <div class="modal fade" id="asignar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asignar funcionario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <select class="form-control" id="usuario_id">
                <option value="">Seleccione un funcionario</option>
                <?php
                  foreach ($usuarios as $key => $usuario) {
                     ?>
                     <option value="<?=$usuario["id"]?>"><?=$usuario["nombre"]?></option>
                     <?php
                  }
                ?>
            </select>
            <input type="hidden" value="" id="ingreso_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-success asignar">Asignar</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <!--DATATABLES-->
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>

    <!--DATATABLES EJEC-->
    <script>

    $('.asignar').click(function (e) {
      if ($('#usuario_id').val()=="" || $('#usuario_id').val()==null) {
        notify("Debes seleccionar un usuario",2);
      }else{
        $.ajax({
          type: "get",
          url: "<?=base_url()?>formulario_controller/asignar_usuario/"+$('#ingreso_id').val()+"/"+$('#usuario_id').val(),
          success: function (response) {
              if (response=="true") {
                $('#asignar').modal('hide');
                redraw();
                notify("Usuario asignado con éxito",1);
              }
          }
        });

      }

    });

    function asignar(e){
      //alert($(e).data('id'));
      $('#ingreso_id').val($(e).data('id'));
      $('#asignar').modal('show');
    }

    function redraw(){
      dataTable.clear().draw();
    }

    var dataTable = $('#tabla').DataTable({
        pageLength: 10,
        "order":[],
        "processing":true,
        "serverSide":true,
        "autowidth":true,
        "ordering":false,
        dom: 'lBfrtip',
        buttons: [
            { extend: 'excel',title: 'Emprendedores',className: 'btn btn-success',text:'<i class="fas fa-file-excel"></i> EXCEL'
                ,exportOptions: {
                        columns: [ 0,1,2,3,4 ]
                }
            }
        ],
        "ajax":{
             url:'<?php echo base_url().'formulario_controller/ajax_listar_formulario/'; ?>',
             type:"POST",
             data:{
                 formulario_id:<?=$formulario["id"]?>,
                 estado_id:function() { return $('#estado_id').val() },
             }
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
    $(document).ready(function(){
      $("#estado_id").change(function(){
        $("#estado").val($("#estado_id").val());
      })
    })
    </script>
</body>
</html>



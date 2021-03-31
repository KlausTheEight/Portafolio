
<script type="text/javascript">
                        $( document ).ready(function() {

                          <?php
                             if ($this->session->flashdata('exito')!=null) {
                              ?>
                               $('#modalExito').modal('show')
                              <?php

                             }
                          ?>
                          <?php
                             if ($this->session->flashdata('error')!=null) {
                              ?>
                               $('#modalError').modal('show')
                              <?php

                             }
                          ?>
                          <?php
                          if ($this->session->flashdata('info')!=null) {
                           ?>
                            $('#modalInfo').modal('show')
                           <?php

                          }
                       ?>

                        });
</script>

<div class="modal fade" id="modalExito" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Correcto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-center">
            <i class="fas fa-thumbs-up fa-4x text-gdm"></i>
        </div>
        <br><br>
        <div class="col-md-12 text-center" id="mensaje_exito">
       <?php   echo $this->session->flashdata('exito'); ?>
     </div>
      </div>
      <div class="modal-footer  text-center">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Información</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-center">
            <i class="fas fa-info fa-4x text-info"></i>
        </div>
        <br><br>
        <div class="col-md-12 text-center" id="mensaje_exito">
       <?php   echo $this->session->flashdata('info');?>
     </div>
      </div>
      <div class="modal-footer  text-center">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Error</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 text-center">
            <i class="fas fa-times fa-4x text-red"></i>
        </div>
        <br><br>
        <div class="col-md-12 text-center" id="mensaje_error">
       <?php  echo $this->session->flashdata('error');?>
        </div>
      </div>
      <div class="modal-footer text-center">
        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
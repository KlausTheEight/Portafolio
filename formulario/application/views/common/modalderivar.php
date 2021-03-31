
  <!-- Modal DERIVAR-->
  <div class="modal fade" id="modalDerivar" tabindex="-1" role="dialog" aria-labelledby="modalDerivarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDerivarLabel">Derivar esta solicitud</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form method="post" action="<?=base_url()?>solicitudes/derivar">
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">

                    <div class="form-group">
                      <label class="form-control-label">Seleccione bandeja</label>
                      <select class="form-control" id="bandeja_id" name="bandeja_id" required>
                        <option value="">--Selecciona una bandeja--</option>
                        
                        <?php 
                          foreach ($bandejas as $bandeja) {
                            if (is_admin(true) || is_bandeja_derivacion($bandeja["id"])) {
                              ?>
                              <option value="<?=$bandeja["id"]?>"><?=$bandeja["nombre"]?></option>
                              <?php
                            }
                          }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">¿A quién deseas derivar esta solicitud?</label>
                      <select class="form-control" id="usuario_id" name="usuario_id" required>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">Comentario interno</label>
                      <textarea class="form-control" name="comentario"></textarea>
                    </div>
                    <?php 
                      if (isset($current) && $current!=null) {
                        ?>
                        <input type="hidden" id="current" value="<?=$current?>" name="current">
                        <?php
                      }
                    ?>
                    <input type="hidden" id="id_solicitud" value="" name="id_solicitud">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="success" class="btn btn-success">Derivar</button>
            </div>
         </form>                         
       

      </div>
    </div>
  </div>

   <!-- Modal DERIVAR-->
   <div class="modal fade" id="modalDerivarSolicitudes" tabindex="-1" role="dialog" aria-labelledby="modalDerivarSolicitudesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalDerivarSolicitudesLabel">Derivar solicitudes seleccionadas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form method="post" action="<?=base_url()?>solicitudes/derivar_ids">
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">

                    <div class="form-group">
                      <label class="form-control-label">Seleccione bandeja</label>
                      <select class="form-control" id="bandeja_id_2" name="bandeja_id" required>
                        <option value="">--Selecciona una bandeja--</option>
                        <?php 
                          foreach ($bandejas as $bandeja) {
                            if (is_admin(true) || is_bandeja_derivacion($bandeja["id"])) {
                              ?>
                              <option value="<?=$bandeja["id"]?>"><?=$bandeja["nombre"]?></option>
                              <?php
                            }
                          }
                        ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">¿A quién deseas derivar estas solicitudes?</label>
                      <select class="form-control" id="usuario_id_2" name="usuario_id" required>
              
                      </select>
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">Comentario interno</label>
                      <textarea class="form-control" name="comentario"></textarea>
                    </div>
                    <?php 
                      if (isset($current) && $current!=null) {
                        ?>
                        <input type="hidden" id="current" value="<?=$current?>" name="current">
                        <?php
                      }
                    ?>
                    <input type="hidden" id="ids_solicitudes" value="" name="ids_solicitudes">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="success" class="btn btn-success">Derivar</button>
            </div>
         </form>                         
       

      </div>
    </div>
  </div>

  
  <!-- Modal DERIVAR-->
  <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEliminarLabel">Eliminar esta solicitud</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
         <form method="post" action="<?=base_url()?>solicitudes/eliminar">
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-12 text-center">
                      <strong>¿Realmente deseas eliminar esta solicitud?</strong>
        
                    <?php 
                      if (isset($current) && $current!=null) {
                        ?>
                        <input type="hidden" id="current" value="<?=$current?>" name="current">
                        <?php
                      }
                    ?>
                    <input type="hidden" id="id_solicitud_eliminar" value="" name="id_solicitud">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="success" class="btn btn-danger">Eliminar</button>
            </div>
         </form>                         
       

      </div>
    </div>
  </div>
<div class="modal fade" id="cambioContrasenaModal" tabindex="-1" role="dialog" aria-labelledby="cambioContrasenaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambioContrasenaModalLabel">Cambiar mi contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?= form_open('Usuario_controller/cambio_contrasena'); ?>
      <div class="modal-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Contraseña actual</label>
          <input type="password" name="a_contrasena" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" required="">
          <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Contraseña nueva</label>
          <input type="password" name="n_contrasena" class="form-control nueva_c"aria-describedby="emailHelp" placeholder="" required="">
          <small id="emailHelp" class="form-text text-danger"></small>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Repetir contraseña nueva</label>
          <input type="password" name="z_contrasena" class="form-control nueva_c"aria-describedby="emailHelp" placeholder=""  required="">
          <small id="emailHelp" class="form-text text-danger error_contrasena"></small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
        <button type="submit" class="btn btn-primary" id="submit_cambio_contrasena" disabled="ds">Guardar</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>
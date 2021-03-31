<div class="col-md-12">

<div class="card shadow">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Perfil de usuario</h3>
                </div>
                <div class="col-4 text-right">
                  <a href="<?=base_url()?>usuario_controller/usuariosapp" class="btn btn-sm btn-primary">Ver lista de usuarios</a>
                </div>
              </div>
            </div>
            <div class="card-body">
              <form>
                <h6 class="heading-small text-muted mb-4">Información del usuario</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Nombres</label>
                        <input disabled type="text" id="input-username" class="form-control" placeholder="Username" value="<?=$usuario["nombres"]?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Email</label>
                        <input disabled type="email" id="input-email" class="form-control" placeholder="jesse@example.com" value="<?=$usuario["email"]?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Apellidos</label>
                        <input disabled type="text" id="input-first-name" class="form-control" placeholder="First name" value="<?=$usuario["apellidos"]?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Rut</label>
                        <input disabled type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?=$usuario["rut"]?>">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Pasaporte</label>
                        <input disabled type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?=$usuario["pasaporte"]?>">
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4">
                <!-- Address -->
                <h6 class="heading-small text-muted mb-4">INFORMACIÓN DE CONTACTO</h6>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-first-name">Teléfono</label>
                            <input disabled type="text" id="input-first-name" class="form-control" placeholder="First name" value="<?=$usuario["celular"]?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-last-name">Teléfono de emergencia</label>
                            <input disabled type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?=$usuario["telefono_emergencia"]?>">
                        </div>
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <h6 class="heading-small text-muted mb-4">INFORMACIÓN DE REGISTRO</h6>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Estado</label><br>
                                <?php 
                                    if ($usuario["status"]==1) {
                                        ?>
                                        <span class="badge badge-lg badge-success">Usuario Activo</span>
                                        <?php
                                    }else{
                                        ?>
                                        <span class="badge badge-lg badge-danger">Usuario Inactivo</span>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Aplicación de Origen</label><br>
                                <span class="badge badge-lg badge-primary"><?=$usuario["origen"]?></span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label" for="input-last-name">Fecha de creación</label>
                            <input disabled type="text" id="input-last-name" class="form-control" placeholder="Last name" value="<?=$usuario["fecha_creacion"]?>">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label" for="input-first-name">Token firebase PQM</label><br>
                                <span class="badge badge-lg badge-primary"><?=$usuario["token_firebase"]?></span>
                            </div>
                        </div>          
                    </div>
                </div>
                
                
              </form>
            </div>
          </div>
</div>
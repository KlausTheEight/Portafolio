
<!DOCTYPE html>
<html>


<head>
 <?php $this->load->view('common/css'); ?>
 <script src="https://cdn.tiny.cloud/1/0j4mrgkhxvdew3aghtqgkfq0gw10t84cr5j08xylooc7k1cy/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
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
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Actualizar</h6>
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
                      <a class="btn btn-primary text-white btn-sm" href="<?php echo base_url().'formulario_controller'; ?>"><i class="fas fa-arrow-left"></i> Volver</a>
                    </div>

                    <div class="col-xl-12">
                      <form method="post" action="<?php echo base_url().'formulario_controller/update';?>">
                        <div class="row">
                          <div class="col-md-4">
                            <input type="hidden" name="id" value="<?=$object["id"]?>">
                            <div class="form-group">
                              <label class="form-control-label">NOMBRE DEL FORMULARIO</label>
                              <input required class="form-control" name="nombre" type="text" value="<?=$object["nombre"]?>">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">PROYECTO</label>
                              <select required class="form-control" name="proyecto_id">
                                <?php foreach($lista_proyecto as $option){
                                  ?>
                                  <option <?php echo $object["proyecto_id"] == $option["id"] ? "selected" : "" ?> value="<?php echo $option["id"] ?>"><?php echo $option["nombre"] ?></option>
                                  <?php
                                }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Activar</label>
                              <br>
                              <input name="estado" type="hidden" value="0">
                              <label class="custom-toggle custom-toggle-success">
                                <input type="checkbox" name="estado" <?php if($object["estado"]==1){ echo "checked";} ?> value="1">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                              </label>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Activar formulario por pasos</label>
                              <br>
                              <input name="pasos" type="hidden" value="0">
                              <label class="custom-toggle custom-toggle-success">
                                <input type="checkbox" name="pasos" <?php if($object["pasos"]==1){ echo "checked";} ?> value="1">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                              </label>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">CLASE DEL CONTENEDOR DEL BOTÓN ENVIAR</label>
                              <input required class="form-control" name="clase_contenedor_boton" type="text" value="<?=$object["clase_contenedor_boton"]?>">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">CLASE DEL BOTÓN ENVIAR</label>
                              <input required class="form-control" name="clase_botones" type="text" value="<?=$object["clase_botones"]?>">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Redirección después de enviar</label>
                              <input class="form-control" name="redireccion" type="text" value="<?=$object["redireccion"]?>">
                              <small>Si se deja en blanco se redirigirá al mismo formulario.</small>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Estado por defecto</label>
                              <select name="estado_id"  class="form-control">
                                <option value="">-Seleccione un estado-</option>
                                <?php
                                  foreach ($estados as $key => $estado) {
                                      ?>
                                        <option value="<?=$estado["id"]?>" <?=$object["estado_id"]==$estado["id"] ? 'selected' : ''?>><?=$estado["nombre"]?></option>
                                      <?php
                                  }
                                ?>
                              </select>
                              <small>Define el estado con el que se ingresarán todos los registros</small>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">Enviar un comprobante en correo después de enviar</label>
                              <br>
                              <input name="envia_correo" type="hidden" value="0">
                              <label class="custom-toggle custom-toggle-success">
                                <input type="checkbox" name="envia_correo" <?php if($object["envia_correo"]==1){ echo "checked";} ?> value="1">
                                <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                              </label>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">CAPTCHA WEB</label>
                              <input class="form-control" name="captcha_web" type="text" value="<?=$object["captcha_web"]?>">
                              <small>Clave web.</small>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label class="form-control-label">CAPTCHA SERVIDOR</label>
                              <input class="form-control" name="captcha_servidor" type="text" value="<?=$object["captcha_servidor"]?>">
                              <small>Clave servidor.</small>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">HOJAS DE ESTILO</label>
                              <?php
                                if ($object["css"]==null) {
                                  $object["css"]='<link rel="stylesheet" href="'.base_url().'assets/css/argon.min9f1e.css?v=1.1.0">';
                                }
                              ?>
                              <textarea name="css" class="form-control"><?=$object["css"]?></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">JAVASCRIPTS</label>
                              <textarea name="js" class="form-control"><?=$object["js"]?></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">CSS CUSTOMIZADO</label>
                              <textarea name="css_custom" class="form-control"><?=$object["css_custom"]?></textarea>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="form-control-label">JS CUSTOMIZADO</label>
                              <textarea name="js_custom" class="form-control"><?=$object["js_custom"]?></textarea>
                            </div>
                          </div>

                          <div class="col-md-12 text-center">
                            <div class="form-group mt-3 text-center">
                              <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Guardar</button>
                              <button class="btn btn-outline-dark" type="button" data-toggle="modal" data-target="#modalInsercion"><i class="fas fa-code"></i> Ver código de inserción</button>
                              <a href="<?=base_url()?>formulario_controller/listar/<?=$object["id"]?>" target="_blank" class="btn btn-outline-dark"><i class="fas fa-table"></i> Ver registros</a>
                              <a class="btn btn-outline-primary" target="_blank" href="<?=base_url()?>publico/formulario?id=<?=sha1($object["id"])?>"><i class="fas fa-eye"></i> Ver formulario</a>
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

          <!--SECCION DE CAMPOS-->
          <div class="row">
            <div class="col-xl-12">
              <div class="card card-stats">
                <!-- CARD -->
                <div class="card-body">

                  <div class="row">
                    <!-- CONTENIDO -->
                    <div class="col-md-12">
                      <h3>Secciones
                        <a href="#"  data-toggle="modal" data-target="#modalSeccion"><i class="fas fa-plus text-success"></i></a>
                      </h3>
                    </div>
                    <!-- END CONTENIDO -->
                  </div>

                  <?php
                  foreach ($secciones as $key => $seccion) {
                    ?>
                    <div class="row mb-4">
                      <div class="col-md-12 mt-4 mb-2">
                        <h4>Sección: <strong><?=$seccion["nombre"]?></strong> <a href="#"><i class="fas fa-pencil-alt text-warning"></i></a></h4>
                      </div>
                      <div class="col-md-12">
                        <button data-id="<?=$seccion["id"]?>" class="btn btn-sm btn-success id-seccion" data-toggle="modal" data-target="#modalCampo"><i class="fas fa-plus mr-2"></i>Agregar nuevo campo</button>
                      </div>
                      <div class="col-md-12 mt-2 table-responsive">
                        <table class="table">
                          <tr>
                            <thead class="thead-light">
                              <th>ID</th>
                              <th>Nombre del campo</th>
                              <th>Tipo de campo</th>
                              <th>Único</th>
                              <th>Obligatorio</th>
                              <th>Acciones</th>
                            </thead>
                          </tr>
                          <tbody>
                            <?php
                            foreach ($seccion["campos"] as $campo) {
                              ?>
                              <tr>
                                <td><?=$campo["id"]?></td>
                                <td><?=$campo["nombre"]?></td>
                                <td><?=$campo["tipo"]?></td>
                                <td><?=$campo["unico"]==1 ? 'Si' : 'No'?></td>
                                <td><?=$campo["obligatorio"]==1 ? 'Si' : 'No'?></td>
                                <td>
                                  <a class="mr-2 editar-campo" onclick="editar('<?=$campo["id"]?>');"><i class="fas fa-pencil-alt text-warning"></i></a>
                                  <a data-id="<?=$campo["id"]?>" onclick="eliminar('<?=$campo["id"]?>','campo');" href="#"><i class="fas fa-times text-danger"></i></a>
                                </td>
                              </tr>
                              <?php
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <?php
                  }
                  ?>

                </div>
              </div>
            </div>
          </div>
          <!--END SECCION DE CAMPOS-->

          <!--SECCIÓN ESTADOS--->
          <div class="row">
            <div class="col-xl-12">
              <div class="card card-stats">
                <!-- CARD -->
                <div class="card-body">

                  <div class="row">
                    <!-- CONTENIDO -->
                    <div class="col-md-12">
                      <h3>Estados</h3>
                      <small>Permite categorizar los ingresos realizados en el formulario</small>
                    </div>
                    <!-- END CONTENIDO -->
                  </div>

                  <div class="row mb-4">

                      <div class="col-md-12">
                        <button data-id="<?=$seccion["id"]?>" class="btn btn-sm btn-success id-seccion" data-toggle="modal" data-target="#modalEstado"><i class="fas fa-plus mr-2"></i>Agregar nuevo estado</button>
                      </div>
                      <div class="col-md-12 mt-2 table-responsive">
                        <table class="table">
                          <tr>
                            <thead class="thead-light">
                              <th>ID</th>
                              <th>Nombre del estado</th>
                              <th>Color</th>
                              <th>Acciones</th>
                            </thead>
                          </tr>
                          <tbody>
                            <?php
                              foreach ($estados as $key => $estado) {
                                ?>
                                  <tr>
                                    <td><?=$estado["id"]?></td>
                                    <td><?=$estado["nombre"]?></td>
                                    <td><button class="btn btn-sm text-white" style="background-color:<?=$estado["color"]?>">Color</button></td>
                                    <td>
                                      <a class="mr-2 editar-estado" onclick="editarEstado('<?=$estado["id"]?>');"><i class="fas fa-pencil-alt text-warning"></i></a>
                                      <a data-id="<?=$estado["id"]?>" onclick="eliminar('<?=$estado["id"]?>','estado');" href="#"><i class="fas fa-times text-danger"></i></a>
                                    </td>
                                  </tr>
                                <?php
                              }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                </div>
              </div>
            </div>
          </div>

          <!--SECCIÓN CORREO--->
          <div class="row">
            <div class="col-xl-12">
              <div class="card card-stats">
                <!-- CARD -->
                <div class="card-body">
                  <form action="<?=base_url()?>formulario_controller/update_correo" method="post">
                    <div class="row">
                      <!-- CONTENIDO -->
                      <div class="col-md-12">
                        <h3>Correo electrónico</h3>
                        <small>Permite enviar un correo de respuesta tras llenar el formulario.
                        Solo funcionará cuando la opción <strong>"Enviar un comprobante en correo después de enviar"</strong> esté activada</small>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label">Selecciona el campo de correo de destino</label>
                          <select class="form-control" name="correo_campo_id" required>
                          <option value="">-Selecciona un campo-</option>
                          <?php
                          foreach ($secciones as $key => $seccion) {
                            foreach ($seccion["campos"] as $campo) {
                              ?>
                                <option <?=$object["correo_campo_id"]==$campo["id"] ? 'selected':''?> value="<?=$campo["id"]?>"><?=$campo["nombre"]?></option>
                              <?php
                            }
                          }
                          ?>
                          </select>
                          <small>Si el valor del campo no tiene una dirección de correo válida, el correo no será enviado</small>

                        </div>

                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label">Enviar copia a</label>
                          <input type="text" name="correo_cc" class="form-control" value="<?=$object["correo_cc"]?>">
                          <small>Ingresa uno o más correos separados por PUNTO Y COMA</small>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label">Asunto del correo</label>
                          <input type="text" name="asunto_correo" class="form-control" value="<?=$object["asunto_correo"]?>">
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label">Plantilla de correo electrónico</label>
                          <textarea id="plantilla_correo" name="plantilla_correo" class="form-control plantillas"><?=$object["plantilla_correo"]?></textarea>
                          <small>Puedes insertar valores de los campos dentro de la plantilla con la siguiente sintaxis {{ID_CAMPO}} , ejemplo: si quieres
                          mostrar el campo "Nombre Vecino" y su id es 34, deberás escribir {{34}} donde quieras mostrar este valor</small>
                        </div>

                      </div>
                      <!-- END CONTENIDO -->
                    </div>


                    <div class="row mb-4">
                        <div class="col-md-12">
                          <input type="hidden" name="formulario_id" value="<?=$object["id"]?>">
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--SECCIÓN FICHA PDF--->
          <div class="row">
            <div class="col-xl-12">
              <div class="card card-stats">
                <!-- CARD -->
                <div class="card-body">
                  <form action="<?=base_url()?>formulario_controller/update_pdf" method="post">
                    <div class="row">
                      <!-- CONTENIDO -->
                      <div class="col-md-12">
                        <h3>Ficha PDF</h3>
                        <small>Permite crear una ficha en pdf para cada registro insertado en el formulario.</small>
                      </div>    

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="form-control-label">Plantilla para ficha pdf</label>
                          <textarea id="plantilla_pdf" name="plantilla_pdf" class="form-control plantillas"><?=$object["plantilla_pdf"]?></textarea>
                          <small>Puedes insertar valores de los campos dentro de la plantilla con la siguiente sintaxis {{ID_CAMPO}} , ejemplo: si quieres
                          mostrar el campo "Nombre Vecino" y su id es 34, deberás escribir {{34}} donde quieras mostrar este valor</small>
                        </div>

                      </div>
                      <!-- END CONTENIDO -->
                    </div>


                    <div class="row mb-4">
                        <div class="col-md-12">
                          <input type="hidden" name="formulario_id" value="<?=$object["id"]?>">
                          <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!--SECCIÓN DATA TABLES--->
          <div class="row">
            <div class="col-xl-12">
              <div class="card card-stats">
                <!-- CARD -->
                <div class="card-body">
                  <form method="post" action="<?=base_url()?>formulario_controller/update_thead">
                    <div class="row">
                      <!-- CONTENIDO -->
                      <div class="col-md-12">
                        <h3>Columnas para la tabla de busqueda</h3>
                      </div>
                      <div class="col-md-12">
                        <?php
                        $thead=explode(',',$object["thead"]);
                        foreach ($secciones as $key => $seccion) {
                          foreach ($seccion["campos"] as $campo) {
                            //if ($campo["unico"]==1) {
                              $iid=uniqid();
                              $checked='';
                              foreach ($thead as $t) {
                                if ($t==$campo["id"]) {
                                  $checked="checked";
                                }
                              }
                              ?>
                              <label for="<?=$iid?>">
                                <input id="<?=$iid?>"
                                type="checkbox"
                                name="thead[]"
                                <?=$campo["type"]=="html" ? ' disabled ' : ''?>
                                <?=$checked?>
                                value="<?=$campo["id"]?>"> <strong><?=$campo["nombre"]?></strong></label><br>
                                <?php
                              //}
                            }

                          }
                          ?>
                        </div>
                        <div class="col-md-12">
                          <input type="hidden" name="formulario_id" value="<?=$object["id"]?>">
                          <button class="btn btn-sm btn-warning" type="submit">Actualizar Campos</button>
                          <a href="<?=base_url()?>formulario_controller/listar/<?=$object["id"]?>" target="_blank" class="btn btn-sm btn-outline-dark">Ver tabla</a>
                        </div>
                        <!-- END CONTENIDO -->
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Page content -->
    </div>

    <!-- Modal SECCION-->
    <div class="modal fade" id="modalSeccion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Secciones</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="<?=base_url()?>formulario_controller/add_seccion">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Escriba un nombre para la sección</label>
                    <input class="form-control" name="nombre" type="text" required>
                    <input type="hidden" name="formulario_id" value="<?=$object["id"]?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Modal CAMPO-->
    <div class="modal fade" id="modalCampo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo Campo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="<?=base_url()?>formulario_controller/add_campo">
            <div class="modal-body">
              <div class="row">

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label">Nombre del campo *</label>
                    <input type="text" class="form-control" name="nombre" required>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label">Descripción del campo</label>
                    <input type="text" class="form-control" name="descripcion">
                    <small>Esta descripción se mostrará en un texto pequeño bajo el campo</small>
                  </div>
                </div>

                <div class="col-md-12">
                  <label class="form-control-label">Tipo de campo</label>
                  <select name="tipo_id" class="form-control" id="tipo_id">
                    <?php
                    foreach ($tipos as $keyt => $tipo) {
                      ?>
                      <option value="<?=$tipo["id"]?>"><?=$tipo["tipo"]?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>

                <div class="col-md-12 html" style="display:none;">
                  <div class="form-group">
                    <label class="form-control-label">Código html</label>
                    <textarea class="form-control" name="html" rows="6"></textarea>
                  </div>
                </div>

                <div class="col-md-12 campo">
                  <div class="form-group">
                    <label class="form-control-label">¿Este campo es obligatorio?</label>
                    <br>
                    <label class="custom-toggle custom-toggle-success">
                      <input type="checkbox" name="obligatorio" value="1">
                      <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                    </label>
                  </div>
                </div>

                <div class="col-md-12 campo">
                  <div class="form-group">
                    <label class="form-control-label">¿Este campo es único?</label>
                    <br>
                    <label class="custom-toggle custom-toggle-success">
                      <input type="checkbox" name="unico" value="1">
                      <span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Si"></span>
                    </label>
                  </div>
                </div>

                <div class="col-md-12 campo input-lista">
                  <div class="form-group">
                    <label class="form-control-label">Valores separados por PUNTO Y COMA</label>
                    <input type="text" class="form-control" name="valores">
                  </div>
                </div>

                <div class="col-md-12 campo">
                  <div class="form-group">
                    <label class="form-control-label">Clase</label>
                    <input type="text" class="form-control" name="class" value="form-control">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label">Clase del div contenedor</label>
                    <input type="text" class="form-control" name="class_contenedor" value="col-md-12">
                  </div>
                </div>

                <div class="col-md-12 campo">
                  <div class="form-group">
                    <label class="form-control-label">ID</label>
                    <input type="text" class="form-control" name="identificador">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label">ORDEN</label>
                    <input type="number" class="form-control" name="orden">
                    <small>Prioridad para el mayor número</small>
                  </div>
                </div>

                <div class="col-md-12 campo input-file">
                  <div class="form-group">
                    <label class="form-control-label">Extensiones de archivo permitidas</label>
                    <input type="text" class="form-control" name="extensiones" value="">
                    <small>Separar por | ej:  pdf|jpg|png (solo válido para input tipo archivo</small>
                  </div>
                </div>

                <h2 class="input-tabla">Configuracíon tabla</h2>
                <div class="col-md-12 input-tabla">
                  <div class="form-group">
                    <label class="form-control-label">TÍTULOS <button id="add-agreagar-titulo" type="button" class="btn btn-info btn-sm "><i class="fa fa-plus"></i> Agregar otra fila</button></label>
                    <input type="text" class="form-control" name="tabla_titulos[]">
                    <small id="add-agreagar-titulo-small">Separados por ; si hay dos títulos iguales juntos, se fusionan las celdas</small>
                  </div>
                </div>

                <div class="col-md-12 input-tabla">
                  <div class="form-group">
                    <label class="form-control-label">ETIQUETAS <button id="add-agreagar-etiqueta" type="button" class="btn btn-info btn-sm "><i class="fa fa-plus"></i> Agregar otra columna</button></label>
                    <input type="text" class="form-control" name="tabla_etiquetas[]">
                    <small id="add-agreagar-etiqueta-small">Separados por ; si hay dos etiquetas iguales juntas, se fusionan las celdas</small>
                  </div>
                </div>

                <div class="col-md-6 input-tabla">
                  <div class="form-group">
                    <label class="form-control-label">CANTIDAD DE FILAS</label>
                    <input type="number" class="form-control" name="tabla_total_lineas">
                    <small>Total de datos que serán ingresados</small>
                  </div>
                </div>

                <div class="col-md-6 input-tabla">
                  <div class="form-group">
                    <label class="form-control-label">CANTIDAD DE FILAS OBLIGATORIAS</label>
                    <input type="number" class="form-control" name="tabla_minimo_filas">
                    <small>Mínimo de filas completadas</small>
                  </div>
                </div>

                <div class="col-md-12 input-tabla">
                  <div class="form-group">
                    <label class="form-control-label">PREVISUALIZACION DE LA TABLA <button id="btn-tabla-previsualizacion" class="btn btn-info btn-sm" type="button">Actualizar</button></label>
                    <div id="tabla-previsualizacion"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="seccion_id" id="seccion_id">
              <input type="hidden" name="formulario_id" id="formulario_id" value="<?=$object["id"]?>">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Crear</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal EDITAR CAMPO-->
    <div class="modal fade" id="modalCampoEditar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Campo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="<?=base_url()?>formulario_controller/editar_campo">
            <div class="modal-body">
              <div class="row" id="formulario-campo-editar">
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="formulario_id" id="formulario_id" value="<?=$object["id"]?>">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Inserción-->
    <div class="modal fade" id="modalInsercion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Código de Inserción</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Copia y pega el siguiente código en tu página web dentro de etiquetas script. El contenido se cargará en el elemento que dispongas
              con id <strong>formularioPenalolen</strong></p>
              <textarea class="form-control" style="font-size:12px;color:#red" rows="20">
               <script>
                $(document).ready(function () {
                  $.ajax({
                    type: "get",
                    url: "<?=base_url()?>publico/formulario?id=<?=sha1($object["id"])?>",
                    success: function (response) {
                      $('#formularioPenalolen').html(response);
                    }
                  });

                });
              </script>
            </textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!--MODAL NUEVO ESTADO-->
    <div class="modal fade" id="modalEstado" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nuevo estado</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form method="post" action="<?=base_url()?>formulario_controller/add_estado">
            <div class="modal-body">
              <div class="form-group">
                  <label class="form-control-label">
                  Ingrese el nombre estado
                  </label>
                  <input class="form-control" type="text" name="nombre" required>
              </div>
              <div class="form-group">
                  <label class="form-control-label">
                  Seleccione un color para el estado
                  </label>
                  <input class="form-control" type="color" name="color" required>
              </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="formulario_id" id="formulario_id" value="<?=$object["id"]?>">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--MODAL ESTADO EDITAR-->
    <div class="modal fade" id="modalEstadoEditar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Editar Estado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="<?=base_url()?>formulario_controller/editar_estado">
            <div class="modal-body">
              <div class="row" id="formulario-estado-editar">
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="formulario_id" id="formulario_id" value="<?=$object["id"]?>">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Editar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--MODAL CONFIRMACION ESTADO ELIMINAR-->
    <!-- Button trigger modal -->

    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Atención</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <div class="row">
                <div class="text-center col-md-12">
                  <strong>¿Realmente desea eliminar este registro?</strong>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <a href="" id="enlace-eliminar" class="btn btn-danger">Eliminar</a>
          </div>
        </div>
      </div>
    </div>


    <?php $this->load->view('mensajes'); ?>
    <?php $this->load->view('common/js'); ?>
    <script>

      var secciones = [];
      var secciones_string = '';
      <?php 
        if ($secciones!=null) {
            foreach ($secciones as $key => $seccion) {
                ?>
                secciones.push('<?=$seccion["id"]?>');
                secciones_string=secciones_string+"<?=$seccion["id"]?> ";
                <?php
            }
          }
      ?>

      tinymce.init({
        selector: '.plantillas',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak table code',
        toolbar_mode: 'floating',
        toolbar: 'undo redo | formatselect | bold italic | ' +
                'forecolor backcolor | image | alignleft aligncenter alignright alignjustify | indent outdent | ' +
                'table tableinsertdialog tablecellprops tableprops | fullscreen | code | custom',
        language: 'es',
        menubar: 'custom',
        height: 500, 
        menu: {
          custom: { 
            title: 'Insertar Campo', 
            items: secciones_string
          }
        },
        setup: function (editor) {
        var toggleState = false;


        <?php 
        if ($secciones!=null) {
            foreach ($secciones as $key => $seccion) {
                ?>
                editor.ui.registry.addNestedMenuItem('<?=$seccion["id"]?>', {
                  text: '<?=$seccion["nombre"]?>',
                  getSubmenuItems: function () {
                    return [
                      
                      <?php 
                        foreach ($seccion["campos"] as $key2 => $campo) {
                          ?>
                          {
                            type: 'menuitem',
                            text: '<?=$campo["id"]?> - <?=trim($campo["nombre"])?>',
                            onAction: function () {
                              editor.insertContent('{{<?=$campo["id"]?>}}');
                            }
                          }
                          <?php
                          if (isset($seccion["campos"][$key2+1])) {
                            echo ",";
                          }
                        }
                      ?>
                    ];
                  }
                });
                <?php
            }
          }
        ?>
      }
      });

      $('.id-seccion').click(function (e) {
        $('#seccion_id').val(e.currentTarget.dataset.id);
      });

      function eliminar(e,tipo) {
        var id = e;
        console.log(id);
        switch (tipo) {
          case 'estado':
            $('#enlace-eliminar').attr("href", "<?=base_url()?>formulario_controller/delete_estado/<?=$object["id"]?>/"+id);
          break;

          case 'campo':
            $('#enlace-eliminar').attr("href", "<?=base_url()?>formulario_controller/delete_campo/<?=$object["id"]?>/"+id);
          break;

          default:
          break;
        }
        $('#modalEliminar').modal('show');
      }

      function editar(e) {
        var campo_id = e;
        console.log(campo_id);
        $.ajax({
          type: "get",
          url: "<?=base_url()?>formulario_controller/editar_campo/"+campo_id,
          success: function (response) {
           $('#formulario-campo-editar').empty();
           $('#formulario-campo-editar').append(response);
           $('#modalCampoEditar').modal('show');
         }
       });
      }

      function editarEstado(e) {
        var estado_id = e;
        console.log(estado_id);
        $.ajax({
          type: "get",
          url: "<?=base_url()?>formulario_controller/editar_estado/"+estado_id,
          success: function (response) {
           $('#formulario-estado-editar').empty();
           $('#formulario-estado-editar').append(response);
           $('#modalEstadoEditar').modal('show');
         }
       });
      }

      function vistaFormularioAgregar() {
        $('.campo').show();
        $('.html').hide();

        $('.input-file').hide();
        $("input[name='extensiones']").val("");

        $('.input-lista').hide();
        $("input[name='valores']").val("");

        $(".input-tabla").hide();
        $(".input-tabla").find('input').val("");

        switch($('#tipo_id').val()){
          case "3":
          $('.input-file').show();
          break;
          case "8":
          $('.html').show();
          $('.campo').hide();
          break;
          case "2":
          case "4":
          case "7":
          $(".input-lista").show();
          break;
          default:
          break;
          case "9":
          $(".input-tabla").show();
        }
      }
      vistaFormularioAgregar();
      $("body").on("click", ".eliminar-input", function(){
        $(this).parent().parent().remove();
      })
      $("body").on('change', '#tipo_id', function (e) {
        vistaFormularioAgregar();
      });
      $("body").on('click', '#add-agreagar-titulo', function (e) {
        $('<div class="input-group"><input type="text" class="form-control" name="tabla_titulos[]"><div class="input-group-append"><button class="eliminar-input btn btn-danger" type="button">Eliminar</button></div>').insertBefore("#add-agreagar-titulo-small")
      });

      $("body").on('click', '#add-agreagar-etiqueta', function (e) {
        $('<div class="input-group"><input type="text" class="form-control" name="tabla_etiquetas[]"><div class="input-group-append"><button class="eliminar-input btn btn-danger" type="button">Eliminar</button></div>').insertBefore("#add-agreagar-etiqueta-small")
      });

      /*if(checked) {
        $("input, select, textarea", $(".sometimesHidden")).attr("disabled", "disabled");
      }
      else {
        $("input, select, textarea", $(".sometimesHidden")).removeAttr("disabled");
      }*/
      $("body").on("click", "#btn-tabla-previsualizacion", function(){
        datos = {configuracion:{titulos:[], etiquetas:[], total_lineas:0,}, class: "", identificador: "preview", obligatorio: "0", id: 9999};
        $("input[name='tabla_titulos[]']").each(function(){datos["configuracion"]["titulos"].push(($(this).val().split(';')));})
        $("input[name='tabla_etiquetas[]']").each(function(){datos["configuracion"]["etiquetas"].push(($(this).val().split(';')));})
        datos["configuracion"]["total_lineas"] = $("input[name='tabla_total_lineas']").val();
        console.log(datos);
        $.post( "<?= base_url() ?>formulario_controller/ajax_tabla_previsualizacion", { datos: JSON.stringify(datos) })
        .done(function( data ) {
          $("#tabla-previsualizacion").html(data);
        });
      })
    </script>
  </body>
  </html>


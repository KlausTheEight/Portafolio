<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">Nombre del campo *</label>
    <input type="hidden" name="id" required value="<?=$campo["id"]?>">
    <input type="text" class="form-control" name="nombre" required value="<?=$campo["nombre"]?>">
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">Descripción del campo</label>
    <input type="text" class="form-control" name="descripcion" value="<?=$campo["descripcion"]?>">
    <small>Esta descripción se mostrará en un texto pequeño bajo el campo</small>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">¿Este campo es obligatorio?</label>
    <br>
    <label class="custom-toggle custom-toggle-success">
      <input type="checkbox" name="obligatorio" value="1" <?=$campo["obligatorio"]==1 ? 'checked' : ''?>>
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

<div class="col-md-12">
  <label class="form-control-label">Tipo de campo</label>
  <select name="tipo_id" class="form-control">
          <?php 
            foreach ($tipos as $keyt => $tipo) {
              ?>
                <option value="<?=$tipo["id"]?>" <?=$campo["tipo_id"]==$tipo["id"] ? 'selected' : ''?>><?=$tipo["tipo"]?></option>
              <?php
            }
          ?>
  </select>
</div>

<div class="col-md-12 html">
  <div class="form-group">
    <label class="form-control-label">Código html</label>
    <textarea class="form-control" name="html" rows="6"><?=$campo["html"]?></textarea>
    <small>Válido solo para tipo HTML</small>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">Valores separados por coma</label>
    <input type="text" class="form-control" name="valores" value="<?=$campo["valores"]?>">
    <small>Solo válido para lista desplegable, opción múltiple y alternativa</small>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">Clase</label>
    <input type="text" class="form-control" name="class" value="<?=$campo["class"]?>">
    <small>No válido para tipo HTML</small>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">Clase del div contenedor</label>
    <input type="text" class="form-control" name="class_contenedor" value="<?=$campo["class_contenedor"]?>">
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">ID</label>
    <input type="text" class="form-control" name="identificador" value="<?=$campo["identificador"]?>">
    <small>No válido para tipo HTML</small>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">ORDEN</label>
    <input type="number" class="form-control" name="orden" value="<?=$campo["orden"]?>">
    <small>Prioridad para el mayor número</small>
  </div>
</div>

<div class="col-md-12">
  <div class="form-group">
    <label class="form-control-label">Extensiones de archivo permitidas</label>
    <input type="text" class="form-control" name="extensiones" value="<?=$campo["extensiones"]?>">
    <small>Separar por | ej:  pdf|jpg|png (solo válido para input tipo archivo</small>
  </div>
</div>
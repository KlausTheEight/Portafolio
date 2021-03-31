<div class="col-md-12">
    <div class="form-group">
        <label class="form-control-label">
        Ingrese el nombre estado
        </label>
        <input class="form-control" type="text" name="nombre" value="<?=$estado["nombre"]?>" required>
        <input name="id" type="hidden" value="<?=$estado["id"]?>">
    </div>
    <div class="form-group">
        <label class="form-control-label">
        Seleccione un color para el estado
        </label>
        <input class="form-control" type="color" name="color" value="<?=$estado["color"]?>" required>
    </div>
</div>